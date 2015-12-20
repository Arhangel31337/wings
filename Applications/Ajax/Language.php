<?php

namespace Applications\Ajax;

final class Language extends Controller
{
	public function __construct()
	{
		$this->model = new \Applications\Models\Language();
		
		$this->model->setWords();
	}
	
	public function add($data, $accesses)
	{
		$access = self::checkAccess($accesses, 'update');
		
		if ($access !== true) return self::json($access);
		
		if ($this->issetAllData($this->model->columns) && $this->validate($this->model->columns))
		{
			$id = $this->model->insert($this->model->columns, $data);
			
			return
			[
				'code'			=> 200,
				'description'	=> $id
			];
		}
		
		$language = $this->model->prepareModel();
		
		$language =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model->columns,
				'name'		=> $this->model->words['item'] . ' "Новый"',
				'type'		=> 'form'
			]
		];
		
		self::json($language);
	}
	
	public function change($id)
	{
		if ($this->issetAllData($this->model->columns) && $this->validate($this->model->columns))
		{
			$this->model->update($this->model->columns, \Wings::$post);
			
			$this->backToItem();
		}
		
		$language = $this->model->getByID($id);
		
		$language =
		[
			'name'		=> $this->model->words['change'],
			'columns'	=> $this->model->columns,
			'values'	=> $language
		];
		
		$this->view->change($language);
	}
	
	public function index($data, $accesses)
	{
		$access = self::checkAccess($accesses, 'select');
		
		if ($access !== true) return self::json($access);
		
		$languages = $this->model->getAll();
		
		$languages =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model->columns,
				'items'		=> $languages,
				'name'		=> $this->model->words['list'],
				'type'		=> $this->model->type
			]
		];
		
		self::json($languages);
	}
	
	public function item($data, $accesses)
	{
		$access = self::checkAccess($accesses, 'update');
		
		if ($access !== true) return self::json($access);
		
		if (!isset($data['id']))
		{
			return
			[
				'code'			=> 500,
				'description'	=> 'Не хватает данных.'
			];
		}
		
		$language = $this->model->getByID($data['id']);
		
		$language =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model->columns,
				'name'		=> $this->model->words['item'] . ' "' . $language['name'] . '"',
				'item'		=> $language,
				'type'		=> 'form'
			]
		];
		
		self::json($language);
	}
	
	public function remove()
	{
		$ajax = new \Applications\Ajax\Controller();
		
		if (!isset(\Wings::$post['ids']) || empty(\Wings::$post['ids'])) return $ajax->json(['code' => 204]);
		
		foreach (\Wings::$post['ids'] as $id) $this->model->delete($id);
		
		return $ajax->json(['code' => 200]);
	}
}