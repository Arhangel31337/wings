<?php

namespace Applications\Ajax;

final class Workspace
{
	public static function initialize()
	{
		$view = new View();
		
		if (\Wings::$user->getIsActive() != 1)
		{
			$data =
			[
				'code'			=> 401,
				'description'	=> 'Необходимо авторизоваться.'
			];
			
			return $view->json($data);
		}
		
		$method = 'list';
		
		if (isset(\Wings::$pathname[1]))  $method = \Wings::$pathname[1];
		
		$mvc = \Wings::$workspace['namespace'] . \ucfirst(\Wings::$pathname[0]);
		
		if(!method_exists($mvc, $method)) throw new \Exception('У класса ' . $mvc . ' не существует метода ' . $method . ' .');
		
		$accesses = \Wings\Page::getPageTypeAccess(\Wings::$pathname[0]);
		
		$access = false;
		
		switch ($method)
		{
			case 'add':
				$access = \Applications\Controller::checkAccess($accesses, 'insert');
				break;
			case 'change':
				$access = \Applications\Controller::checkAccess($accesses, 'update');
				break;
			case 'remove':
				$access = \Applications\Controller::checkAccess($accesses, 'delete');
				break;
			default:
				$access = \Applications\Controller::checkAccess($accesses, 'select');
				break;
		}
		
		if ($access !== true) return $view->json($access);
		
		$mvc = new $mvc($accesses);
		
		$mvc->$method(\Wings::$post);
	}
}