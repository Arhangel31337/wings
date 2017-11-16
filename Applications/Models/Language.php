<?php

namespace Applications\Models;

final class Language extends Model
{
	public	static	$columns	=
	[
		'id'	=>
		[
			'field'		=> 'label',
			'generated'	=> true,
			'turn'		=> 1,
			'type'		=> ['int', 3]
		],
		'name'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 2,
			'type'		=> ['str', 5],
			'validate'	=> ['required']
		],
		'nameEn'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 3,
			'type'		=> ['str', 63],
			'validate'	=> ['required']
		],
		'code'	=>
		[
			'field'		=> 'string',
			'style'		=> ['align'	=> 'left'],
			'turn'		=> 4,
			'type'		=> ['str', 5],
			'validate'	=> ['required']
		]
	];
	public	static	$table	= 'Language';
}