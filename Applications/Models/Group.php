<?php

namespace Applications\Models;

final class Group extends Model
{
	public	static	$columns =
	[
		'id'	=>
		[
			'field'		=> 'label',
			'generated'	=> true,
			'style'		=> ['align'	=> 'center'],
			'turn'		=> 1,
			'type'		=> ['int', 3]
		],
		'name'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 2,
			'type'		=> ['str', 255]
		]
	];
	public	static	$multilang	= ['name'];
	public	static	$table		= 'Group';
}