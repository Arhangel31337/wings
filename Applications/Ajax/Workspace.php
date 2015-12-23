<?php

namespace Applications\Ajax;

final class Workspace
{
	public static function initialize()
	{
		if (!isset(\Wings::$pathname[0])) return \Applications\BackEnd\Workspace::authorize();
		
		if (\Wings::$user->getIsActive() != 1)
		{
			$data =
			[
				'code'			=> 403,
				'description'	=> 'Необходимо авторизоваться.'
			];
			
			return \Applications\Ajax\Controller::json($data);
		}
		
		$method = 'index';
		
		if (isset(\Wings::$pathname[1]) && \Wings::$pathname[1] !== 'list')  $method = \Wings::$pathname[1];
		
		$mvc = \Wings::$workspace['namespace'] . \ucfirst(\Wings::$pathname[0]);
		
		if(!method_exists($mvc, $method)) throw new \Exception('У класса ' . $mvc . ' не существует метода ' . $method . ' .');
		
		$accesses = \Wings\Page::getPageTypeAccess(\Wings::$pathname[0]);
		
		$mvc = new $mvc();
		$mvc->$method(\Wings::$post, $accesses);
	}
}