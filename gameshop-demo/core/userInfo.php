<?php
if(!class_exists('User')) {
	include('user.php');
}

Class UserInfo { 
	public function getResponsibilities() {
		return User::$user['responsibilities'];
	}
}