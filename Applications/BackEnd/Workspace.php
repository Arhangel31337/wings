<?php

namespace Applications\BackEnd;

final class Workspace
{
	public static function initialize()
	{
		if (\Wings::$user->getIsActive() != 1)
		{
			$method = 'index';
			
			if (isset(\Wings::$pathname[1]) && \Wings::$pathname[0] === 'authorization') $method = \Wings::$pathname[1];
			
			return self::authorize($method);
		}
		
		$mvc = new \Applications\BackEnd\Index();
	}
	
	public static function authorize($method = 'index')
	{
		$mvc = new \Applications\BackEnd\Authorization();
		return $mvc->$method();
	}
}