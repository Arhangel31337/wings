<?php

namespace Applications\Ajax;

class Controller extends \Applications\Controller
{
	protected $model;
	protected static $view;
	
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
	
	public static function xml($data)
	{
		$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><data />');
		
		arrayToXML($data, $xml);
		
		self::$view = new View();
		self::$view->xml($xml->asXML());
	}
}

?>