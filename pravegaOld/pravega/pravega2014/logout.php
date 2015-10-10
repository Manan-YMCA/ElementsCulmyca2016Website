<?php
	include('db_config.php');
	
	$expiry = time() - 3600;
	
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	mysqli_query($link, "DELETE FROM sessions WHERE email = '". $_COOKIE['email']."'");
	
	setcookie("email", "", $expiry);
	setcookie("name", "", $expiry);
	setcookie("hash", "", $expiry);
	
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>