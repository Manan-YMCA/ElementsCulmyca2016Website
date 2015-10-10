<?php
ob_start();
session_start();
require_once 'includes/DbConnector.php';
require_once 'includes/FormActionValidator.php';
require_once 'includes/functions.php';;
$functions = new GlobalFunctions();
$db = new DbConnector();
$fav=new FormActionValidator();

$fav->postDataExist('name');
$fav->postDataExist('email');
$fav->postDataExist('password');
$fav->postDataExist('cpassword');
$fav->postDataExist('city');
$fav->postDataExist('college_name');
$fav->postDataExist('day');
$fav->postDataExist('month');
$fav->postDataExist('year');
$fav->postDataExist('mobile');
$sign = array();
if(!$fav->foundErrors()) {
	$name = $sign['name'] = $_POST['name'];
	$email = $sign['email'] = $_POST['email'];
	$mobile = $sign['mobile'] = $_POST['mobile'];
	$password = $sign['password'] = $_POST['password'];
	$cpassword = $sign['cpassword'] = $_POST['cpassword'];	
	$city = $sign['city'] = $_POST['city'];
	$college_name = $sign['college_name'] = $_POST['college_name'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$dob = $sign['dob'] = $day.'-'.$month.'-'.$year;
	$get_know = $_POST['know'];
	$get_know[7] =  $_POST['other_know'];
	$know = implode(',', $get_know);
	$sign['know'] = $know;
	
	define('TO_ADMIN', 'iiscpravega@gmail.com');
	$referer=trim($_SERVER['HTTP_REFERER']);
	define('SUBJECT', 'Pravega college ambassador registration');
		
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
		$_SESSION['error'] = "Invalid email format";
		header('location:ambassador_registration.php');
		return false;
	}
	
	if($password != $cpassword){
		$_SESSION['error'] = "Password and confirm password are not same.";
		header('location:ambassador_registration.php');
		return false;
	}
	
	$check_sql="select * from ambassador";
	$where =" where email = '$email'";
	$order = NULL;		
	$check=$db->select($check_sql, $where, $order);		
	$count=$db->countResult();
	if($count == 1) {
		$_SESSION['error'] = "Email already registered as college ambassador";
		header('location:ambassador_registration.php');
		return false;
	}else {
		$check_sql="select * from student";
		$where =" where email = '$email'";
		$order = NULL;		
		$check=$db->select($check_sql, $where, $order);		
		$count=$db->countResult();
		if($count == 1) {
			$_SESSION['error'] = "Email already registered in student";
			header('location:ambassador_registration.php');
			return false;
		}
	}
	
	$check_sql="select * from ambassador order by id desc limit 1";
	$where = NULL;
	$order = NULL;		
	$check=$db->select($check_sql, $where, $order);		
	$count=$db->countResult();
	if($count == 1) {
		$result = $db->fetchData();
		$last_id = $result[0]['id'];
		$user_id = 1000 + $last_id;
		$username = 'prac'.$user_id;
	}else{
		$username = 'prac1000';
	}
	$sign['username'] = $username;
	$salt = 'hjghbdjgh7486539neojnvge0@#$nfwgjknej';
    $verification_code = $sign['verification_code'] = md5($username . $salt);
	
	$password = $functions->generate_password($sign['password']);
	$insert_id =$db->insert('ambassador',array('', $username, $name, $email, $password, $mobile, $city, $college_name, $dob, $know, 0, $verification_code, date('Y-m-d'))); 			
	if($insert_id) {
		sendEmail(trim($email), TO_ADMIN, SUBJECT, 'message', $sign);
	}else {
		$_SESSION['error'] = "Error occurred while registering";
		header('location:ambassador_registration.php');
		return false;
	}
	
} else {
	$_SESSION['error'] = "Please fill up all the mandatory fields.";
	header('location:ambassador_registration.php');
	return false;
}

function sendEmail($to, $from, $subj, $body, $sign) {
	$message = "Welcome to Pravega 2015 <br>Your pravega username is ".$sign['username']."<br> Click on this url to confirm your registration in pravega 2015<br>
				<a href='http://www.pravega.org/activate.php?account=ambassador&vkey=".$sign['verification_code'].'&uname='.$sign['username']."'>http://www.pravega.org/activate.php?account=ambassador&vkey=".$sign['verification_code'].'&uname='.$sign['username']."</a>";
	$phpversion = phpversion();
	$boundary = md5( time() );
	$headers = "From: $from\n"."Date: $date\n"."Content-Type: text/html; charset=\"UTF-8\"\n";
	if (mail(trim($to), trim($subj), $message, $headers)) {
		sendEmailAdmin(TO_ADMIN, trim($sign['email']), SUBJECT, 'message', $sign);
	} else {
		$_SESSION['error'] = "Sorry, some errors occurred. Please try again later.";
		header('location:ambassador_registration.php');
		return false;
	}		
}

function sendEmailAdmin($to, $from, $subj, $body, $sign) {
	$message = "<h2>College Ambassador Registration</h2><br><table class='table table-striped table-bordered' align='center' style='max-width: 100%; background-color: transparent; border-collapse: collapse; border-spacing: 0; width: 100%; padding-bottom: 25px;'>
					<tr class='odd'>
						<td style='width:100px;padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;background-color: #f9f9f9;'>Name</td>
						<td style='width:200px;padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;background-color: #f9f9f9;'>".$sign['name']."</td>
					</tr>
					<tr>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;'>Email</td>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;'>".$sign['email']."</td>
					</tr>
					<tr class='odd'>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;background-color: #f9f9f9;'>Mobile</td>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;background-color: #f9f9f9;'>".$sign['mobile']."</td>
					</tr>
					<tr>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;'>Username</td>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;'>".$sign['username']."</td>
					</tr>
					<tr>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;'>City</td>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;'>".$sign['city']."</td>
					</tr>

					<tr class='odd'>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;background-color: #f9f9f9;'>College</td>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;background-color: #f9f9f9;'>".$sign['college_name']."</td>
					</tr>
					<tr>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;'>Date of birth</td>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;'>".$sign['dob']."</td>
					</tr>

					<tr class='odd'>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;background-color: #f9f9f9;'>Know about Pravega</td>
						<td style='padding: 8px; line-height: 18px; text-align: left; vertical-align: top; border-top:1px solid #dddddd;border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; color:#555555;background-color: #f9f9f9;'>".$sign['know']."</td>
					</tr>

					<tr>
						<td style='height:20px'></td>
						<td style='height:20px'></td>
					</tr>
				</table>";
	$phpversion = phpversion();
	$boundary = md5( time() );
	$headers = "From: $from\n"."Date: $date\n"."Content-Type: text/html; charset=\"UTF-8\"\n";
	if (mail(trim($to), trim($subj), $message, $headers)) {
		$_SESSION['success'] = "We have sent a verification mail for confirmation.";
		header('location:ambassador_registration.php');
	} else {
		$_SESSION['error'] = "Sorry, some errors occurred. Please try again later.";
		header('location:ambassador_registration.php');
		return false;
	}		
}

ob_end_flush();
?>