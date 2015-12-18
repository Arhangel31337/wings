<?php

namespace Applications\Models;

final class Group extends Model
{
	public $columns =
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
	public $multilang	= ['name'];
	public $table		= 'Group';
	public $tree		= 'NestedSets';
}