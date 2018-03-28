<?php
$p = $product->getNew();
var_dump($p->getID());
?>
<script>
$(document).ready(function() {	
	carousel.load(<?=json_encode($p->getImages())?>);
})
</script>
<div class="content">
	<h1>New game</h1>
	<div class="carousel" id="carousel">
		<div class="big" id="big">
		    <ul>
		    </ul>
		</div>
		<div class="prev" id="prev">
			<ul>
			</ul>
		</div>
	</div>
	<div class="desc">
		<div class="shortDesc">
			<span class="productTitle">
				<?=$p->getName()?>
			</span>
			<span class="supported">
				<?php 
				$ossName = $p->getOSsName();
				if ($ossName != NULL):
					for ($i = 0; $i < count($ossName); $i++):
					?>
						<img src="style/<?=$ossName[$i]?>.svg" title="<?=$ossName[$i]?>">
					<?php
					endfor;
				endif;
				?>
			</span>
			<a href="<?=$p->getLink($_SERVER['HTTP_USER_AGENT'])?>" class="btn">Download</a>
		</div>
		<div class="fullDesc">
			<?=$p->getDesc()?>
		</div>
		<a href="download/<?=$p->getID()?>" class="link">read more</a>
	</div>
</div>