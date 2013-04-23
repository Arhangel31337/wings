<?php

namespace Applications\FrontEnd;

class Workspace
{
	final public static function Initialize()
	{
		$result = FrontEndModel::GetMVC(implode('/', \Wings::$pathname));
		
		if (empty($result) || !isset($result[0]['name']))
		{
			$result[0]['name'] = 'Error';
			$result[0]['method'] = 'Index';
		}
		elseif (!isset($result[0]['method']) || is_null($result[0]['method'])) $result[0]['method'] = 'Index';
		
		$result[0]['name'] = \Wings::$workspace['namespace'] . $result[0]['name'] . '\Controller';
		
		$mvc = new $result[0]['name']();
		
		$mvc->$result[0]['method']();;
	}
}