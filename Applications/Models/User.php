<?php

namespace Applications\Models;

final class User extends Model
{
	public $columns =
	[
		'id'	=>
		[
			'field'		=> ['type'	=> 'label'],
			'generated'	=> true,
			'style'		=> ['align'	=> 'center'],
			'type'		=> ['int', 11]
		],
		'created'	=>
		[
			'default'	=> 'now',
			'field'		=> ['type'	=> 'string'],
			'generated'	=> true,
			'style'		=> ['align'	=> 'center'],
			'type'		=> ['str', 19]
		],
		'lastVisit'	=>
		[
			'default'	=> 'now',
			'field'		=> ['type'	=> 'string'],
			'generated'	=> true,
			'style'		=> ['align'	=> 'center'],
			'type'		=> ['str', 19]
		],
		'login'	=>
		[
			'field'		=> ['type'	=> 'string'],
			'link'		=> true,
			'style'		=> ['align'	=> 'center'],
			'type'		=> ['str', 31],
			'validate'	=> ['required']
		],
		'password'	=>
		[
			'field'		=> ['type'	=> 'password'],
			'isFormF'	=> true,
			'type'		=> ['str', 127],
			'validate'	=> ['required']
		],
		'mail'	=>
		[
			'field'		=> ['type'	=> 'string'],
			'style'		=> ['align'	=> 'center'],
			'type'		=> ['str', 127],
			'validate'	=> ['mail']
		],
		'isActive'	=>
		[
			'field'		=> ['type'	=> 'checkbox'],
			'style'		=> ['align'	=> 'center'],
			'type'		=> ['int', 1]
		],
		'isDeleted'	=>
		[
			'field'		=> ['type'	=> 'checkbox'],
			'style'		=> ['align'	=> 'center'],
			'type'		=> ['int', 1]
		]
	];
	public $links	= ['Group'];
	public $table	= 'User';
}