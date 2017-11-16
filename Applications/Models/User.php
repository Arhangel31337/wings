<?php

namespace Applications\Models;

final class User extends Model
{
	public	static	$columns =
	[
		'id'	=>
		[
			'field'		=> 'label',
			'generated'	=> true,
			'turn'		=> 1,
			'type'		=> ['int', 11]
		],
		'created'	=>
		[
			'default'	=> 'now',
			'field'		=> 'string',
			'generated'	=> true,
			'turn'		=> 6,
			'type'		=> ['str', 19]
		],
		'group'		=>
		[
			'field'		=> 'multiselect',
			'isFormF'	=> true,
			'turn'		=> 5,
			'type'		=> ['int', 11]
		],
		'lastVisit'	=>
		[
			'default'	=> 'now',
			'field'		=> 'string',
			'generated'	=> true,
			'turn'		=> 7,
			'type'		=> ['str', 19]
		],
		'login'	=>
		[
			'field'		=> 'string',
			'turn'		=> 2,
			'type'		=> ['str', 31],
			'validate'	=> ['required']
		],
		'password'	=>
		[
			'field'		=> 'password',
			'isFormF'	=> true,
			'turn'		=> 4,
			'type'		=> ['str', 127]
		],
		'mail'	=>
		[
			'field'		=> 'string',
			'turn'		=> 3,
			'type'		=> ['str', 127],
			'validate'	=> ['mail']
		],
		'isActive'	=>
		[
			'field'		=> 'switch',
			'turn'		=> 8,
			'type'		=> ['int', 1]
		],
		'isDeleted'	=>
		[
			'field'		=> 'switch',
			'turn'		=> 9,
			'type'		=> ['int', 1]
		]
	];
	public	static	$links	= ['Group'];
	public	static	$table	= 'User';
}