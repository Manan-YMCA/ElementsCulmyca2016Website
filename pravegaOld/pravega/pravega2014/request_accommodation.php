<?php
	//MAILGUN
	require 'php/vendor/autoload.php';
	use Mailgun\Mailgun;

	# Instantiate the client.
	$mgClient = new Mailgun('key-3qzkjwywk-67fwlke64w99s6cxpwo2z8');
	$domain = "pravega.org";
	//END MAILGUN

	session_start();
	include('db_config.php');

	$errors = 0; //no errors initially

	function get_post_var($var) //safe post data collection
	{
		$val = $_POST[$var];
		if (get_magic_quotes_gpc())
			$val = stripslashes($val);
		return $val;
	}

	$email = get_post_var('email');
	$name = get_post_var('name');
	$gender = get_post_var('gender');
	$arrival_date = get_post_var('arrival_date');
	$arrival_time = get_post_var('arrival_time');
	$departure_date = get_post_var('departure_date');
	$departure_time = get_post_var('departure_time');
	$reg_event =  get_post_var('reg_event');
	$city =  get_post_var('city');
	$explara_no = get_post_var('explara_no');
	
	$arrival = $arrival_date ." ".$arrival_time.":00";
	$departure = $departure_date ." ".$departure_time.":00";
	
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	$query = "SELECT `".$reg_event."` FROM events WHERE email=?";	
	$stmt = mysqli_prepare($link, $query);
	if ($stmt)
	{
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $registered);
		mysqli_stmt_fetch($stmt);

		mysqli_stmt_free_result($stmt);
		mysqli_stmt_close($stmt);
	}
	
	else
	{
		$errors = 1;
		$registered = 0;
	}
	
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	$query = "SELECT email FROM accommodation WHERE email=?";	
	$stmt = mysqli_prepare($link, $query);
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $accomm_requested);
	mysqli_stmt_fetch($stmt);
	
	//ERROR HANDLING
	
	if ($accomm_requested)
	{
		$errors = 1;
		$_SESSION['errors_accomm_requested'] = 1;
	}
	
	if (!$registered)
    {
		$errors = 1;
		$_SESSION['errors_reg_event'] = 1;
	}
	
	if ($gender == "")
	{
		$errors = 1;
		$_SESSION['errors_gender'] = 1;
	}
	
	if ($arrival_time == "" || $arrival_date == "" || $departure_date == "" || $departure_time == "")
	{
		$errors = 1;
		$_SESSION['errors_arrival_departure'] = 1;
	}
	
	if ($city == "")
	{
		$errors = 1;
		$_SESSION['errors_city'] = 1;
	}
	
	//END ERROR HANDLING
	
	if ($errors)
	{
		$_SESSION['errors'] = 1;
		$_SESSION['gender'] = $gender;
		$_SESSION['arrival_date'] = $arrival_date;
		$_SESSION['arrival_time'] = $arrival_time;
		$_SESSION['departure_date'] = $departure_date;
		$_SESSION['departure_time'] = $departure_time;
		$_SESSION['reg_event'] = $reg_event;
		$_SESSION['explara_no'] = $explara_no;
		
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	
	else
	{		
		$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

		if (!$link) {
			die('Connect Error (' . mysqli_connect_errno() . ') '
					. mysqli_connect_error());
		}
		
		mysqli_stmt_close($stmt);
		
		$query_accomo = "INSERT INTO accommodation (name, email, gender, event, arrival, departure, city, explara_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$query_gender = "UPDATE usernames SET gender=?, city=? WHERE email=? LIMIT 1";

		$stmt1 = mysqli_prepare($link, $query_accomo);
		$stmt2 = mysqli_prepare($link, $query_gender);		

		mysqli_stmt_bind_param($stmt1, "ssssssss", $name, $email, $gender, $reg_event, $arrival, $departure, $city, $explara_no);
		mysqli_stmt_bind_param($stmt2, "sss", $gender, $city, $email);
		
		if (mysqli_stmt_execute($stmt1) && mysqli_stmt_execute($stmt2))
		{
			// subject
			$subject = 'Account Activation at Pravega.org';

			// message
			$message = '
			<html>
			<head>
			  <title>Account Activation at Pravega.org</title>
			</head>
			<body>
				Hello, '.$first_name . ' '. $last_name .'!<br><br>
			
				Thank you for registering at pravega.org. Your User ID is <b>'. $user_id .'</b>.<br><br>
				
				Your account has not yet been activated. Click <a href="http://pravega.org/activate?email='. $email .'&code='.$activation_code.'">here</a> to activate now.<br><br>
				
				If you are unable to see the link above, go to the following URL and enter your email address and activation code:<br><br>
				URL: pravega.org/activate<br>
				Code: '.$activation_code.'
				<br><br>
				
				Thanks,<br>
				The Pravega Web Team
			</body>
			</html>
			';

			// Mail it
			/*$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Pravega Web Team <web@pravega.org>',
                        'to'      => $first_name.' '. $last_name.'<'.$email.'>',
                        'subject' => $subject,
                        'text'    => '',
						'html' => $message));*/
			
			mysqli_close($link);
			
			$_SESSION['success'] = 1;
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
		else
			mysqli_close($link);
	}

?>