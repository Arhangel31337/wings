<?php

namespace Wings;

final class UserGroupeModel
{
	public static function addUser($mail, $login, $password, $created)
	{
		$args = [
			'mail'		=> [$mail, 'str', 127],
			'login'		=> [$login, 'str', 63],
			'password'	=> [$password, 'str', 127],
			'created'	=> [$created, 'str', 19],
			'lastVisit'	=> [$created, 'str', 19]
		];
		
		return self::getUserByID(\Wings\DB::insert('User', $args));
	}
	
	public static function addUserGroupLink($userID, $groupID)
	{
		$args = [
			'groupID'	=> [$groupID, 'int', 11],
			'userID'	=> [$userID, 'int', 11]
		];
		
		\Wings\DB::insert('link_UserGroup', $args);
	} 
	
	public static function authUser($mail, $login, $password, $created)
	{
		$wheres = [
			'login' 	=> '=',
			'password'	=> '=',
			'created'	=> '='
		];
		
		$args = [
			'login' 	=> [$login, 'str', 63],
			'password'	=> [$password, 'str', 127],
			'created'	=> [$created, 'str', 19]
		];
		
		$result = DB::Select('User', '*', $wheres, $args, null, '0, 1');
		
		if (empty($result)) return null;
		else return $result[0];
	}
	
	public static function getGroups($langID = null)
	{
		if (\is_null($langID)) $langID = \Wings::$language['id'];
		
		$query = '
			SELECT
				gr.*,
				lgr.`name`
			FROM
				`Group` gr
			INNER JOIN `lang_Group` lgr ON gr.`id` = lgr.`group` AND lgr.`lang` = :langID;
		';
		$args = ['langID' => [$langID, 'int', 3]];
		return DB::fetchAll($query, $args);
	}
	
	public static function getGroupsByUserID($userID)
	{
		$query = '
			SELECT
				gr.*,
				lgr.`name`
			FROM
				`link_UserGroup` lgrus
			INNER JOIN `Group` gr ON lgrus.`group` = gr.`id`
			INNER JOIN `lang_Group` lgr ON gr.`id` = lgr.`group` AND lgr.`lang` = :langID
			WHERE
				lgrus.`user` = :userID;
		';
		
		$args = [
			'userID' => [$userID, 'int', 11],
			'langID'	=> [\Wings::$language['id'], 'int', 11]
		];
		
		$result = \Wings\DB::FetchAll($query, $args);
		
		if (count($result) > 0) return $result;
		else return [];
	}

	public static function getGroupsLanguages($groupID)
	{
		return DB::select('lang_Groups', '*', ['groupID' => '='], ['groupID' => [$groupID, 'int', 11]]);
	}
	
	public static function getUserByID($userID)
	{
		$wheres = ['id' => '='];
		$args = ['id' => [$userID, 'int', 11]];
	
		$result = DB::Select('User', '*', $wheres, $args);
		
		if (\count($result) === 1) return $result[0];
		else return null;
	}
	
	public static function getUserByLogin($login)
	{
		$wheres = [
			'login'	=> '=',
			'mail'	=> '='
		];
		$args = [
			'login'	=> [$login, 'str', 63],
			'mail'	=> [$login, 'str', 127]
		];
		
		$result = DB::Select('User', '*', $wheres, $args, null, null, 'OR');

		if (\count($result) === 1) return $result[0];
		else return null;
	}
	
	public static function getUsers()
	{
		return DB::select('User', '*');
	}
	
	public static function getUsersByIDs($userIDs)
	{
		if (\is_array($userIDs)) $userIDs = implode(', ', $userIDs);
		
		return DB::fetchAll('SELECT * FROM `User` WHERE `id` IN (' . $userIDs . ');');
	}
	
	public static function groupAdd($languages, $groupID)
	{
		$args = ['id' => [NULL]];
		
		$id = DB::insert('Groups', $args);
		
		foreach ($languages as $value)
		{
			$args = [
				'groupID'	=> [$id, 'int', 11],
				'langID'	=> [$value['langID'], 'int', 3],
				'name'		=> [$value['name'], 'str', 255]
			];
			\Wings\DB::insert('lang_Groups', $args);
		}
		
		$args = ['groupID' => [$groupID, 'int', 11]];
		
		$accesses = DB::select('access_Pages', '*', ['groupID' => '='], $args);
		
		foreach ($accesses as $value)
		{
			$args = [
				'type'		=> [$value['type'], 'int', 1],
				'groupID'	=> [$id, 'int', 11],
				'pageID'	=> [$value['pageID'], 'int', 11],
				'select'	=> [$value['select'], 'int', 1],
				'insert'	=> [$value['insert'], 'int', 1],
				'update'	=> [$value['update'], 'int', 1],
				'delete'	=> [$value['delete'], 'int', 1]
			];
			\Wings\DB::insert('access_Pages', $args);
		}
		
		return $id;
	}
	
	public static function groupUpdate($id, $languages)
	{
		$wheres = ['groupID' => '='];
		$args = ['groupID' => [$id, 'int', 11]];
		DB::delete('lang_Groups', $wheres, $args);
		
		foreach ($languages as $value)
		{
			$args = [
				'groupID'	=> [$id, 'int', 11],
				'langID'	=> [$value['langID'], 'int', 3],
				'name'		=> [$value['name'], 'str', 255]
			];
			\Wings\DB::insert('lang_Groups', $args);
		}
		
		return $id;
	}
	
	public static function userUpdate($args)
	{
		DB::update('User', $args);
	}
}