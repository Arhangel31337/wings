<?php

namespace Applications\BackEnd;

class Workspace
{
	final public static function Initialize()
	{
		$result = \Applications\Model::GetMVC(\Wings::$workspace['host'], \Wings::$workspace['name'], implode('/', \Wings::$pathname));
		
		if (empty($result) || !isset($result['name']))
		{
			$result['name'] = 'Error';
			$result['method'] = 'Index';
			$result['args'] = 404;
		}
		elseif (!isset($result['method']) || is_null($result['method'])) $result['method'] = 'Index';
		
		$result['name'] = \Wings::$workspace['namespace'] . $result['name'] . '\Controller';
		
		$mvc = new $result['name']();
		
		if (isset($result['args']) && !empty($result['args'])) $mvc->$result['method']($result['args']); 
		else $mvc->$result['method']();
	}
}