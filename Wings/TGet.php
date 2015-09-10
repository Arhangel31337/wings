<?php

namespace Wings;

trait tGet
{
	final public function __call($methodName, $argument)
	{
		$args = preg_split('/(?<=\w)(?=[A-Z])/', $methodName);
		$action = array_shift($args);
		$args[0] = strtolower($args[0]);
		$propertyName = implode('', $args);
		
		if ($action === 'get')
		{
			return isset($this->$propertyName) ? $this->$propertyName : null;
		}
	} 
}