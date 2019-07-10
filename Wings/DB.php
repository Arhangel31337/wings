<?php

/**
 * Project:     Wings (framework)
 * File:        DB.php
 * 
 * Фреймворк разработанный для собственных нужд.
 * 
 * @link http://arhangel31337.ru/
 * @copyright 2012 Arhangel31337
 * @author Arhangel31337<arhangel31337@gmail.com>
 * @author Коломиец Алексей
 * @package Wings
 * @version 1.0.0
 * 
 */

namespace Wings;

final class DB
{
	public static	$currentBase		= 0;
	private static	$pdo				= array();
	
	const			TRANSACTION_START	= true;
	const			TRANSACTION_STOP	= false;
	
	/**
	 * 
	 */
	public static function calcFoundRows()
	{
		$query = 'SELECT FOUND_ROWS();';
		
		return self::fetchOne($query);
	}
	
	/**
	 * Удаления записи из таблицы
	 *
	 * @param string $table - наименование таблицы в БД
	 * @param array $wheres - массив условий вида array('columnName' => 'condition')
	 * @param array $args - массив подстановочных данных вида array('name' => array('value', 'type', 'length'))
	 *
	 * @return PDOStatement - объект оператора
	 */
	public static function delete($table, $wheres, $args)
	{
		$where = array();
		
		foreach ($wheres as $key => $value)
		{
			$where[] = '`' . $key . '` ' . $value . ' :' . $key;
		}
		
		$query = 'DELETE FROM `' . $table . '` WHERE ' . implode(' AND ', $where) . ';';
		
		return self::Query($query, $args);
	}
	
	public static function getEnumValues($table, $column)
	{
		$query = 'SHOW COLUMNS FROM `' . $table . '` LIKE \'' . $column . '\';';
		
		$result = self::fetchAll($query);
		
		if (!isset($result[0]['Type'])) return null;
		
		$matches = [];
		
		\preg_match_all('/enum\((\'.+\')\)/', $result[0]['Type'], $matches);
		
		if (!isset($matches[1][0])) return null;
		
		$result = mb_substr($matches[1][0], 1, (strlen($matches[1][0]) - 2));
		
		return explode('\',\'', $result);
	}
	
	/**
	 * Создания подключений к БД
	 * 
	 * @param array $settings - параметры подключения к БД
	 * 
	 * @return void
	 */
	public static function init($settings)
	{
		try
		{
			if (isset($settings['type']))
			{
				$charsetQuery = 'SET character_set_connection = ' . $settings['charset'] . ";\n";
				$charsetQuery .= 'SET character_set_client = ' . $settings['charset'] . ";\n";
				$charsetQuery .='SET character_set_results = ' . $settings['charset'] . ";\n";
				
				self::$pdo[] = new \PDO($settings['type'] . ':host=' . $settings['host'] . ';dbname=' . $settings['name'], $settings['login'], $settings['password']);
				self::$pdo[self::$currentBase]->query($charsetQuery);
			}
			elseif (isset($settings[0]['type'])) 
			{
				foreach ($settings as $key => $value)
				{
					$charsetQuery = 'SET character_set_connection = ' . $value['charset'] . ";\n";
					$charsetQuery .= 'SET character_set_client = ' . $value['charset'] . ";\n";
					$charsetQuery .='SET character_set_results = ' . $value['charset'] . ";\n";
					
					self::$pdo[$key] = new \PDO($value['type'] . ':host=' . $value['host'] . ';dbname=' . $value['name'], $value['login'], $value['password']);
					self::$pdo[$key]->query($charsetQuery);
				}
			}
			else throw new Exception('Нет настроек к базе данных');
		}
		catch (\PDOException $exception)
		{
			throw new \Exception($exception->getMessage());
		}
	}
	
	/**
	 * Добавление записи в таблицу
	 *
	 * @param string $table - наименование таблицы в БД
	 * @param array $args - массив подстановочных данных вида array('name' => array('value', 'type', 'length'))
	 *
	 * @return int - id вставленной строки
	 */
	public static function insert($table, $args)
	{
		$keys = array_keys($args);
		
		if (empty($args)) $query = 'INSERT INTO `' . $table . '` () VALUES ();';
		else $query = 'INSERT INTO `' . $table . '` (`' . implode('`, `', $keys) . '`) VALUES (:' . implode(', :', $keys) . ');';
		
		self::Query($query, $args);
		
		return self::$pdo[self::$currentBase]->lastInsertId();
	}
	
	/**
	 * Получение данных из запроса
	 *
	 * @param string $query - SQL-запрос
	 * @param array $args - массив подстановочных данных вида array(array('value', 'type', 'length'))
	 * @param string|PDO::ATTR_FETCH_MODE $fetchType = 'assoc' - тип возвращаемых данных принятые в классе
	 *
	 * @return PDOStatement - объект оператора
	 */
	public static function fetchAll($query, $args = [], $fetchType = 'assoc')
	{
		$statement = self::Query($query, $args);
		return $statement->FetchAll(self::FetchType($fetchType));
	}
	
	/**
	 * Получение следующего значения из запроса
	 *
	 * @param string $query - SQL-запрос
	 * @param array $args - массив подстановочных данных вида array(array('value', 'type', 'length'))
	 * @param int $column = 0 - порядковый номер колонки
	 *
	 * @return PDOStatement - объект оператора
	 */
	public static function fetchColumn($query, $args = [], $column = 0)
	{
		$statement = self::Query($query, $args);
		$result = [];
		
		$value = $statement->fetchColumn($column);
		
		while ($value)
		{
			$result[] = $value;
			
			$value = $statement->fetchColumn($column);
		}
		
		return $result;
	}
	
	public static function fetchOne($query, $args = [], $column = 0)
	{
		$statement = self::Query($query, $args);
		
		if (!\is_numeric($column)) $column = 0;
		
		return $statement->fetchColumn($column);
	}
	
	public static function fetchRow($query, $args = [], $row = 0, $fetchType = 'assoc')
	{
		$statement = self::Query($query, $args);
		$statement = $statement->FetchAll(self::FetchType($fetchType));
		if (\count($statement) === 0) return null;
		if (is_numeric($row)) return $statement[$row];
	}
	
	/**
	 * Преобразование сокращений в значения PDO::ATTR_FETCH_MODE
	 *
	 * @param string $fetchType - сокращение
	 *
	 * @return PDO::ATTR_FETCH_MODE - PDO::FETCH_* константа
	 */
	private static function fetchType($fetchType)
	{
		switch ($fetchType)
		{
			case 'assoc':
				return \PDO::FETCH_ASSOC;
				break;
			case 'both':
				return \PDO::FETCH_BOTH;
				break;
			case 'bound':
				return \PDO::FETCH_BOUND;
				break;
			case 'class':
				return \PDO::FETCH_CLASS;
				break;
			case 'into':
				return \PDO::FETCH_INTO;
				break;
			case 'lazy':
				return \PDO::FETCH_LAZY;
				break;
			case 'num':
				return \PDO::FETCH_NUM;
				break;
			case 'obj':
				return \PDO::FETCH_OBJ;
				break;
			default:
				return \PDO::FETCH_ASSOC;
				break;
		}
	}
	
	/**
	 * Выборка данных из таблицы
	 *
	 * @param string $table - наименование таблицы в БД
	 * @param string $select - наименование полей для выборки
	 * @param array $wheres = null - массив условий вида array('columnName' => 'condition')
	 * @param array $args - массив подстановочных данных вида array('name' => array('value', 'type', 'length'))
	 * @param string $order = null - наименование полей для сортировки
	 * @param string $separator = 'AND' - разделитель между условиями
	 *
	 * @return array массив результатов запроса
	 */
	public static function select($table, $select = '*', $wheres = null, $args = null, $order = null, $limit = null, $separator = 'AND')
	{
		$query = 'SELECT ' . $select . ' FROM `' . $table . '`';
		
		if (!\is_null($wheres))
		{
			$where = array();
			
			foreach ($wheres as $key => $value)
			{
				$where[] = '`' . $key . '` ' . $value . ' :' . $key;
			}
			
			$query .= ' WHERE ' . implode(' ' . $separator . ' ', $where);
		}
		
		if (!\is_null($order))
		{
			$query .= ' ORDER BY ' . $order;
		}
		
		if (!\is_null($limit))
		{
			$query .= ' LIMIT ' . $limit;
		}
		
		$query .= ';';
		
		return self::FetchAll($query, $args);
	}
	
	/**
	 * Открытие/закрытие транзакции
	 *
	 * @param string $type = 'off' - переключатель on|off
	 *
	 * @return void
	 */
	public static function transaction($type = self::TRANSACTION_STOP)
	{
		if ($type)
		{
			if (self::$pdo[self::$currentBase]->inTransaction()) self::$pdo[self::$currentBase]->commit();
			
			self::$pdo[self::$currentBase]->beginTransaction();
		}
		else self::$pdo[self::$currentBase]->commit();
	}
	
	/**
	 * Выполнение запроса
	 *
	 * @param string $query - SQL-запрос
	 * @param array $args - массив подстановочных данных вида array('name' => array('value', 'type', 'length'))
	 *
	 * @return PDOStatement - объект оператора
	 */
	public static function query($query, $args = array())
	{
		//trace($query); trace($args);
		$query = self::$pdo[self::$currentBase]->prepare($query);
		
		if (!empty($args))
		{
			foreach ($args as $key => $value)
			{
				if (!is_array($value)) $query->bindParam(':' . $key, $value);
				else
				{
					$value = self::ValueParameters($value);
					
					if (isset($value['length'])) $query->bindParam(':' . $key, $value['value'], $value['type'], $value['length']);
					else $query->bindParam(':' . $key, $value['value'], $value['type']);
				}
			}
		}
		
		try
		{
			if (!$query->execute()) throw new Exception($query->errorInfo()[2]);
		}
		catch (\PDOException $exception)
		{
			throw new \Exception($exception->getMessage());
		}
		$pdo = self::$pdo[self::$currentBase];
		
		return $query;
	}
	
	/**
	 * Обновление записи в таблице
	 *
	 * @param string $table - наименование таблицы в БД
	 * @param array $args - массив подстановочных данных вида array('name' => array('value', 'type', 'length'))
	 *
	 * @return PDOStatement - объект оператора
	 */
	public static function update($table, $args)
	{
		$keys = array_keys($args);
		$last = count($keys) - 1;
		
		$sets = array();
		
		for ($i = 0; $i < $last; $i++)
		{
			$sets[] = '`' . $keys[$i] . '` = :' . $keys[$i];
		}
		
		$query = 'UPDATE `' . $table . '` SET ' . implode(', ', $sets) . ' WHERE `' . $keys[$last] . '` = :' . $keys[$last] . ';';
		
		return self::Query($query, $args);
	}
	
	/**
	 * Преобразование сокращений к типу PDO::PARAM_INPUT_OUTPUT
	 *
	 * @param string $value - сокращение
	 *
	 * @return PDO::PARAM_INPUT_OUTPUT - PDO::PARAM_* константа
	 */
	private static function valueParameters($value)
	{
		if (!isset($value[1])) $value[1] = gettype($value);
		
		$value[1] = strtolower($value[1]);
		
		switch ($value[1])
		{
			case 'boolen':
			case 'bool':
				$value[1] = \PDO::PARAM_BOOL;
				break;
			case 'null':
				$value[1] = \PDO::PARAM_NULL;
				break;
			case 'integer':
			case 'int':
				$value[1] = \PDO::PARAM_INT;
				break;
			case 'string':
			case 'str':
				$value[1] = \PDO::PARAM_STR;
				break;
			case 'lob':
				$value[1] = \PDO::PARAM_LOB;
				break;
			case 'stmt':
				$value[1] = \PDO::PARAM_STMT;
				break;
			default:
				$value[1] = \PDO::PARAM_STR;
				break;
		}
		
		if (!isset($value[2])) return array('value' => $value[0], 'type' => $value[1]);
		else return array('value' => $value[0], 'type' => $value[1], 'length' => $value[2]);
	}
}