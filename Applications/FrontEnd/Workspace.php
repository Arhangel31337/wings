<?php

namespace Applications\FrontEnd;

final class Workspace
{
	public static function initialize()
	{
		$result = \Wings\Page::getPageMVC(\Wings::$workspace['host'], \Wings::$workspace['name'], implode('/', \Wings::$pathname));
		
		traceExit($result);
	}
}