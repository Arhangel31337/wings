<?php

namespace Applications\BackEnd\Index;

final class View extends \Applications\BackEnd\View
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		\Wings::$view['contentTPL'] = 'index.tpl';
	}
}