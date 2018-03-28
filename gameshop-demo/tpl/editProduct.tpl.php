<?php
if (isset($_GET['id'])):
	$id = $_GET['id'];
	$p = $product->get($id);
	$ossName = $p->getOSsName();
?>
<div class="form">
	<div class="content">
		<h2>Edit</h2>
		<div class="enterForm">
			<form method="post" action="/thecaracca1/core/api.php" enctype="multipart/form-data">
				<input type="text" name="title" value="<?=$p->getName()?>">
				<textarea name="desc"><?=$p->getDesc()?></textarea>

				<select name="genre">
				  <option value="" <?=($p->getGenre() == "") ? 'selected' : ''?>>Select genre</option>
				  <option value="arcade" <?=($p->getGenre() == "arcade") ? 'selected' : ''?>>Arcade</option>
				  <option value="RTS" <?=($p->getGenre() == "RTS") ? 'selected' : ''?>>RTS</option>
				  <option value="MMO" <?=($p->getGenre() == "MMO") ? 'selected' : ''?>>RPG</option>
				  <option value="platformer" <?=($p->getGenre() == "Platformer") ? 'selected' : ''?>>Platformer</option>
				  <option value="action" <?=($p->getGenre() == "action") ? 'selected' : ''?>>Action</option>
				</select>

				<select name="multiplayer">
					<option value="" <?=($p->hasMultiplayer() == "") ? 'selected' : ''?>>Has multiplayer?</option>
				  	<option value="0" <?=($p->hasMultiplayer() == "no") ? 'selected' : ''?>>No</option>
				  	<option value="1" <?=($p->hasMultiplayer() == "yes") ? 'selected' : ''?>>Yes</option>
				</select>

				<select name="graphics">
					<option value="" <?=($p->getGraphicsType() == "") ? 'selected' : ''?>>Select graphics type</option>
				  	<option value="2D" <?=($p->getGraphicsType() == "2D") ? 'selected' : ''?>>2D</option>
				  	<option value="3D" <?=($p->getGraphicsType() == "3D") ? 'selected' : ''?>>3D</option>
				  	<option value="pseudo 3D" <?=($p->getGraphicsType() == "pseudo 3D") ? 'selected' : ''?>>pseudo 3D</option>
				</select>

				<input type="text" name="engine" value="<?=$p->getEngineName()?>" placeholder="Engine">

				<select name="modding">
					<option value="" <?=($p->isModdingFriendly() == "") ? 'selected' : ''?>>Is modding friendly?</option>
				  	<option value="0" <?=($p->isModdingFriendly() == "no") ? 'selected' : ''?>>No</option>
				  	<option value="1" <?=($p->isModdingFriendly() == "yes") ? 'selected' : ''?>>Yes</option>
				</select>

				<select name="license">
					<option value="" <?=($p->getLicense() == "") ? 'selected' : ''?>>Select license</option>
				  	<option value="EULA" <?=($p->getLicense() == "EULA") ? 'selected' : ''?>>EULA</option>
				  	<option value="GPL" <?=($p->getLicense() == "GPL") ? 'selected' : ''?>>GPL</option>
				</select>

				<input type="text" name="version" value="<?=$p->getVersion()?>" placeholder="Version">

				<ul>
					<?php
					if ($ossName != NULL):
					?>
					<li>
						<label onclick="osSelected(this)"><input type="checkbox" name="os[]" value="android" <?=($ossName[0] == "android") ? 'checked' : ''?>> Android</label>
						<input type="file" name="androidapp" class="app">
					</li>
					<li>
						<label onclick="osSelected(this)"><input type="checkbox" name="os[]" value="linux" <?=($ossName[1] == "linux") ? 'checked' : ''?>> Linux</label>
						<input type="file" name="linuxapp" class="app">
					</li>
					<?php
					else:
					?>
					<li>
						<label onclick="osSelected(this)"><input type="checkbox" name="os[]" value="android"> Android</label>
						<input type="file" name="androidapp" class="app">
					</li>
					<li>
						<label onclick="osSelected(this)"><input type="checkbox" name="os[]" value="linux"> Linux</label>
						<input type="file" name="linuxapp" class="app">
					</li>
					<?php
					endif;
					?>
				</ul>

				<?php
				$images = $p->getImages();
				for ($l = 0; $l < count($images); $l++):
				?>
					<div class="editproductImg">
						<img src="<?=$images[$l]?>">
					</div>
					<input type="hidden" name="oldImageName[]" value="<?=$images[$l]?>">
				<?php
				endfor;
				$linksName = $p->getLinksName();
				if ($linksName != NULL):
					for ($l = 0; $l < count($linksName); $l++):
					?>
						<input type="hidden" name="linksName[]" value="<?=$linksName[$l]?>">
					<?php
					endfor;
				endif;
				?>

				<input type="file" name="images[]" multiple="true">
				<input type="hidden" name="id" value="<?=$id?>">
				<input type="hidden" name="action" value="editProduct">
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