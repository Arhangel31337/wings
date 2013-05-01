<?php

namespace Applications\FrontEnd\Index;

class View
{
	final public function __construct()
	{
		\Wings::$view['tpl'] = 'default.tpl';
	}
}