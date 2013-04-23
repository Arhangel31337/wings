<?php

namespace Wings;

class Singleton
{
	private static $instance;
	
	final private function __construct()
	{
		
	}
	
	final private function __clone()
	{
		
	}
	
	final public static function Instance()
	{
		$class = \get_called_class();
		
		if (!isset(self::$instance[$class])) self::$instance[$class] = new $class;
		return self::$instance[$class];
	}
}

?>