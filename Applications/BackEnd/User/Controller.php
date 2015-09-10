<?php

namespace Applications\BackEnd\User;

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
		
		$user = Model::prepareModel();
		
		$user['isActive'] = 1;
		
		$this->view->add($user);
	}
	
	public function change($id)
	{
		if ($this->issetAllData(Model::$columns) && $this->validate(Model::$columns))
		{
			Model::update();
			
			$this->backToItem();
		}
		
		$user = Model::getByID($id);
		
		$user['password'] = '';
		
		$this->view->change($user);
	}
	
	public function index()
	{
		$users = Model::getAll();
		
		$this->view->items($users);
	}
	
	public function item($id)
	{
		$user = Model::getByID($id);
		
		$this->view->item($user);
	}
}