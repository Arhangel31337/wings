<?php

namespace Applications\Ajax;

final class View
{
	public function __construct()
	{
		\Wings::$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'] . '/Templates/Ajax/');
	}
	
	public function csv($data)
	{
		$strings = [];
		
		foreach ($data as $string)
		{
			$rows = [];
			
			foreach ($string as $row) $rows[] = $row;
			
			$strings[] = \implode(';', $rows);
		}
		
		self::json(\implode("\n", $strings));
	}
	
	public function html($file, $data)
	{
		\header('Content-type: text/html; charset=UTF-8');
		
		\Wings::$view['tpl'] = 'html.tpl';
		\Wings::$view['file'] = $file;
		
		foreach ($data as $key => $value) \Wings::$view[$key] = $value;
	}
	
	public function json($data)
	{
		\header('Content-type: application/json; charset=UTF-8');
		
		\Wings::$view['tpl'] = 'json.tpl';
		\Wings::$view['json'] = \json_encode($data);
	}
	
	public function xml($data)
	{
		$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><data />');
		
		arrayToXML($data, $xml);
		
		\header('Content-type: text/xml; charset=UTF-8');
		
		\Wings::$view['tpl'] = 'xml.tpl';
		\Wings::$view['xml'] = $xml->asXML();
	}
}