<?php

namespace Applications\BackEnd;

final class Workspace
{
	public static $reservedWords = ['add', 'change', 'item', 'move', 'remove'];
	
	public static function initialize()
	{
		if (\Wings::$user->getIsActive() != 1)
		{
			$result['mvc'] = \Wings::$workspace['namespace'] . 'Authorization\Controller';
			$mvc = new $result['mvc']();
			return $mvc->index();
		}
		
		$pathCount = \count(\Wings::$pathname) - 1;
		$lastPath = '';
		if ($pathCount !== -1) $lastPath = \Wings::$pathname[$pathCount];
		
		if (\is_numeric($lastPath))
		{
			$lastPath = 'select';
			\Wings::$pathname[] = 'select';
			$pathCount++;
		}
		
		if (in_array($lastPath, self::$reservedWords))
		{
			$method = $lastPath;
			$args = \Wings::$pathname[$pathCount - 1];
			unset(\Wings::$pathname[$pathCount]);
			unset(\Wings::$pathname[$pathCount - 1]);
		}
		
		$result = \Wings\Page::getPageMVC(\Wings::$workspace['host'], \Wings::$workspace['name'], implode('/', \Wings::$pathname));
		
		$result['access'] = \Wings\Page::getAccess($result['id']);
		
		\Wings::$page = $result;
		
		if (isset($result['access']['select']) && !$result['access']['select'])
		{
			$result['mvc'] = 'Error';
			$result['method'] = 'index';
			$result['args'] = 403;
		}
		
		if (\is_null($result) || !isset($result['mvc']))
		{
			$result['mvc'] = 'Error';
			$result['method'] = 'index';
			$result['args'] = 404;
		}
		
		if ($result['mvc'] !== 'Error' && isset($method))
		{
			$result['method'] = $method;
			$result['args'] = $args;
		}
		
		$result['mvc'] = \Wings::$workspace['namespace'] . $result['mvc'] . '\Controller';
		
		if (!isset($result['method']) || is_null($result['method'])) $result['method'] = 'index';
		
		if (!class_exists($result['mvc'])) throw new \Exception('Класс ' . $result['mvc'] . ' не существует.');
		
		$mvc = new $result['mvc']();
		
		if(!method_exists($mvc, $result['method'])) throw new \Exception('У класса ' . $result['mvc'] . ' не существует метода ' . $result['method'] . ' .');
		
		if (isset($result['args']) && !empty($result['args'])) $mvc->$result['method']($result['args']); 
		else $mvc->$result['method']();
	}
}