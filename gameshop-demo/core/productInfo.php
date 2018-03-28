<?php
if(!class_exists('Product')) {
	include('product.php');
}


Class ProductInfo extends BD { 
	public function getName() {
		return Product::$product['name'];
	}

	public function getDesc() {
		return Product::$product['desc'];
	}

	public function getID() {
		return Product::$product['id'];
	}

	public function getImages() {
		return Product::$product['images'];
	}

	public function getOSsName() {
		if (isset(Product::$product['oss_name'])) {
			return Product::$product['oss_name'];
		}
	}

	public function getGenre() {
		return Product::$product['genre'];
	}

	public function hasMultiplayer() {
		return (Product::$product['multiplayer'] == 1) ? $bool = "yes": $bool = "no";
	}

	public function getGraphicsType() {
		return Product::$product['graphics_type'];
	}

	public function getEngineName() {
		return Product::$product['engine'];
	}

	public function isModdingFriendly() {
		return (Product::$product['modding_friendly'] == 1) ? $bool = "yes": $bool = "no";
	}

	public function getLicense() {
		return Product::$product['license'];
	}

	public function getVersion() {
		return Product::$product['version'];
	}

	public function getLinksName() {
		if (isset(Product::$product['links_name'])) {
			return Product::$product['links_name'];
		}
	}

	public function getLink($userAgent) {
		$osName;
		$link = 'data/product/'.$this->getName().'/download/';

   		$osArray = [
	        '/windows nt 10/i'     =>  'windows',
	        '/windows nt 6.3/i'     =>  'windows',
	        '/windows nt 6.2/i'     =>  'windows',
	        '/windows nt 6.1/i'     =>  'windows',
	        '/linux/i'              =>  'linux',
	        '/ubuntu/i'             =>  'linux',
	        '/android/i'            =>  'android'
        ];

	    foreach ($osArray as $regex => $value) { 
	        if (preg_match($regex, $userAgent)) {
	            $osName  = $value;
	        }
	    } 

		$osName = BD::$mysqli->real_escape_string($osName);

	    $sql = 'SELECT `link` FROM `product_supported`
	    LEFT JOIN `os` ON `product_supported`.`os_id`= `os`.`id`
	    WHERE `product_id`="'.$this->getID().'" AND  `os`.`name`="'.$osName.'"';
	    $sqlres = BD::$mysqli->query ($sql) or die($sql);
	    if ($result = $sqlres->fetch_array(MYSQLI_ASSOC)) {
	    	$link .= $result['link'];
	    }
	    return $link;
	}
}