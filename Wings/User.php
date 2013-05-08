<?php

namespace Wings;

class User
{
	final public static function issetUserInSession()
	{
		if (\isExistence(\Wings::$session['user']) && 
			\isExistence(\Wings::$session['user']['login']) && 
			\isExistence(\Wings::$session['user']['password']))
		{
			$self = UserModel::GetUser($session['user']['login'], $session['user']['password']);
		}
		else return false;
	}
}