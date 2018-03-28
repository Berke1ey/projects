<?php
if (isset($_GET['id'])):
	$id = $_GET['id'];
	$n = $news->get($id)
?>
<div class="form">
	<div class="content">
		<h2>Edit</h2>
		<div class="enterForm">
			<form method="post" action="/thecaracca1/core/api.php" enctype="multipart/form-data">
				<input type="text" name="title" value="<?=$n->getName()?>">
				<textarea name="desc"><?=$n->getDesc()?></textarea>
				<div class="editnewsImg">
					<img src="/thecaracca1/<?=$n->getImage()?>">
				</div>
				<input type="file" name="image">
				<input type="hidden" name="id" value="<?=$id?>">
				<input type="hidden" name="oldImageName" value="<?=$n->getImage()?>">
				<input type="hidden" name="action" value="editNews">
				<input type="submit" value="edit">
			</form>
		</div>
	</div>
</div>
<?php
else:
?>
<div class="warning">
	<h2>Nothing to edit</h2>
</div>
<?php
endif;
?>