<?php
$p = $product->get($id);
?>
<script>
$(document).ready(function() {	
	carousel.load(<?=json_encode($p->getImages())?>);
})
</script>
<div class="landing">
	<div class="content">
		<div class="product">
			<div class="short">
				<div class="firstBlock">
					<div class="carousel" id="carousel">
						<div class="shortBigImage" id="big">
						    <ul>
						    </ul>
						</div>
						<div class="shortSmallImage" id="prev">
							<ul>
							</ul>
						</div>
					</div>
					<div class="data">
						<h2>Description</h2>
						<div>
							<span>Genre:</span> <span class="val"><?=$p->getGenre()?></span>
						</div>
						<div>
							<span>Multiplayer:</span> <span class="val"><?=$p->hasMultiplayer()?></span>
						</div>
						<div>
							<span>Graphics:</span> <span class="val"><?=$p->getGraphicsType()?></span>
						</div>
						<div>
							<span>Engine:</span> <span class="val"><?=$p->getEngineName()?></span>
						</div>
						<div>
							<span>Modding friendly:</span> <span class="val"><?=$p->isModdingFriendly()?></span>
						</div>
						<div>
							<span>License:</span> <span class="val"><?=$p->getLicense()?></span>
						</div>
						<div>
							<span>Version:</span> <span class="val"><?=$p->getVersion()?></span>
						</div>
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
				</div>
				<div class="linkContainer">
					<a href="/thecaracca1/<?=$p->getLink($_SERVER['HTTP_USER_AGENT'])?>" class="btn">Download</a>
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
	</div>
</div>