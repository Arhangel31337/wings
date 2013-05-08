<?php

namespace Applications;

class Model
{
	public static function GetMVC($host, $workspace, $pageURL)
	{
		$query = '
			SELECT
				pt.`MVC` AS name,
				pt.`method` AS method
			FROM
				`Hosts` h,
				`Pages` p,
				`PageTypes` pt,
				`Workspaces` w
			WHERE
				p.`URL` LIKE :pageURL AND
				p.`isActive` = 1 AND
				p.`pageTypeID` = pt.`ID` AND
				pt.`workspaceID` = w.`ID` AND
				w.`name` LIKE :workspace AND
				w.`hostID` = h.`ID` AND
				h.`name` LIKE :host
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