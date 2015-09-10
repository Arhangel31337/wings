<?php

namespace Wings;

class Logs
{
	const logDir = 'Logs/';
	private static $dir;
	
	public static function api($description = null)
	{
		if (\is_null($description)) $description = [];
		else $description = ['data' => $description];
		
		if (isset($_SERVER['REMOTE_ADDR'])) $description['remoteAddress'] = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['REQUEST_URI'])) $description['request'] = $_SERVER['REQUEST_URI'];
		if (isset($_SERVER['HTTP_REFERER'])) $description['referer'] = $_SERVER['HTTP_REFERER'];
		
		$writeData = [
			'sessionID'		=> \session_id(),
			'description'	=> $description
		];
		
		$dirPath = \Wings::$dir . self::logDir . 'API/';
		Directory::create($dirPath);
		self::WriteLog($dirPath, serialize($writeData));
	}
	
	public static function autoload($writeData)
	{
		$dirPath = \Wings::$dir . self::logDir . 'Autoload/';
		Directory::create($dirPath);
		self::WriteLog($dirPath, $writeData);
	}
	
	public static function insertRecordInDB($pageID = null, $event = 'select', $description = null)
	{
		if (!isset($userID)) $userID = 0;
		
		if (\is_null($pageID)) $pageID = \Wings::$page['id'];
		
		if (\is_null($description)) $description = [];
		else $description = ['data' => $description];
		
		if (isset($_SERVER['REMOTE_ADDR'])) $description['remoteAddress'] = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['REQUEST_URI'])) $description['request'] = $_SERVER['REQUEST_URI'];
		if (isset($_SERVER['HTTP_REFERER'])) $description['referer'] = $_SERVER['HTTP_REFERER'];
		
		$args = [
			'userID'		=> [\Wings::$user->getId(), 'int', 11],
			'langID'		=> [\Wings::$language['id'], 'int', 11],
			'pageID'		=> [$pageID, 'int', 11],
			'event'			=> [$event, 'str', 6],
			'description'	=> [serialize($description), 'str']
		];
		\Wings\DB::insert('Logs', $args);
	}
	
	public static function insertRecordInFile($pageID = null, $event = 'select', $description = null)
	{
		if (!isset($userID)) $userID = 0;
		
		if (\is_null($pageID)) $pageID = \Wings::$page['id'];
		
		if (\is_null($description)) $description = [];
		else $description = ['data' => $description];
		
		if (isset($_SERVER['REMOTE_ADDR'])) $description['remoteAddress'] = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['REQUEST_URI'])) $description['request'] = $_SERVER['REQUEST_URI'];
		if (isset($_SERVER['HTTP_REFERER'])) $description['referer'] = $_SERVER['HTTP_REFERER'];
		
		$writeData = [
			'userID'		=> \Wings::$user->getId(),
			'langID'		=> \Wings::$language['id'],
			'pageID'		=> $pageID,
			'event'			=> $event,
			'description'	=> str_replace("\n", '', $description)
		];
		
		$dirPath = \Wings::$dir . self::logDir . 'Users/';
		Directory::create($dirPath);
		self::WriteLog($dirPath, serialize($writeData));
	}
	
	public static function readFileByDatePeriod($dateFrom = null, $dateTo = null)
	{
		if (\is_null($dateFrom)) $dateFrom = \date('Y-m-d');
		if (\is_null($dateTo)) $dateTo = \date('Y-m-d');
		
		$dateFrom = new \DateTime($dateFrom);
		$dateTo = new \DateTime($dateTo);
		$dateTo->add(new \DateInterval('P1D'));
		$dateInterval = new \DateInterval('P1D');
		
		$datePeriod = new \DatePeriod($dateFrom, $dateInterval, $dateTo);
		
		$dirPath = \Wings::$dir . self::logDir . 'Users/';
		Directory::create($dirPath);
		
		$file = [];
		$dates = [];
		
		foreach ($datePeriod as $date)
		{
			$dates[] = $date->format('Y-m-d');
			$fileName = $dirPath . $date->format('Y-m-d') . '.log';
			
			if (!\file_exists($fileName)) continue;
			
			$file = \array_merge($file, \file($fileName));
		}
		
		$list = [];
		$pages = [];
		$users = [];
		
		foreach ($file as $string)
		{
			$pattern = '/(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}) (.*)/';
			\preg_match($pattern, $string, $matches);
			
			$dateTime = $matches[1];
			list($date, $time) = explode(' ', $dateTime);
			$array = @\unserialize($matches[2]);
			
			if ($array === false) continue;
			
			if (!isset($list[$date]))
			{
				$list[$date] = [];
			}
			
			$list[$date][] = [
				'dateTime'		=> $dateTime,
				'user'			=> $array['userID'],
				'page'			=> $array['pageID'],
				'event'			=> $array['event'],
				'description'	=> $array['description']
			];
			$list[$date]['users'][$array['userID']] = $dateTime;
			$users[$array['userID']]['pages'][$date][] = [
				'dateTime'		=> $dateTime,
				'page'			=> $array['pageID'],
				'event'			=> $array['event'],
				'description'	=> $array['description']
			];
			$pages[$array['pageID']]['users'][$date][] = [
				'dateTime'		=> $dateTime,
				'user'			=> $array['userID'],
				'event'			=> $array['event'],
				'description'	=> $array['description']
			];
		}
		
		return ['dates' => $dates, 'users' => $users, 'pages' => $pages, 'list' => $list];
	}
	
	public static function readDBByDatePeriod($dateFrom = null, $dateTo = null, $type = 'submit')
	{
		if (\is_null($dateFrom)) $dateFrom = \date('Y-m-d');
		if (\is_null($dateTo)) $dateTo = \date('Y-m-d');
		
		$dateFrom .= ' 00:00:00';
		$dateTo .= '23:59:59';
		
		$query = '
			SELECT
				*
			FROM
				`Logs` l
			WHERE
				l.`dateTime` >= :dateFrom AND
				l.`dateTime` <= :dateTo AND
				l.`event` = :type;
		';
		$args = [
			'dateFrom'	=> [$dateFrom, 'str', 19],
			'dateTo'	=> [$dateTo, 'str', 19],
			'type'	=> [$type, 'str', 6]
		];
		
		$result = DB::fetchAll($query, $args);
		
		foreach ($result as $key => $value) $result[$key]['description'] = unserialize($value['description']);
		
		return $result;
	}
	
	private static function writeLog($dirPath, $writeData)
	{
		$filePath = $dirPath . \date('Y-m-d') . '.log';
		
		$file = \fopen($filePath, 'a');
		\flock($file, \LOCK_EX);
		\fwrite($file, \date('Y-m-d H:i:s') . ' ' . $writeData . \PHP_EOL);
		\flock($file, \LOCK_UN);
		\fclose($file);
	}
}

?>