<?php
if (isset($_GET['id'])):
?>
<div class="form">
	<div class="content">
		<h2>You sure?</h2>
		<div class="enterForm">
			<form method="post" action="/thecaracca1/core/api.php">
				<input type="hidden" name="id" value="<?=$_GET['id']?>">
				<input type="hidden" name="action" value="deleteProduct">
				<input type="submit" value="delete">
			</form>
		</div>
	</div>
</div>
<?php
else:
?>
<div class="warning">
	<h2>Nothing to delete</h2>
</div>
<?php
endif;
?>