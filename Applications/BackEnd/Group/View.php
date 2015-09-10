<?php

namespace Applications\BackEnd\Group;

final class View extends \Applications\BackEnd\View
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function add($group = null)
	{
		$group =
		[
			'name'		=> Model::$words['add'],
			'columns'	=> Model::$columns,
			'values'	=> $group
		];
		
		parent::add($group);
	}
	
	public function change($group)
	{
		$group =
		[
			'name'		=> Model::$words['change'],
			'columns'	=> Model::$columns,
			'values'	=> $group
		];
		
		parent::change($group);
	}
	
	public function item($group)
	{
		$name = $group['name'];
		unset($group['name']);
		
		$group =
		[
			'name'		=> Model::$words['item'] . ' "' . $name . '"',
			'columns'	=> Model::$columns,
			'item'		=> $group
		];
		
		parent::item($group);
	}
	
	public function tree($groups)
	{
		$groups =
		[
			'name'		=> Model::$words['list'],
			'columns'	=> Model::$columns,
			'items'		=> $groups
		];
		
		parent::tree($groups);
	}
}