<?php

namespace Wings\Tree;

final class NestedSets implements iTree
{
	public static function createTree($result)
	{
		$count = \count($result);
		
		if ($count === 0) return [];
		
		$tree = [];
		$levelPath = [&$tree];
		
		$levelPath[($result[0]['level'] - 1)][] = $result[0];
		
		for ($i = 1; $i < $count; $i++)
		{
			if ($result[$i]['level'] > $result[($i - 1)]['level'])
			{
				$pp = &$levelPath[($result[$i]['level'] - 2)];
				$levelPath[($result[($i)]['level'] - 1)] = &$pp[\count($pp) - 1]['childrens'];
			}
			
			$levelPath[($result[$i]['level'] - 1)][] = $result[$i];
		}
		
		return $tree;
	}
	
	public static function deleteNode($table, $nodeID, $userID = null)
	{
		\Wings\DB::transaction(\Wings\DB::TRANSACTION_START);
		
		\Wings\DB::query('CREATE TEMPORARY TABLE `temporaryTable` (`id` INT(11) NOT NULL);');
		
		$query = '
			INSERT INTO `temporaryTable` (
				SELECT
					children.`id`
				FROM
					`' . $table . '` parent
				JOIN `' . $table . '` children ON children.`keyLeft` BETWEEN parent.`keyLeft` AND parent.`keyRight`
				WHERE parent.`id` = :id
			);
		';
		\Wings\DB::query($query, ['id' => [$access['id'], 'int', 11]]);
		
		\Wings\DB::query('SET SQL_SAFE_UPDATES = 0;');
		
		\Wings\DB::query('DELETE FROM `' . $table . '` WHERE `id` IN (SELECT `id` FROM `temporaryTable`);');
		
		$query = '
			UPDATE `' . $table . '`
			SET
				`keyLeft` = IF(`keyLeft` > :keyLeft, `keyLeft` - (:keyRight - :keyLeft + 1), `keyLeft`),
				`keyRight` = `keyRight` - (:keyRight - :keyLeft + 1)
			WHERE `keyRight` > :keyRight;
		';
		$args =
		[
			'keyLeft'	=> [$access['keyLeft'], 'int', 11],
			'keyRight'	=> [$access['keyRight'], 'int', 11]
		];
		\Wings\DB::query($query, $args);

		\Wings\DB::query('SET SQL_SAFE_UPDATES = 1;');
		
		\Wings\DB::query('DROP TABLE `temporaryTable`;');
		
		\Wings\DB::transaction();
	}
	
	public static function getNode($table, $nodeID)
	{
		return \Wings\DB::select($table, '*', ['id' => '='], ['id' => [$nodeID, 'int', 11]])[0];
	}
	
	public static function insertNode($table, $parentID, $args)
	{
		$node = \Wings\DB::select($table, '*', ['id' => '='], ['id' => [$parentID, 'int', 11]])[0];
		
		\Wings\DB::transaction(\Wings\DB::TRANSACTION_START);
		
		\Wings\DB::query('SET SQL_SAFE_UPDATES = 0;');
		
		$query = '
			UPDATE `' . $table . '`
			SET
				`keyLeft` = CASE WHEN `keyLeft` > :keyRight THEN `keyLeft` + 2 ELSE `keyLeft` END,
				`keyRight` = `keyRight` + 2
			WHERE `keyRight` >= :keyRight
			ORDER BY `keyRight` DESC;
		';
		\Wings\DB::query($query, ['keyRight' => [$node['keyRight'], 'int', 11]]);
		
		\Wings\DB::query('SET SQL_SAFE_UPDATES = 1;');

		$args +=
		[
			'keyLeft'		=> [$node['keyRight'] - 0, 'int', 11],
			'keyRight'		=> [($node['keyRight'] + 1), 'int', 11],
			'level'			=> [($node['level'] + 1), 'int', 11]
		];
		
		$id = \Wings\DB::insert($table, $args);
		
		\Wings\DB::transaction();
		
		return $id;
	}
	
	public static function selectAll($table, $select = '*', $addJoin = '', $addArgs = [])
	{
		$query = 'SELECT ';
		if ($select === '*') $query .= $select;
		else $query .= '`' . $table . '`.`level`, ' . $select;
		
		$query .= ' FROM `' . $table . '`';
		
		if (!empty($addJoin)) $query .= ' ' . $addJoin;
		
		$query .= ' ORDER BY `' . $table . '`.`keyLeft`;';
		
		return self::createTree(\Wings\DB::FetchAll($query, $addArgs));
	}
	
	public static function selectChildrens($table, $parentID, $userID = null, $langID = null)
	{
		if (\is_null($userID)) $userID = \Wings::$user->getId();
		if (\is_null($langID)) $langID = \Wings::$language['id'];
		
		$query = '
			SELECT
				children.*,
				MAX(pa.`select`) AS `select`,
				MAX(pa.`insert`) AS `insert`,
				MAX(pa.`update`) AS `update`,
				MAX(pa.`delete`) AS `delete`,
				lp.`name`,
				lp.`title`,
				lp.`keywords`,
				lp.`description`
			FROM
				`' . $table . '` parent
			INNER JOIN `' . $table . '` children ON children.`keyLeft` BETWEEN parent.`keyLeft` AND parent.`keyRight` AND children.`isActive` = 1 AND children.`isVisible` = 1 AND children.`isDeleted` = 0
			INNER JOIN `Hosts` h ON children.`hostID` = h.`id` AND h.`name` = :host
			INNER JOIN `Workspaces` w ON children.`workspaceID` =w.`id` AND w.`name` = :workspace
			INNER JOIN `access_Pages` pa ON children.`id` = pa.`pageID`
			LEFT OUTER JOIN `links_GroupsUsers` lgrus ON pa.`groupID` = lgrus.`groupID`
			INNER JOIN `lang_Pages` lp ON children.`id` = lp.`pageID` AND lp.`langID` = :langID
			WHERE
				parent.`id` = :parentID AND
				(pa.`userID` = :userID OR lgrus.`userID` = :userID)
			GROUP BY pa.`pageID`
			ORDER BY children.`keyLeft` ASC;
		';
		
		$args =
		[
			'host' => [\Wings::$workspace['host'], 'str', 63],
			'workspace' => [\Wings::$workspace['name'], 'str', 31],
			'parentID' => [$parentID, 'int', 11],
			'userID' => [$userID, 'int', 11],
			'langID' => [$langID, 'int', 3]
		];
		
		return \Wings\DB::FetchAll($query, $args);
	}
	
	public static function selectCurrentBranch($table, $nodeID, $userID = null, $langID = null)
	{
		$query = '
			SELECT
				nodes.*,
				MAX(pa.`select`) AS `select`,
				MAX(pa.`insert`) AS `insert`,
				MAX(pa.`update`) AS `update`,
				MAX(pa.`delete`) AS `delete`,
				lp.`name`,
				lp.`title`,
				lp.`keywords`,
				lp.`description`
			FROM
				`' . $table . '` node
			JOIN `' . $table . '` nodes ON node.`keyLeft` <= nodes.`keyRight` AND node.`keyRight` >= nodes.`keyLeft` AND node.`isActive` = 1 AND node.`isVisible` = 1 AND node.`isDeleted` = 0
			INNER JOIN `Hosts` h ON nodes.`hostID` = h.`id` AND h.`name` = :host
			INNER JOIN `Workspaces` w ON nodes.`workspaceID` =w.`id` AND w.`name` = :workspace
			INNER JOIN `access_Pages` pa ON nodes.`id` = pa.`pageID`
			LEFT OUTER JOIN `links_GroupsUsers` lgrus ON pa.`groupID` = lgrus.`groupID`
			INNER JOIN `lang_Pages` lp ON nodes.`id` = lp.`pageID` AND lp.`langID` = :langID
			WHERE
				node.`id` = :nodeID AND
				(pa.`userID` = :userID OR lgrus.`userID` = :userID)
			GROUP BY pa.`pageID`
			ORDER BY nodes.`keyLeft` ASC;
		';
		
		$args =
		[
			'host' => [\Wings::$workspace['host'], 'str', 63],
			'workspace' => [\Wings::$workspace['name'], 'str', 31],
			'nodeID' => [$nodeID, 'int', 11],
			'userID' => [$userID, 'int', 11],
			'langID' => [$langID, 'int', 3]
		];
		
		return self::createTree(\Wings\DB::FetchAll($query, $args));
	}
	
	public static function selectParents($table, $childID, $args = [], $select = [], $join = [], $where = [], $group = [])
	{
		$query = 'SELECT parent.*';
		if (!empty($select)) $query .= ',' . \implode(',', $select);
		$query .= "\n" . 'FROM `' . $table . '` child JOIN `' . $table . '` parent ON (child.`keyLeft` BETWEEN parent.`keyLeft` AND parent.`keyRight`)';
		if (!empty($join)) $query .= "\n" . \implode("\n", $join);
		$query .= "\n" . 'WHERE child.`id` = :childID';
		if (!empty($where)) $query .= "AND \n" . \implode("AND \n", $where);
		if (!empty($group)) $query .= "GROUP BY " . \implode(", ", $group);
		$query .= "\n" . 'ORDER BY parent.`keyLeft` ASC;';
		
		$args = \array_merge(['childID' => [$childID, 'int', 11]], $args);
		
		return \Wings\DB::FetchAll($query, $args);
	}
	
	public static function updateNode($table, $nodeID, $parentID, $nearNodeID)
	{
		$node = self::getNode($table, $nodeID);
		$parent = self::getNode($table, $parentID);
		$nearNode = self::getNode($table, $nearNodeID);
		
		$keyLeft = $node['keyLeft'];
		$keyRight = $node['keyRight'];
		
		$nearKeyRight = $nearNode['keyRight'];
		if ($parentID === $nearNodeID) $nearKeyRight = $parent['keyLeft'];
		
		$skewLevel = $parent['level'] - $node['level'] + 1;
		$skewTree = $keyRight - $keyLeft + 1;
		
		if ($nearKeyRight < $keyRight)
		{
			$skewEdit = $nearKeyRight - $keyLeft + 1;
			
			$query = '
				UPDATE `' . $table . '`
				SET
					`keyRight` =
						IF(`keyLeft` >= :keyLeft,
							`keyRight` + :skewEdit,
							IF(`keyRight` < :keyLeft,
								`keyRight` + :skewTree,
								`keyRight`
							)
						),
					`level` =
						IF(`keyLeft` >= :keyLeft,
							`level` + :skewLevel,
							`level`
						),
					`keyLeft` =
					IF(`keyLeft` >= :keyLeft,
						`keyLeft` + :skewEdit,
						IF(`keyLeft` > :nearKeyRight,
							`keyLeft`+ :skewTree,
							`keyLeft`
						)
					)
				WHERE
					`keyRight` > :nearKeyRight AND
					`keyLeft` < :keyRight;
			';
		}
		else
		{
			$skewEdit = $nearKeyRight - $keyLeft + 1 - $skewTree;
			
			$query = '
				UPDATE `' . $table . '`
				SET
					`keyLeft` =
						IF(`keyRight` <= :keyRight,
							`keyLeft` + :skewEdit,
							IF(`keyLeft` > :keyRight,
								`keyLeft` - :skewTree,
								`keyLeft`
							)
						),
					`level` =
						IF(`keyRight` <= :keyRight,
							`level` + :skewLevel,
							`level`
						),
					`keyRight` =
						IF(`keyRight` <= :keyRight,
							`keyRight` + :skewEdit,
							IF(`keyRight` <= :nearKeyRight,
								`keyRight` - :skewTree,
								`keyRight`)
						)
				WHERE
					`keyRight` > :keyLeft AND
					`keyLeft` <= :nearKeyRight;
			';
		}
		\Wings\DB::transaction(\Wings\DB::TRANSACTION_START);
		
		$args =
		[
			'keyLeft'		=> [$keyLeft, 'int', 11],
			'keyRight'		=> [$keyRight, 'int', 11],
			'nearKeyRight'	=> [$nearKeyRight, 'int', 11],
			'skewEdit'		=> [$skewEdit, 'int', 11],
			'skewTree'		=> [$skewTree, 'int', 11],
			'skewLevel'		=> [$skewLevel, 'int', 11]
		];
		
		\Wings\DB::query($query, $args);
		
		\Wings\DB::transaction();
	}
}