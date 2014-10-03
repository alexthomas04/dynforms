<?php
session_start();
$GLOBALS['config']= array(
	'mysql' => array(
		'host'=>'mysql.5jelly.com',
		'username' => 'u899728766_sonic',
		'password' => 'piRcircl3',
		'db' => 'u899728766_dynfo')

	);

spl_autoload_register(function($class){
	require_once 'classes/' . $class . '.php';
});

function getClientIP() {

    if (isset($_SERVER)) {

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];

        return $_SERVER["REMOTE_ADDR"];
    }

    if (getenv('HTTP_X_FORWARDED_FOR'))
        return getenv('HTTP_X_FORWARDED_FOR');

    if (getenv('HTTP_CLIENT_IP'))
        return getenv('HTTP_CLIENT_IP');

    return getenv('REMOTE_ADDR');
}

DB::getInstance()->insert('logins',array('ip'=>getClientIP()));