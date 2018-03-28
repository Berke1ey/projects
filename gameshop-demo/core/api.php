<?php
ini_set("display_errors", "on");
error_reporting(E_ALL);

if(!class_exists('Product')) {
	include('product.php');
}

if(!class_exists('News')) {
	include('news.php');
}

if(!class_exists('User')) {
	include('user.php');
}


$product = new Product();
$news = new News();
$user = new User();

if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == 'search')  {
		 header ("Location: /thecaracca1/search/".$_REQUEST['search']);
	}
	if ($_REQUEST['action'] == 'enter')  {	
		$login = $_REQUEST['login'];
		$password = $_REQUEST['password'];
		$enter = $user->enter($login, $password);
		if ($enter) { 
			setcookie('cookie', md5($password), time()+3600*24, "/");
			header("Location: /thecaracca1/");
		}
		else {
			header("Location: ".$_SERVER['HTTP_REFERER']."?fail=true");
		}
	}

	if ($_REQUEST['action'] == 'addnews')  {	
		$title = $_REQUEST['title'];
		$desc = $_REQUEST['desc'];
		$image = $_FILES['image'];
		$send = $news->send($title, $desc, $image);
		if ($send) { 
			header("Location: /thecaracca1/news/");
		}
		else {
			header("Location: ".$_SERVER['HTTP_REFERER']."?fail=true");
		}
	}

	if ($_REQUEST['action'] == 'deleteNews')  {	
		$id = $_REQUEST['id'];
		$send = $news->delete($id);
		$last = count($_SESSION['visited'])-3;
		$page = $_SESSION['visited'][$last];
//		header("Location: ".$page);
		header("Location: /thecaracca1/news/");
	}

	if ($_REQUEST['action'] == 'editNews')  {	
		$id = $_REQUEST['id'];
		$title = $_REQUEST['title'];
		$desc = $_REQUEST['desc'];
		$oldImageName = $_REQUEST['oldImageName'];
		$image = $_FILES['image'];
		$send = $news->edit($id, $title, $desc, $image, $oldImageName);
		$last = count($_SESSION['visited'])-3;
		$page = $_SESSION['visited'][$last];
//		header("Location: ".$page);
		header("Location: /thecaracca1/news/");
	}

	if ($_REQUEST['action'] == 'addproduct')  {
		$title = $_REQUEST['title'];
		$desc = $_REQUEST['desc'];
		$images = $_FILES['images'];
		$genre = $_REQUEST['genre'];
		$multiplayer = $_REQUEST['multiplayer'];
		$graphicstype = $_REQUEST['graphicstype'];
		$engine = $_REQUEST['engine'];
		$license = $_REQUEST['license'];
		$modding = $_REQUEST['modding'];
		$version = $_REQUEST['version'];
		$oss = isset($_REQUEST['oss']) ? $_REQUEST['oss'] : NULL;
		$downloadAndroid = isset($_FILES['download-android']) ? $_FILES['download-android'] : NULL;
		$downloadLinux = isset($_FILES['download-linux']) ? $_FILES['download-linux'] : NULL;
	
		$product->send($title, $desc, $images, $genre, $multiplayer, $graphicstype, $engine, $license, $modding, $version, $oss, $downloadAndroid, $downloadLinux);
		header("Location: /thecaracca1/download/");
	}

	if ($_REQUEST['action'] == 'deleteProduct')  {	
		$id = $_REQUEST['id'];
		$send = $product->delete($id);
		$last = count($_SESSION['visited'])-3;
		$page = $_SESSION['visited'][$last];
		header("Location: /thecaracca1/download/");
	}
}
?>