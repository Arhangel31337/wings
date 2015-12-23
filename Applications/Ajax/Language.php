<?php

namespace Applications\Ajax;

final class Language extends Controller
{
	public function __construct()
	{
		$this->model = new \Applications\Models\Language();
		$this->model->model = $this->model;
		$this->model->setWords();
	}
	
	public function add($data, $accesses)
	{
		$access = self::checkAccess($accesses, 'update');
		
		if ($access !== true) return self::json($access);
		
		$model = $this->model;
		
		if ($this->issetAllData($model::$columns) && $this->validate($model::$columns))
		{
			$id = $this->model->insert($model::$columns, $data);
			
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
				'columns'	=> $model::$columns,
				'name'		=> $model::$words['item'] . ' "Новый"',
				'type'		=> 'form'
			]
		];
		
		self::json($language);
	}
	
	public function index($data, $accesses)
	{
		$access = self::checkAccess($accesses, 'select');
		
		if ($access !== true) return self::json($access);
		
		$model = $this->model;
		
		$languages = $this->model->getAll();
		
		$languages =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $model::$columns,
				'items'		=> $languages,
				'name'		=> $model::$words['list'],
				'type'		=> $model::$type
			]
		];
		
		self::json($languages);
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
		
		$language = $this->model->getByID($data['id']);
		
		$language =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $model::$columns,
				'name'		=> $model::$words['item'] . ' "' . $language['name'] . '"',
				'item'		=> $language,
				'type'		=> 'form'
			]
		];
		
		self::json($language);
	}
	
	public function remove($data, $accesses)
	{
		$access = self::checkAccess($accesses, 'delete');
		
		if ($access !== true) return self::json($access);
		
		$model = $this->model;
		
		if (!isset(\Wings::$post['ids']) || empty(\Wings::$post['ids']))
		{
			return self::json([
				'code'			=> 500,
				'description'	=> 'Не хватает данных.'
			]);
		}
		
		foreach (\Wings::$post['ids'] as $id) $this->model->delete($id);
		
		return self::json([
			'code'			=> 200,
			'description'	=> ''
		]);
	}
}