<?php

namespace Wings;

final class Validation
{
	final public static function mail($value)
	{
		$pattern = '/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/';
		if (preg_match($pattern, $value)) return true;
		else return false;
	}
	
	final public static function noSpecialCharacters($value)
	{
		$pattern = '/^[0-9a-zA-Zа-яА-Я]+$/';
		if (preg_match($pattern, $value)) return true;
		else return false;
	}
	
	final public static function numeric($value)
	{
		return (\is_numeric((int)$value));
	}
	
	final public static function path($value)
	{
		$pattern = '/^[0-9a-zA-Z_\/\?=\:\&\.-]+$/';
		if (preg_match($pattern, $value)) return true;
		else return false;
	}
	
	final public static function phone($value)
	{
		$pattern = '/^[0-9\-+ \(\)]+$/';
		if (preg_match($pattern, $value)) return true;
		else return false;
	}
	
	final public static function required($value)
	{
		if ($value === "0" || $value === 0) return true;
		return (!empty($value));
	}
	
	final public static function selected($value)
	{
		return self::required($value);
	}
}