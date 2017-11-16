<?php

namespace Applications\Ajax;

final class User extends Controller
{
	function __construct ()
	{
		$this->model = new \Applications\Models\User();
	}
	
	public function add($data)
	{
		if ($this->issetAllData($this->model::$columns) && $this->validate($this->model::$columns))
		{
			$id = $this->model->insert();
			
			return self::json([
				'code'			=> 200,
				'description'	=> $id
			]);
		}
		
		$user = $this->model->prepareModel();
		
		$user['isActive'] = 1;
		
		$user =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model::$columns,
				'name'		=> $this->model::$words['add'],
				'type'		=> 'form'
			]
		];
		
		self::json($user);
	}
	
	public function change($id)
	{
		if (self::issetAllData($this->model::$columns) && self::validate($this->model::$columns))
		{
			$this->model->update();
			
			return self::json([
				'code'			=> 200,
				'description'	=> ''
			]);
		}
		else
		{
			return self::json([
				'code'			=> 500,
				'description'	=> 'Не хватает данных.'
			]);
		}
	}
	
	public function index($data)
	{
		$users = $this->model->getAll();
		
		$users =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model::$columns,
				'items'		=> $users,
				'name'		=> $this->model::$words['list'],
				'type'		=> $this->model::$type
			]
		];
		
		self::json($users);
	}
	
	public function item($data)
	{
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
				'columns'	=> $this->model::$columns,
				'item'		=> $user,
				'name'		=> $this->model::$words['item'] . ' "' . $user['login'] . '"',
				'type'		=> 'form'
			]
		];
		
		self::json($user);
	}
}