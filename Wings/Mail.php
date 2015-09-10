<?php
namespace Wings;

final class Mail
{
	const eol = "\n";
	
	private $body;
	private $bound;
	private $content = '';
	private $files = [];
	private $from;
	private $images = [];
	private $header;
	private $subject = '';
	private $to;
	
	public function __construct($from, $to)
	{
		$this->from = $from;
		
		$to = \explode(',', $to);
		$temp = [];
		
		foreach ($to as $value)
		{
			$tmp = \trim($value);
			if (Validation::mail($tmp)) $temp[] = $tmp;
		}
		
		$this->to = $temp;
		
		$this->bound = date('YmdHis_') . \Wings::$user->getLogin();
	}
	
	public function addContent($string)
	{
		$this->content .= $string;
	}
	
	public function addFile($path, $name = null)
	{
		if (!\file_exists($path)) return;
		
		if (\is_null($name)) $name = \basename($path);
		
		$this->files[] = ['path' => $path, 'name' => $name];
	}
	
	public function addImage($path, $name = null)
	{
		if (!\file_exists($path)) return;
		
		if (\is_null($name)) $name = \basename($path);
		
		$this->images[] = ['path' => $path, 'name' => $name];
	}
	
	private function encoding($string)
	{
		return '=?utf-8?B?' . \base64_encode($string) . '?=';
	}
	
	public function send()
	{
		foreach ($this->images as $key => $image)
		{
			$image['content'] = fopen($image['path'], 'rb');
			$this->body .= self::eol . '--' . $this->bound . self::eol;
			$this->body .= 'Content-Type: ' . mime_content_type($image['path']) . self::eol;
			$this->body .= 'Content-Transfer-Encoding: base64' . self::eol;
			$this->body .= 'Content-ID: Image' . $key . self::eol;
			$this->body .= chunk_split(base64_encode(fread($image['content'],filesize($image['path']))));
			
			$this->content = str_replace($image['name'], 'cid:Image' . $key, $this->content);
		}
		
		$this->body = '--' . $this->bound . self::eol;
		$this->body .= 'Content-Type: text/html; charset=utf-8' . self::eol;
		$this->body .= 'Content-Transfer-Encoding: base64' . self::eol;
		
		$this->body .= chunk_split(base64_encode($this->content));
		
		foreach ($this->files as $file)
		{
			$file['content'] = fopen($file['path'], 'rb');
			$this->body .= self::eol . '--' . $this->bound . self::eol;
			$this->body .= 'Content-Type: ' . mime_content_type($file['path']) . '; name="' . '=?utf-8?B?' . base64_encode($file['name']) . '?=' . '"' . self::eol;
			$this->body .= 'Content-Transfer-Encoding: base64' . self::eol;
			$this->body .= 'Content-Disposition: attachment; filename="' . $this->encoding($file['name']) . '"' . self::eol;
			$this->body .= chunk_split(base64_encode(fread($file['content'],filesize($file['path']))));
		}
		
		$this->body .= '--' . $this->bound . '--' . self::eol;
		
		$notError = true;
		
		foreach ($this->to as $to)
		{
			$this->header = 'From: ' . iconv('UTF-8', 'cp1251', $this->from['name']) . '<' . $this->from['mail'] . '>' . self::eol;
			$this->header .= 'To: ' . $to . self::eol;
			$this->header .= 'X-Mailer: PHPMail Tool' . self::eol;
			$this->header .= 'Reply-To: ' . $this->from['mail'] . self::eol;
			$this->header .= 'MIME-Version: 1.0;' . self::eol;
			$this->header .= 'Content-Type: multipart/mixed;';
			$this->header .= 'boundary="' . $this->bound . '"' . self::eol;
			
			if (!\mail($to, $this->subject, $this->body, $this->header)) $notError = false; 
		}
		
		return $notError;
	}
	
	public function setSubject($string)
	{
		$this->subject = $this->encoding($string);
	}
}