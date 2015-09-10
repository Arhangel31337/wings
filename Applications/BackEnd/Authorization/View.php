<?php

namespace Applications\BackEnd\Authorization;

final class View
{
	public function __construct()
	{
		\Wings::$view['files']['css'] = '/css/authorization.css';
		\Wings::$view['files']['js'][] = ['async' => true, 'src' => '/js/BackEnd/auth.js'];
		\Wings::$view['tpl'] = 'authorization.tpl';
	}
}