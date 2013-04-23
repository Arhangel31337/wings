<?php

return array(
	'db'		=> array(
		'type'		=> 'mysql',
		'host'		=> 'localhost',
		'name'		=> 'arhangel31337',
		'login'		=> 'root',
		'password'	=> '',
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

?>