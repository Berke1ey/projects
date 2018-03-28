<?php include('tpl/header.tpl.php');?>
<?php
if (isset($_COOKIE['cookie']))
	$responsibilities = $user->get($_COOKIE['cookie'])->getResponsibilities();
if ($responsibilities == 'admin'):
	include('tpl/editProduct.tpl.php');
else:
	include('tpl/norights.tpl.php');
endif;
?>
<?php include('tpl/footer.tpl.php');?>