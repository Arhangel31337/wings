<?php

namespace Applications\FrontEnd;

class FrontEndModel
{
	public static function GetMVC($host, $workspace, $pageURL)
	{
		$query = '
			SELECT
				pt.`MVC` AS name,
				pt.`method` AS method
			FROM
				`hosts` h,
				`Pages` p,
				`PageTypes` pt
			WHERE
				p.`URL` LIKE :pageURL AND
				p.`hostID` = h.`ID` AND
				h.`name` LIKE :host AND
				p.`pageTypeID` = pt.`ID` AND
				pt.`workspace` LIKE :workspace AND
				p.`isActive` = 1
		';
		
		$args = array(
			'host'		=> array($host, 'str', 31),
			'workspace'	=> array($workspace, 'str', 31),
			'pageURL'	=> array($pageURL, 'str', 255)
		);
		
		$result = \Wings\DB::FetchAll($query, $args);
		
		if (isset($result[0])) return $result[0];
		else return null;
	}
}