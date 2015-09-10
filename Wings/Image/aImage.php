<?php

namespace Wings\Image;

abstract class aImage
{
	protected $image;
	public $height;
	public $width;
	
	final protected function getProperties()
	{
		$this->height = \imagesy($this->image);
		$this->width = \imagesx($this->image);
	}
	
	final public function resize($width = null, $height = null, $quality = 100)
	{
		if (\is_null($width) && \is_null($height)) return;
		if ($width === $this->width && $height === $this->height) return;
		
		if (!\is_null($width) && !\is_null($height))
		{
			if ($this->width > $this->height) $ratio = $this->width / $height;
			else $ratio = $this->height / $width;
		}
		elseif (\is_null($height)) $ratio = $this->width / $width;
		else $ratio = $this->height / $height;
		
		$destWidth = \round($this->width / $ratio);
		$destHeight = \round($this->height / $ratio);
		
		$dest = \imagecreatetruecolor($destWidth, $destHeight);
		
		\imagecopyresized($dest, $this->image, 0, 0, 0, 0, $destWidth, $destHeight, $this->width, $this->height);
		
		$fileName = $this->save($dest, $quality);
		
		\imagedestroy($dest);
		
		return $fileName;
	}
	
	public abstract function save($image, $quality);
}

?>