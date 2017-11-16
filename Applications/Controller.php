<?php
namespace Applications;

class Controller
{
	public static function checkAccess($accesses, $type)
	{
		if ($accesses[$type] === 0)
		{
			return
			[
				'code'			=> 403,
				'description'	=> 'Доступ запрещён.'
			];
		}
		
		return true;
	}
	
	public static function issetAllData($columns)
	{
		foreach ($columns as $key => $value)
		{
			if (isset($value['generated']) && $value['generated'] === true && !isset($field['field']['isConfirm'])) continue;
			if ($value['field'] === 'checkbox') continue;
			
			if (isset(\Wings::$post[$key])) continue;
			else return false;
		}
		
		return true;
	}
	
	protected static function validate($fields)
	{
		foreach ($fields as $key => $field)
		{
			if (!isset($field['validate'])) continue;
			
			if (isset($field['validate']))
			{
				foreach ($field['validate'] as $value)
				{
					if ($value === 'checked' && !isset(\Wings::$post[$key])) return false;
					if (!\Wings\Validation::$value(\Wings::$post[$key])) return false;
				}
			}
		}
		
		return true;
	}
}
