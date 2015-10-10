<?php
	session_start();

	$errors = 0; //no errors initially

	include('db_config.php');
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') '
			. mysqli_connect_error());
	}
	
	function get_post_var($var) //safe post data collection
	{
		$val = $_POST[$var];
		if (get_magic_quotes_gpc())
			$val = stripslashes($val);
		return $val;
	}
	
	$fields = array_keys($_POST);
	//$event_name = mysqli_real_escape_string($link, get_post_var('event_name'));
	$event_name = get_post_var('event_name');
	
	$_SESSION['a'] = $event_name;
	
	$team_size = 0;
	for ($i=0; $i < sizeof($fields); $i++)
	{	
		if (substr_count($fields[$i], "email") && $_POST[$fields[$i]] != "")
		{		
			$team_size++;
		}
	}
	
	$emails;
	for ($i=0; $i < $team_size; $i++)
	{
		$text = 'email' . ($i+1);
		$emails[$i] = get_post_var($text);
	}
	
	//pre-error handling data
	
	$exist = array_fill(0, $team_size, 0);
	$activated = array_fill(0, $team_size, 0);
	$in_team = array_fill(0, $team_size, 0);
	$duplicate = array_fill(0, $team_size, 0);
	
	//checking duplicates
	for ($i = 0; $i < $team_size; $i++)
	{
		if ($duplicate[$i] == 0)
		{
			for ($j = $i+1; $j < $team_size; $j++)
			{
				if ($emails[$i] == $emails[$j])
				{
					$duplicate[$j] = 1;
				}
			}
		}
	}		
	
	//checking email existence
	for ($i = 0; $i < $team_size; $i++)
	{
		$query = "SELECT email FROM usernames WHERE email=?";
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "s", $emails[$i]);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $result);
		
		while (mysqli_stmt_fetch($stmt)) {
			$exist[$i]++;
		}
		mysqli_stmt_reset($stmt);
	}
	
	//checking activation
	for ($i = 0; $i < $team_size; $i++)
	{
		$query = "SELECT activated FROM usernames WHERE email=?";
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "s", $emails[$i]);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $result);
		mysqli_stmt_fetch($stmt);
		
		if ($result)
			$activated[$i] = 1;
			
		mysqli_stmt_reset($stmt);
	}
	
	//checking for already registered
	for ($i = 0; $i < $team_size; $i++)
	{
		$query = "SELECT `".$event_name."` FROM events WHERE email=?";
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "s", $emails[$i]);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $result);
		mysqli_stmt_fetch($stmt);
		
		if ($result)
			$in_team[$i] = 1;
		mysqli_stmt_reset($stmt);
	}
	
	//check exceeding capacity for Mobile Making
	
	
	if ($event_name == "Publish or Perish" || $event_name == "Apocalypse Now!" || $event_name ==  "Crypto")
	{
		$query = 'SELECT `'. $event_name. '` FROM `teams` WHERE `'. $event_name .'` != ""';
		$result = mysqli_query($link, $query);
		
		$num_participants = mysqli_num_rows($result);
		mysqli_free_result($result);
	
		if ($num_participants >= 100)
		{
			$errors = 1;
			$_SESSION['error_capacity'] = 1;
		}
	}
	

	
	
	//ERROR HANDLING
	
	for ($i = 0; $i < $team_size; $i++)
	{
		$text = $i+1;
		
		if ($duplicate[$i])
		{
			$errors = 1;
			$_SESSION['errors_email' . $text] = 1;
		}
		
		if (!$exist[$i])
		{
			$errors = 1;
			$_SESSION['errors_email' . $text] = 1;
		}
		
		if (!$activated[$i])
		{
			$errors = 1;
			$_SESSION['errors_activation' . $text] = 1;
		}
		
		if ($in_team[$i])
		{
			$errors = 1;
			$_SESSION['errors_in_team' . $text] = 1;
		}
	}

	
	// for ($i = 0; $i < sizeof($fields); $i++)
	// {
		// if ($_POST[$fields[$i]] == "")
		// {
			// $errors = 1;
			// $_SESSION['errors_extra_' . $fields[$i]] = 1;
		// }
	// }
	
	//END ERROR HANDLING
	
	if ($errors)
	{
		$_SESSION['errors'] = 1;
		
		for ($i = 0; $i < sizeof($fields); $i++)
		{
			$_SESSION[$fields[$i]] = $_POST[$fields[$i]];
		}
		
		mysqli_close($link);
		header("Location: ".$_SERVER['HTTP_REFERER']."#register");
	}
	
	else
	{	

		for ($i = 0; $i < $team_size; $i++)
		{
			mysqli_stmt_reset($stmt);
			
			$query = "UPDATE events SET `".$event_name."` = 1 WHERE email=?";
			$stmt = mysqli_prepare($link, $query);
			mysqli_stmt_bind_param($stmt, "s", $emails[$i]);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_reset($stmt);
			
			$query = "UPDATE teams SET `".$event_name."` = ? WHERE email=?";
			$stmt = mysqli_prepare($link, $query);
			mysqli_stmt_bind_param($stmt, "ss", implode(",", $emails), $emails[$i]);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_reset($stmt);
		}
		
		mysqli_close($link);
		
		$_SESSION['success'] = 1;
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
?>