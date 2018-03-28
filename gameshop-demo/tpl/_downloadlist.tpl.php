<div class="product">
	<div class="short">
		<div class="productImage">
			<div class="shortBigImage_1">
				<img src="<?=$images[0]?>">
			</div>
			<div class="shortSmallImage_1">
				<ul>
				<?php
				for ($l = 0; $l < count($images); $l++):
				?>
					<li><img src="<?=$images[$l]?>"></li>
				<?php
				endfor;
				?>
				</ul>
			</div>
		</div>
		<div class="shortDescription">
			<span class="shortproductTitle">
				<?=$p->getName()?>
			</span>
			<span class="shortsupported">
				<?php 
				$ossName = $p->getOSsName();

				for ($l = 0; $l < count($ossName); $l++):
				?>
					<img src="/thecaracca1/style/<?=$ossName[$l]?>.svg" title="<?=$ossName[$l]?>">
				<?php
				endfor;
				?>
			</span>
			<div class="fullDesc">
				<?=$p->getDesc()?>
			</div>
			<a href="/thecaracca1/download/<?=$p->getID()?>" class="link">read more</a>
		</div>
	</div>
	<?php
	if (isset($_COOKIE['cookie'])):
		$responsibilities = $user->get($_COOKIE['cookie'])->getResponsibilities();
		if ($responsibilities == 'admin'):
		?>
		<div class="edit">
			<ul>
				<li><a class="lnk" href="/thecaracca1/editProduct/?id=<?=$id?>">Edit</a></li>
				<li><a class="lnk" href="/thecaracca1/deleteProduct/?id=<?=$id?>">Delete</a></li>
			</ul>
		</div>
		<?php 
		endif;
	endif;
 	?>
</div>