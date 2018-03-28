<?php
$n = $news->get($id);
?>
<div class="landing">
	<div class="content">
		<div class="news">
			<div class="newsImg">
				<img src="/thecaracca1/<?=$n->getImage()?>">
			</div>
			<div class="newsDesc">
				<div class="shortNewsDesc">
					<span class="newsTitle"><?=$n->getName()?></span>
					<span class="newsDate"><?=$n->getDate()?></span>
				</div>
				<?=$n->getDesc()?>
			</div>
			<?php
			if (isset($_COOKIE['cookie'])):
				$responsibilities = $user->get($_COOKIE['cookie'])->getResponsibilities();
				if ($responsibilities == 'admin'):
				?>
				<div class="edit">
					<ul>
						<li><a class="lnk" href="/thecaracca1/editNews/?id=<?=$id?>">Edit</a></li>
						<li><a class="lnk" href="/thecaracca1/deleteNews/?id=<?=$id?>">Delete</a></li>
					</ul>
				</div>
				<?php 
				endif;
			endif;
		 	?>
		</div>
	</div>
</div>