<div class="form">
	<div class="content">
		<h1>Add Product</h1>
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
				<select name="genre" required="">
					<option value="">Select genre</option>
					<option value="Arcade">Arcade</option>
					<option value="RPG">RPG</option>
					<option value="Action">Action</option>
					<option value="RTS">RTS</option>
				</select>
				<select name="multiplayer" required="">
					<option value="">Has multiplayer?</option>
					<option value="0">no</option>
					<option value="1">yes</option>
				</select>
				<select name="graphicstype" required="">
					<option value="">Select graphics type</option>
					<option value="2D">2D</option>
					<option value="3D">3D</option>
					<option value="pseudo 3D">pseudo 3D</option>
				</select>
				<input type="text" name="engine" placeholder="engine" required="">
				<select name="modding" required="">
					<option value="">Is modding-friendly?</option>
					<option value="0">no</option>
					<option value="1">yes</option>
				</select>
				<select name="license" required="">
					<option value="">Select license</option>
					<option value="EULA">EULA</option>
					<option value="GPL">GPL</option>
				</select>
				<input type="text" name="version" placeholder="version" required="">
				<ul>
					<li>
						<label onclick="osSelected(this)"><input type="checkbox" name="oss[]" value="android"> Android</label>
						<input type="file" name="download-android" class="app">
					</li>
					<li>
						<label onclick="osSelected(this)"><input type="checkbox" name="oss[]" value="linux"> Linux</label>
						<input type="file" name="download-linux"  class="app">
					</li>
				</ul>
				<input type="file" name="images[]" required="" multiple="true">
				<input type="hidden" name="action" value="addproduct">
				<input type="submit" value="send">
			</form>
		</div>
	</div>
</div>