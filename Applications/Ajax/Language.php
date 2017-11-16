<?php

namespace Applications\Ajax;

final class Language extends Controller
{
	public function __construct()
	{
		$this->model = new \Applications\Models\Language();
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
		
		$language = $this->model->prepareModel();
		
		$language =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model::$columns,
				'name'		=> $this->model::$words['add'],
				'type'		=> 'form'
			]
		];
		
		self::json($language);
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
		$languages = $this->model->getAll();
		
		$languages =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model::$columns,
				'items'		=> $languages,
				'name'		=> $this->model::$words['list'],
				'type'		=> $this->model::$type
			]
		];
		
		self::json($languages);
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