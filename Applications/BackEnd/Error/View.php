<?php

namespace Applications\BackEnd\Error;

final class View extends \Applications\BackEnd\View
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($errorCode, $errorMessage)
	{
		\Wings::$view['contentTPL'] = 'error.tpl';
		\Wings::$view['error']['number'] = $errorCode;
		\Wings::$view['error']['description'] = $errorMessage;
	}
}