<?php

namespace Applications\Models;

final class History extends \Wings\Model
{
	public			$accesses	=
	[
		'delete'	=> false,
		'insert'	=> false,
		'select'	=> true,
		'update'	=> false
	];
	public	static	$columns =
	[
		'changes'	=>
		[
			'field'		=> 'text',
			'isFormF'	=> true,
			'turn'		=> 8,
			'type'		=> ['str']
		],
		'id'		=>
		[
			'field'		=> 'label',
			'generated'	=> true,
			'turn'		=> 1,
			'type'		=> ['int', 3]
		],
		'datetime'	=>
		[
			'default'	=> 'now',
			'field'		=> 'datetime',
			'isNFormF'	=> true,
			'generated'	=> true,
			'turn'		=> 2,
			'type'		=> ['str', 19]
		],
		'ip'	=>
		[
			'field'		=> 'string',
			'turn'		=> 6,
			'type'		=> ['str', 31],
			'validate'	=> ['required']
		],
		'row'		=>
		[
			'field'		=> 'string',
			'turn'		=> 5,
			'type'		=> ['int', 3]
		],
		'session'	=>
		[
			'field'		=> 'string',
			'turn'		=> 7,
			'type'		=> ['str', 31],
			'validate'	=> ['required']
		],
		'table'		=>
		[
			'field'		=> 'string',
			'turn'		=> 4,
			'type'		=> ['int', 11]
		],
		'user'		=>
		[
			'field'		=> 'string',
			'turn'		=> 3,
			'type'		=> ['int', 11]
		]
	];
	public	static	$table	= 'History';
	
	public function getAll($model = null)
	{
		if (\is_null($model)) $model = $this;
		
		$this->setFieldsNames();
		
		$query = '
			SELECT
				`History`.`id`,
				`History`.`datetime`,
				`History`.`ip`,
				`History`.`row`,
				`History`.`session`,
				`User`.`login` AS `user`,
				`lang_Table`.`item` AS `table`
			FROM `History`
			INNER JOIN `link_HistoryField` ON `History`.`id` = `link_HistoryField`.`history`
			INNER JOIN `Field` ON `link_HistoryField`.`field` = `Field`.`id`
			INNER JOIN `User` ON `History`.`user` = `User`.`id`
			INNER JOIN `lang_Table` ON `History`.`table` = `lang_Table`.`table` AND `lang_Table`.`lang` = :language
			GROUP BY `History`.`id`
			ORDER BY `History`.`datetime` DESC;
		';
		$args = ['language' => [\Wings::$language['id'], 'int', 2]];
		
		return \Wings\DB::fetchAll($query, $args);
	}
	
	public function getByID($id, $model = null)
	{
		if (\is_null($model)) $model = $this;
		
		$fields = $this->setFieldsNames();
		
		$query = '
			SELECT
				`History`.`id`,
				`History`.`datetime`,
				`History`.`ip`,
				`History`.`row`,
				`History`.`session`,
				`User`.`login` AS `user`,
				GROUP_CONCAT(
					CONCAT_WS(
						" : ",
						`lang_Field`.`name`,
						`link_HistoryField`.`dataOld`,
						`link_HistoryField`.`dataNew`
					) SEPARATOR "\n"
				) AS `changes`,
				`lang_Table`.`item` AS `table`
			FROM `History`
			INNER JOIN `link_HistoryField` ON `History`.`id` = `link_HistoryField`.`history`
			INNER JOIN `Field` ON `link_HistoryField`.`field` = `Field`.`id`
			INNER JOIN `lang_Field` ON `Field`.`id` = `lang_Field`.`field` AND `lang_Field`.`lang` = :language
			INNER JOIN `User` ON `History`.`user` = `User`.`id`
			INNER JOIN `lang_Table` ON `History`.`table` = `lang_Table`.`table` AND `lang_Table`.`lang` = :language
			WHERE
				`History`.`id` = :id;
		';
		$args =
		[
			'id'		=> [$id, 'int', 11],
			'language'	=> [\Wings::$language['id'], 'int', 2]
		];
		
		return \Wings\DB::fetchRow($query, $args);
	}
}
