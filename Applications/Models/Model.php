<?php

namespace Applications\Models;

abstract class Model
{
	public	static	$columns	= [];
	public	static	$links		= [];
	public	static	$multilang	= [];
	public	static	$table		= '';
	public	static	$tree		= '';
	public	static	$type		= 'list';
	public	static	$words		= [];
	
	public	$model;
	
	public function __construct()
	{
		$this->setWords();
	}
	
	public function delete($id, $model = null)
	{
		if (\is_null($model)) $model = $this;
		
		$wheres = ['id' => '='];
		$args = ['id' => [$id, 'int', 11]];
		
		\Wings\DB::delete($model::$table, $wheres, $args);
	}
	
	public function getAll($model = null)
	{
		if (\is_null($model)) $model = $this;
		
		list($columns, $joins) = $this->getColumnsAndJoins($model, true);
		
		$this->setFieldsNames();
		
		if ($model::$tree !== '') $result = \Wings\Tree\NestedSets::selectAll($model::$table, $columns, $joins);
		else
		{
			$query = 'SELECT ' . $columns . ' FROM `' . $model::$table . '`' . $joins;
			$result = \Wings\DB::fetchAll($query);
		}
		
		if (!empty($model::$multilang)) $result = $this->setLanguageFields($result);
		
		return $result;
	}
	
	public function getByID($id, $model = null)
	{
		if (\is_null($model)) $model = $this;
		
		list($columns, $joins) = $this->getColumnsAndJoins();
		
		$query = 'SELECT ' . $columns . ' FROM `' . $model::$table . '` ' . $joins . ' WHERE `' . $model::$table . '`.`id` = :id';
		
		$args = ['id' => [$id, 'int', 11]];
		
		$result = \Wings\DB::fetchAll($query, $args);
		
		if (!isset($result[0])) return null;
		
		if (!empty($model::$links))
		{
			foreach ($model::$links as $link)
			{
				$name = \strtolower($link);
				
				$linkModel = \explode('\\', \get_called_class());
				$linkModel[(\count($linkModel) - 2)] = $link;
				$linkModel = '\\' . \implode('\\', $linkModel);
				
				$result[0][$name] = $this->getLinkData('\\Applications\\Models\\' . $link, $id);
			}
		}
		
		$fields = $this->setFieldsNames();
		
		if (empty($model::$multilang)) return $result[0];
		
		$item =
		[
			'id'		=> $result[0]['id'],
			'code'		=> $result[0]['code'],
			'nameEn'	=> $result[0]['nameEn']
		];
		
		foreach ($model::$multilang as $column)
		{
			foreach ($result as $i => $el)
			{
				$key = $column . '[' . $el['lang'] . ']';
				
				$item[$key] = $el[$column];
				$model::$columns[$key] = $model::$columns[$column];
				
				$model::$columns[$key]['key'] = $key;
				$model::$columns[$key]['name'] = $fields[$column] . ' (' . $el['nameEn'] . ')';
				if ($model::$columns[$key]['turn'] > 9) $model::$columns[$key]['turn'] = (int)(1 . $i . $model::$columns[$key]['turn']);
				else $model::$columns[$key]['turn'] = (int)(1 . $i . '0' . $model::$columns[$key]['turn']);
				
				if ($el['lang'] == \Wings::$language['id']) $item[$column] = $el[$column];
			}
			
			unset($model::$columns[$column]);
		}
		
		return $item;
	}
	
	private function getColumnsAndJoins($model = null, $isList = false)
	{
		if (\is_null($model)) $model = $this;
		
		$columns = [];
		$joins = [];
		
		foreach ($model::$columns as $key => $column)
		{
			if (in_array($key, $model::$multilang) || $column['field'] === 'multiselect') continue;
				
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
			
			foreach ($model::$multilang as $field) $columns[] = '`lang_' . $model::$table . '`.`' . $field . '` AS `' . $field . '`';
			
			$join = 'INNER JOIN `lang_' . $model::$table . '` ON `' . $model::$table . '`.`id` = `lang_' . $model::$table . '`.`' . lcfirst($model::$table) . '`';
			
			if ($isList) $join .= ' AND `lang_' . $model::$table . '`.`lang` = ' . \Wings::$language['id'];
			
			$joins[] = $join;
			$joins[] = 'INNER JOIN `Language` ON `lang_' . $model::$table . '`.`lang` = `Language`.`id`';
		}
		
		return [\implode(', ', $columns), \implode(' ', $joins)];
	}
	
	private function getFieldsNames($model = null)
	{
		if (\is_null($model)) $model = $this;
		
		$fields = \array_unique(\array_merge(\array_keys($model::$columns), $model::$multilang));
		
		$fields = '\'' . \implode('\', \'', $fields) . '\'';
		
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
	
	private function getLinkData($linkModel, $id = 0, $model = null)
	{
		if (\is_null($model)) $model = $this;
		
		$query =
		'
			SELECT
				t.`id`,
				lt.`' . \lcfirst($model::$table) . '` AS ltid
			FROM `' . $linkModel::$table . '` t
			LEFT OUTER JOIN `link_' . $model::$table . $linkModel::$table . '` lt ON
				t.`id` = lt.`' . \lcfirst($linkModel::$table) . '` AND
				lt.`' . \lcfirst($model::$table) . '` = ' . $id . ';
		';
		
		$result = \Wings\DB::fetchAll($query);
		
		$issets = [];
		
		foreach ($result as $row) $issets[$row['id']] = $row['ltid'];
		
		$links = $this->getAll($linkModel);
		
		$links = \treeToArray($links);
		
		\usort($links, function ($a, $b) {
			return strcmp($a['name'], $b['name']);
		});
		
		foreach ($links as &$value)
		{
			if (is_null($issets[$value['id']])) $value['selected'] = false;
			else $value['selected'] = true;
		}
		
		return $links;
	}
	
	public function insert($model = null)
	{
		if (\is_null($model)) $model = $this;
		
		$args = [];
		
		foreach ($model::$columns as $key => $column)
		{
			if (isset($column['generated']) && $column['generated'] === true && !isset($column['default'])) continue;
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
				if ($column['field'] === 'checkbox')
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
		
		return $id;
	}
	
	public function move($nodeID, $parentID, $nearNodeID, $model = null)
	{
		if (\is_null($model)) $model = $this;
		
		if (!empty($model::$tree))
		{
			$tree = '\\Wings\\Tree\\' . $model::$tree;
			$tree::updateNode($model::$table, $nodeID, $parentID, $nearNodeID);
		}
		else ;
	}
	
	public function prepareModel($model = null)
	{
		if (\is_null($model)) $model = $this;
		
		$result = [];
		
		if (!empty($model::$tree))
		{
			$result['parent'] = $this->getAll();
			
			$field =
			[
				'field'		=> 'select',
				'key'		=> 'parent',
				'turn'		=> 1,
				'type'		=> ['int', 11]
			];
			
			$model::$columns = \array_slice($model::$columns, 0, 1, true) + ['parent' => $field] + \array_slice($model::$columns, 1, null, true);
		}
		
		if (!empty($model::$links))
		{
			foreach ($model::$links as $link)
			{
				$name = \strtolower($link);
				
				$result[$name] = $this->getLinkData('\\Applications\\Models\\' . $link);
			}
		}
		
		if (!empty($model::$multilang)) $this->setLanguages();
		
		$this->setFieldsNames();
		
		return $result;
	}
	
	public function setFieldsNames($model = null)
	{
		if (\is_null($model)) $model = $this;
		
		$fields = $this->getFieldsNames();
		
		foreach ($model::$columns as $key => &$value)
		{
			if (isset($fields[$key])) $value['name'] = $fields[$key];
		}
		
		return $fields;
	}
	
	private function setLanguageFields($result, $model = null)
	{
		if (\is_null($model)) $model = $this;
		
		foreach ($model::$multilang as $column)
		{
			foreach ($result as &$el)
			{
				if ($el['lang'] == \Wings::$language['id']) $el[$column] = $el[$column];
				
				if (isset($el['childrens'])) $el['childrens'] = $this->setLanguageFields($el['childrens']);
			}
		}
		
		return $result;
	}
	
	private function setLanguages($model = null)
	{
		if (\is_null($model)) $model = $this;
		
		$languages = \Wings\DB::select('Language', '`id`, `nameEn`', null, null, '`id` ASC');
		
		$fields = $this->getFieldsNames();
		
		foreach ($model::$multilang as $column)
		{
			foreach ($languages as $i => $language)
			{
				$key = $column . '[' . $language['id'] . ']';
				
				$model::$columns[$key] = $model::$columns[$column];
				
				$model::$columns[$key]['key'] = $key;
				$model::$columns[$key]['name'] = $fields[$column] . ' (' . $language['nameEn'] . ')';
				if ($model::$columns[$key]['turn'] > 9) $model::$columns[$key]['turn'] = (int)(1 . $i . $model::$columns[$key]['turn']);
				else $model::$columns[$key]['turn'] = (int)(1 . $i . '0' . $model::$columns[$key]['turn']);
			}
			
			unset($model::$columns[$column]);
		}
	}
	
	public function setWords($model = null)
	{
		if (\is_null($model)) $model = $this;
		
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
			'name'	=> [$model::$table, 'str', 63]
		];
		
		$model::$words = \Wings\DB::fetchRow($query, $args);
	}
	
	public function update($model = null)
	{
		if (\is_null($model)) $model = $this;
		
		$id = \Wings::$post['id'];
		
		$args = [];
		
		foreach ($model::$columns as $key => $column)
		{
			if (isset($column['generated']) && $column['generated'] === true) continue;
			if (in_array($key, $model::$multilang)) continue;
			
			$args[$key] = [\Wings::$post[$key], $column['type'][0], $column['type'][1]];
		}
		
		if (\count($args) > 0)
		{
			$args['id'] = [$id, $column['type'][0], $column['type'][1]];
			
			\Wings\DB::update($model::$table, $args);
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