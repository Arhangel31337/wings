<?php

namespace Applications\Models;

abstract class Model
{
	public		$columns	= [];
	public		$links		= [];
	public		$multilang	= [];
	public		$table		= '';
	public		$tree		= '';
	public		$words		= [];
	
	public function delete($id)
	{
		$wheres = ['id' => '='];
		$args = ['id' => [$id, 'int', 11]];
		
		\Wings\DB::delete($this->table, $wheres, $args);
	}
	
	public function getAll($model = null)
	{
		list($columns, $joins) = $this->getColumnsAndJoins(true);
		
		$this->setFieldsNames();
		
		if ($this->tree !== '') $result = \Wings\Tree\NestedSets::selectAll($this->table, $columns, $joins);
		else
		{
			$query = 'SELECT ' . $columns . ' FROM `' . $this->table . '`' . $joins;
			$result = \Wings\DB::fetchAll($query);
		}
		
		if (!empty($this->multilang)) $result = $this->setLanguageFields($result);
		
		return $result;
	}
	
	public function getByID($id)
	{
		list($columns, $joins) = $this->getColumnsAndJoins();
		
		$query = 'SELECT ' . $columns . ' FROM `' . $this->table . '` ' . $joins . ' WHERE `' . $this->table . '`.`id` = :id';
		
		$args = ['id' => [$id, 'int', 11]];
		
		$result = \Wings\DB::fetchAll($query, $args);
		
		if (!isset($result[0])) return null;
		
		if (!empty($this->links))
		{
			foreach ($this->links as $link)
			{
				$name = \strtolower($link);
		
				$this->columns[$name] =
				[
					'field'		=> ['type'	=> 'multiselect'],
					'key'		=> 'parent',
					'type'		=> ['int', 11]
				];
		
				$linkModel = \explode('\\', \get_called_class());
				$linkModel[(\count($linkModel) - 2)] = $link;
				$linkModel = '\\' . \implode('\\', $linkModel);
				
				$result[0][$name] = $this->getLinkData('\\Applications\\Models\\' . $link, $id);
			}
		}
		
		$fields = $this->setFieldsNames();
		
		if (empty($this->multilang)) return $result[0];
		
		$item =
		[
			'id'		=> $result[0]['id'],
			'code'		=> $result[0]['code'],
			'nameEn'	=> $result[0]['nameEn']
		];
		
		foreach ($this->multilang as $column)
		{
			foreach ($result as $el)
			{
				$key = $column . '[' . $el['lang'] . ']';
				
				$item[$key] = $el['lang_' . $column];
				$this->columns[$key] = $this->columns[$column];
				
				$this->columns[$key]['key'] = $column . '[' . $el['lang'] . ']';
				$this->columns[$key]['name'] = $fields[$column] . ' (' . $el['nameEn'] . ')';
				
				if ($el['lang'] == \Wings::$language['id']) $item[$column] = $el['lang_' . $column];
			}
			
			unset($this->columns[$column]);
		}
		
		return $item;
	}
	
	private function getColumnsAndJoins($isList = false)
	{
		$columns = [];
		$joins = [];
		
		foreach ($this->columns as $key => $column)
		{
			if (in_array($key, $this->multilang)) continue;
			
			if (isset($column['field']['isConfirm']) && $column['field']['isConfirm'] === true) continue;
				
			if (isset($column['alterTable']))
			{
				$alt = $column['alterTable'];
				$tableAdd = $alt['name'] . $key;
		
				$columns[] = '`' . $tableAdd . '`.`' . $alt['field'] . '` AS `' . $column['key'] . '`';
		
				$joins[] = 'INNER JOIN `' . $alt['name'] . '` ' . $tableAdd . ' ON `' . $this->table . '`.`' . $alt['key1'] . '` = ' . $tableAdd . '.`' . $alt['key2'] . '`';
			}
			else $columns[] = '`' . $this->table . '`.`' . $key . '`';
		}
		
		if (!empty($this->multilang))
		{
			$columns[] = '`Language`.`id` AS `lang`';
			$columns[] = '`Language`.`code` AS `code`';
			$columns[] = '`Language`.`nameEn` AS `nameEn`';
			
			foreach ($this->multilang as $field) $columns[] = '`lang_' . $this->table . '`.`' . $field . '` AS `lang_' . $field . '`';
			
			$join = 'INNER JOIN `lang_' . $this->table . '` ON `' . $this->table . '`.`id` = `lang_' . $this->table . '`.`' . lcfirst($this->table) . '`';
			
			if ($isList) $join .= ' AND `lang_' . $this->table . '`.`lang` = ' . \Wings::$language['id'];
			
			$joins[] = $join;
			$joins[] = 'INNER JOIN `Language` ON `lang_' . $this->table . '`.`lang` = `Language`.`id`';
		}
		
		return [\implode(', ', $columns), \implode(' ', $joins)];
	}
	
	private function getFieldsNames()
	{
		$fields = \array_unique(\array_merge(\array_keys($this->columns), $this->multilang));
		
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
	
	private function getLinkData($linkModel, $id = 0)
	{
		$query =
		'
			SELECT
				t.`id`,
				lt.`' . \strtolower($this->table) . '` AS ltid
			FROM `' . $linkModel::$table . '` t
			LEFT OUTER JOIN `link_' . $this->table . $linkModel::$table . '` lt ON
				t.`id` = lt.`' . \strtolower($linkModel::$table) . '` AND
				lt.`' . \strtolower($this->table) . '` = ' . $id . ';
		';
		
		$result = \Wings\DB::fetchAll($query);
		
		$issets = [];
		
		foreach ($result as $row) $issets[$row['id']] = $row['ltid'];
		
		$links = $this->getAll($linkModel);
		
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
	
	public function insert()
	{
		$args = [];
		
		foreach ($this->columns as $key => $column)
		{
			if (isset($column['generated']) && $column['generated'] === true && !isset($column['default'])) continue;
			if (isset($column['field']['isConfirm']) && $column['field']['isConfirm'] === true) continue;
			if (in_array($key, $this->multilang)) continue;
			
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
		
		if (!empty($this->tree)) $id = \Wings\Tree\NestedSets::insertNode($this->table, \Wings::$post['parent'], $args);
		else $id = \Wings\DB::insert($this->table, $args);
		
		if (!empty($this->multilang))
		{
			$table = 'lang_' . $this->table;
			$column = lcfirst($this->table);
			
			$argss = [];
			
			foreach ($this->multilang as $field)
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
					
					$argss[$lang][$field] = [$value, $this->columns[$field]['type'][0], $this->columns[$field]['type'][1]];
				}
			}
			
			foreach ($argss as $args) \Wings\DB::insert($table, $args);
		}
		
		if (!empty($this->links))
		{
			foreach ($this->links as $link)
			{
				$arg1 = \strtolower($this->table);
				$arg2 = \strtolower($link);
				$table = 'link_' . $this->table . $link;
				
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
	
	public function move($nodeID, $parentID, $nearNodeID)
	{
		if (!empty($this->tree))
		{
			$tree = '\\Wings\\Tree\\' . $this->tree;
			$tree::updateNode($this->table, $nodeID, $parentID, $nearNodeID);
		}
		else ;
	}
	
	public function prepareModel()
	{
		$result = [];
		
		if (!empty($this->tree))
		{
			$result['parent'] = $this->getAll();
			
			$field =
			[
				'field'		=> ['type'	=> 'select'],
				'key'		=> 'parent',
				'type'		=> ['int', 11]
			];
			
			$this->columns = \array_slice($this->columns, 0, 1, true) + ['parent' => $field] + \array_slice($this->columns, 1, null, true);
		}
		
		if (!empty($this->links))
		{
			foreach ($this->links as $link)
			{
				$name = \strtolower($link);
				
				$this->columns[$name] =
				[
					'field'		=> ['type'	=> 'multiselect'],
					'key'		=> 'parent',
					'type'		=> ['int', 11]
				];
				
				$result[$name] = $this->getLinkData('\\Applications\\Models\\' . $link);
			}
		}
		
		if (!empty($this->multilang)) $this->setLanguages();
		
		$this->setFieldsNames();
		
		return $result;
	}
	
	public function setFieldsNames()
	{
		$fields = $this->getFieldsNames();
		
		foreach ($this->columns as $key => &$value)
		{
			if (isset($fields[$key])) $value['name'] = $fields[$key];
		}
		
		return $fields;
	}
	
	private function setLanguageFields($result)
	{
		foreach ($this->multilang as $column)
		{
			foreach ($result as &$el)
			{
				if ($el['lang'] == \Wings::$language['id']) $el[$column] = $el['lang_' . $column];
				
				if (isset($el['childrens'])) $el['childrens'] = $this->setLanguageFields($el['childrens']);
			}
		}
		
		return $result;
	}
	
	private function setLanguages()
	{
		$languages = \Wings\DB::select('Language', '`id`, `nameEn`', null, null, '`id` ASC');
		
		$fields = $this->getFieldsNames();
		
		foreach ($this->multilang as $column)
		{
			foreach ($languages as $language)
			{
				$key = $column . '[' . $language['id'] . ']';
				
				$this->columns[$key] = $this->columns[$column];
				
				$this->columns[$key]['key'] = $column . '[' . $language['id'] . ']';
				$this->columns[$key]['name'] = $fields[$column] . ' (' . $language['nameEn'] . ')';
			}
			
			unset($this->columns[$column]);
		}
	}
	
	public function setWords()
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
			'name'	=> [$this->table, 'str', 63]
		];
		
		$this->words = \Wings\DB::fetchRow($query, $args);
	}
	
	public function update()
	{
		$id = \Wings::$post['id'];
		
		$args = [];
		
		foreach ($this->columns as $key => $column)
		{
			if (isset($column['generated']) && $column['generated'] === true) continue;
			if (isset($column['field']['isConfirm']) && $column['field']['isConfirm'] === true) continue;
			if (in_array($key, $this->multilang)) continue;
			
			$args[$key] = [\Wings::$post[$key], $column['type'][0], $column['type'][1]];
		}
		
		if (\count($args) > 0)
		{
			$args['id'] = [$id, $column['type'][0], $column['type'][1]];
			
			\Wings\DB::update($this->table, $args);
		}
		
		if (!empty($this->multilang))
		{
			$table = 'lang_' . $this->table;
			$column = lcfirst($this->table);
			
			\Wings\DB::delete($table, [$column => '='], [$column => [$id, 'int', 11]]);
			
			$argss = [];
			
			foreach ($this->multilang as $field)
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
					
					$argss[$lang][$field] = [$value, $this->columns[$field]['type'][0], $this->columns[$field]['type'][1]];
				}
			}
			
			foreach ($argss as $args) \Wings\DB::insert($table, $args);
		}
		
		if (!empty($this->links))
		{
			foreach ($this->links as $link)
			{
				$arg1 = \strtolower($this->table);
				$arg2 = \strtolower($link);
				$table = 'link_' . $this->table . $link;
				
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