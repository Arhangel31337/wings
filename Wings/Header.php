<?php

namespace Wings;

final class Header
{
	private static $locations = array();
	
	final static public function charset($charset)
	{
		self::Headline('Content-type: text/html; charset=' . $charset);
	}
	
	final static public function getBrowserInfo()
	{
		if (!isset($_SERVER['HTTP_USER_AGENT'])) return null;
		
		\preg_match("/(Trident|MSIE|Opera|Firefox|Chrome|Version|Safari)(?:\/| )([0-9.]+)/", $_SERVER['HTTP_USER_AGENT'], $browser);
		
		if (empty($browser)) return null;
		
		if ($browser[1] == 'Opera' && $browser[2] == '9.80') return $browser[2] = \substr($_SERVER['HTTP_USER_AGENT'], -5);
		if ($browser[1] == 'Version') $browser[1] = 'Safari';
		
		if (\strpos($_SERVER['HTTP_USER_AGENT'], 'Gecko')) $browser[3] = 'Gecko';
		if (\strpos($_SERVER['HTTP_USER_AGENT'], 'WebKit')) $browser[3] = 'WebKit';
		if (!isset($browser[3]) && $browser[1] === 'MSIE') $browser[3] = 'MSIE';
		if (!isset($browser[3])) $browser[3] = null;
		
		$browser[2] = (integer)$browser[2];
		
		return [
			'userAgent'	=> $_SERVER['HTTP_USER_AGENT'],
			'name'		=> $browser[1],
			'version'	=> $browser[2],
			'core'		=> $browser[3]
		];
	}
	
	final static public function headline($string)
	{
		\header($string);
	}
	
	final static public function isOldBrowser()
	{
		$browser = self::getBrowserInfo();
		
		if (!isset($browser['userAgent'])) return true;
		
		if (strstr($browser['userAgent'], 'Trident/7.0') !== false) $browser['version'] = 11;
		if (!isset($browser['core']) || \is_null($browser['core'])) return true;
		
		switch ($browser['name'])
		{
			case 'Trident':
				if ($browser['version'] < 5) return true;
				else return false;
			case 'MSIE':
				if ($browser['version'] < 9) return true;
				else return false;
			case 'Firefox':
				if ($browser['version'] < 7) return true;
				else return false;
			case 'Opera':
				if ($browser['version'] < 12) return true;
				else return false;
			case 'Chrome':
				if ($browser['version'] < 12) return true;
				else return false;
			case 'Safari':
				if ($browser['version'] < 5) return true;
				else return false;
			default:
				return false;
		}
	}
	
	final static public function location($url)
	{
		self::$locations[] = $url;
	}
	
	final static public function setLocation($url = null)
	{
		if (\is_null($url) && !empty(self::$locations))
		{
			self::Headline('Location: ' . \array_pop(self::$locations));
			exit;
		}
		elseif (!\is_null($url))
		{
			self::Headline('Location: ' . $url);
			exit;
		}
	}
}

?>