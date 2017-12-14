<?php
namespace Applications\Models;

final class Field extends \Wings\Model
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
		'field'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 3,
			'type'		=> ['str', 255]
		],
		'name'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 4,
			'type'		=> ['str', 255]
		],
		'table'	=>
		[
			'field'		=> 'select',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 2,
			'type'		=> ['str', 255]
		]
	];
	public	static	$link	= ['table'];
	public	static	$multilang	= ['name'];
	public	static	$table		= 'Field';
}
