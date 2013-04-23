<?php

class Wings
{
	public static $ajax;
	public static $dir;
	public static $get = array();
	public static $pathname = array('');
	public static $post = array();
	public static $smarty;
	public static $view;
	public static $workspace;
	
	final public function __construct()
	{
		self::$dir = str_replace('\\', '/', dirname(__FILE__)) . '/';
		
		require self::$dir . 'functions.php';
		require self::$dir . 'Autoloader.php';
		require self::$dir . 'Exception.php';
		
		$this->GlobalsInterpretation();
		$this->Initialize();
	}
	
	final private function GlobalsInterpretation()
	{
		self::$get = $_GET;
		
		if (isset($_GET['pathname']))
		{
			self::$pathname = explode('/', $_GET['pathname']);
			
			if (self::$pathname[count(self::$pathname) - 1] == '') unset(self::$pathname[count(self::$pathname) - 1]);
			
			unset(self::$get['pathname']);
		}
		
		self::$post = $_POST;
	}
	
	final private function Initialize()
	{
		$settings = \Wings\Autoloader::ArrayFiles(self::$dir . 'config.php');
		
		\Wings\Autoloader::$debug = $settings['debug']['autoload'];
		\Wings\Exception::$debug = $settings['debug']['exception'];
		\Wings\Exception::$debugType = $settings['debug']['excType'];
		
		foreach ($settings['workspace'] as $key => $value)
		{
			if ($value['url'] === '')
			{
				$workspaceBasic = $value;
				$workspaceBasic['name'] = $key;
				$workspaceBasic['namespace'] = '\\Applications\\' . $key . '\\';
			}
			
			if ($value['url'] === self::$pathname[0])
			{
				self::$workspace = $value;
				self::$workspace['name'] = $key;
				self::$workspace['namespace'] = '\\Applications\\' . $key . '\\';
			}
		}
		
		if (self::$workspace === null) self::$workspace = $workspaceBasic;
		else array_splice(self::$pathname, 0, 1);
		
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']))
		{
			if ($_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest') self::$ajax = true;
			else self::$ajax = false;
		}
		
		\Wings\DB::Init($settings['db']);
		
		require $_SERVER['DOCUMENT_ROOT'] . '/Modules/Smarty/Smarty.class.php';
		
		self::$smarty = new Smarty();
		self::$smarty->muteExpectedErrors();
		self::$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'] . '/Templates/' . self::$workspace['name'] . '/');
		self::$smarty->setCompileDir(self::$dir . 'Compile/Smarty/');
		self::$smarty->setCacheDir(self::$dir . 'Cache/Smarty/');
		self::$smarty->debugging = $settings['debug']['smarty'];
	}
	
	final public function Start()
	{
		self::$view['type'] = 'http';
		
		$workspaceClass = self::$workspace['namespace'] . 'Workspace';
		$workspaceClass::Initialize();
	}
	
	final public function View()
	{
		header('Content-Type: text/html; charset=utf-8');
		
		if (self::$view['type'] === 'http')
		{
			unset(self::$view['type']);
			
			if (!isset(self::$view['tpl'])) throw new \Wings\Exception('Не задан шаблон для выполнения.');
			
			foreach (self::$view as $key => $value) self::$smarty->assign($key, $value);
			
			self::$smarty->display(self::$view['tpl']);
		}
		else
		{
			
		}
	}
}