<?php 
if (isset($_COOKIE['cookie'])):
	$responsibilities = $user->get($_COOKIE['cookie'])->getResponsibilities();
	if ($responsibilities == 'admin'):
	?>
	<div class="landing">
		<div class="content">
			<a class="link" href="/thecaracca1/addnews/">Add news</a>
		</div>
	</div>	
	<?php
	endif;
endif;
?>
<div class="landing">
	<div class="content">
		<h1>News</h1>
		<?php
		$published = $news->publishedIDs();
		for ($i = 0; $i < count($published); $i++):
			$id = $published[$i];
			$n = $news->get($id);
			include('_newsShort.tpl.php');
		endfor;
		?>
	</div>
</div>