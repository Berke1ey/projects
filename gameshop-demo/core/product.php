<?php
ini_set("display_errors", "on");
error_reporting(E_ALL);

if(!class_exists('BD')) {
	include('bd.php');
}
if(!class_exists('ProductInfo')) {
	include('productInfo.php');
}
if(!class_exists('Image')) {
	include('image.php');
}

class Product extends BD {

	static $product;

	public function get($id) {
		$id = BD::$mysqli->real_escape_string($id);

		$sql = 'SELECT * FROM `products` WHERE `id`="'.$id.'" AND `deleted`=0';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		while ($result = $sqlres->fetch_array(MYSQLI_ASSOC)) {

			$sql1 = 'SELECT * 
			FROM `product_image`
			LEFT JOIN `images` ON `product_image`.`image_id` = `images`.`id`
		 	WHERE `product_image`.`product_id`="'.$id.'"';
		 	$sqlres1 = BD::$mysqli->query ($sql1) or die($sql1);
		 	while ($result1 = $sqlres1->fetch_array(MYSQLI_ASSOC)) {
		 		$result['images'][] = '/thecaracca1/data/product/'.$result['name'].'/screenshot/'.$result1['name'];
		 	}

			$sql2 = 'SELECT * 
			FROM `product_supported`
			LEFT JOIN `os` ON `os`.`id` = `product_supported`.`os_id`
		 	WHERE `product_supported`.`product_id`="'.$id.'"';
		 	$sqlres2 = BD::$mysqli->query ($sql2) or die($sql2);
		 	while ($result2 = $sqlres2->fetch_array(MYSQLI_ASSOC)) {
		 		$result['oss_name'][] = $result2['name'];
		 		$result['links_name'][] = $result2['link'];
		 	}

			Product::$product = $result;
			$info = new ProductInfo();
			return $info;
		}
	}

	public function getNew() {
		$sql = 'SELECT * FROM `products` WHERE `deleted`=0 ORDER BY `id` DESC LIMIT 1';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		while ($result = $sqlres->fetch_array(MYSQLI_ASSOC)) {

			$sql1 = 'SELECT * 
			FROM `product_image`
			LEFT JOIN `images` ON `product_image`.`image_id` = `images`.`id`
		 	WHERE `product_image`.`product_id`="'.$result['id'].'"';
		 	$sqlres1 = BD::$mysqli->query ($sql1) or die($sql1);
		 	while ($result1 = $sqlres1->fetch_array(MYSQLI_ASSOC)) {
		 		$result['images'][] = '/thecaracca1/data/product/'.$result['name'].'/screenshot/'.$result1['name'];
		 	}

			$sql2 = 'SELECT * 
			FROM `product_supported`
			LEFT JOIN `os` ON `os`.`id` = `product_supported`.`os_id`
		 	WHERE `product_supported`.`product_id`="'.$result['id'].'"';
		 	$sqlres2 = BD::$mysqli->query ($sql2) or die($sql2);
		 	while ($result2 = $sqlres2->fetch_array(MYSQLI_ASSOC)) {
		 		$result['oss_name'][] = $result2['name'];
		 		$result['links_name'][] = $result2['link'];
		 	}

			Product::$product = $result;
			$info = new ProductInfo();
			return $info;
		}
	}

	public function publishedIDs() {
		$ids = [];
		$sql = 'SELECT `id` FROM `products` WHERE `deleted`=0 ORDER BY `id` DESC';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		while ($result = $sqlres->fetch_array(MYSQLI_NUM)) {
			$ids[] = $result[0];
		}
		return $ids;
	}

	public function search($request) {
		$request = BD::$mysqli->real_escape_string($request);
		$res = [];

		$sql = "SELECT `id` FROM `products` WHERE `name` LIKE '%".$request."%' AND  `deleted`=0";
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		while ($result = $sqlres->fetch_array(MYSQLI_ASSOC)) {
			$res[] = $result['id'];
		}
		return $res;
	}

	public function getCount() {
		$count = 0; 

		$sql = 'SELECT COUNT(*) FROM `products` WHERE `deleted`=0';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		if ($result = $sqlres->fetch_array(MYSQLI_NUM)) {
			$count = $result[0];
		}
		return $count;
	}

	public function hasProduct($title) {
		$title = BD::$mysqli->real_escape_string($title);
		$sql = 'SELECT COUNT(*) FROM `products` WHERE `name`="'.$title.'" AND `deleted`=0';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		if ($result = $sqlres->fetch_array(MYSQLI_NUM)) {
			if ($result[0] > 0) {
				return true;
			}
		}
		return false;
	}

	public function delete($id) {
		$id = BD::$mysqli->real_escape_string($id);
		$sql = 'UPDATE `products` SET `deleted`=1 WHERE `id`="'.$id.'"';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
	}

	public function send($title, $desc, $images, $genre, $multiplayer, $graphicstype, $engine, $license, $modding, $version, $oss, $downloadAndroid, $downloadLinux) {
		$title = BD::$mysqli->real_escape_string($title);
		$desc = BD::$mysqli->real_escape_string($desc);
		$genre = BD::$mysqli->real_escape_string($genre);
		$multiplayer = BD::$mysqli->real_escape_string($multiplayer);
		$graphicstype = BD::$mysqli->real_escape_string($graphicstype);
		$engine = BD::$mysqli->real_escape_string($engine);
		$license = BD::$mysqli->real_escape_string($license);
		$modding = BD::$mysqli->real_escape_string($modding);
		$version = BD::$mysqli->real_escape_string($version);



		if (!$this->hasProduct($title)) {
			$dirname = __DIR__.'/../data/product/'.$title;

			$sql = 'INSERT INTO `products` (`name`, `desc`, `genre`, `multiplayer`, `graphics_type`, `engine`, `modding_friendly`, `license`, `version`) VALUES ("'.$title.'", "'.$desc.'", "'.$genre.'", "'.$multiplayer.'", "'.$graphicstype.'", "'.$engine.'", "'.$modding.'", "'.$license.'", "'.$version.'")';
			$sqlres = BD::$mysqli->query ($sql) or die(BD::$mysqli->error);
			$id = BD::$mysqli->insert_id;

			if ($images['name'][0] != "") {
				for ($i = 0; $i < count($images['name']); $i++) {
					$img = new Image();
					$name = $img->setImageName();
					$imageSize = getimagesize($images["tmp_name"][$i]);

				   	if($imageSize["mime"] == "image/jpeg") {
						$image = imagecreatefromjpeg($images["tmp_name"][$i]);
				  	} 
				  	elseif($imageSize["mime"] == "image/gif") {
						$image = imagecreatefromgif($images["tmp_name"][$i]);
				  	} 
				  	elseif($imageSize["mime"] == "image/png") {
						$image = imagecreatefrompng($images["tmp_name"][$i]);
				  	}
				  	
				  	if(!is_dir($dirname)) {
				  		mkdir($dirname, 0777);
				  		mkdir($dirname."/screenshot", 0777);
				  	}
					imagejpeg($image, $dirname.'/screenshot/'.$name);
					imagedestroy($image);

					$sql = 'INSERT INTO `images` (`name`) VALUES ("'.$name.'")';
					$sqlres = BD::$mysqli->query ($sql) or die(BD::$mysqli->error);
					$imageID = BD::$mysqli->insert_id;

					$sql = 'INSERT INTO `product_image` (`product_id`, `image_id`) VALUES ("'.$id.'", "'.$imageID .'")';
					$sqlres = BD::$mysqli->query ($sql) or die(BD::$mysqli->error);
				}
			}
			
			if ($oss != NULL) {

				if ($downloadAndroid != NULL) {

				  	if(!is_dir($dirname)) {
				  		mkdir($dirname, 0777);
				  	}
				  	mkdir($dirname."/download", 0777);
					move_uploaded_file($downloadAndroid["tmp_name"], $dirname."/download/".$downloadAndroid["name"]);

					for ($i=0; $i < count($oss); $i++) { 
						if ($oss[$i] == 'android') {
							$sql = 'SELECT `id` FROM `os` WHERE `name`="android"';
							$sqlres = BD::$mysqli->query ($sql) or die(BD::$mysqli->error);
							if ($result = $sqlres->fetch_array(MYSQLI_ASSOC)) {
								$sql1 = 'INSERT INTO `product_supported` (`product_id`, `os_id`, `link`) VALUES ("'.$id.'", "'.$result['id'].'", "'.$downloadAndroid["name"].'")';
								$sqlres1 = BD::$mysqli->query ($sql1) or die(BD::$mysqli->error);
							}
						}
					}
				}
				if ($downloadLinux != NULL) {
				  	if(!is_dir($dirname)) {
				  		mkdir($dirname, 0777);
				  	}
				  	mkdir($dirname."/download", 0777);
					move_uploaded_file($downloadLinux["tmp_name"], $dirname."/download/".$downloadLinux["name"]);

					for ($i=0; $i < count($oss); $i++) { 
						if ($oss[$i] == 'linux') {
							$sql = 'SELECT `id` FROM `os` WHERE `name`="linux"';
							$sqlres = BD::$mysqli->query ($sql) or die(BD::$mysqli->error);
							if ($result = $sqlres->fetch_array(MYSQLI_ASSOC)) {
								$sql1 = 'INSERT INTO `product_supported` (`product_id`, `os_id`, `link`) VALUES ("'.$id.'", "'.$result['id'].'", "'.$downloadLinux["name"].'")';
								$sqlres1 = BD::$mysqli->query ($sql1) or die(BD::$mysqli->error);
							}
						}
					}

				}
			}
		}
	}
}
