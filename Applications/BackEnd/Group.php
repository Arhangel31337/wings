<?php

namespace Applications\BackEnd;

final class Group extends Controller
{
	function __construct ()
	{
		$this->model = new \Applications\Models\Group();
		
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
		
		$group = $this->model->prepareModel();
		
		$group =
		[
			'name'		=> $this->model->words['add'],
			'columns'	=> $this->model->columns,
			'values'	=> $group
		];
		
		$this->view->add($group);
	}
	
	public function change($id)
	{
		if ($this->issetAllData($this->model->columns) && $this->validate($this->model->columns))
		{
			$this->model->update();
			
			$this->backToItem();
		}
		
		$group = $this->model->getByID($id);
		
		$group =
		[
			'name'		=> $this->model->words['change'],
			'columns'	=> $this->model->columns,
			'values'	=> $group
		];
		
		$this->view->change($group);
	}
	
	public function list()
	{
		$groups = $this->model->getAll();
		
		$groups =
		[
			'name'		=> $this->model->words['list'],
			'columns'	=> $this->model->columns,
			'items'		=> $groups
		];
		
		$this->view->tree($groups);
	}
	
	public function item($id)
	{
		$group = $this->model->getByID($id);
		
		$name = $group['name'];
		unset($group['name']);
		
		$group =
		[
			'name'		=> $this->model->words['item'] . ' "' . $name . '"',
			'columns'	=> $this->model->columns,
			'item'		=> $group
		];
		
		$this->view->item($group);
	}
}