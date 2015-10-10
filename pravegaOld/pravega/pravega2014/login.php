<?php
	require 'php/PasswordHash.php';

	$hash_cost_log2 = 8;
	$hash_portable = FALSE;
	$hasher = new PasswordHash($hash_cost_log2, $hash_portable);

	$debug = TRUE;

	include('db_config.php');

	function get_post_var($var)
	{
		$val = $_POST[$var];
		if (get_magic_quotes_gpc())
			$val = stripslashes($val);
		return $val;
	}

	$email = get_post_var('email');
	$password = get_post_var('password');

	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') '
				. mysqli_connect_error());
	}

	$query = "SELECT firstname, lastname FROM usernames WHERE email=?";
	$query_check = "SELECT password FROM usernames WHERE email=?";

	$stmt2 = mysqli_prepare($link, $query);
	mysqli_stmt_bind_param($stmt2, "s", $email);
	mysqli_stmt_execute($stmt2);
	mysqli_stmt_bind_result($stmt2, $first, $last);
	mysqli_stmt_fetch($stmt2);
	mysqli_stmt_reset($stmt2);
	

	$actual_hash = '*'; // In case the user is not found
	$stmt1 = mysqli_prepare($link, $query_check);
	mysqli_stmt_bind_param($stmt1, "s", $email);
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_bind_result($stmt1, $actual_hash);
	mysqli_stmt_fetch($stmt1);


	if ($hasher->CheckPassword($password, $actual_hash)) {
		$what = 1;
	} else {
		$what = 0;
	}

	mysqli_close($link);

	if ($what == 1)
	{
		$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
		
		$id = uniqid();
		$expiry = time() + 3600;
		
		mysqli_query($link, "DELETE FROM sessions WHERE email = '". $email."'");
		
		$query_add_session = "INSERT INTO sessions (email, hash, expiry) VALUES (?, ?, ?)";
		$stmt42 = mysqli_prepare($link, $query_add_session);
		mysqli_stmt_bind_param($stmt42, "ssi", $email, $id, $expiry);
		mysqli_stmt_execute($stmt42);
		
		
		setcookie("email", $email, $expiry);
		setcookie("name", $first ." ".$last, $expiry);
		setcookie("hash", $id, $expiry);
		
		mysqli_close($link);
		
		session_start();
		$_SESSION['error'] = 0;
		$_SESSION['login'] = 1;
		
		if ($_SERVER['HTTP_REFERER'] == "http://pravega.org/login_form.php" && ($_POST['referer'] == "" || $_POST['referer'] == "http://pravega.org/login_form.php"))
			header("Location: index.php");
		else if ($_SERVER['HTTP_REFERER'] == "http://pravega.org/login_form.php" && $_POST['referer'] != "")
			header("Location: ". $_POST['referer']);
		else header("Location: ".$_SERVER['HTTP_REFERER']);
	}

	else
	{
		session_start();
		$_SESSION['error'] = 1; 
		$_SESSION['email'] = $email;

		header("Location: login_form.php");
	}

?>