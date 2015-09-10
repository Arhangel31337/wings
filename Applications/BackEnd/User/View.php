<?php

namespace Applications\BackEnd\User;

final class View extends \Applications\BackEnd\View
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function add($user = null)
	{
		$user =
		[
			'name'		=> Model::$words['add'],
			'columns'	=> Model::$columns,
			'values'	=> $user
		];
		
		parent::add($user);
	}
	
	public function change($user)
	{
		$user =
		[
			'name'		=> Model::$words['change'],
			'columns'	=> Model::$columns,
			'values'	=> $user
		];
		
		parent::change($user);
	}
	
	public function item($user)
	{
		$user =
		[
			'name'		=> Model::$words['item'] . ' "' . $user['login'] . '"',
			'columns'	=> Model::$columns,
			'item'		=> $user
		];
		
		parent::item($user);
	}
	
	public function items($users)
	{
		$users =
		[
			'name'		=> Model::$words['list'],
			'columns'	=> Model::$columns,
			'items'		=> $users
		];
		
		parent::items($users);
	}
}