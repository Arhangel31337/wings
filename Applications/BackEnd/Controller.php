<?php

namespace Applications\BackEnd;

class Controller
{
	protected $model;
	protected $view;
	
	public function __construct()
	{
		$menuTree = \Wings\Page::selectAllAvailable();
		$breadcrumbs = \Wings\Page::selectParents(\Wings::$page['id']);
		
		View::setNavigation($menuTree[0]['childrens']);
		View::setBreadcrumbs($breadcrumbs);
	}
	
	public function backToItem()
	{
		$url = explode('/', $_SERVER['REQUEST_URI']);
		$url[(count($url) - 2)] = 'item';
		$url = implode('/', $url);
		
		\Wings\Header::setLocation($url);
	}
	
	public function backToList()
	{
		$url = explode('/', $_SERVER['REQUEST_URI']);
		unset($url[(count($url) - 2)]);
		unset($url[(count($url) - 2)]);
		$url = implode('/', $url);
		
		\Wings\Header::setLocation($url);
	}
	
	public function issetAllData($columns)
	{
		foreach ($columns as $key => $value)
		{
			if (isset($value['generated']) && $value['generated'] === true && !isset($field['field']['isConfirm'])) continue;
			if ($value['field']['type'] === 'checkbox') continue;
			
			if (isset(\Wings::$post[$key])) continue;
			else return false;
		}
		
		return true;
	}
	
	public function move($id)
	{
		$model = '\\' . str_replace('\\Controller', '\\Model', \get_called_class());
		
		Model::move($model, $id, \Wings::$post['parentID'], \Wings::$post['nearNodeID']);
		
		$ajax = new \Applications\Ajax\Controller();
		
		return $ajax->json(['code' => 200]);
	}
	
	public function validate($fields)
	{
		foreach ($fields as $key => $field)
		{
			if (!isset($field['validate']) && !isset($field['field']['isConfirm'])) continue;
			
			if (isset($field['validate']))
			{
				foreach ($field['validate'] as $value)
				{
					if ($value === 'checked' && !isset(\Wings::$post[$key])) return false;
					if (!\Wings\Validation::$value(\Wings::$post[$key])) return false;
				}
			}
			
			if (isset($field['field']['isConfirm']))
			{
				if (\Wings::$post[$key] !== \Wings::$post[$field['field']['fieldKey']]) return false;
			}
		}
	
		return true;
	}
}