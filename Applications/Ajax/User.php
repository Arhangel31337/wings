<?php

namespace Applications\Ajax;

final class User extends Controller
{
	function __construct ()
	{
		$this->model = new \Applications\Models\User();
		$this->model->model = $this->model;
		$this->model->setWords();
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
	
	public function index($data, $accesses)
	{
		$access = self::checkAccess($accesses, 'select');
		
		if ($access !== true) return self::json($access);
		
		$model = $this->model;
		
		$users = $this->model->getAll();
		
		$users =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $model::$columns,
				'items'		=> $users,
				'name'		=> $model::$words['list'],
				'type'		=> $model::$type
			]
		];
		
		self::json($users);
	}
	
	public function item($data, $accesses)
	{
		$access = self::checkAccess($accesses, 'update');
		
		if ($access !== true) return self::json($access);
		
		$model = $this->model;
		
		if ($this->issetAllData($model::$columns) && $this->validate($model::$columns))
		{
			$this->model->update($model::$columns, \Wings::$post);
			
			return self::json([
				'code'			=> 200,
				'description'	=> ''
			]);
		}
		
		if (!isset($data['id']))
		{
			return self::json([
				'code'			=> 500,
				'description'	=> 'Не хватает данных.'
			]);
		}
		
		$user = $this->model->getByID($data['id']);
		
		$user =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $model::$columns,
				'item'		=> $user,
				'name'		=> $model::$words['item'] . ' "' . $user['login'] . '"',
				'type'		=> 'form'
			]
		];
		
		self::json($user);
	}
}