<?php

return array(
	'php'		=> array(
		'display_errors'		=> 'on',
		'log_errors'			=> 'on',
		'register_globals'		=> 'Off',
		'magic_quotes_gpc'		=> 'Off',
		'magic_quotes_runtime'	=> 'Off',
		'date.timezone'			=> 'Europe/Moscow'
	),
	'host' => array(
		'wwwNecessarily'	=> true,
		'charset'			=> 'utf-8'
	),
	'db'		=> array(
		'type'		=> 'mysql',
		'host'		=> 'localhost',
		'name'		=> 'wings',
		'login'		=> 'root',
		'password'	=> '14a86r35h',
		'charset'	=> 'UTF8'
	),
	'debug'		=> array(
		'autoload'	=> true,
		'exception'	=> true,
		'excType'	=> 'Web',
		'smarty'	=> false
	),
	'workspace' => array(
		'FrontEnd'	=> array(
			'url'		=> '',
			'multilang'	=> false
		),
		'BackEnd'	=> array(
			'url'		=> 'admin',
			'multilang'	=> false
		)
	)
);