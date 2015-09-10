<?php

namespace Applications\BackEnd\Index;

final class Controller extends \Applications\BackEnd\Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->view = new View();
	}
	
	public function index()
	{
		$this->view->index();
	}
}