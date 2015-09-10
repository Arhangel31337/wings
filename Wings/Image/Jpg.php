<?php

namespace Wings\Image;

class Jpg extends aImage
{
	final public function __construct($path)
	{
		$this->image = \imagecreatefromjpeg($path);
		$this->getProperties();
	}
	
	final public function save($image, $quality)
	{
		$fileName =  $_SERVER['DOCUMENT_ROOT'] . \Wings::$settings['uploadDir'] . 'temp/' . date('YmdHis') . '_estimate.jpg';
		
		\imagejpeg($image, $fileName, $quality);
		
		return $fileName;
	}
}

?>