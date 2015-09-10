<?php

namespace Wings\Tree;

interface iTree
{
	/**
	 * Удалить узел
	 * 
	 * @param string $table - Наименование таблицы
	 * @param int $nodeID - ИД узла
	 * 
	 * @return null
	 */
	public static function deleteNode($table, $nodeID);
	
	/**
	 * Получить узел
	 * 
	 * @param unknown $table
	 * @param unknown $nodeID
	 */
	public static function getNode($table, $nodeID);
	
	/**
	 * Вставить узел
	 * 
	 * @param string $table - Наименование таблицы
	 * @param int $parentID - ИД родителя
	 * 
	 * @return null
	 */
	public static function insertNode($table, $parentID, $args);
	
	/**
	 * Выбор всех записей
	 * 
	 * @param string $table - Наименование таблицы
	 * 
	 * @return array
	 */
	public static function selectAll($table);
	
	/**
	 * Выбор всех детей
	 * 
	 * @param string $table - Наименование таблицы
	 * @param int $parentID - ИД родителя
	 * 
	 * @return array
	 */
	public static function selectChildrens($table, $parentID, $userID);
	
	/**
	 * Выбор ветки, в которой есть данный узел
	 * 
	 * @param string $table - Наименование таблицы
	 * @param int $nodeID - ИД узла
	 * 
	 * @return array
	 */
	public static function selectCurrentBranch($table, $nodeID);
	
	/**
	 * Выбор всех родителей
	 * 
	 * @param string $table - Наименование таблицы
	 * @param int $childID - ИД потомка
	 * 
	 * @return array
	 */
	public static function selectParents($table, $childID, $args = [], $select = [], $join = [], $where = [], $group = []);
	
	/**
	 * Переместить ветку
	 * 
	 * @param string $table - Наименование таблицы
	 * @param int $nodeID - ИД узла
	 * @param int $nearNodeID - ИД нижеидущего узла
	 * 
	 * @return null
	 */
	public static function updateNode($table, $nodeID, $parentID, $nearNodeID);
}