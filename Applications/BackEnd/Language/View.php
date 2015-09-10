<?php

namespace Applications\BackEnd\Language;

final class View extends \Applications\BackEnd\View
{
	public function __construct ()
	{
		parent::__construct();
	}
	
	public function add($language = null)
	{
		$language =
		[
			'name'		=> Model::$words['add'],
			'columns'	=> Model::$columns,
			'values'	=> $language
		];
		
		parent::add($language);
	}
	
	public function change($language)
	{
		$language =
		[
			'name'		=> Model::$words['change'],
			'columns'	=> Model::$columns,
			'values'	=> $language
		];
		
		parent::change($language);
	}
	
	public function item($language)
	{
		$language =
		[
			'name'		=> Model::$words['item'] . ' "' . $language['name'] . '"',
			'columns'	=> Model::$columns,
			'item'		=> $language
		];
		
		parent::item($language);
	}
	
	public function items($languages)
	{
		$languages =
		[
			'name'		=> Model::$words['list'],
			'columns'	=> Model::$columns,
			'items'		=> $languages
		];
	
		parent::items($languages);
	}
}