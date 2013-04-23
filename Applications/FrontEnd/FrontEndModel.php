<?php

namespace Applications\FrontEnd;

class FrontEndModel
{
	public static function GetMVC($pageURL)
	{
		$query = '
			SELECT
				`pageTypeMVC` AS name,
				pageTypeMethod AS method
			FROM
				`Pages` p,
				`PageTypes` pt
			WHERE
				p.`pageTypeID` = pt.`pageTypeID` AND
				p.`pageURL` LIKE :pageURL AND
				p.`pageActive` = 1
		';
		
		$result = \Wings\DB::FetchAll($query, array('pageURL' => array($pageURL, 'str', 255)));
		
		return $result;
	}
}