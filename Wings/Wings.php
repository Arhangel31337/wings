<?php

final class Wings
{
	public static $ajax = false;
	public static $cookie = [];
	public static $dir;
	public static $errors = [];
	public static $files = [];
	public static $get = [];
	public static $host;
	public static $isAjax;
	public static $language;
	public static $page = [];
	public static $pathname = [];
	public static $post = [];
	public static $session = [];
	public static $settings = [];
	public static $smarty;
	public static $user;
	public static $view = ['files' => ['css' => [], 'js' => []]];
	public static $words;
	public static $workspace;
	
	public function __construct()
	{
		self::$dir = str_replace('\\', '/', dirname(__FILE__)) . '/';
		
		require self::$dir . 'functions.php';
		require self::$dir . 'Autoloader.php';
		require self::$dir . 'Exception.php';
		
		$this->globalsInterpretation();
		$this->initialize();
	}
	
	private function globalsInterpretation()
	{
		session_start();
		
		if (isset($_COOKIE['PHPSESSID'])) setcookie('PHPSESSID', $_COOKIE['PHPSESSID'], time() + 3600, '/');
		
		self::$get = $_GET;
		
		if (isset($_GET['pathname']))
		{
			self::$pathname = explode('/', $_GET['pathname']);
			
			if (self::$pathname[count(self::$pathname) - 1] == '') unset(self::$pathname[count(self::$pathname) - 1]);
			
			unset(self::$get['pathname']);
		}
		
		self::$files = $_FILES;
		self::$post = $_POST;
		self::$session = $_SESSION;
	}
	
	private function initialize()
	{
		$settings = \Wings\Autoloader::arrayFiles(self::$dir . 'personal_config.php');
		$personal_settings = \Wings\Autoloader::arrayFiles(self::$dir . 'config.php');
		
		$settings = \array_replace_recursive($personal_settings, $settings);
		
		foreach ($settings['php'] as $key => $value) ini_set($key, $value);
		
		self::$view['meta'] = $settings['meta'];
		self::$settings = $settings['settings'];
		self::$settings['sessionTime'] = $settings['php']['session.cookie_lifetime'];
		
		\Wings\Crypt::initialize($settings['crypt']);
		\Wings\File::initialize();
		
		\Wings\Autoloader::$debug = $settings['debug']['autoload'];
		\Wings\Exception::$debug = $settings['debug']['exception'];
		\Wings\Exception::$debugType = $settings['debug']['excType'];
		
		\Wings\DB::init($settings['db']);
		
		self::$isAjax = false;
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') self::$ajax = true;
		
		$host = \str_replace('www.', '', $_SERVER['HTTP_HOST']);
		
		$query = '
			SELECT
				h.*
			FROM `Host` h
			INNER JOIN `Language` l ON h.`defaultLang` = l.`id`;
		';
		self::$host = \Wings\DB::select('Host', '*', ['name' => '='], ['name' => [$host, 'str', 255]])[0];
		
		if (!self::testLanguage(self::$host['defaultLang'])) return;
		
		if (!isset(self::$pathname[0])) self::$pathname[0] = '';
		
		foreach ($settings['workspace'] as $key => $value)
		{
			if ($value['url'] === null)
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
		else \array_splice(self::$pathname, 0, 1);
		
		self::$workspace['host'] = self::$host['name'];
		/*
		if (isset(self::$language) && !empty(self::$language))
		{
			self::$words = \Wings\Autoloader::arrayFiles(
				$_SERVER['DOCUMENT_ROOT'] .'/Applications/Languages/' . self::$language['code'] .'.php'
			);
		}
		*/
		if ($this->testHostRules() !== true) return;
		
		self::$user = new \Wings\User();
		
		if (!\is_null(self::$user->getId()))
		{
			$args = [
				'lastVisit'	=> [date('Y-m-d H:i:s'), 'str', 19],
				'id'		=> self::$user->getId()
			];
			\Wings\UserGroupeModel::userUpdate($args);
		}
		
		require $_SERVER['DOCUMENT_ROOT'] . '/Modules/Smarty/Smarty.class.php';
		
		self::$smarty = new Smarty();
		self::$smarty->muteExpectedErrors();
		self::$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'] . '/Templates/' . self::$workspace['name'] . '/');
		self::$smarty->setCompileDir(self::$dir . 'Compile/Smarty/');
		self::$smarty->setCacheDir(self::$dir . 'Cache/Smarty/');
		self::$smarty->debugging = $settings['debug']['smarty'];
	}
	
	public function start()
	{
		self::$view['type'] = 'http';
		
		if (self::$workspace['isHTML5'] && \Wings\Header::isOldBrowser())
		{
			\Wings::$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'] . '/Templates/');
			\Wings::$view['files']['css'] = '/css/browser.css';
			\Wings::$view['tpl'] = 'browser.tpl';
			
			return;
		}
		
		$workspaceClass = self::$workspace['namespace'] . 'Workspace';
		$workspaceClass::initialize();
		
		$_SESSION = self::$session;
	}
	
	private function testHostRules()
	{
		$http = 'http://';
		if (isset($_SERVER['HTTPS'])) $http = 'https://';
		
		if (isset(self::$get['logout']))
		{
			session_destroy();
			\Wings\Header::location($_SERVER['REDIRECT_URL']);
			return $this->View();
		}
		
		if (self::$host['needHTTPS'])
		{
			if (!isset($_SERVER['HTTPS']))
			{
				\Wings\Header::location('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
				return $this->View();
			}
		}
		
		if (self::$host['needWWW'])
		{
			if(strpos($_SERVER['HTTP_HOST'], 'www.') === false)
			{
				\Wings\Header::location($http . 'www.' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
				return $this->View();
			}
		}
		
		return true;
	}
	
	private function testLanguage($default)
	{
		$query = '
			SELECT
				l.*
			FROM
				`Host` h
			INNER JOIN `link_HostLanguage` lhl ON h.`id` = lhl.`host`
			INNER JOIN `Language` l ON lhl.`language` = l.`id`;
		';
		$languages = \Wings\DB::fetchAll($query);
		
		if (!self::$host['isMultilang'])
		{
			self::$language = $languages[0];
			return true;
		}
		
		$languageCodes = [];
		foreach ($languages as $value) $languageCodes[] = $value['code'];
			
		if(isset(self::$pathname[0]) && strlen(self::$pathname[0]) === 5)
		{
			$key = array_search(self::$pathname[0], $languageCodes);
			if ($key !== false)
			{
				self::$pathname = array_slice(self::$pathname, 1);
				self::$language = $languages[$key];
			}
		}
		
		if (isset(self::$language)) return true;
		
		$lang = false;
		
		if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		{
			$list = \strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']);
			
			if (\preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/', $list, $list))
			{
				$language = \array_combine($list[1], $list[2]);
				
				foreach ($language as $key => $q) $language[$key] = $q ? $q : '1.0';
				\arsort($language, SORT_NUMERIC);
			}
			
			$languagesCutting = [];
			
			foreach ($languageCodes as $key => $value) $languagesCutting[$key] = strtok($value, '-');
			
			foreach ($language as $key => $value)
			{
				$lang = array_search($key, $languageCodes);
				if ($lang !== false) break;
				
				$lang = array_search($key, $languagesCutting);
				if ($lang !== false) break;
			}
		}
		
		if ($lang === false) $lang = $default;
		
		self::$language = $languages[$lang];
		
		$_SERVER['REQUEST_URI'] = self::$language['code'] . $_SERVER['REQUEST_URI'];
		
		$http = 'http://';
		if (isset($_SERVER['HTTPS'])) $http = 'https://';
		
		\Wings\Header::location($http . $_SERVER['HTTP_HOST'] . '/' . $_SERVER['REQUEST_URI']);
		
		return $this->View();
	}
	
	public function view()
	{
		\Wings\Header::setLocation();
		
		self::$view['errors'] = self::$errors;
		self::$view['language'] = self::$language;
		self::$view['page'] = self::$page;
		self::$view['pathname'] = self::$pathname;
		self::$view['user'] = self::$user->getUserData();
		self::$view['workspace'] = self::$workspace;
		self::$view['words'] = self::$words;
		//trace(self::$view);
		
		if (self::$view['type'] === 'http')
		{
			unset(self::$view['type']);
			
			self::$view['charset'] = self::$host['charset'];
			
			if (!isset(self::$view['tpl'])) throw new \Wings\Exception('Не задан шаблон для выполнения.');
			
			foreach (self::$view as $key => $value) self::$smarty->assign($key, $value);
			
			self::$smarty->display(self::$view['tpl']);
		}
	}
}