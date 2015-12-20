<?php

namespace Applications\BackEnd;

final class Index extends Controller
{
	function __construct ()
	{
		$this->view = new View();
		
		\Wings::$view['files']['js'][] = ['async' => true, 'src' => '/js/BackEnd/main.js'];
		
		\Wings::$view['pages'] = \Wings\Page::selectAllAvailable();
	}
}
