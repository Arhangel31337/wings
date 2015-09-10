<?php

namespace Wings;

final class Soap
{
	public	$result;
	private	$soapClient;
	
	public function __construct($url, $login, $password)
	{
		$this->soapClient = new \SoapClient($url, ['login' => $login, 'password' => $password, 'trace' => 1, 'exceptions' => 1]);
	}
	
	public static function createParam($structure, $name, $namespace)
	{
		return new \SoapVar($structure, SOAP_ENC_OBJECT, $name, $namespace);
	}
	
	public function exec($operation, $options = null)
	{
		if (!is_null($options) && is_array($options)) $this->result = $this->soapClient->$operation($options);
		else $this->result = $this->soapClient->$operation();
		
		$this->result = \objectToArray($this->result);
		
		if (!isset($this->result['return'])) $this->result = null;
		else $this->result = $this->result['return'];
		
		return $this->result;
	}
}