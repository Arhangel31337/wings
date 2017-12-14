<?php

return [
	/**
	 * Не менять после запуска сайта (используется только при шифровании данных)!
	 */
	'crypt'		=>
	[
		'blowfish'	=> '$2a$a7$',
		'extDes'	=> '_J9..',
		'md5'		=> '$1$',
		'sha256'	=> '$5$rounds=10000$',
		'sha512'	=> '$6$rounds=10000$',
		'stdDes'	=> 'wi'
	],
	'db'		=>
	[
		[
			'type'		=> 'mysql',
			'host'		=> 'localhost',
			'name'		=> 'wings',
			'login'		=> 'root',
			'password'	=> '123456789',
			'charset'	=> 'UTF8'
		]
	],
	'debug'		=>
	[
		'autoload'	=> false,
		'exception'	=> true,
		'excType'	=> 'Web',
		'smarty'	=> false
	],
	'meta'		=>
	[
		'httpEquiv'	=>
		[
			'Content-Language'		=> 'ru',
			'Content-Script-Type'	=> 'text/javascript',
			'Content-Style-Type'	=> 'text/css',
			'Content-Type'			=> 'text/html; charset=utf-8'
		],
		'name'			=>
		[
			'Author'		=> 'Алексей aka Arhangel31337 Коломиец',
			'Copyright'		=> '©2010-' . \date('Y') . ' Arhangel31337',
			'SKYPE_TOOLBAR'	=> 'SKYPE_TOOLBAR_PARSER_COMPATIBLE'
		]
	],
	'php'		=>
	[
		'display_errors'			=> 'off',
		'log_errors'				=> 'on',
		'register_globals'			=> 'Off',
		'magic_quotes_gpc'			=> 'Off',
		'magic_quotes_runtime'		=> 'Off',
		'date.timezone'				=> 'Europe/Moscow',
		'session.gc_maxlifetime'	=> 1800,
		'session.cookie_lifetime'	=> 1800,
		'upload_max_filesize'		=> '1024M',
		'post_max_size'				=> '1024M',
		'soap.wsdl_cache_enabled'	=> 0
	],
	'settings'	=>
	[
		'crypt'				=> 'sha512',
		'salt'				=> 'secret',
		'uploadDir'			=> '/uploaded/'
	],
	'workspace' =>
	[
		'FrontEnd'	=>
		[
			'isHTML5'		=> true,
			'url'			=> null
		],
		'BackEnd'	=>
		[
			'isHTML5'		=> true,
			'url'			=> 'admin'
		],
		'Ajax'	=>
		[
			'isHTML5'		=> false,
			'url'			=> 'ajax'
		],
		'Files'	=>
		[
			'isHTML5'		=> false,
			'url'			=> 'files'
		],
		'API'	=>
		[
			'isHTML5'		=> false,
			'url'			=> 'api'
		]
	]
];