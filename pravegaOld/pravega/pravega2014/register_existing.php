<?php
	include('db_config.php');
	session_start();

	$errors = 0; //no errors initially

	$email = $_POST['email'];
	$returning = $_POST['returning'];
	$emergency_contact = $_POST['emergency_contact'];
	$num_bands = $_POST['num_bands'];
	
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	
	if ($returning == 0)
	{
		$query = "SELECT mobile, city, gender, college FROM usernames WHERE email=?";
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $mobile, $city, $gender, $college);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_reset($stmt);
	}
	
	else
	{
		$mobile = $_POST['mobile'];
		$city = $_POST['city'];
		$gender = $_POST['gender'];
		$college = $_POST['college'];
	}
	
	//ERROR HANDLING
	//CHECK EMPTY FIELDS
	
	if ($mobile == "" || $city == "" || $gender == "" || $college == "")
	{
		$errors = 1;
		$_SESSION['return'] = $returning + 1;
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

		$query = "UPDATE usernames SET mobile=?, city=?, college=?, gender=?, paid=1, emergency_contact=?, num_bands=? WHERE email=? LIMIT 1";
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "sssssis", $mobile, $city, fix_case($college), $gender, $emergency_contact, $num_bands, $email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_reset($stmt);
		
		$query = "SELECT firstname, lastname, college FROM usernames WHERE email=? LIMIT 1";
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $firstname, $lastname, $college);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_reset($stmt);
			
		//TO UPPER CASE
			
		mysqli_close($link);
		$_SESSION['success'] = 1;
		$_SESSION['email'] = $email;
		$_SESSION['name'] = fix_case($firstname) . " ". fix_case($lastname);
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