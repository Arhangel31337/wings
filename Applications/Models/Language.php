<?php

namespace Applications\Models;

final class Language extends Model
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
	public $table = 'Language';
}