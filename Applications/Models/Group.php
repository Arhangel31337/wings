<?php

namespace Applications\Models;

final class Group extends Model
{
	public static $columns =
	[
		'id'	=>
		[
			'field'		=> 'label',
			'generated'	=> true,
			'style'		=> ['align'	=> 'center'],
			'type'		=> ['int', 3]
		],
		'name'	=>
		[
			'field'		=> 'string',
			'link'		=> true,
			'style'		=> ['align'	=> 'center'],
			'type'		=> ['str', 255]
		]
	];
	public static $multilang	= ['name'];
	public static $table		= 'Group';
	public static $tree		= 'NestedSets';
}