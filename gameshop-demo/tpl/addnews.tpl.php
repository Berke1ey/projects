<div class="form">
	<div class="content">
		<h1>Add News</h1>
		<?php
		if (isset($_GET['fail']) and ($_GET['fail'] == true)):
		?>
			<div class="notice">
				Fail
			</div>
		<?php
		endif;
		?>
		<div class="enterForm">
			<form method="post" action="/thecaracca1/core/api.php" enctype="multipart/form-data">
				<input type="text" name="title" placeholder="title" required="">
				<textarea name="desc" placeholder="desc" required=""></textarea>
				<input type="file" name="image" required="">
				<input type="hidden" name="action" value="addnews">
				<input type="submit" value="send">
			</form>
		</div>
	</div>
</div>