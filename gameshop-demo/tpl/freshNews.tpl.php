<div class="content">
	<h1>News</h1>
	<?php
	$published = $news->publishedIDs();
	if (count($published) > $freshNewsCount):
		for ($i = 0; $i < $freshNewsCount; $i++):
			$id = $published[$i];
			$n = $news->get($id);
			include('_newsShort.tpl.php');
		endfor;
	else:
		for ($i = 0; $i < count($published); $i++):
			$id = $published[$i];
			$n = $news->get($id);
			include('_newsShort.tpl.php');
		endfor;
	endif;
	?>
</div>