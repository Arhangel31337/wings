<?php

namespace Applications\BackEnd;

class View
{
	private static $formDefaultEnctype = 'application/x-www-form-urlencoded';
	private static $formFileEnctype = 'multipart/form-data';
	
	public function __construct()
	{
		\Wings::$view['tpl'] = 'default.tpl';
	}
	
	public function add($element)
	{
		$element['columns'] = $this->setColumnsValues($element['columns'], $element['values']);
		
		$this->issetFileField($element['columns']);
		
		\Wings::$view['files']['js'][] = ['async' => true, 'src' => '/js/BackEnd/form.js'];
		\Wings::$view['contentTPL'] = 'form/add.tpl';
		\Wings::$view['element'] = $element;
	}
	
	public function change($element)
	{
		$element['columns'] = $this->setColumnsValues($element['columns'], $element['values']);
		
		$this->issetFileField($element['columns']);
		
		\Wings::$view['files']['js'][] = ['async' => true, 'src' => '/js/BackEnd/form.js'];
		\Wings::$view['contentTPL'] = 'form/change.tpl';
		\Wings::$view['element'] = $element;
	}
	
	private function cleanColumns($columns)
	{
		foreach ($columns as $key => $value)
		{
			if (isset($value['isFormF']) && $value['isFormF'] === true) unset($columns[$key]);
		}
		
		return $columns;
	}
	
	private function issetFileField($columns)
	{
		foreach ($columns as $column)
		{
			if ($column['field']['type'] === 'file')
			{
				\Wings::$view['formEnctype'] = self::$formFileEnctype;
				return;
			}
		}
		
		\Wings::$view['formEnctype'] = self::$formDefaultEnctype;
	}
	
	public function item($element)
	{
		$element['columns'] = $this->cleanColumns($element['columns']);
		
		\Wings::$view['files']['js'][] = ['async' => true, 'src' => '/js/BackEnd/table.js'];
		\Wings::$view['contentTPL'] = 'table/item.tpl';
		\Wings::$view['element'] = $element;
	}
	
	public function items($list)
	{
		$list['columns'] = $this->cleanColumns($list['columns']);
		
		\Wings::$view['files']['js'][] = ['async' => true, 'src' => '/js/BackEnd/table.js'];
		\Wings::$view['contentTPL'] = 'table/list.tpl';
		\Wings::$view['list'] = $list;
	}
	
	public function tree($tree)
	{
		$tree['columns'] = $this->cleanColumns($tree['columns']);
		
		\Wings::$view['files']['js'][] = ['async' => true, 'src' => '/js/BackEnd/table.js'];
		\Wings::$view['contentTPL'] = 'table/tree.tpl';
		\Wings::$view['tree'] = $tree;
	}
	
	private function setColumnsValues($columns, $values)
	{
		foreach ($columns as $key => $column)
		{
			if (isset($values[$key])) $columns[$key]['value'] = $values[$key];
		}
		
		return $columns;
	}
	
	public static function setBreadcrumbs($breadcrumbs)
	{
		\Wings::$view['breadcrumbs'] = $breadcrumbs;
	}
	
	public static function setNavigation($tree)
	{
		\Wings::$view['navigation'] = $tree;
	}
}