<?php
if (!isset($_COOKIE['cookie'])):
?>
	<div class="form">
		<div class="content">
			<h1>Enter</h1>
			<?php
			if (isset($_GET['fail']) and ($_GET['fail'] == true)):
			?>
				<div class="notice">
					Wrong e-mail or password!
				</div>
			<?php
			endif;
			?>
			<div class="enterForm">
				<form method="post" action="/thecaracca1/core/api.php">
					<input type="text" name="login" placeholder="e-mail" required="">
					<input type="password" name="password" placeholder="password" required="">
					<input type="hidden" name="action" value="enter">
					<input type="submit" value="log in">
				</form>
			</div>
		</div>
	</div>
<?php
else:
?>
<div class="warning">
	<h2>You already entered</h2>
</div>
<?php
endif;
?>