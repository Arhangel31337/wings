<?php

namespace Applications\Ajax;

class Controller
{
	protected $model;
	protected static $view;
	
	protected static function checkAccess($accesses, $type)
	{
		if ($accesses[$type] === 0)
		{
			return
			[
				'code'			=> 403,
				'description'	=> 'Доступ запрещён.'
			];
		}
		
		return true;
	}
	
	public static function csv($data)
	{
		self::$view = new View();
		
		$strings = [];
		
		foreach ($data as $string)
		{
			$rows = [];
			
			foreach ($string as $row) $rows[] = $row;
			
			$strings[] = \implode(';', $rows);
		}
		
		self::$view->json(\implode("\n", $strings));
	}
	
	public function issetAllData($columns)
	{
		foreach ($columns as $key => $value)
		{
			if (isset($value['generated']) && $value['generated'] === true && !isset($field['field']['isConfirm'])) continue;
			if ($value['field']['type'] === 'checkbox') continue;
			
			if (isset(\Wings::$post[$key])) continue;
			else return false;
		}
		
		return true;
	}
	
	public static function html($file, $data)
	{
		self::$view = new View();
		self::$view->html($file, $data);
	}
	
	public static function json($data)
	{
		self::$view = new View();
		self::$view->json(json_encode($data));
	}
	
	public static function text($data)
	{
		self::$view = new View();
		self::$view->json($data);
	}
	
	protected static function validate($fields)
	{
		foreach ($fields as $key => $field)
		{
			if (!isset($field['validate']) && !isset($field['field']['isConfirm'])) continue;
			
			if (isset($field['validate']))
			{
				foreach ($field['validate'] as $value)
				{
					if ($value === 'checked' && !isset(\Wings::$post[$key])) return false;
					if (!\Wings\Validation::$value(\Wings::$post[$key])) return false;
				}
			}
			
			if (isset($field['field']['isConfirm']))
			{
				if (\Wings::$post[$key] !== \Wings::$post[$field['field']['fieldKey']]) return false;
			}
		}
	
		return true;
	}
	
	public static function xml($data)
	{
		$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><data />');
		
		arrayToXML($data, $xml);
		
		self::$view = new View();
		self::$view->xml($xml->asXML());
	}
}

?>