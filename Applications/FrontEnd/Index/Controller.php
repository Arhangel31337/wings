<?php

namespace Applications\FrontEnd\Index;

final class Controller
{
	private static $view;
	
	final public function __construct()
	{
		self::$view = new View();
	}
	
	final public function Index()
	{
		
	}
}