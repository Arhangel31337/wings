<?php

namespace Wings;

final class Crypt
{
	private static $blowfish;
	private static $extDes;
	private static $md5;
	private static $sha256;
	private static $sha512;
	private static $stdDes;
	
	public static function initialize($settings)
	{
		self::$blowfish = $settings['blowfish'];
		self::$extDes = $settings['extDes'];
		self::$md5 = $settings['md5'];
		self::$sha256 = $settings['sha256'];
		self::$sha512 = $settings['sha512'];
		self::$stdDes = \substr($settings['stdDes'], 0, 2);
	}

	public static function blowfish($string, $salt)
	{
		$salt = self::secret('sha1', $salt);
		$salt = self::$blowfish . \substr($salt, 0, 22);
		return \crypt($string, $salt);
	}

	public static function extDes($string, $salt)
	{
		$salt = self::secret(null, $salt);
		$salt = self::$extDes . \substr($salt, 0, 4);
		return \crypt($string, $salt);
	}

	public static function md5($string, $salt)
	{
		$salt = self::secret('md5', $salt);
		$salt = self::$md5 . $salt;
		return \crypt($string, $salt);
	}
	
	private static function secret($cryptType, $salt)
	{
		$salt = $salt . \Wings::$settings['salt'];
		if (!\is_null($cryptType)) $salt = \hash($cryptType, $salt);
		$salt = \base64_encode($salt);
		$salt = \str_replace('+', '.', $salt);
		
		return $salt;
	}

	public static function sha256($string, $salt)
	{
		$salt = self::secret('sha256', $salt);
		$salt = self::$sha256 . $salt;
		return \crypt($string, $salt);
	}
	
	public static function sha512($string, $salt)
	{
		$salt = self::secret('sha512', $salt);
		$salt = self::$sha512 . $salt;
		return \crypt($string, $salt);
	}
	
	public static function stdDes($string, $salt)
	{
		return \crypt($string, self::$extDes);
	}
}