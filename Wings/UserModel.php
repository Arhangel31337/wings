<?php

namespace Wings;

class UserModel
{
	public static function GetUser($login, $password)
	{
		DB::Select('Users', '*', array(), array());
	}
}

?>