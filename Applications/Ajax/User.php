<?php

namespace Applications\BackEnd;

final class User extends Controller
{
	function __construct ()
	{
		$this->model = new \Applications\Models\User();
		
		$this->model->setWords();
		
		parent::__construct();
		$this->view = new View();
	}
	
	public function add()
	{
		if ($this->issetAllData($this->model->columns) && $this->validate($this->model->columns))
		{
			$this->model->insert();
			$this->backToList();
		}
		
		$user = $this->model->prepareModel();
		
		$user['isActive'] = 1;
		
		$user =
		[
			'name'		=> $this->model->words['add'],
			'columns'	=> $this->model->columns,
			'values'	=> $user
		];
		
		$this->view->add($user);
	}
	
	public function change($id)
	{
		if ($this->issetAllData($this->model->columns) && $this->validate($this->model->columns))
		{
			$this->model->update();
			
			$this->backToItem();
		}
		
		$user = $this->model->getByID($id);
		
		$user['password'] = '';
		
		$user =
		[
			'name'		=> $this->model->words['change'],
			'columns'	=> $this->model->columns,
			'values'	=> $user
		];
		
		$this->view->change($user);
	}
	
	public function index()
	{
		$users = $this->model->getAll();
		
		$users =
		[
			'name'		=> $this->model->words['list'],
			'columns'	=> $this->model->columns,
			'items'		=> $users
		];
		
		$this->view->items($users);
	}
	
	public function item($id)
	{
		$user = $this->model->getByID($id);
		
		$user =
		[
			'name'		=> $this->model->words['item'] . ' "' . $user['login'] . '"',
			'columns'	=> $this->model->columns,
			'item'		=> $user
		];
		
		$this->view->item($user);
	}
}