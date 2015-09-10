<?php

namespace Applications\BackEnd\Group;

final class Model extends \Applications\BackEnd\Model
{
	public static $columns =
	[
		'id'	=>
		[
			'field'		=> ['type'	=> 'label'],
			'generated'	=> true,
			'style'		=> ['align'	=> 'center'],
			'type'		=> ['int', 3]
		],
		'name'	=>
		[
			'field'		=> ['type'	=> 'string'],
			'link'		=> true,
			'style'		=> ['align'	=> 'center'],
			'type'		=> ['str', 255]
		]
	];
	protected static $multilang = ['name'];
	public static $table	= 'Group';
	protected static $tree	= 'NestedSets';
}