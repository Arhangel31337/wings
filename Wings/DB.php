<?php

/**
 * Project:     Wings: framework для собственных нужд
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

class DB
{
	private static $pdo = array();
	public static $currentBase = 0;
	
	/**
	 * Удаления записи из таблицы
	 *
	 * @param string $table - наименование таблицы в БД
	 * @param array $wheres - массив условий вида array('columnName' => 'condition')
	 * @param array $args - массив подстановочных данных вида array(array('value', 'type', 'length'))
	 *
	 * @return PDOStatement - объект оператора
	 */
	public static function Delete($table, $wheres, $args)
	{
		$where = array();
		
		foreach ($wheres as $key => $value)
		{
			$where[] = '`' . $key . '` ' . $value . ' :' . $key;
		}
		
		$query = 'DELETE FROM `' . $table . '` WHERE ' . implode(' AND ', $where);
		
		return self::Query($query, $args);
	}
	
	/**
	 * Создания подключений к БД
	 * 
	 * @param array $settings - параметры подключения к БД
	 * 
	 * @return void
	 */
	public static function Init($settings)
	{
		try
		{
			if (isset($settings['type']))
			{
				self::$pdo[] = new \PDO($settings['type'] . ':host=' . $settings['host'] . ';dbname=' . $settings['name'], $settings['login'], $settings['password']);
				self::$pdo[self::$currentBase]->query('SET character_set_connection = ' . $settings['charset'] . ';');
				self::$pdo[self::$currentBase]->query('SET character_set_client = ' . $settings['charset'] . ';');
				self::$pdo[self::$currentBase]->query('SET character_set_results = ' . $settings['charset'] . ';');
			}
			elseif (isset($settings[0]['type'])) 
			{
				foreach ($settings as $key => $value)
				{
					self::$pdo[$key] = new \PDO($value['type'] . ':host=' . $value['host'] . ';dbname=' . $value['name'], $value['login'], $value['password']);
					self::$pdo[$key]->query('SET character_set_connection = ' . $value['charset'] . ';');
					self::$pdo[$key]->query('SET character_set_client = ' . $value['charset'] . ';');
					self::$pdo[$key]->query('SET character_set_results = ' . $value['charset'] . ';');
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
	 * @param array $args - массив подстановочных данных вида array(array('value', 'type', 'length'))
	 *
	 * @return PDOStatement - объект оператора
	 */
	public static function Insert($table, $args)
	{
		$keys = array_keys($args);
		
		$query = 'INSERT INTO `' . $table . '` (`' . implode('`, `', $keys) . '`) VALUES (:' . implode(', :', $keys) . ');';
		
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
	public static function FetchAll($query, $args = array(), $fetchType = 'assoc')
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
	public static function FetchColumn($query, $args, $column = 0)
	{
		$statement = self::Query($query, $args);
		return $statement->fetchColumn($column);
	}
	
	/**
	 * Преобразование сокращений в значения PDO::ATTR_FETCH_MODE
	 *
	 * @param string $fetchType - сокращение
	 *
	 * @return PDO::ATTR_FETCH_MODE - PDO::FETCH_* константа
	 */
	private static function FetchType($fetchType)
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
	 * @param string $order = null - наименование полей для сортировки
	 * @param array $args - массив подстановочных данных вида array(array('value', 'type', 'length'))
	 *
	 * @return PDOStatement - объект оператора
	 */
	public static function Select($table, $select, $wheres = null, $args = null, $order = null)
	{
		$query = 'SELECT ' . $select . ' FROM `' . $table . '`';
		
		if ($wheres !== null)
		{
			$where = array();
			
			foreach ($wheres as $key => $value)
			{
				$where[] = '`' . $key . '` ' . $value . ' :' . $key;
			}
			
			$query .= ' WHERE ' . implode(' AND ', $where);
		}
		
		if ($order !== null)
		{
			$query .= ' ORDER BY ' . $order;
		}
		
		return self::FetchAll($query, $args);
	}
	
	/**
	 * Открытие/закрытие транзакции
	 *
	 * @param string $type = 'off' - переключатель on|off
	 *
	 * @return void
	 */
	public static function Transaction($type = 'off')
	{
		if ($type === 'on') self::$pdo[self::$currentBase]->beginTransaction();
		else self::$pdo[self::$currentBase]->commit();
	}
	
	/**
	 * Выполнение запроса
	 *
	 * @param string $query - SQL-запрос
	 * @param array $args - массив подстановочных данных вида array(array('value', 'type', 'length'))
	 *
	 * @return PDOStatement - объект оператора
	 */
	private static function Query($query, $args = array())
	{
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
			$query->execute();
		}
		catch (\PDOException $exception)
		{
			throw new \Exception($exception->getMessage());
		}
		
		return $query;
	}
	
	/**
	 * Обновление записи в таблице
	 *
	 * @param string $table - наименование таблицы в БД
	 * @param array $args - массив подстановочных данных вида array(array('value', 'type', 'length'))
	 *
	 * @return PDOStatement - объект оператора
	 */
	public static function Update($table, $args)
	{
		$keys = array_keys($args);
		$last = count($keys) - 1;
		
		$sets = array();
		
		for ($i = 0; $i < $last; $i++)
		{
			$sets[] = '`' . $keys[$i] . '` = :' . $keys[$i];
		}
		
		$query = 'UPDATE `' . $table . '` SET ' . implode(', ', $sets) . ' WHERE `' . $keys[$last] . '` = :' . $keys[$last];
		
		return self::Query($query, $args);
	}
	
	/**
	 * Преобразование сокращений к типу PDO::PARAM_INPUT_OUTPUT
	 *
	 * @param string $value - сокращение
	 *
	 * @return PDO::PARAM_INPUT_OUTPUT - PDO::PARAM_* константа
	 */
	private static function ValueParameters($value)
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