<?php

namespace Applications\BackEnd;

final class Index
{
	function __construct() {}
	
	function index()
	{
		\Wings::$view['tpl'] = 'default.tpl';
		
		\Wings::$view['files']['css'][] = 'https://fonts.googleapis.com/css?family=Roboto:400,500,700&subset=latin,cyrillic-ext';
		\Wings::$view['files']['css'][] = '/css/backend/reset.css';
		\Wings::$view['files']['css'][] = '/css/backend/style.css';
		
		\Wings::$view['files']['js'][] = ['async' => false, 'src' => '/js/jquery.min.js'];
		\Wings::$view['files']['js'][] = ['async' => false, 'src' => '/js/jquery-ui.min.js'];
		\Wings::$view['files']['js'][] = ['async' => false, 'src' => '/js/BackEnd/functions.js'];
		\Wings::$view['files']['js'][] = ['async' => false, 'src' => '/js/BackEnd/elements.js'];
		
		\Wings::$view['files']['js'][] = ['async' => true, 'src' => '/js/BackEnd/main.js'];
		
		\Wings::$page =
		[
			'documentState'		=> 'Dynamic',
			'pageDescription'	=> 'Wings панель администрирования',
			'pageKeywords'		=> 'Wings admin',
			'pageTitle'			=> 'Wings Администрирование',
			'resourceType'		=> 'Document',
			'revisit'			=> '1 days',
			'robots'			=> 'INDEX,NOFOLLOW'
		];
		
		\Wings::$view['pages'] = \Wings\Page::selectAllAvailable();
	}
}
