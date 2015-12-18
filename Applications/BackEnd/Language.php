<?php

namespace Applications\BackEnd;

final class Language extends Controller
{
	public function __construct()
	{
		$this->model = new \Applications\Models\Language();
		
		$this->model->setWords();

		$this->view = new View();
		
		parent::__construct();
	}
	
	public function add()
	{
		if ($this->issetAllData($this->model->columns) && $this->validate($this->model->columns))
		{
			$this->model->insert($this->model->columns, \Wings::$post);
			
			$this->backToList();
		}
		
		$language = $this->model->prepareModel();
		
		$language =
		[
			'name'		=> $this->model->words['add'],
			'columns'	=> $this->model->columns,
			'values'	=> $language
		];
		
		$this->view->add($language);
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
	
	public function index()
	{
		$languages = $this->model->getAll();
		
		$languages =
		[
			'name'		=> $this->model->words['list'],
			'columns'	=> $this->model->columns,
			'items'		=> $languages
		];
		
		$this->view->items($languages);
	}
	
	public function item($id)
	{
		$language = $this->model->getByID($id);
		
		$language =
		[
			'name'		=> $this->model->words['item'] . ' "' . $language['name'] . '"',
			'columns'	=> $this->model->columns,
			'item'		=> $language
		];
		
		$this->view->item($language);
	}
	
	public function remove()
	{
		$ajax = new \Applications\Ajax\Controller();
		
		if (!isset(\Wings::$post['ids']) || empty(\Wings::$post['ids'])) return $ajax->json(['code' => 204]);
		
		foreach (\Wings::$post['ids'] as $id) $this->model->delete($id);
		
		return $ajax->json(['code' => 200]);
	}
}