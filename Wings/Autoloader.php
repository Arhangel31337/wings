<?php

namespace Wings;

class Autoloader
{
	public static $debug = true;
	
	public static function ArrayFiles($filePath)
	{
		$dataFile = \Wings::$dir . 'Compile/' . \str_replace(array('/', '.'), '_', \str_replace($_SERVER['DOCUMENT_ROOT']. '/', '', $filePath)) . '.dat';
		
		if (!\file_exists($dataFile) || \filemtime($dataFile) <= \filemtime($filePath))
		{
			$result = require $filePath;
			
			if (($file = \fopen($dataFile, 'w')))
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

?>