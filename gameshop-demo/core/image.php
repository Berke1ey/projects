<?php
if(!class_exists('BD')) {
	include('bd.php');
}

class Image {
	function setImageName() {
	    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	    $res = '';
	    $len = mt_rand(6, 12);
	    for ($i = 0; $i < $len; $i++) {
	        $res .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	    }

	    $res .= $res.time().image_type_to_extension(IMAGETYPE_JPEG);
	    return $res;	
	}

	function getImageID($name) {
		$name = BD::$mysqli->real_escape_string($name);

		$sql = 'SELECT `id` FROM `images` WHERE `name`="'.$name.'"';
		$sqlres = BD::$mysqli->query ($sql) or die($sql);
		if ($result = $sqlres->fetch_array(MYSQLI_ASSOC)) {
			return $result['id'];
		}
	}
}
?>