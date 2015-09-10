<?php

namespace Wings;

final class User
{
	use tGet;
	
	public $additional;
	private $created;
	private $id;
	private $isActive;
	private $isDeleted;
	private $groups;
	private $lastVisit;
	private $login;
	private $mail;
	private $password;
	
	public function __construct()
	{
		$result = $this->issetUserInSession();
	}
	
	public static function add($mail, $login, $password)
	{
		list($password, $created) = self::createPassword($mail, $password);
		
		return UserGroupeModel::addUser($mail, $login, $password, $created);
	}
	
	public function addUserGroupLink($groupID)
	{
		UserGroupeModel::addUserGroupLink($this->id, $groupID);
	}
	
	public static function createPassword($mail, $password, $created = null)
	{
		if (\is_null($created))
		{
			$created = \date('Y-m-d H:i:s');
			$result = Crypt::sha512($password, self::createSalt($created, $mail));
			return array($result, $created);
		}
		else 
		{
			$result = Crypt::sha512($password, self::createSalt($created, $mail));
			return $result;
		}
	}
	
	private static function createSalt($dateTime, $email)
	{
		return \Wings::$settings['salt'] . $dateTime . $email;
	}
	
	public function getUserData()
	{
		$result = [];
		
		$result['additional'] = $this->additional;
		$result['created'] = $this->created;
		$result['groups'] = $this->groups;
		$result['id'] = $this->id;
		$result['isActive'] = $this->isActive;
		$result['isDeleted'] = $this->isDeleted;
		$result['lastVisit'] = $this->lastVisit;
		$result['login'] = $this->login;
		$result['mail'] = $this->mail;
		
		return $result;
	}
	
	private function initializeGroupsByUserID($userID)
	{
		foreach (UserGroupeModel::getGroupsByUserID($userID) as $value)
		{
			$this->groups[$value['id']] = $value['name'];
		}
	}
	
	public function initializeUser($mail, $login, $password, $created)
	{
		$hash = Crypt::sha512($password, self::createSalt($created, $mail));
		
		$user = UserGroupeModel::authUser($mail, $login, $hash, $created);
		
		if (!\is_null($user))
		{
			$this->initializeGroupsByUserID($user['id']);
			$this->setUserData($user);
		}
	}
	
	private function issetUserInSession()
	{
		if (isset(\Wings::$session['user']) && 
			isset(\Wings::$session['user']['login']) && 
			isset(\Wings::$session['user']['password'])
		)
		{
			$user = UserGroupeModel::authUser(\Wings::$session['user']['mail'], \Wings::$session['user']['login'], 
					\Wings::$session['user']['password'], \Wings::$session['user']['created']);
			
			if (!\is_null($user))
			{
				$this->initializeGroupsByUserID($user['id']);
				$this->setUserData($user);
			}
		}
	}
	
	private function setUserData($user)
	{
		if (isset(\Wings::$session['user']['additional']))
		{
			$this->additional	= \Wings::$session['user']['additional'];
		}
		
		$this->created		= $user['created'];
		$this->id			= $user['id'];
		$this->isActive		= $user['isActive'];
		$this->isDeleted	= $user['isDeleted'];
		$this->login		= $user['login'];
		$this->lastVisit	= $user['lastVisit'];
		$this->mail			= $user['mail'];
		$this->password		= $user['password'];
		
		\Wings::$session['user']['additional']	= $this->additional;
		\Wings::$session['user']['created']		= $user['created'];
		\Wings::$session['user']['id']			= $user['id'];
		\Wings::$session['user']['isActive']	= $user['isActive'];
		\Wings::$session['user']['isDeleted']	= $user['isDeleted'];
		\Wings::$session['user']['groups']		= $this->groups;
		\Wings::$session['user']['login']		= $user['login'];
		\Wings::$session['user']['lastVisit']	= $user['lastVisit'];
		\Wings::$session['user']['mail']		= $user['mail'];
		\Wings::$session['user']['password']	= $user['password'];
	}
	
	public static function verificationPassword($mail, $password, $created, $inputPassword)
	{
		$hash = self::createPassword($mail, $inputPassword, $created);
		
		return ($hash === $password);
	}
	
	public function update($args)
	{
		$this->setUserData(UserGroupeModel::userUpdate($args));
	}
	
	public function updateAdditional()
	{
		\Wings::$session['user']['additional']	= $this->additional;
	}
}