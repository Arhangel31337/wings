<?php

namespace Wings;

final class Header
{
	final static public function Charset($charset)
	{
		self::Headline('Content-type: text/html; charset=' . $charset);
	}
	
	final static public function Headline($string)
	{
		header($string);
	}
	
	final static public function Location($url)
	{
		self::Headline('Location: ' . $url);
		exit;
	}
}