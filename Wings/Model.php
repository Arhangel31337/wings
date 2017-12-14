<?php

namespace Wings;

abstract class Model
{
	public			$accesses	=
	[
		'delete'	=> true,
		'insert'	=> true,
		'select'	=> true,
		'update'	=> true
	];
	public	static	$columns	= [];
	public	static	$link		= [];
	public	static	$links		= [];
	public	static	$multilang	= [];
	private			$history	= [];
	public	static	$table		= '';
	public	static	$tree		= '';
	public	static	$type		= 'list';
	public	static	$words		= [];
	
	public			$model;
	
	public function __construct()
	{
		$this->setWords();
	}
	
	private function addHistory($data, $model = null, $remove = false)
	{
		if (\is_null($model)) $model = $this;
		
		if (!isset($model->history['id']))
		{
			$query = 'SELECT t.id FROM `Table` t WHERE t.`table` = :table;';
			$args = ['table' => [$model::$table, 'str', 63]];
			
			$model->history['table'] = DB::fetchOne($query, $args);
			
			if (!isset($data['id'])) $model->history['row'] = [0];
			else
			{
				$model->history['row'] = $data['id'];
				$temp = $model::$columns;
				$model->history['old'] = $model->getByID($model->history['row'][0]);
				$model::$columns = $temp;
			}
			
			$args =
			[
				'datetime'	=> [\date('Y-m-d- H:i:s'), 'str', 19],
				'ip'		=> [$_SERVER['REMOTE_ADDR'], 'str', 15],
				'row'		=> [$model->history['row'][0], 'int', 11],
				'session'	=> [\session_id(), 'str', 31],
				'table'		=> [$model->history['table'], 'int', 11],
				'user'		=> [\Wings::$user->getId(), 'int', 11]
			];
			$model->history['id'] = DB::insert('History', $args);
		}
		
		if ($remove) $fields = \array_keys($model->history['old']);
		else $fields = \array_keys($data);
		
		$query = 'SELECT * FROM `Field` f WHERE f.`field` IN (\'' . \implode('\',\'', $fields) . '\') AND f.`table` = :table;';
		$args = ['table' => [$model->history['table'], 'str', 63]];
		
		$result = DB::fetchAll($query, $args);
		
		foreach ($result as $row) $model->history['fields'][$row['field']] = $row['id'];
		
		if ($remove)
		{
			foreach ($model->history['old'] as $key => $value)
			{
				if (!isset($model::$columns[$key])) continue;
				
				if (!isset($model->history['fields'][$key])) continue;
				
				if (\is_array($model->history['old'][$key]))
				{
					if (!\is_array($model->history['old'][$key][0]))
						$model->history['old'][$key] = \implode(', ', $model->history['old'][$key]);
						else $model->history['old'][$key] = '';
				}
				
				$args =
				[
					'dataOld'	=> [$model->history['old'][$key], 'str'],
					'dataNew'	=> ['', 'str'],
					'field'		=> [$model->history['fields'][$key], 'int', 11],
					'history'	=> [$model->history['id'], 'int', 11]
				];
				
				DB::insert('link_HistoryField', $args);
			}
			
			return;
		}
		
		foreach ($data as $key => $value)
		{
			if (\is_array($value[0])) $value[0] = \implode(', ', $value[0]);
			
			if (isset($data['id']))
			{
				if ($value[0] == $model->history['old'][$key]) continue;
				
				if (\is_array($model->history['old'][$key]))
				{
					if (!\is_array($model->history['old'][$key][0]))
						$model->history['old'][$key] = \implode(', ', $model->history['old'][$key]);
						else $model->history['old'][$key] = '';
				}
				
				$args =
				[
					'dataOld'	=> [$model->history['old'][$key], 'str'],
					'dataNew'	=> $value,
					'field'		=> [$model->history['fields'][$key], 'int', 11],
					'history'	=> [$model->history['id'], 'int', 11]
				];
				DB::insert('link_HistoryField', $args);
			}
			else 
			{
				$args =
				[
					'dataOld'	=> ['', 'str'],
					'dataNew'	=> $value,
					'field'		=> [$model->history['fields'][$key], 'int', 11],
					'history'	=> [$model->history['id'], 'int', 11]
				];
				
				DB::insert('link_HistoryField', $args);
			}
		}
	}
	
	public function delete($id, $model = null)
	{
		if (\is_null($model)) $model = $this;
		
		$wheres = ['id' => '='];
		$args = ['id' => [$id, 'int', 11]];
		
		self::addHistory($args, $model, true);
		
		DB::delete($model::$table, $wheres, $args);
	}
	
	public function getAll($model = null)
	{
		if (\is_null($model)) $model = $this;
		
		list($columns, $joins) = $this->getColumnsAndJoins($model, true);
		
		$this->setFieldsNames();
		
		if ($model::$tree !== '') $result = \Wings\Tree\NestedSets::selectAll($model::$table, $columns, $joins);
		else
		{
			$query = 'SELECT ' . $columns . ' FROM `' . $model::$table . '` ' . $joins;
			$result = DB::fetchAll($query);
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
		
		$result = DB::fetchAll($query, $args);
		
		if (!isset($result[0])) return null;
		
		if (!empty($model::$link))
		{
			foreach ($model::$link as $link)
			{
				$name = \strtolower($link);
				
				$result[0][$name] = $this->getLinkData('\\Applications\\Models\\' . $link, $id, null, false);
			}
		}
		
		if (!empty($model::$links))
		{
			foreach ($model::$links as $link)
			{
				$name = \strtolower($link);
				
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
		
		return \array_merge($result[0], $item);
	}
	
	private function getColumnsAndJoins($model = null, $isList = false)
	{
		if (\is_null($model)) $model = $this;
		
		$columns = [];
		$joins = [];
		
		foreach ($model::$columns as $key => $column)
		{
			if (\in_array($key, $model::$multilang) ||
				\in_array($key, $model::$link) ||
				\in_array($key, $model::$links)) continue;
				
			$columns[] = '`' . $model::$table . '`.`' . $key . '`';
		}
		
		if (!empty($model::$link))
		{
			foreach ($model::$link as $key => $link)
			{
				$linkModel = '\\Applications\\Models\\' . \ucfirst($link);
				
				if (!empty($linkModel::$multilang))
				{
					$columns[] = '`lang_' . \ucfirst($link) . '`.`name` AS `' . $link . '`';
					$joins[] = 'INNER JOIN `lang_' . \ucfirst($link) . '` ON `' .
						$model::$table . '`.`' . $link . '` = `lang_' . \ucfirst($link) . '`.`' . $link . '` AND ' .
						'`lang_' . \ucfirst($link) . '`.`lang` = ' . \Wings::$language['id'];
				}
				else
				{
					$columns[] = '`' . \ucfirst($link) . '`.`name` AS `' . $link . '`';
					$joins[] = 'INNER JOIN `' . \ucfirst($link) . '` ON `' . $model::$table . '`.`' . $link . '` = `' . \ucfirst($link) . '`.`id`';
				}
			}
		}
		
		if (!empty($model::$multilang))
		{
			$columns[] = '`Language`.`id` AS `lang`';
			$columns[] = '`Language`.`code` AS `code`';
			$columns[] = '`Language`.`nameEn` AS `nameEn`';
			
			foreach ($model::$multilang as $field) $columns[] = 'IFNULL(`lang_' . $model::$table . '`.`' . $field . '`, "") AS `' . $field . '`';
			
			$join = 'LEFT OUTER JOIN `lang_' . $model::$table . '` ON `' .
				$model::$table . '`.`id` = `lang_' . $model::$table . '`.`' . \lcfirst($model::$table) . '` AND ' .
				'`lang_' . $model::$table . '`.`lang` = `Language`.`id`';
			
			if ($isList)
			{
				$join = 'INNER JOIN `lang_' . $model::$table . '` ON `' .
					$model::$table . '`.`id` = `lang_' . $model::$table . '`.`' . \lcfirst($model::$table) . '` AND ' .
					'`lang_' . $model::$table . '`.`lang` = `Language`.`id` AND `lang_' . $model::$table . '`.`lang` = ' . \Wings::$language['id'];
			}
			
			$joins[] = 'INNER JOIN `Language`';
			$joins[] = $join;
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
				f.`field`,
    			lf.`name` AS `value`
			FROM `Table` t
			INNER JOIN `Field` f ON t.`id` = f.`table`
			INNER JOIN `lang_Field` lf ON
				t.`table` = :table AND
				f.`id` = lf.`field` AND
			    lf.`lang` = :lang
			WHERE f.`field` IN (' . $fields . ');
		';
		$args =
		[
			'lang'	=> [\Wings::$language['id'], 'int', 2],
			'table'	=> [$model::$table, 'str', 63]
		];
		
		$result = DB::fetchAll($query, $args);
		
		$fields = [];
		
		foreach ($result as $row) $fields[$row['field']] = $row['value'];
		
		return $fields;
	}
	
	private function getLinkData($linkModel, $id = 0, $model = null, $multi = true)
	{
		if (\is_null($model)) $model = $this;
		
		if ($multi)
		{
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
		}
		else
		{
			$query =
			'
				SELECT
					t1.`id`,
					t2.`id` AS ltid
				FROM `' . $linkModel::$table . '` t1
				LEFT OUTER JOIN `' . $model::$table . '` t2 ON
					t1.`id` = t2.`' . \lcfirst($linkModel::$table) . '` AND
					t2.`id` = ' . $id . ';
			';
		}
		
		$result = DB::fetchAll($query);
		
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
			if (in_array($key, $model::$links)) continue;
			
			if (isset($column['default']))
			{
				switch ($column['default'])
				{
					case 'now':
						$value = \date('Y-m-d H:i:s');
						break;
					default:
						$value = $column['default'];
						break;
				}
			}
			else
			{
				if ($column['field'] === 'checkbox' || $column['field'] === 'switch')
				{
					if (isset(\Wings::$post[$key])) $value = 1;
					else $value = 0;
				}
				elseif ($column['field'] === 'password') $value = User::createPassword(\Wings::$post['mail'], \Wings::$post['password'])[0];
				else $value = \Wings::$post[$key];
			}
			
			$args[$key] = [$value, $column['type'][0], $column['type'][1]];
		}
		
		self::addHistory($args);
		
		if (!empty($model::$tree)) $id = \Wings\Tree\NestedSets::insertNode($model::$table, \Wings::$post['parent'], $args);
		else $id = DB::insert($model::$table, $args);
		
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
					
					self::addHistory([$field => ['[' . $lang . ']' . $value, $model::$columns[$field]['type'][0], $model::$columns[$field]['type'][1]]]);
					
					$argss[$lang][$field] = [$value, $model::$columns[$field]['type'][0], $model::$columns[$field]['type'][1]];
				}
			}
			
			foreach ($argss as $args) DB::insert($table, $args);
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
					
					self::addHistory([$arg2	=> [$value, 'int', 11]]);
					
					DB::insert($table, $args);
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
		
		if (!empty($model::$link))
		{
			foreach ($model::$link as $link)
			{
				$name = \strtolower($link);
				
				$result[$name] = $this->getLinkData('\\Applications\\Models\\' . $link, 0, null, false);
			}
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
	
	public function setAccesses($accesses)
	{
		if ($accesses['delete'] == 0) $this->accesses['delete'] = false;
		if ($accesses['insert'] == 0) $this->accesses['insert'] = false;
		if ($accesses['select'] == 0) $this->accesses['select'] = false;
		if ($accesses['update'] == 0) $this->accesses['update'] = false;
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
		
		$languages = DB::select('Language', '`id`, `nameEn`', null, null, '`id` ASC');
		
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
			WHERE t.`table` = :name
			LIMIT 0, 1;
		';
		$args =
		[
			'lang'	=> [\Wings::$language['id'], 'int', 3],
			'name'	=> [$model::$table, 'str', 63]
		];
		
		$model::$words = DB::fetchRow($query, $args);
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
			if (in_array($key, $model::$links)) continue;
			
			if ($column['field'] === 'checkbox' || $column['field'] === 'switch')
			{
				if (isset(\Wings::$post[$key])) $value = 1;
				else $value = 0;
			}
			elseif ($column['field'] === 'password')
			{
				if (empty(\Wings::$post[$key])) continue;
				
				$value = User::createPassword(\Wings::$post['mail'], \Wings::$post[$key])[0];
			}
			else $value = \Wings::$post[$key];
			
			$args[$key] = [$value, $column['type'][0], $column['type'][1]];
		}
		
		$args['id'] = [$id, $column['type'][0], $column['type'][1]];
		
		self::addHistory($args);
		
		if (\count($args) > 1) DB::update($model::$table, $args);
		
		if (!empty($model::$multilang))
		{
			$table = 'lang_' . $model::$table;
			$column = lcfirst($model::$table);
			
			DB::delete($table, [$column => '='], [$column => [$id, 'int', 11]]);
			
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
					
					self::addHistory([$field => ['[' . $lang . ']' . $value, $model::$columns[$field]['type'][0], $model::$columns[$field]['type'][1]]]);
					
					$argss[$lang][$field] = [$value, $model::$columns[$field]['type'][0], $model::$columns[$field]['type'][1]];
				}
			}
			
			foreach ($argss as $args) DB::insert($table, $args);
		}
		
		if (!empty($model::$links))
		{
			foreach ($model::$links as $link)
			{
				$arg1 = \strtolower($model::$table);
				$arg2 = \strtolower($link);
				$table = 'link_' . $model::$table . $link;
				
				DB::delete($table, [$arg1 => '='], [$arg1 => [$id, 'int', 11]]);
				
				if (empty(\Wings::$post[$arg2])) continue;
				
				foreach (\Wings::$post[$arg2] as $value)
				{
					$args =
					[
						$arg1	=> [$id, 'int', 11],
						$arg2	=> [$value, 'int', 11]
					];
					
					self::addHistory([$arg2	=> [$value, 'int', 11]]);
					
					DB::insert($table, $args);
				}
			}
		}
	}
}