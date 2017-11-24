<?php

namespace Applications\Ajax;

class Controller extends \Applications\Controller
{
	protected $model;
	protected $view;
	
	public function __construct()
	{
		$calledClass = \str_replace(__NAMESPACE__ . '\\', '', get_called_class());
		$modelClass = '\\Applications\\Models\\' . $calledClass;
		
		$this->model = new $modelClass();
		$this->view = new View();
	}
	
	public function add($data)
	{
		if ($this->issetAllData($this->model::$columns) && $this->validate($this->model::$columns))
		{
			$id = $this->model->insert();
			
			return $this->view->json([
				'code'			=> 200,
				'description'	=> $id
			]);
		}
		
		$item = $this->model->prepareModel();
		
		$item =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model::$columns,
				'name'		=> $this->model::$words['add'],
				'type'		=> 'form'
			]
		];
		
		$this->view->json($item);
	}
	
	public function change($id)
	{
		if (self::issetAllData($this->model::$columns) && self::validate($this->model::$columns))
		{
			$this->model->update();
			
			$this->view->json([
				'code'			=> 200,
				'description'	=> ''
			]);
		}
		else
		{
			$this->view->json([
				'code'			=> 500,
				'description'	=> 'Не хватает данных.'
			]);
		}
	}
	
	public function item($data)
	{
		if (!isset($data['id']))
		{
			return $this->view->json([
				'code'			=> 500,
				'description'	=> 'Не хватает данных.'
			]);
		}
		
		$item = $this->model->getByID($data['id']);
		
		$item =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model::$columns,
				'item'		=> $item,
				'name'		=> $this->model::$words['item'],
				'type'		=> 'form'
			]
		];
		
		$this->view->json($item);
	}
	
	public function list($data)
	{
		$items = $this->model->getAll();
		
		$items =
		[
			'code'	=> 200,
			'data'	=>
			[
				'columns'	=> $this->model::$columns,
				'items'		=> $items,
				'name'		=> $this->model::$words['list'],
				'type'		=> $this->model::$type
			]
		];
		
		$this->view->json($items);
	}
	
	public function remove($data)
	{
		if (!isset(\Wings::$post['ids']) || empty(\Wings::$post['ids']))
		{
			return $this->view->json([
				'code'			=> 500,
				'description'	=> 'Не хватает данных.'
			]);
		}
		
		foreach (\Wings::$post['ids'] as $id) $this->model->delete($id);
		
		$this->view->json([
			'code'			=> 200,
			'description'	=> ''
		]);
	}
}

?>