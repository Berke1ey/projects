<?php
if(!class_exists('news')) {
	include('news.php');
}


Class NewsInfo extends BD { 
	public function getName() {
		return News::$news['name'];
	}

	public function getDesc() {
		return News::$news['desc'];
	}

	public function getID() {
		return News::$news['id'];
	}

	public function getImage() {
		return News::$news['image'];
	}

	public function getDate() {
		return date("Y.m.d", News::$news['date']);
	}
}