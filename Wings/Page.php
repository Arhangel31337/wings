<?php

namespace Wings;

final class Page
{
	public static function getAccess($pageID, $userID = null)
	{
		if (\is_null($userID)) $userID = \Wings::$user->getId();
		
		$query = '
			SELECT
				p.`id`,
				p.`keyLeft`,
				p.`keyRight`,
				p.`level`,
				p.`host`,
				p.`workspace`,
				p.`pageType`,
				p.`alias`,
				p.`URL`,
				MAX(pa.`select`) AS `select`,
				MAX(pa.`insert`) AS `insert`,
				MAX(pa.`update`) AS `update`,
				MAX(pa.`delete`) AS `delete`
			FROM
				`Page` p
			INNER JOIN `access_Page` pa ON p.`id` = pa.`page`
			LEFT OUTER JOIN `link_UserGroup` lgrus ON pa.`group` = lgrus.`group`
			WHERE
				p.`id` = :pageID AND
				(pa.`user` = :userID OR lgrus.`user` = :userID)
			GROUP BY pa.`page`;
		';
		
		$args =
		[
			'pageID' => array($pageID, 'int', 11),
			'userID' => array($userID, 'int', 11)
		];
		
		$result = \Wings\DB::FetchAll($query, $args);
		
		if (\count($result) === 0) return false;
		else return $result[0];
	}
	
	public static function getAccesses($pageID, $langID = null)
	{
		if (\is_null($langID)) $langID = \Wings::$language['id'];
		
		$query = '
			SELECT 
				pa.*,
				CASE WHEN pa.`type` = 1 THEN lgr.`name` ELSE us.`login` END AS `name`
			FROM `access_Pages` pa
			LEFT OUTER JOIN `lang_Groups` lgr ON pa.`groupID` = lgr.`groupID` AND lgr.`langID` = :langID
			LEFT OUTER JOIN `Users` us ON pa.`userID` = us.`id`
			WHERE
				pa.`pageID` = :pageID AND
				(pa.`type` = 1 AND lgr.`langID` IS NOT NULL OR
				pa.`type` = 0 AND lgr.`langID` IS NULL)
			ORDER BY pa.`type` DESC;
		';
		
		$args = [
			'pageID'	=> [$pageID, 'int', 11],
			'langID'	=> [$langID, 'int', 3]
		];
		
		return \Wings\DB::fetchAll($query, $args);
	}
	
	public static function getPageMVC($host, $workspace, $pageURL)
	{
		$query = '
			SELECT
				p.*,
				pt.`MVC` AS `mvc`,
				pt.`method` AS `method`,
				lp.`name`,
				lp.`title`,
				lp.`keywords`,
				lp.`description`
			FROM
				`Page` p
			INNER JOIN `Host` h ON p.`host` = h.`id` AND h.`name` = :host
			INNER JOIN `Workspace` w ON p.`workspace` = w.`id` AND w.`name` = :workspace
			INNER JOIN `PageType` pt ON p.`pageType` = pt.`id`
			INNER JOIN `lang_Page` lp ON p.`id` = lp.`page` AND lp.`lang` = :langID
			WHERE
				p.`URL` = :pageURL AND
				p.`isActive` = 1
			LIMIT 0, 1;
		';
		
		$args =
		[
			'host'		=> [$host, 'str', 31],
			'workspace'	=> [$workspace, 'str', 31],
			'pageURL'	=> [$pageURL, 'str', 255],
			'langID'	=> [\Wings::$language['id'], 'str', 2]
		];
		
		$result = \Wings\DB::FetchAll($query, $args);
		
		if (isset($result[0])) return $result[0];
		else return null;
	}
	
	public static function selectAllAvailable($userID = null, $langID = null, $onlyVisible = true, $onlyDeleted = false)
	{
		if (\is_null($userID)) $userID = \Wings::$user->getId();
		if (\is_null($langID)) $langID = \Wings::$language['id'];
		
		$query = '
			SELECT
				p.*,
				lpt.`name` AS `pageTypeName`,
				MAX(pa.`select`) AS `select`,
				MAX(pa.`insert`) AS `insert`,
				MAX(pa.`update`) AS `update`,
				MAX(pa.`delete`) AS `delete`,
				lp.`name`,
				lp.`title`,
				lp.`keywords`,
				lp.`description`
			FROM
				`User` us
			INNER JOIN `link_UserGroup` lgrus ON us.`id` = lgrus.`user`
			INNER JOIN `Group` gr ON lgrus.`group` = gr.`id`
			LEFT OUTER JOIN `access_Page` pa ON 
				(pa.`type` = 0 AND gr.`id` = pa.`group`) OR 
				(pa.`type` = 1 AND us.`id` = pa.`user`)
		';
		
		if ($onlyDeleted) $query .= 'INNER JOIN `Page` p ON  pa.`page` = p.`id` AND p.`isDeleted` = 1';
		elseif ($onlyVisible) $query .= 'INNER JOIN `Page` p ON  pa.`page` = p.`id` AND p.`isActive` = 1 AND p.`isVisible` = 1 AND p.`isDeleted` = 0';
		else $query .= 'INNER JOIN `Page` p ON  pa.`page` = p.`id`';
		
		$query .= '
			INNER JOIN `PageType` pt ON p.`pageType` = pt.`id`
			INNER JOIN `lang_PageType` lpt ON pt.`id` = lpt.`pageType` AND lpt.`lang` = :langID
			INNER JOIN `Host` h ON p.`host` = h.`id` AND h.`name` = :host
			INNER JOIN `Workspace` w ON p.`workspace` =w.`id` AND w.`name` = :workspace
			INNER JOIN `lang_Page` lp ON p.`id` = lp.`page` AND lp.`lang` = :langID
			WHERE
				us.`id` = :userID
			GROUP BY pa.`page`
			ORDER BY p.`keyLeft`;
		';
		
		$args =
		[
			'host' => array(\Wings::$workspace['host'], 'str', 63),
			'workspace' => array(\Wings::$workspace['name'], 'str', 31),
			'userID' => array($userID, 'int', 11),
			'langID' => array($langID, 'int', 3)
		];
		
		return \Wings\Tree\NestedSets::createTree(\Wings\DB::FetchAll($query, $args));
	}
	
	public static function selectParents($childID, $userID = null, $langID = null)
	{
		if (\is_null($userID)) $userID = \Wings::$user->getId();
		if (\is_null($langID)) $langID = \Wings::$language['id'];
		
		$select =
		[
			'lp.`name`',
			'lp.`title`',
			'lp.`keywords`',
			'lp.`description`'
		];
		
		$join = ['INNER JOIN `lang_Page` lp ON parent.`id` = lp.`page` AND lp.`lang` = :langID'];
		
		$args = ['langID' => [$langID, 'int', 3]];
		
		return \Wings\Tree\NestedSets::selectParents('Page', $childID, $args, $select, $join);
	}
}