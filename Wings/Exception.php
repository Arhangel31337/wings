<?php

namespace Wings;

class Exception extends \Exception
{
	public static $debug = true;
	public static $debugType = 'Web';
	private static $errorNumber;
	private static $errorMessage;
	private static $errorFile;
	private static $errorLine;
	private static $errorDescription;
	private static $errorTrace;
	
	private static $errorName = array(
			0    => 'Exception',
			1    => 'Error',
			2    => 'Warning',
			4    => 'Parse',
			8    => 'Notice',
			16   => 'Core Error',
			32   => 'Core Warning',
			64   => 'Compile Error',
			128  => 'Compile Warning',
			256  => 'User Error',
			512  => 'User Warning',
			1024 => 'User Notice',
			2048 => 'Strict',
			4096 => 'Recoverable Error',
			8192 => 'Deprecated',
			16384=> 'User Deprecated',
			30719=> 'All'
	);
	
    private static function clear()
    {
        self::$errorNumber = null;
        self::$errorMessage = null;
        self::$errorFile = null;
        self::$errorLine = null;
        self::$errorDescription = null;
        self::$errorTrace = null;
    }
    
	public static function error($errorNumber, $errorString, $errorFile, $errorLine, $errorContext = '')
    {
        self::$errorNumber = $errorNumber;
        self::$errorMessage = \preg_replace('/\[.*\]/siU', '', $errorString);
        self::$errorFile = $errorFile;
        self::$errorLine = $errorLine;
        self::$errorDescription = $errorContext;
        self::$errorTrace = \array_slice(\debug_backtrace(), 1);
        self::Report('Report' . self::$debugType);
    }
    
    public static function exception($exceptionHandler)
    {
        self::$errorNumber = $exceptionHandler->getCode();
        self::$errorMessage = $exceptionHandler->getMessage();
        self::$errorFile = $exceptionHandler->getFile();
        self::$errorLine = $exceptionHandler->getLine();
        self::$errorDescription = '';
        self::$errorTrace = \array_slice(\debug_backtrace(), 2);
        self::Report('Report' . self::$debugType);
    }
	
    private static function getStringInFile($fileName, $numberString)
    {
    	if (\file_exists($fileName))
    	{
	        $file = \file($fileName);
	        return $file[$numberString - 1];
    	}
    	
    	return '';
    }
    
    private static function report($methodName)
    {
    	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') self::reportAJAX();
        elseif (self::$debug) self::$methodName();
        
        self::Clear();
    }
    
    private static function reportAJAX()
    {
    	\header('Content-type: application/json; charset=UTF-8');
    	
    	$data =
    	[
    		'type'		=> self::$errorName[self::$errorNumber],
    		'file'		=> self::$errorFile,
    		'line'		=> self::$errorLine,
    		'message'	=> self::$errorMessage
    	];
    	
    	if (!empty(self::$errorTrace) && self::$errorTrace[0]['function'] != 'RegisterShutdownFunction') $data['trace'] = self::$errorTrace;
    	
    	echo \json_encode($data);
    	
    	exit();
    }
    
    private static function reportWeb()
    {
        require \Wings::$dir . '/Exception/index.php';
        exit();
    }
    
	public static function shutdown()
	{
		$error = \error_get_last();
		
		if ($error['type'] == E_ERROR || $error['type'] == E_CORE_ERROR || $error['type'] == E_COMPILE_ERROR || $error['type'] == E_USER_ERROR)
		{
			self::Error($error['type'], $error['message'], $error['file'], $error['line']);
		}
	}
}

\set_error_handler(\create_function('$errorNumber, $errorString, $errorFile, $errorLine, $errorContext', '\Wings\Exception::error($errorNumber, $errorString, $errorFile, $errorLine, $errorContext);'), E_ALL);
\set_exception_handler(\create_function('$exceptionHandler', '\Wings\Exception::exception($exceptionHandler);'));
\register_shutdown_function(\create_function('', '\Wings\Exception::shutdown();'));