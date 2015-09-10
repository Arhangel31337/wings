<?php

namespace Wings;

final class Directory
{
	public function __construct(){}
	
	public static function create($fullPath)
	{
		if (\file_exists($fullPath)) return null;
		
		$paths = \explode('/', $fullPath);
		
		$count = \count($paths);
		
		unset($paths[$count - 1]);
		
		$fullPathToParent = \implode('/', $paths);
		
		if (!\file_exists($fullPathToParent)) self::create($fullPathToParent);
		
		if (!\file_exists($fullPath)) \mkdir($fullPath);
	}
	
	public static function getChildren($fullPath)
	{
		if (!\file_exists($fullPath)) return [];
		
		$list = \scandir($fullPath);
		$list = \array_slice($list, 2);
		
		return $list;
	}
}