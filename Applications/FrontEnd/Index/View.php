<?php

namespace Applications\FrontEnd\Index;

class View
{
	public function __construct()
	{
		\Wings::$view['tpl'] = 'index.tpl';
	}
}