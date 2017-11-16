<?php

namespace Wings;

final class File
{
	public static $uploadDir;
	
	public function __construct() {}
	
	public static function confirmTempFile($filePath)
	{
		$fileMime = \preg_replace('/[\s\.]/', '_', \mime_content_type($filePath));
		$type = \explode('/', $fileMime);
		
		$filePathNew = \explode('/', $filePath);
		$filePathNew = $filePathNew[(\count($filePathNew) - 1)];
		$fileName = \str_replace(\session_id() . '_', '', $filePathNew);
		$dirPath = self::$uploadDir . $type[0] . '/';
		$filePathNew = $dirPath . $fileName;
		
		Directory::create($dirPath);
		
		if (\rename($filePath, $filePathNew)) return ['name' => $fileName, 'mime' => \mime_content_type($filePathNew)];
		else return false;
	}
	
	public static function copy($pathFrom, $pathTo)
	{
		if (\file_exists($pathTo)) \unlink($pathTo);
		
		\copy($pathFrom, $pathTo);
	}
	
	public static function initialize()
	{
		self::$uploadDir = $_SERVER['DOCUMENT_ROOT'] . \Wings::$settings['uploadDir'];
	}
	
	public static function issetTempFile($tempPath)
	{
		$tempPath = \explode('/', $tempPath);
		
		if (\stristr($_SERVER['SERVER_SOFTWARE'], 'win')) $tempPath[(count($tempPath) - 1)] = \iconv('utf-8', 'cp1251', $tempPath[(count($tempPath) - 1)]);
		
		$realPath = self::$uploadDir . 'temp/' . \session_id() . '_' . $tempPath[(count($tempPath) - 1)];
		
		if (\file_exists($realPath)) return $realPath;
		else return false;
	}
	
	public static function getFileName($fileName)
	{
		if (\stristr($_SERVER['SERVER_SOFTWARE'], 'win')) $fileName = \iconv('cp1251', 'utf-8', $fileName);
		return $fileName;
	}
	
	public static function getUserTempFiles()
	{
		$fileDir = self::$uploadDir . 'temp/';
		$mktime = \time();
		$userTempFiles = [];
		$prefix = \session_id() . '_';
		
		$fileList = Directory::getChildren($fileDir);
		
		foreach ($fileList as $value)
		{
			$filePath = $fileDir . $value;
			$fileTime = \filemtime($filePath);
				
			if (($mktime - $fileTime) < \Wings::$settings['sessionTime'])
			{
				$fileName = self::getFileName($value);
				if(\strstr($fileName, $prefix))
				{
					$fileName = \str_replace($prefix, '', $fileName);
					$fileMime = \preg_replace('/[\s\.]/', '_', \mime_content_type($filePath));
					$type = \explode('/', $fileMime);
					
					$userTempFiles[] =
					[
						'level' => 0,
						'pageName' => 'Новые',
						'id' => 0,
						'pageID' => 'new',
						'mime' => $fileMime,
						'name' => $fileName,
						'type' => $type[0],
						'fullPath' => '/files/' . $type[0] . '/' . $fileName,
						'size' => \filesize($filePath),
						'time' => \date('Y-m-d H:i:s', $fileTime)
					];
				}
			}
			else
			{
				if (!\is_dir($filePath)) unlink($filePath);
			}
		}
		
		return $userTempFiles;
	}
	
	public static function transfer($pathFrom, $pathTo)
	{
		if (\stristr($_SERVER['SERVER_SOFTWARE'], 'win')) $pathTo = \iconv('utf-8', 'cp1251', $pathTo);
		
		if (\file_exists($pathTo)) \unlink($pathTo);
		
		$pathToDir = \explode('/', $pathTo);
		unset($pathToDir[(\count($pathToDir) - 1)]);
		$pathToDir = \implode('/', $pathToDir);
		
		Directory::create($pathToDir);
		\copy($pathFrom, $pathTo);
		\unlink($pathFrom);
	}
	
	public static function upload($file,$catalog = null, $name = null)
	{
		if (!\is_uploaded_file($file['tmp_name'])) return ['status' => 1, 'message' => 'Файл не был загружен на сервер.'];
		
		if ($name !== null && !empty($name)) $file['name'] = \urldecode($name);
		else $file['name'] = \urldecode($file['name']);
		
		$type = \explode('/', \mime_content_type($file['tmp_name']));
		
		if ($catalog !== null && !empty($catalog))
		{
			$path = $_SERVER['DOCUMENT_ROOT'] . $catalog;
			$fullPath = $fullPathToJS = $path . $file['name'];
		}
		else 
		{
			$path = self::$uploadDir . $type[0] . '/';
			$fullPath = $path . $file['name'];
			$fullPathToJS = '/files/' . $type[0] . '/' . $file['name'];
		}
		
		if (\stristr($_SERVER['SERVER_SOFTWARE'], 'win')) $fullPath = \iconv('utf-8', 'cp1251', $fullPath);
		
		if (\file_exists($fullPath)) return ['status' => 2, 'message' => 'Файл с таким именем существует.'];
		
		if ($catalog === false || empty($catalog))
		{
			$path = self::$uploadDir . 'temp/';
			$fullPath = $path . \session_id() . '_' . $file['name'];
		}
		
		if (\stristr($_SERVER['SERVER_SOFTWARE'], 'win')) $fullPath = \iconv('utf-8', 'cp1251', $fullPath);
		
		if (\file_exists($fullPath)) return ['status' => 2, 'message' => 'Файл с таким именем существует.'];
		
		Directory::create($path);
		
		if (!\move_uploaded_file($file['tmp_name'], $fullPath)) return ['status' => 3, 'message' => 'Файл нельзя переместить.'];
		
		return [
			'status' => 200, 
			'data' => [
				'name' => $file['name'],
				'mime' => implode('/', $type),
				'fullPath' => $fullPathToJS,
				'date' => \date('Y-m-d H:i:s', \filemtime($fullPath)),
				'size' => \filesize($fullPath)
			]
		];
	}
}