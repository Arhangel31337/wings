<?php

namespace Wings;

class Autoloader
{
	public static $debug = true;
	
	public static function ArrayFiles($filePath)
	{
		if (\substr($_SERVER['DOCUMENT_ROOT'], -1) !== '/') $dataFile = \str_replace($_SERVER['DOCUMENT_ROOT'] . '/', '', $filePath);
		else $dataFile = \str_replace($_SERVER['DOCUMENT_ROOT'], '', $filePath);
		
		$dataFile = \Wings::$dir . 'Compile/' . \str_replace(array('/', '.'), '_', $dataFile) . '.dat';
		
		if (!\file_exists($dataFile) || \filemtime($dataFile) <= \filemtime($filePath))
		{
			$result = require $filePath;
			
			$file = \fopen($dataFile, 'w');
			
			if ($file)
			{
				\fwrite($file, \serialize($result));
				\fclose($file);
			}
		}
		else $result = \unserialize(\file_get_contents($dataFile));
		
		return $result;
	}
	
	public static function Autoload($class)
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