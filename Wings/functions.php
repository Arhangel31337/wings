<?php

function isExistence($variable)
{
	if (isset($variable) && !empty($variable)) return true;
	else return false;
}

function trace($toTrace)
{
	echo '<pre>';
	echo var_dump($toTrace);
	echo '</pre>';
}