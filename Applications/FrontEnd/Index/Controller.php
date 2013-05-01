<?php

namespace Applications\FrontEnd\Index;

final class Controller
{
	private static $view;
	
	final public function __construct() {}
	
	final public function Index()
	{
	    new View();
	}
}