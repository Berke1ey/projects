<?php 

class BD {	
	public static $mysqli;

	public function __construct() {
		$config['MYSQL_SERVER'] 	= 'localhost';
		$config['MYSQL_DB'] 		= '*******';
		$config['MYSQL_USER'] 		= '******';
		$config['MYSQL_PASSWORD'] 	= '*******';

		BD::$mysqli = new MySQLi($config['MYSQL_SERVER'],$config['MYSQL_USER'],$config['MYSQL_PASSWORD'],$config['MYSQL_DB']);

		if (BD::$mysqli->connect_error) {
			die('Ошибка подключения (' . BD::$mysqli->connect_errno . ') '. BD::$mysqli->connect_error);
		}
	}
}
