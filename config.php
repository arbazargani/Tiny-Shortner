<?php
	define('ABS_PATH', dirname((key_exists('REQUEST_SCHEME', $_SERVER) ? $_SERVER['REQUEST_SCHEME'] : 'http') . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']) . '/');
	define('EN_APP_NAME', 'TinyShortener');
	define('FA_APP_NAME', 'تاینی لینک');
	define('ADMIN_URL', 'admin');
	define('ADMIN_ABS_PATH', ABS_PATH . ADMIN_URL);
	define('MAINTENANCE', FALSE);

    /*
     * 1- If you are using UNIX based system , you should use 127.0.0.1
     * 2- If you are using windows or something else , you should use localhost
     */

    define('MYSQL_HOST', '127.0.0.1');

	define('MYSQL_PORT', '8080');
	define('MYSQL_USERNAME', 'root');
	define('MYSQL_PASSWORD', '');
	define('MYSQL_DATABASE', 'tiny');
	define('DEBUG_MODE', FALSE);


	function Get($PREDEFINED) {
		return $PREDEFINED;
	}
	function PUT($PREDEFINED) {
		echo $PREDEFINED;
	}