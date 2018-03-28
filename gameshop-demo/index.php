<?php
ini_set("display_errors", "on");
error_reporting(E_ALL);

include('config.php');

if(!class_exists('Product')) {
	include('core/product.php');
}

if(!class_exists('News')) {
	include('core/news.php');
}
if(!class_exists('User')) {
	include('core/user.php');
}

$product = new Product();
$news = new News();
$user = new User();

$title;
$responsibilities = "";

session_start();
if (empty($_SESSION['visited'])) {
    $_SESSION['visited'] = [];
}
if (count($_SESSION['visited']) > 3) {
	unset($_SESSION['visited'][0]);
	unset($_SESSION['visited'][1]);
	sort($_SESSION['visited']);
}
$_SESSION['visited'][] = $_SERVER["REQUEST_URI"];


$class = ["download" => $product, "news" => $news];

if (!isset($_GET['page'])) {
	$title = "home";
	include("includes/index.php");
}
else {
	preg_match('/^(.*?)\/(.*?)$/', $_GET['page'], $matches);
	if ($matches[2] == "") {
		$title = $matches[1];
		include("includes/".$matches[1].$pages[$matches[1]].".php");
	}
	else {
		$id = $matches[2];
		($matches[1] == 'search') ? $title = 'search' : $title = $class[$matches[1]]->get($id)->getName();	
		include("includes/".$matches[1].".php");
	}
}
?>
