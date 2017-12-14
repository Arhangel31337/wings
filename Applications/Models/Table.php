<?php
namespace Applications\Models;

final class Table extends \Wings\Model
{
	public	static	$columns =
	[
		'add'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 6,
			'type'		=> ['str', 255]
		],
		'change'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 7,
			'type'		=> ['str', 255]
		],
		'id'	=>
		[
			'field'		=> 'label',
			'generated'	=> true,
			'style'		=> ['align'	=> 'center'],
			'turn'		=> 1,
			'type'		=> ['int', 3]
		],
		'item'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 5,
			'type'		=> ['str', 255]
		],
		'list'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 4,
			'type'		=> ['str', 255]
		],
		'name'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 3,
			'type'		=> ['str', 255]
		],
		'table'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 2,
			'type'		=> ['str', 255]
		]
	];
	public	static	$multilang	= ['add', 'change', 'item', 'list', 'name'];
	public	static	$table		= 'Table';
}
