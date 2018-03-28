<?php 
if (isset($_COOKIE['cookie'])):
	$responsibilities = $user->get($_COOKIE['cookie'])->getResponsibilities();
	if ($responsibilities == 'admin'):
	?>
	<div class="landing">
		<div class="content">
			<a class="link" href="/thecaracca1/addproduct/">Add product</a>
		</div>
	</div>	
	<?php
	endif;
endif;
?>
<div class="landing">
	<div class="content">
		<h1>Download</h1>
		<?php
		$published = $product->publishedIDs();
		for ($i = 0; $i < count($published); $i++) {
			$id = $published[$i];
			$p = $product->get($id);
			$images = $p->getImages();
			include('_downloadlist.tpl.php');
		}
		?>
	</div>
</div>