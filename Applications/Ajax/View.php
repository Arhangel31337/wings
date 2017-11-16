<?php

namespace Applications\Ajax;

final class View
{
	public function __construct()
	{
		\Wings::$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'] . '/Templates/Ajax/');
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
		\Wings::$view['json'] = $data;
	}
	
	public function xml($data)
	{
		\header('Content-type: text/xml; charset=UTF-8');
		
		\Wings::$view['tpl'] = 'xml.tpl';
		\Wings::$view['xml'] = $data;
	}
}