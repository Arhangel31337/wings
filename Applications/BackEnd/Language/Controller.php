<?php

namespace Applications\BackEnd\Language;

final class Controller extends \Applications\BackEnd\Controller
{
	public function __construct ()
	{
		Model::setWords();
		
		parent::__construct();
		$this->view = new View();
	}
	
	public function add()
	{
		if ($this->issetAllData(Model::$columns) && $this->validate(Model::$columns))
		{
			Model::insert(Model::$columns, \Wings::$post);
			
			$this->backToList();
		}
		
		$language = Model::prepareModel();
		
		$this->view->add($language);
	}
	
	public function change($id)
	{
		if ($this->issetAllData(Model::$columns) && $this->validate(Model::$columns))
		{
			Model::update(Model::$columns, \Wings::$post);
			
			$this->backToItem();
		}
		
		$language = Model::getByID($id);
		
		$this->view->change($language);
	}
	
	public function index()
	{
		$languages = Model::getAll();
		
		$this->view->items($languages);
	}
	
	public function item($id)
	{
		$language = Model::getByID($id);
		
		$this->view->item($language);
	}
	
	public function remove()
	{
		$ajax = new \Applications\Ajax\Controller();
		
		if (!isset(\Wings::$post['ids']) || empty(\Wings::$post['ids'])) return $ajax->json(['code' => 204]);
		
		foreach (\Wings::$post['ids'] as $id) Model::delete($id);
		
		return $ajax->json(['code' => 200]);
	}
}