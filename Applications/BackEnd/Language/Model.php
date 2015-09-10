<?php

namespace Applications\BackEnd\Language;

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
			'style'		=>
			[
				'align'		=> 'center',
				'main'		=> true
			],
			'type'		=> ['str', 5],
			'validate'	=> ['required']
		],
		'nameEn'	=>
		[
			'field'		=> ['type'	=> 'string'],
			'style'		=>
			[
				'align'		=> 'center',
				'main'		=> true
			],
			'type'		=> ['str', 63],
			'validate'	=> ['required']
		],
		'code'	=>
		[
			'field'		=> ['type'	=> 'string'],
			'style'		=>
			[
				'align'		=> 'center',
				'main'		=> true
			],
			'type'		=> ['str', 63],
			'validate'	=> ['required']
		]
	];
	public static $table = 'Language';
}