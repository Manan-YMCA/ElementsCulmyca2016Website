<?php
	session_start();

	$errors = 0; //no errors initially

	function fail($pub, $pvt = '')
	{
		global $debug;
		$msg = $pub;
		if ($debug && $pvt !== '')
			$msg .= ": $pvt";
	/* The $pvt debugging messages may contain characters that would need to be
	 * quoted if we were producing HTML output, like we would be in a real app,
	 * but we're using text/plain here.  Also, $debug is meant to be disabled on
	 * a "production install" to avoid leaking server setup details. */
		exit("An error occurred ($msg).\n");
	}

	include('db_config.php');

	function get_post_var($var) //safe post data collection
	{
		$val = $_POST[$var];
		if (get_magic_quotes_gpc())
			$val = stripslashes($val);
		return $val;
	}

	$email = get_post_var('email');
	$city = get_post_var('city');
	$codechef = get_post_var('codechef');
	$mobile = get_post_var('mobile');
	$college = get_post_var('college');
	$gender = get_post_var('gender');
	
	if ($_POST['accommodation'] == "on")
		$accommodation = 1;
	else $accommodation = 0;
	
	//ERROR HANDLING
	if (strlen($mobile) != 10)
	{
		$errors = 1;
		$_SESSION['errors_mobile'] = 1;
	}
		
	if ($city == "")
	{
		$errors = 1;
		$_SESSION['errors_city'] = 1;
	}
	
	if ($college == "")
	{
		$errors = 1;
		$_SESSION['errors_college'] = 1;
	}
	
	if ($gender == "")
	{
		$errors = 1;
		$_SESSION['errors_gender'] = 1;
	}
	
	//END ERROR HANDLING
	
	if ($errors)
	{
		$_SESSION['errors'] = 1;
		$_SESSION['city'] = $city;
		$_SESSION['codechef'] = $codechef;
		$_SESSION['mobile'] = $mobile;
		$_SESSION['college'] = $college;
		$_SESSION['gender'] = $gender;
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	
	else
	{		
		$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

		if (!$link) {
			die('Connect Error (' . mysqli_connect_errno() . ') '
					. mysqli_connect_error());
		}

		$query = "UPDATE usernames SET city=?, codechef=?, mobile=?, college=?, gender=?, accommodation=? WHERE email=? LIMIT 1";
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "sssssis", $city, $codechef, $mobile, $college, $gender, $accommodation, $email);
		mysqli_stmt_execute($stmt);
		
		mysqli_close($link);
		$_SESSION['success'] = 1;
		header("Location: profile");
	}
?>