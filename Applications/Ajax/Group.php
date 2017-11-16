<?php

namespace Applications\Ajax;

final class Group extends Controller
{
	function __construct()
	{
		$this->model = new \Applications\Models\Group();
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
		
		$group = $this->model->prepareModel();
		
		$group =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model::$columns,
				'name'		=> $this->model::$words['add'],
				'type'		=> 'form'
			]
		];
		
		self::json($group);
	}
	
	public function change($id)
	{
		if (self::issetAllData($this->model::$columns) && self::validate($this->model::$columns))
		{
			$this->model->update();
			
			self::json([
				'code'			=> 200,
				'description'	=> ''
			]);
		}
		else
		{
			self::json([
				'code'			=> 500,
				'description'	=> 'Не хватает данных.'
			]);
		}
	}
	
	public function index($data)
	{
		$groups = $this->model->getAll();
		
		$groups =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model::$columns,
				'items'		=> $groups,
				'name'		=> $this->model::$words['list'],
				'type'		=> $this->model::$type
			]
		];
		
		self::json($groups);
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
		
		$language = $this->model->getByID($data['id']);
		
		$language =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model::$columns,
				'item'		=> $language,
				'name'		=> $this->model::$words['item'] . ' "' . $language['name'] . '"',
				'type'		=> 'form'
			]
		];
		
		self::json($language);
	}
	
	public function remove($data)
	{
		if (!isset(\Wings::$post['ids']) || empty(\Wings::$post['ids']))
		{
			return self::json([
				'code'			=> 500,
				'description'	=> 'Не хватает данных.'
			]);
		}
		
		foreach (\Wings::$post['ids'] as $id) $this->model->delete($id);
		
		self::json([
			'code'			=> 200,
			'description'	=> ''
		]);
	}
}