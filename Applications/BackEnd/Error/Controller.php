<?php

namespace Applications\BackEnd\Error;

final class Controller extends \Applications\BackEnd\Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->view = new View();
	}
	
	public function index($errorCode)
	{
		$errors =
		[
			'403'	=> 'У Вас не хватает прав доступа на данную страницу.',
			'404'	=> 'Данной страницы не существует.'
		];
		
		$this->view->index($errorCode, $errors[$errorCode]);
	}
}