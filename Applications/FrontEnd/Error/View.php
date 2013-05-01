<?php

namespace Applications\FrontEnd\Error;

class View
{
	final public function __construct($error)
	{
		\Wings::$view['tpl'] = 'default.tpl';
		\Wings::$view['contentTPL'] = 'error.tpl';
		\Wings::$view['error']['number'] = $error;
		
		switch ($error)
		{
			case 404:
				\Wings::$view['error']['message'] = 'Страница не найдена.';
				break;
		}
	}
}

?>