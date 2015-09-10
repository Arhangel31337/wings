<?php

namespace Wings\Image;

class Png extends aImage
{
	final public function __construct($path)
	{
		$this->image = \imagecreatefrompng($path);
		$this->getProperties();
	}
	
	final public function save($image, $quality)
	{
		$quality= \round(9 * $quality / 100);
		
		$fileName =  $_SERVER['DOCUMENT_ROOT'] . \Wings::$settings['uploadDir'] . 'temp/' . date('YmdHis') . '_estimate.png';
		
		\imagepng($image, $fileName, $quality);
		
		return $fileName;
	}
}

?>