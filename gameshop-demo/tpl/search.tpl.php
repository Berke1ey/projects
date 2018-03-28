<?php 
$productResult = $product->search($matches[2]);
$newsResult = $news->search($matches[2]);
 ?>
<div class="landing">
	<div class="content">
		<h1>Search</h1>
		<div>
			<?php
			 if ((count($productResult) == 0) and (count($newsResult) == 0)):
			 ?>
				Nothing found
			<?php
			 else:
			 ?>
				Found <?=count($productResult)+count($newsResult)?> results
			<?php
			endif;
			?>
		</div>
	</div>
</div>
<?php
 if (count($productResult) > 0):
 ?>
<div class="landing">
	<div class="content">
		<h1>Download</h1>
		<?php
		for ($i = 0; $i < count($productResult); $i++) {
			$id = $productResult[$i];
			$p = $product->get($id);
			$images = $p->getImages();
 			include('_downloadlist.tpl.php');
 		}
 		?>
 	</div>
 </div>
 <?php
 endif;
 if (count($newsResult) > 0):
 ?>
<div class="landing">
	<div class="content">
		<h1>News</h1>
		<?php
		for ($i = 0; $i < count($newsResult); $i++) {
			$id = $newsResult[$i];
			$n = $news->get($id);
			include('_newsShort.tpl.php');
 		}
 		?>
 	</div>
 </div>
 <?php
 endif;