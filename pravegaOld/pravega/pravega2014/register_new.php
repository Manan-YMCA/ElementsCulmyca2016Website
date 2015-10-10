<?php
	session_start();
	include('db_config.php');
	
	$errors = 0; //no errors initially

	$email = $_POST['email'];
	$first_name = fix_case($_POST['first']);
	$last_name = fix_case($_POST['last']);
	$city = $_POST['city'];
	$mobile = $_POST['mobile'];
	$college = fix_case($_POST['college']);
	$gender = $_POST['gender'];
	$emergency_contact = $_POST['emergency_contact'];
	$num_bands = $_POST['num_bands'];
	
	$num_rows = 0;
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	$query = "SELECT email FROM usernames WHERE email=?";
	$stmt = mysqli_prepare($link, $query);
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $result);
	
	while (mysqli_stmt_fetch($stmt)) {
        $num_rows++;
    }
	mysqli_stmt_reset($stmt);
	
	//ERROR HANDLING
	
	if ($num_rows > 0)
    {
		$errors = 1;
		$_SESSION['errors_email_coll'] = 1;
	}
	
	if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i', $email))
	{
		$errors = 1;
		$_SESSION['errors_email'] = 1;
	}
	
	if (strlen($mobile) != 10)
	{
		$errors = 1;
		$_SESSION['errors_mobile'] = 1;
	}
	
	if (strlen($emergency_contact) != 10)
	{
		$errors = 1;
		$_SESSION['errors_emergency_contact'] = 1;
	}
	
	if (!strcmp($emergency_contact, $mobile))
	{
		$errors = 1;
		$_SESSION['errors_emergency_contact'] = 1;
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
		$_SESSION['email'] = $email;
		$_SESSION['first_name'] = $first_name;
		$_SESSION['last_name'] = $last_name;
		$_SESSION['city'] = $city;
		$_SESSION['mobile'] = $mobile;
		$_SESSION['emergency_contact'] = $emergency_contact;
		$_SESSION['college'] = $college;
		$_SESSION['gender'] = $gender;
		$_SESSION['num_bands'] = $num_bands;
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	
	else
	{		
		$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

		$query = "INSERT INTO usernames (firstname, lastname, email, city, mobile, college, gender, paid, emergency_contact, num_bands) VALUES (?, ?, ?, ?, ?, ?, ?, 1, ?, ?)";
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "ssssssssi", fix_case($first_name), fix_case($last_name), $email, $city, $mobile, fix_case($college), $gender, $emergency_contact, $num_bands);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_reset($stmt);
		mysqli_close($link);
		
		$_SESSION['email'] = $email;
		$_SESSION['success'] = 1;
		$_SESSION['name'] = fix_case($first_name) . " ". fix_case($last_name);
		$_SESSION['college'] = fix_case($college);
		
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}

	function fix_case($string)
	{	
		$words = explode(" ", $string);
		for ($i=0; $i < sizeof($words); $i++)
		{
			if ((strtolower($words[$i]) != "of" && strtolower($words[$i]) != "the")|| $i == 0)
			{
				$words[$i] = ucfirst($words[$i]);
			}
		}
		return implode(" ", $words);
	}
	
?>