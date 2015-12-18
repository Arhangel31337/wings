<?php

namespace Applications\BackEnd;

final class Authorization
{
	public function __construct() {}
	
	public function index()
	{
		\Wings::$view['files']['js'][] = ['async' => true, 'src' => '/js/BackEnd/auth.js'];
		\Wings::$view['tpl'] = 'auth.tpl';
	}
	
	public function checkLogin()
	{
		if (!isset(\Wings::$post['login']) || empty(\Wings::$post['login']))
		{
			$result =
			[
				'code'			=> 401,
				'description'	=> 'Логин или e-mail не введён.'
			];
		}
		
		$user = \Wings\UserGroupeModel::getUserByLogin(\Wings::$post['login']);
		
		if (\is_null($user))
		{
			$result =
			[
				'code'			=> 404,
				'description'	=> 'Пользователь не найден'
			];
		}
		else 
		{
			$result =
			[
				'code'			=> 200,
				'description'	=> $user['login']
			];
		}
		
		return \Applications\Ajax\Controller::json($result);
	}
	
	public function checkPassword()
	{
		if (!isset(\Wings::$post['login']) || empty(\Wings::$post['login']) ||
			!isset(\Wings::$post['password']) || empty(\Wings::$post['password']))
		{
			$result =
			[
				'code'			=> 401,
				'description'	=> 'Логин и/или пароль не введён.'
			];
		}
		
		$user = \Wings\UserGroupeModel::getUserByLogin(\Wings::$post['login']);
		
		$result = \Wings::$user->verificationPassword($user['mail'], $user['password'], $user['created'], \Wings::$post['password']);
		
		if ($result)
		{
			\Wings::$user->initializeUser($user['mail'], $user['login'], \Wings::$post['password'], $user['created']);
			
			$result =
			[
				'code'			=> 200,
				'description'	=> 'Ok'
			];
		}
		else
		{
			$result =
			[
				'code'			=> 404,
				'description'	=> 'Пароль не подходит.'
			];
		}
		
		return \Applications\Ajax\Controller::json($result);
	}
}