<?php

namespace Applications\BackEnd\Authorization;

final class Controller
{
	public function __construct() {}
	
	public function index()
	{
		if (isset(\Wings::$post['login']))
		{
			if (!empty(\Wings::$post['login']) && !empty(\Wings::$post['password']))
				$this->authorize(\Wings::$post['login'], \Wings::$post['password']);
			else \Wings::$errors[] = "Не заполнены все обязательные поля.";
		}
		
		new View();
	}
	
	private function authorize($login, $password)
	{
		$user = \Wings\UserGroupeModel::getUserByLogin($login);
		
		$result = \Wings::$user->verificationPassword($user['mail'], $user['password'], $user['created'], $password);
		
		if ($result)
		{
			\Wings::$user->initializeUser($user['mail'], $login, $password, $user['created']);
				
			\Wings\Header::location($_SERVER['HTTP_REFERER']);
		}
		else \Wings::$errors[] = 'Логин и/или пароль не верны.';
	}
}