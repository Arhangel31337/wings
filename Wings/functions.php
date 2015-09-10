<?php

function arrayToXML($array, &$xml)
{
	foreach($array as $key => $value)
	{
		if(\is_array($value))
		{
			if(!\is_numeric($key))
			{
				$subnode = $xml->addChild("$key");
				arrayToXML($value, $subnode);
			}
			else \arrayToXML($value, $xml);
		}
		else
		{
			$xml->addChild($key,$value);
		}
	}
}

function objectToArray($object)
{
	if(!\is_object($object) && !\is_array($object)) return $object;
	
	if( \is_object($object)) $object = \get_object_vars($object);
	
	return \array_map('objectToArray', $object);
}

function trace($toTrace = null)
{
	echo '<pre>';
	if(\is_null($toTrace)) echo 'Точка проверки.';
	else echo \var_dump($toTrace);
	echo '</pre>';
}

function traceExit($toTrace = null)
{
	\trace($toTrace);
	exit();
}

function transliterate($string)
{
	$converter = [
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
		'ё' => 'e', 'ж' => 'zh',  'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k',
		'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
		'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch', 'ь' => '',  'ы' => 'y', 'ъ' => '',
		'э' => 'e', 'ю' => 'yu',  'я' => 'ya',
		
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
		'Ё' => 'E', 'Ж' => 'Zh',  'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K',
		'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
		'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch', 'Ь' => '',  'Ы' => 'Y', 'Ъ' => '',
		'Э' => 'E', 'Ю' => 'Yu',  'Я' => 'Ya',
		
		'-' => ''
	];
	
	return \strtr($string, $converter);
}

function treeToArray($tree)
{
	$array = [];
	
	foreach ($tree as $node)
	{
		if (isset($node['childrens']))
		{
			$childrens = \treeToArray($node['childrens']);
			unset($node['childrens']);
			
			$array[] = $node;
			$array = array_merge($array, $childrens);
		}
		else $array[] = $node;
	}
	
	return $array;
}