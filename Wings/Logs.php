<?php

namespace Wings;

class Logs
{
	const logDir = 'Logs/';
	private static $dir;
	
	public static function Autoload($writeData)
	{
		self::$dir = \Wings::$dir . self::logDir . 'Autoload/';
		self::WriteLog($writeData);
	}
	
	private static function Conversion($object)
	{
		\ob_start();
		if (is_array($object))
		{
			\var_dump($object);
			$object = \ob_get_clean();
		}
		if (is_object($object))
		{
			\var_dump($object);
			$object = \ob_get_clean();
		}
		\ob_end_clean();
		
		return $object;
	}
	
	private static function WriteLog($writeData)
	{
		$filePath = self::$dir . \date('Y-m-d') . '.log';
		
		$file = \fopen($filePath, 'a');
		\flock($file, \LOCK_EX);
		\fwrite($file, \date('Y-m-d H:i:s') . ' ' . $writeData . \PHP_EOL);
		\flock($file, \LOCK_UN);
		\fclose($file);
	}
}

?>