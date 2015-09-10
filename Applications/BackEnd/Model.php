<?php

namespace Applications\BackEnd;

class Model
{
	protected static $links		= [];
	protected static $multilang	= [];
	protected static $tree		= '';
	public static $words		= [];
	
	public static function delete($id)
	{
		$wheres = ['id' => '='];
		$args = ['id' => [$id, 'int', 11]];
		
		\Wings\DB::delete(self::getTable(), $wheres, $args);
	}
	
	public static function getAll($model = null)
	{
		if (is_null($model)) $model = '\\' . \get_called_class();
		
		list($columns, $joins) = self::getColumnsAndJoins($model, true);
		
		self::setFieldsNames($model);
		
		if ($model::$tree !== '') $result = \Wings\Tree\NestedSets::selectAll($model::$table, $columns, $joins);
		else
		{
			$query = 'SELECT ' . $columns . ' FROM `' . $model::$table . '`' . $joins;
			$result = \Wings\DB::fetchAll($query);
		}
		
		if (!empty($model::$multilang)) $result = self::setLanguageFields($model, $result);
		
		return $result;
	}
	
	public static function getByID($id)
	{
		$model = '\\' . \get_called_class();
		
		list($columns, $joins) = self::getColumnsAndJoins($model);
		
		$query = 'SELECT ' . $columns . ' FROM `' . self::getTable() . '` ' . $joins . ' WHERE `' . self::getTable() . '`.`id` = :id';
		
		$args = ['id' => [$id, 'int', 11]];
		
		$result = \Wings\DB::fetchAll($query, $args);
		
		if (!isset($result[0])) return null;
		
		if (!empty($model::$links))
		{
			foreach ($model::$links as $link)
			{
				$name = \strtolower($link);
		
				$model::$columns[$name] =
				[
					'field'		=> ['type'	=> 'multiselect'],
					'key'		=> 'parent',
					'type'		=> ['int', 11]
				];
		
				$linkModel = \explode('\\', \get_called_class());
				$linkModel[(\count($linkModel) - 2)] = $link;
				$linkModel = '\\' . \implode('\\', $linkModel);
		
				$link = \str_replace($model::$table, $link, $model);
				
				$result[0][$name] = self::getLinkData($model, $link, $id);
			}
		}
		
		$fields = self::setFieldsNames($model);
		
		if (empty($model::$multilang)) return $result[0];
		
		$item =
		[
			'id'		=> $result[0]['id'],
			'code'		=> $result[0]['code'],
			'nameEn'	=> $result[0]['nameEn']
		];
		
		foreach ($model::$multilang as $column)
		{
			foreach ($result as $el)
			{
				$key = $column . '[' . $el['lang'] . ']';
				
				$item[$key] = $el['lang_' . $column];
				$model::$columns[$key] = $model::$columns[$column];
				
				$model::$columns[$key]['key'] = $column . '[' . $el['lang'] . ']';
				$model::$columns[$key]['name'] = $fields[$column] . ' (' . $el['nameEn'] . ')';
				
				if ($el['lang'] == \Wings::$language['id']) $item[$column] = $el['lang_' . $column];
			}
			
			unset($model::$columns[$column]);
		}
		
		return $item;
	}
	
	private static function getColumnsAndJoins($model, $isList = false)
	{
		$columns = [];
		$joins = [];
		
		foreach ($model::$columns as $key => $column)
		{
			if (in_array($key, $model::$multilang)) continue;
			
			if (isset($column['field']['isConfirm']) && $column['field']['isConfirm'] === true) continue;
				
			if (isset($column['alterTable']))
			{
				$alt = $column['alterTable'];
				$tableAdd = $alt['name'] . $key;
		
				$columns[] = '`' . $tableAdd . '`.`' . $alt['field'] . '` AS `' . $column['key'] . '`';
		
				$joins[] = 'INNER JOIN `' . $alt['name'] . '` ' . $tableAdd . ' ON `' . $model::$table . '`.`' . $alt['key1'] . '` = ' . $tableAdd . '.`' . $alt['key2'] . '`';
			}
			else $columns[] = '`' . $model::$table . '`.`' . $key . '`';
		}
		
		if (!empty($model::$multilang))
		{
			$columns[] = '`Language`.`id` AS `lang`';
			$columns[] = '`Language`.`code` AS `code`';
			$columns[] = '`Language`.`nameEn` AS `nameEn`';
			
			foreach ($model::$multilang as $field) $columns[] = '`lang_' . $model::$table . '`.`' . $field . '` AS `lang_' . $field . '`';
			
			$join = 'INNER JOIN `lang_' . $model::$table . '` ON `' . $model::$table . '`.`id` = `lang_' . $model::$table . '`.`' . lcfirst($model::$table) . '`';
			
			if ($isList) $join .= ' AND `lang_' . $model::$table . '`.`lang` = ' . \Wings::$language['id'];
			
			$joins[] = $join;
			$joins[] = 'INNER JOIN `Language` ON `lang_' . $model::$table . '`.`lang` = `Language`.`id`';
		}
		
		return [\implode(', ', $columns), \implode(' ', $joins)];
	}
	
	private static function getFieldsNames($model)
	{
		$fields = \array_unique(\array_merge(\array_keys($model::$columns), $model::$multilang));
		
		$fields = '\'' . implode('\', \'', $fields) . '\'';
		
		$query = '
			SELECT
				f.`name`,
    			lf.`name` AS `value`
			FROM `Field` f
			INNER JOIN `lang_Field` lf ON
				f.`id` = lf.`field` AND
			    lf.`lang` = ' . \Wings::$language['id'] . '
			WHERE f.`name` IN (' . $fields . ');
		';
		
		$result = \Wings\DB::fetchAll($query);
		
		$fields = [];
		
		foreach ($result as $row) $fields[$row['name']] = $row['value'];
		
		return $fields;
	}
	
	private static function getLinkData($model, $linkModel, $id = 0)
	{
		$links = self::getAll($linkModel);
		
		$query =
		'
			SELECT
				t.`id`,
				lt.`' . \strtolower($model::$table) . '` AS ltid
			FROM `' . $linkModel::$table . '` t
			LEFT OUTER JOIN `link_' . $model::$table . $linkModel::$table . '` lt ON
				t.`id` = lt.`' . \strtolower($linkModel::$table) . '` AND
				lt.`' . \strtolower($model::$table) . '` = ' . $id . ';
		';
		
		$result = \Wings\DB::fetchAll($query);
		
		$issets = [];
		
		foreach ($result as $row) $issets[$row['id']] = $row['ltid'];
		
		$links = \treeToArray($links);
		
		usort($links, function ($a, $b) {
			return strcmp($a['name'], $b['name']);
		});
		
		foreach ($links as &$value)
		{
			if (is_null($issets[$value['id']])) $value['selected'] = false;
			else $value['selected'] = true;
		}
		
		return $links;
	}
	
	private static function getParents($model)
	{
		$parents = self::getAll($model);
	}
	
	public static function getTable()
	{
		$model = '\\' . \get_called_class();
		
		return $model::$table;
	}
	
	public static function insert()
	{
		$model = '\\' . \get_called_class();
		
		$args = [];
		
		foreach ($model::$columns as $key => $column)
		{
			if (isset($column['generated']) && $column['generated'] === true && !isset($column['default'])) continue;
			if (isset($column['field']['isConfirm']) && $column['field']['isConfirm'] === true) continue;
			if (in_array($key, $model::$multilang)) continue;
			
			if (isset($column['default']))
			{
				switch ($column['default'])
				{
					case 'now':
						$args[$key] = [\date('Y-m-d H:i:s'), $column['type'][0], $column['type'][1]];
						break;
					default:
						$args[$key] = [$column['default'], $column['type'][0], $column['type'][1]];
						break;
				}
			}
			else
			{
				if ($column['field']['type'] === 'checkbox')
				{
					if (isset(\Wings::$post[$key])) $args[$key] = [1, $column['type'][0], $column['type'][1]];
					else $args[$key] = [0, $column['type'][0], $column['type'][1]];
				}
				else $args[$key] = [\Wings::$post[$key], $column['type'][0], $column['type'][1]];
			}
		}
		
		if (!empty($model::$tree)) $id = \Wings\Tree\NestedSets::insertNode($model::$table, \Wings::$post['parent'], $args);
		else $id = \Wings\DB::insert($model::$table, $args);
		
		if (!empty($model::$multilang))
		{
			$table = 'lang_' . $model::$table;
			$column = lcfirst($model::$table);
			
			$argss = [];
			
			foreach ($model::$multilang as $field)
			{
				foreach (\Wings::$post[$field] as $lang => $value)
				{
					if (!isset($argss[$lang]))
					{
						$argss[$lang] =
						[
							'lang'	=> [$lang, 'int', 3],
							$column	=> [$id, 'int', 11]
						];
					}
					
					$argss[$lang][$field] = [$value, $model::$columns[$field]['type'][0], $model::$columns[$field]['type'][1]];
				}
			}
			
			foreach ($argss as $args) \Wings\DB::insert($table, $args);
		}
		
		if (!empty($model::$links))
		{
			foreach ($model::$links as $link)
			{
				$arg1 = \strtolower($model::$table);
				$arg2 = \strtolower($link);
				$table = 'link_' . $model::$table . $link;
				
				foreach (\Wings::$post[$arg2] as $value)
				{
					$args =
					[
						$arg1	=> [$id, 'int', 11],
						$arg2	=> [$value, 'int', 11]
					];
					\Wings\DB::insert($table, $args);
				}
			}
		}
	}
	
	public static function move($model, $nodeID, $parentID, $nearNodeID)
	{
		if (!empty($model::$tree))
		{
			$tree = '\\Wings\\Tree\\' . $model::$tree;
			$tree::updateNode($model::$table, $nodeID, $parentID, $nearNodeID);
		}
		else ;
	}
	
	public static function prepareModel()
	{
		$model = '\\' . \get_called_class();
		
		$result = [];
		
		if (!empty($model::$tree))
		{
			$result['parent'] = self::getAll($model);
			
			$field =
			[
				'field'		=> ['type'	=> 'select'],
				'key'		=> 'parent',
				'type'		=> ['int', 11]
			];
			
			$model::$columns = \array_slice($model::$columns, 0, 1, true) + ['parent' => $field] + \array_slice($model::$columns, 1, null, true);
		}
		
		if (!empty($model::$links))
		{
			foreach ($model::$links as $link)
			{
				$name = \strtolower($link);
				
				$model::$columns[$name] =
				[
					'field'		=> ['type'	=> 'multiselect'],
					'key'		=> 'parent',
					'type'		=> ['int', 11]
				];
				
				$linkModel = \explode('\\', \get_called_class());
				$linkModel[(\count($linkModel) - 2)] = $link;
				$linkModel = '\\' . \implode('\\', $linkModel);
				
				$link = \str_replace($model::$table, $link, $model);
				
				$result[$name] = self::getLinkData($model, $link);
			}
		}
		
		if (!empty($model::$multilang)) self::setLanguages($model);
		
		self::setFieldsNames($model);
		
		return $result;
	}
	
	public static function setFieldsNames($model = null)
	{
		if (is_null($model)) $model = '\\' . \get_called_class();
		
		$fields = self::getFieldsNames($model);
		
		foreach ($model::$columns as $key => &$value)
		{
			if (!isset($value['name'])) $value['name'] = $fields[$key];
		}
		
		return $fields;
	}
	
	private static function setLanguageFields($model, $result)
	{
		foreach ($model::$multilang as $column)
		{
			foreach ($result as &$el)
			{
				if ($el['lang'] == \Wings::$language['id']) $el[$column] = $el['lang_' . $column];
				
				if (isset($el['childrens'])) $el['childrens'] = self::setLanguageFields($model, $el['childrens']);
			}
		}
		
		return $result;
	}
	
	private static function setLanguages($model = null)
	{
		if (is_null($model)) $model = '\\' . \get_called_class();
		
		$languages = \Wings\DB::select('Language', '`id`, `nameEn`', null, null, '`id` ASC');
		
		$fields = self::getFieldsNames($model);
		
		foreach ($model::$multilang as $column)
		{
			foreach ($languages as $language)
			{
				$key = $column . '[' . $language['id'] . ']';
				
				$model::$columns[$key] = $model::$columns[$column];
				
				$model::$columns[$key]['key'] = $column . '[' . $language['id'] . ']';
				$model::$columns[$key]['name'] = $fields[$column] . ' (' . $language['nameEn'] . ')';
			}
			
			unset($model::$columns[$column]);
		}
	}
	
	public static function setWords()
	{
		$query = '
			SELECT
				lt.`add`, 
			    lt.`change`, 
			    lt.`item`, 
			    lt.`list`
			FROM `Table` t
			INNER JOIN `lang_Table` lt ON
				t.`id` = lt.`table` AND 
				lt.`lang` = :lang
			WHERE t.`name` = :name
			LIMIT 0, 1;
		';
		$args =
		[
			'lang'	=> [\Wings::$language['id'], 'int', 3],
			'name'	=> [self::getTable(), 'str', 63]
		];
		
		self::$words = \Wings\DB::fetchRow($query, $args);
	}
	
	public static function update()
	{
		$id = \Wings::$post['id'];
		
		$model = '\\' . \get_called_class();
		
		$args = [];
		
		foreach ($model::$columns as $key => $column)
		{
			if (isset($column['generated']) && $column['generated'] === true) continue;
			if (isset($column['field']['isConfirm']) && $column['field']['isConfirm'] === true) continue;
			if (in_array($key, $model::$multilang)) continue;
			
			$args[$key] = [\Wings::$post[$key], $column['type'][0], $column['type'][1]];
		}
		
		if (\count($args) > 0)
		{
			$args['id'] = [$id, $column['type'][0], $column['type'][1]];
			
			\Wings\DB::update(self::getTable(), $args);
		}
		
		if (!empty($model::$multilang))
		{
			$table = 'lang_' . $model::$table;
			$column = lcfirst($model::$table);
			
			\Wings\DB::delete($table, [$column => '='], [$column => [$id, 'int', 11]]);
			
			$argss = [];
			
			foreach ($model::$multilang as $field)
			{
				foreach (\Wings::$post[$field] as $lang => $value)
				{
					if (!isset($argss[$lang]))
					{
						$argss[$lang] =
						[
							'lang'	=> [$lang, 'int', 3],
							$column	=> [$id, 'int', 11]
						];
					}
					
					$argss[$lang][$field] = [$value, $model::$columns[$field]['type'][0], $model::$columns[$field]['type'][1]];
				}
			}
			
			foreach ($argss as $args) \Wings\DB::insert($table, $args);
		}
		
		if (!empty($model::$links))
		{
			foreach ($model::$links as $link)
			{
				$arg1 = \strtolower($model::$table);
				$arg2 = \strtolower($link);
				$table = 'link_' . $model::$table . $link;
				
				\Wings\DB::delete($table, [$arg1 => '='], [$arg1 => [$id, 'int', 11]]);
				
				foreach (\Wings::$post[$arg2] as $value)
				{
					$args =
					[
						$arg1	=> [$id, 'int', 11],
						$arg2	=> [$value, 'int', 11]
					];
					\Wings\DB::insert($table, $args);
				}
			}
		}
	}
}