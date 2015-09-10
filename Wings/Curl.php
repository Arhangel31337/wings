<?php

namespace Wings;

final class Curl
{
	private $curl;
	public $debug = false;
	public $encoding = '';
	public $freshConnect = true;
	public $getHeader = 0;
	public $httpHeader = [
		'Content-Type: text/xml; charset=UTF-8',
		'SOAPAction: http://localhost/spec'
	];
	public $noBody = 0;
	public $result;
	public $timeout = 20;
	private $url;
	public $userAgent = 'Mozilla/4.0 (compatible;)';
	public $userPassword = '';
	public $verbose = 0;
	
	final public function __construct($url)
	{
		$this->url = $url;
		
		$this->curl = curl_init();
		
		\curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
		\curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->timeout);
	}
	
	final public function cookie($data)
	{
		$array = array();
		
		foreach ($data as $key => $value)
		{
			$array[] = $key . '=' . $value;
		}
		
		\curl_setopt($this->curl, CURLOPT_COOKIE, implode('; ', $array));
	}
	
	final public function sslUndefined()
	{
		\curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
		\curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
	}
	
	final public function post($data)
	{
		\curl_setopt($this->curl, CURLOPT_POST, true);
		
		$array = array();
		
		if (\is_array($data))
		{
			foreach ($data as $key => $value) $array[] = $key . '=' . $value;
			\curl_setopt($this->curl, CURLOPT_POSTFIELDS, implode('&', $array));
		}
		else
		{
			$array = $data;
			\curl_setopt($this->curl, CURLOPT_POSTFIELDS, $array);
		}
	}
	
	final public function start()
	{
		\curl_setopt($this->curl, CURLOPT_ENCODING, $this->encoding);
		\curl_setopt($this->curl, CURLOPT_FRESH_CONNECT, $this->freshConnect);
		\curl_setopt($this->curl, CURLOPT_HEADER, $this->getHeader);
		\curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->httpHeader);
		\curl_setopt($this->curl, CURLOPT_NOBODY, $this->noBody);
		\curl_setopt($this->curl, CURLOPT_URL, $this->url);
		\curl_setopt($this->curl, CURLOPT_USERAGENT, $this->userAgent);
		if (!empty($this->userPassword)) \curl_setopt($this->curl, CURLOPT_USERPWD, $this->userPassword);
		\curl_setopt($this->curl, CURLOPT_VERBOSE, $this->verbose);

		\curl_setopt($this->curl, CURLINFO_HEADER_OUT, true);
		
		$this->result = curl_exec($this->curl);
		if ($this->debug)
		{
			trace(curl_getinfo($this->curl, CURLINFO_HEADER_OUT));
			trace($this->url);
			trace((!empty($this->userPassword)) ? $this->userPassword : null);
			trace($this->result);
		}
	}
}