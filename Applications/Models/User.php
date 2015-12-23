<?php

namespace Applications\Models;

final class User extends Model
{
	public static $columns =
	[
		'id'	=>
		[
			'field'		=> ['type'	=> 'label'],
			'generated'	=> true,
			'turn'		=> 1,
			'type'		=> ['int', 11]
		],
		'created'	=>
		[
			'default'	=> 'now',
			'field'		=> ['type'	=> 'string'],
			'generated'	=> true,
			'turn'		=> 5,
			'type'		=> ['str', 19]
		],
		'lastVisit'	=>
		[
			'default'	=> 'now',
			'field'		=> ['type'	=> 'string'],
			'generated'	=> true,
			'turn'		=> 6,
			'type'		=> ['str', 19]
		],
		'login'	=>
		[
			'field'		=> ['type'	=> 'string'],
			'link'		=> true,
			'turn'		=> 2,
			'type'		=> ['str', 31],
			'validate'	=> ['required']
		],
		'password'	=>
		[
			'field'		=> ['type'	=> 'password'],
			'isFormF'	=> true,
			'turn'		=> 4,
			'type'		=> ['str', 127],
			'validate'	=> ['required']
		],
		'mail'	=>
		[
			'field'		=> ['type'	=> 'string'],
			'turn'		=> 3,
			'type'		=> ['str', 127],
			'validate'	=> ['mail']
		],
		'isActive'	=>
		[
			'field'		=> ['type'	=> 'switch'],
			'turn'		=> 7,
			'type'		=> ['int', 1]
		],
		'isDeleted'	=>
		[
			'field'		=> ['type'	=> 'switch'],
			'turn'		=> 8,
			'type'		=> ['int', 1]
		]
	];
	public static $links	= ['Group'];
	public static $table	= 'User';
}