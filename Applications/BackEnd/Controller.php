<?php

namespace Applications\BackEnd;

class Controller
{
	protected $model;
	protected $view;
	
	public function __construct()
	{
		$menuTree = \Wings\Page::selectAllAvailable();
		
		View::setNavigation($menuTree[0]['childrens']);
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
	
	public function move($id)
	{
		$model = '\\' . str_replace('\\Controller', '\\Model', \get_called_class());
		
		Model::move($model, $id, \Wings::$post['parentID'], \Wings::$post['nearNodeID']);
		
		$ajax = new \Applications\Ajax\Controller();
		
		return $ajax->json(['code' => 200]);
	}
}