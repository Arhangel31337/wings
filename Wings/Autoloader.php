<?php

namespace Wings;

class Autoloader
{
	public static $debug = true;
	
	public static function arrayFiles($filePath)
	{
		if (\substr($_SERVER['DOCUMENT_ROOT'], -1) !== '/') $dataFile = \str_replace($_SERVER['DOCUMENT_ROOT'] . '/', '', $filePath);
		else $dataFile = \str_replace($_SERVER['DOCUMENT_ROOT'], '', $filePath);
		
		Directory::create(\Wings::$dir . 'Compile/');
		
		$dataFile = \Wings::$dir . 'Compile/' . \str_replace(array('/', '.'), '_', $dataFile) . '.dat';
		
		if (!\file_exists($dataFile) || \filemtime($dataFile) <= \filemtime($filePath))
		{
			if (\file_exists($filePath))
			{
				$result = require $filePath;
				
				$file = \fopen($dataFile, 'w');
				
				if ($file)
				{
					\fwrite($file, \serialize($result));
					\fclose($file);
				}
			}
			else return null;
		}
		else $result = \unserialize(\file_get_contents($dataFile));
		
		return $result;
	}
	
	public static function autoload($class)
	{
		$filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . \str_replace('\\', '/', $class) . '.php';
		
		if (\file_exists($filePath))
		{
			require $filePath;
			if (self::$debug) \Wings\Logs::Autoload('Файл ' . $filePath . ' подключён.');
		}
		else if (self::$debug) \Wings\Logs::Autoload('Файл ' . $filePath . ' не найден.');
	}
}

\spl_autoload_register('\Wings\Autoloader::Autoload');