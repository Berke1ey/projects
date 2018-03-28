<?php
ini_set("display_errors", "on");
error_reporting(E_ALL);

if(!class_exists('BD')) {
	include('bd.php');
}
if(!class_exists('NewsInfo')) {
	include('newsInfo.php');
}
if(!class_exists('Image')) {
	include('image.php');
}

class News extends BD {

	static $news;

	public function get($id) {
		$id = BD::$mysqli->real_escape_string($id);
		$sql = 'SELECT * FROM `news` WHERE `id`="'.$id.'" AND `deleted`=0';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		while ($result = $sqlres->fetch_array(MYSQLI_ASSOC)) {

			$sql1 = 'SELECT * 
			FROM `news_image`
			LEFT JOIN `images` ON `news_image`.`image_id` = `images`.`id`
		 	WHERE `news_image`.`news_id`="'.$result['id'].'"';
		 	$sqlres1 = BD::$mysqli->query ($sql1) or die($sql1);
		 	while ($result1 = $sqlres1->fetch_array(MYSQLI_ASSOC)) {
		 		$result['image']= 'data/news/'.$result['name'].'/'.$result1['name'];

		 	}
			News::$news = $result;
			$info = new NewsInfo();
			return $info;
		}

	}

	public function search($request) {
		$request = BD::$mysqli->real_escape_string($request);
		$res = [];

		$sql = "SELECT `id` FROM `news` WHERE `name` LIKE '%".$request."%' AND `deleted`=0  ORDER BY `id` DESC";
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		while ($result = $sqlres->fetch_array(MYSQLI_ASSOC)) {
			$res[] = $result['id'];
		}
		return $res;
	}

	public function delete($id) {
		$id = BD::$mysqli->real_escape_string($id);
		$sql = 'UPDATE `news` SET `deleted`=1 WHERE `id`="'.$id.'"';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
	}

	public function getCount() {
		$count = 0; 

		$sql = 'SELECT COUNT(*) FROM `news` WHERE `deleted`=0';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		if ($result = $sqlres->fetch_array(MYSQLI_NUM)) {
			$count = $result[0];
		}
		return $count;
	}

	public function hasNews($title) {
		$title = BD::$mysqli->real_escape_string($title);
		$sql = 'SELECT COUNT(*) FROM `news` WHERE `name`="'.$title.'" AND `deleted`=0';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		if ($result = $sqlres->fetch_array(MYSQLI_NUM)) {
			if ($result[0] > 0) {
				return true;
			}
		}
		return false;
	}

	public function publishedIDs() {
		$ids = [];
		$sql = 'SELECT `id` FROM `news` WHERE `deleted`=0 ORDER BY `id` DESC';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		while ($result = $sqlres->fetch_array(MYSQLI_NUM)) {
			$ids[] = $result[0];
		}
		return $ids;
	}

	public function edit($id, $title, $desc, $image, $oldImageName) {
		$title = BD::$mysqli->real_escape_string($title);
		$desc = BD::$mysqli->real_escape_string($desc);
		$id = BD::$mysqli->real_escape_string($id);

		$sql = 'UPDATE `news` SET `name`="'.$title.'", `desc`="'.$desc.'" WHERE `id`="'.$id.'"';
		$sqlres = BD::$mysqli->query ($sql) or die(BD::$mysqli->error);

	  	$newDIRname = __DIR__.'/../data/news/'.$title;
	  	if(!is_dir($newDIRname)) {
	  		mkdir($newDIRname, 0777);
	  		copy(__DIR__."/../".$oldImageName, $newDIRname."/".explode("/", $oldImageName)[3]);
	  	}

		if ($image["name"] !== "") {
			$img = new Image();
			$name = $img->setImageName();
			$imageSize = getimagesize($image["tmp_name"]);

		   	if($imageSize["mime"] == "image/jpeg") {
				$image = imagecreatefromjpeg($image["tmp_name"]);
		  	} 
		  	elseif($imageSize["mime"] == "image/gif") {
				$image = imagecreatefromgif($image["tmp_name"]);
		  	} 
		  	elseif($imageSize["mime"] == "image/png") {
				$image = imagecreatefrompng($image["tmp_name"]);
		  	}

			imagejpeg($image, $newDIRname.'/'.$name);
			imagedestroy($image);

			$imageID = $img->getImageID(explode("/", $oldImageName)[3]);

			$sql = 'UPDATE `images` SET `name`="'.$name.'" WHERE `id`="'.$imageID.'"';
			$sqlres = BD::$mysqli->query ($sql) or die(BD::$mysqli->error);
		}
	}

	public function send($title, $desc, $image) {
		$title = BD::$mysqli->real_escape_string($title);
		$desc = BD::$mysqli->real_escape_string($desc);
		$img = new Image();
		$name = $img->setImageName();
		$res = false;

		if (!$this->hasNews($title)) {
			$imageSize = getimagesize($image["tmp_name"]);

		   	if($imageSize["mime"] == "image/jpeg") {
				$image = imagecreatefromjpeg($image["tmp_name"]);
		  	} 
		  	elseif($imageSize["mime"] == "image/gif") {
				$image = imagecreatefromgif($image["tmp_name"]);
		  	} 
		  	elseif($imageSize["mime"] == "image/png") {
				$image = imagecreatefrompng($image["tmp_name"]);
		  	}
		  	$newDIRname = __DIR__.'/../data/news/'.$title;
		  	if(!is_dir($newDIRname)) {
		  		mkdir($newDIRname, 0777);
		  	}
			imagejpeg($image, $newDIRname.'/'.$name);
			imagedestroy($image);


			$sql = 'INSERT INTO `news` (`name`, `desc`, `date`) VALUES ("'.$title.'", "'.$desc.'", UNIX_TIMESTAMP())';
			$sqlres = BD::$mysqli->query ($sql) or die(BD::$mysqli->error);
			$id = BD::$mysqli->insert_id;

			$sql = 'INSERT INTO `images` (`name`) VALUES ("'.$name.'")';
			$sqlres = BD::$mysqli->query ($sql) or die(BD::$mysqli->error);
			$imageID = BD::$mysqli->insert_id;

			$sql = 'INSERT INTO `news_image` (`news_id`, `image_id`) VALUES ("'.$id.'", "'.$imageID .'")';
			$sqlres = BD::$mysqli->query ($sql) or die(BD::$mysqli->error);
			$res = true;
		}
		return $res;
	}
}