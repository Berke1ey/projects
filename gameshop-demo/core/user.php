<?php
ini_set("display_errors", "on");
error_reporting(E_ALL);

if(!class_exists('BD')) {
	include('bd.php');
}
if(!class_exists('UserInfo')) {
	include('userInfo.php');
}


class User extends BD {

	static $user;


	public function enter($login, $password) {
		$res = false;
		$login = BD::$mysqli->real_escape_string($login);	
		$password = BD::$mysqli->real_escape_string($password);
		$sql = 'SELECT COUNT(*) FROM `users` WHERE `email`="'.$login.'" AND `password`="'.$password.'"';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		if ($result = $sqlres->fetch_array(MYSQLI_NUM)) {
			if ($result[0] > 0) {
				$res = true;
			}
		}
		return $res;
	}

	public function get($cookie) {
		$cookie = BD::$mysqli->real_escape_string($cookie);
		$sql = 'SELECT * FROM `users` WHERE  MD5(`password`)="'.$cookie.'"';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		while ($result = $sqlres->fetch_array(MYSQLI_ASSOC)) {
			$sql1 = 'SELECT * 
			FROM `user_responsibilities`
			LEFT JOIN `responsibilities` ON `user_responsibilities`.`responsibilities_id` = `responsibilities`.`id`
		 	WHERE `user_responsibilities`.`user_id`="'.$result['id'].'"';
		 	$sqlres1 = BD::$mysqli->query ($sql1) or die($sql1);
		 	while ($result1 = $sqlres1->fetch_array(MYSQLI_ASSOC)) {
		 		$result['responsibilities'] = $result1['name'];

		 	}
			User::$user = $result;
			$info = new userInfo();
			return $info;
		}
	}
}