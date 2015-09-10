<?php

namespace Applications\BackEnd\Group;

final class Controller extends \Applications\BackEnd\Controller
{
	function __construct ()
	{
		Model::setWords();
		
		parent::__construct();
		$this->view = new View();
	}
	
	public function add()
	{
		if ($this->issetAllData(Model::$columns) && $this->validate(Model::$columns))
		{
			Model::insert();
			
			$this->backToList();
		}
		
		$group = Model::prepareModel();
		
		$this->view->add($group);
	}
	
	public function change($id)
	{
		if ($this->issetAllData(Model::$columns) && $this->validate(Model::$columns))
		{
			Model::update();
			
			$this->backToItem();
		}
		
		$group = Model::getByID($id);
		
		$this->view->change($group);
	}
	
	public function index()
	{
		$groups = Model::getAll();
		
		$this->view->tree($groups);
	}
	
	public function item($id)
	{
		$group = Model::getByID($id);
		
		$this->view->item($group);
	}
}