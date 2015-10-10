<?php
	require 'php/PasswordHash.php';
	require_once('php/recaptchalib.php');

	//MAILGUN
	require 'php/vendor/autoload.php';
	use Mailgun\Mailgun;

	$mgClient = new Mailgun('key-3qzkjwywk-67fwlke64w99s6cxpwo2z8');
	$domain = "pravega.org";
	//END MAILGUN

	session_start();

	$errors = 0; //no errors initially

	//RECAPTCH
	$privatekey = "6LemeecSAAAAAMWP7QEs8YzGsZjDvoFiFifd8OV5";
	$resp = recaptcha_check_answer ($privatekey,
	$_SERVER["REMOTE_ADDR"],
	$_POST["recaptcha_challenge_field"],
	$_POST["recaptcha_response_field"]);
	//END RECAPTCHA

	//PASSWORD HASHING REQUIREMENTS
	$hash_cost_log2 = 8;
	$hash_portable = FALSE;

	$debug = TRUE;
	//END PASSWORD HASHING REQUIREMENTS

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
	$first_name = get_post_var('first');
	$last_name = get_post_var('last');
	$password = get_post_var('password');
	$verify = get_post_var('verify');
	$city = get_post_var('city');
	$codechef = get_post_var('codechef');
	$mobile = get_post_var('mobile');
	$day = get_post_var('day');
	$month = get_post_var('month');
	$year = get_post_var('year');
	$dob = $year.'-'.$month.'-'.$day;
	$college = get_post_var('college');
	$activation_code = uniqid();
	$accommodation = 0;
	
	$gender = get_post_var('gender');
	
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
	
	
	if	(!$resp->is_valid)
	{
		$_SESSION['errors_captcha'] = 1;
		$errors = 1;
	} 

	if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i', $email))
	{
		$errors = 1;
		$_SESSION['errors_email'] = 1;
	}
	
	if (strlen($password) > 72 || strlen($password) < 8)
	{
		$errors = 1;
		$_SESSION['errors_pass'] = 1;
	}
	
	
	if (strcmp($password, $verify) != 0)
	{
		$errors = 1;
		$_SESSION['errors_verification'] = 1;
	}
	
	
	if (strlen($mobile) != 10)
	{
		$errors = 1;
		$_SESSION['errors_mobile'] = 1;
	}
	
	if ($year == "empty")
	{
		$errors = 1;
		$_SESSION['errors_dob'] = 1;
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
		$_SESSION['password'] = $password;
		$_SESSION['verify'] = $verify;
		$_SESSION['city'] = $city;
		$_SESSION['codechef'] = $codechef;
		$_SESSION['mobile'] = $mobile;
		$_SESSION['day'] = $day;
		$_SESSION['month'] = $month;
		$_SESSION['year'] = $year;
		$_SESSION['college'] = $college;
		$_SESSION['gender'] = $gender;
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	
	else
	{		
		$hasher = new PasswordHash($hash_cost_log2, $hash_portable);
		$hash = $hasher->HashPassword($password);
		if (strlen($hash) < 20)
			fail('Failed to hash new password');
		unset($hasher);


		$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

		if (!$link) {
			die('Connect Error (' . mysqli_connect_errno() . ') '
					. mysqli_connect_error());
		}

		$query = "INSERT INTO usernames (firstname, lastname, email, password, dob, city, codechef, mobile, college, activation_code, gender, accommodation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$query_events = "INSERT INTO events (email) VALUES (?)";
		$query_teams = "INSERT INTO teams (email) VALUES (?)";

		$stmt1 = mysqli_prepare($link, $query);
		$stmt2 = mysqli_prepare($link, $query_events);
		$stmt3 = mysqli_prepare($link, $query_teams);

		mysqli_stmt_bind_param($stmt1, "sssssssssssi", $first_name, $last_name, $email, $hash, $dob, $city, $codechef, $mobile, $college, $activation_code, $gender, $accommodation);
		mysqli_stmt_bind_param($stmt2, "s", $email);
		mysqli_stmt_bind_param($stmt3, "s", $email);
		
		if (mysqli_stmt_execute($stmt1)&& mysqli_stmt_execute($stmt2) && mysqli_stmt_execute($stmt3))
		{
			mysqli_stmt_reset($stmt1);
			$query = "SELECT id FROM usernames where email=?";
			$stmt1 = mysqli_prepare($link, $query);
			mysqli_stmt_bind_param($stmt1, "s", $email);
			mysqli_stmt_execute($stmt1);
			mysqli_stmt_bind_result($stmt1, $user_id);
			mysqli_stmt_fetch($stmt1);

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
			$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Pravega Web Team <web@pravega.org>',
                        'to'      => $first_name.' '. $last_name.'<'.$email.'>',
                        'subject' => $subject,
                        'text'    => '',
						'html' => $message));
			
			mysqli_close($link);
			
			$_SESSION['email'] = $email;
			header("Location: success.php");
		}
		else
			mysqli_close($link);
	}

?>