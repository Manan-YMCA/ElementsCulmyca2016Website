<?php
ob_start();
session_start();
require_once 'includes/DbConnector.php';
require_once 'includes/FormActionValidator.php';
$db = new DbConnector();
$fav = new FormActionValidator();
require_once 'includes/functions.php';
require_once 'includes/constants.php';
$functions = new GlobalFunctions();

if(isset($_POST['get_login']) && $_POST['get_login']=='Login') {
	$fav->postDataExist('username');
	$fav->postDataExist('password');
	if(!$fav->foundErrors()) {
		$username = $fav->preventInjuctionPost('username');
		$password = $fav->preventInjuctionPost('password');
		$password = $functions->generate_password($password);
		
		$check_sql = "select * from student ";
		$where = " where username='$username' and password='$password' and verification=1";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);		
		$count = $db->countResult();	
		if($count == 1) {
			$result = $db->fetchData();
			$_SESSION['user'] = $result[0]['name'];
			$_SESSION['username'] = $result[0]['username'];
			$_SESSION['user_email'] = $result[0]['email'];
			$_SESSION['user_id'] = $result[0]['id'];
			$_SESSION['login_type'] = 'student';
			$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
			
			$_SESSION['success'] = "You are succesfully logged in";
			header('location:my_account.php');
			return true;
		}
		
		$check_sql = "select * from student ";
		$where = " where email='$username' and password='$password' and verification=1";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);		
		$count = $db->countResult();	
		if($count == 1) {
			$result = $db->fetchData();
			$_SESSION['user'] = $result[0]['name'];
			$_SESSION['username'] = $result[0]['username'];
			$_SESSION['user_email'] = $result[0]['email'];
			$_SESSION['user_id'] = $result[0]['id'];
			$_SESSION['login_type'] = 'student';
			$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
			
			$_SESSION['success'] = "You are succesfully logged in";
			header('location:my_account.php');
			return true;
		}		
		
		$check_sql = "select * from ambassador ";
		$where = " where username='$username' and password='$password' and verification=1";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);		
		$count = $db->countResult();	
		if($count == 1) {
			$result = $db->fetchData();
			$_SESSION['user'] = $result[0]['name'];
			$_SESSION['username'] = $result[0]['username'];
			$_SESSION['user_email'] = $result[0]['email'];
			$_SESSION['user_id'] = $result[0]['id'];
			$_SESSION['login_type'] = 'ambassador';
			$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
			
			$_SESSION['success'] = "You are succesfully logged in";
			header('location:my_account.php');
			return true;
		}		
		
		$check_sql = "select * from ambassador ";
		$where = " where email='$username' and password='$password' and verification=1";
		$order = NULL;		
		$check = $db->select($check_sql, $where, $order);		
		$count = $db->countResult();	
		if($count == 1) {
			$result = $db->fetchData();
			$_SESSION['user'] = $result[0]['name'];
			$_SESSION['username'] = $result[0]['username'];
			$_SESSION['user_email'] = $result[0]['email'];
			$_SESSION['user_id'] = $result[0]['id'];
			$_SESSION['login_type'] = 'ambassador';
			$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
			
			$_SESSION['success'] = "You are succesfully logged in";
			header('location:my_account.php');
			return true;
		}else {
			$_SESSION['error'] = "Either Username/Email/Password is incorrect";
			header('location:login.php');
			return false;
		}
		
	}else {
		$_SESSION['error'] = "Fill up the mandatory fields";
		header('location:login.php');
		return false;
	}
}elseif(isset($_POST['forgtot_pass']) && $_POST['forgtot_pass']=='Send') {	
	require 'includes/recaptchalib.php';
	$fav->postDataExist('username');
	$fav->postDataExist('recaptcha_response_field');
	if(!$fav->foundErrors()) {
		$username = $fav->preventInjuctionPost('username');
		$recaptcha_response_field = $fav->preventInjuctionPost('recaptcha_response_field');
		$error = null;
		$err = null;
		$output = null;
		$privatekey = RECAPTCHA_PRIVATE_KEY;
		$resp = recaptcha_check_answer($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);		
		if($resp->is_valid){
			$table = 'student';
			$check_sql = "select * from student ";
			$where = " where username='$username' and verification=1";
			$order = NULL;		
			$check = $db->select($check_sql, $where, $order);
			$table = 'student';		
			$count = $db->countResult();	
			
			if($count != 1) {		
				$check_sql = "select * from student ";
				$where = " where email='$username' and verification=1";
				$order = NULL;		
				$check = $db->select($check_sql, $where, $order);	
				$table = 'student';	
				$count = $db->countResult();	
			}		
			
			if($count != 1) {
				$check_sql = "select * from ambassador ";
				$where = " where username='$username' and verification=1";
				$order = NULL;		
				$check = $db->select($check_sql, $where, $order);
				$table = 'ambassador';		
				$count = $db->countResult();
			}		
			
			if($count != 1) {
				$check_sql = "select * from ambassador ";
				$where = " where email='$username' and verification=1";
				$order = NULL;		
				$check = $db->select($check_sql, $where, $order);		
				$table = 'ambassador';
				$count = $db->countResult();	
			}
		
			if($count == 1) {
				$result = $db->fetchData();
				$get_pass = $newpassword = $functions->genRandomString(8);
				$newpassword = $functions->generate_password($newpassword);
				$res = $db->update($table, array('password'=>$newpassword),array('id'=>'id= '.$result[0]['id'])); 
				$name = $result[0]['name'];
				$email = $result[0]['email'];
				if($res) {					
					define('TO', $email);
					define('FROM', 'iiscpravega@gmail.com');
					$referer=trim($_SERVER['HTTP_REFERER']);
					define('SUBJECT', 'Pravega 2015 - forgot password');
					function sendEmail($to, $from, $subj, $body, $name, $get_pass) {
						$message = "<h2>Pravega 2015</h2> <br>Hi $name your new password is ". $get_pass;
						$phpversion = phpversion();
						$boundary = md5( time() );
						$headers = "From: $from\n"."Date: $date\n"."Content-Type: text/html; charset=\"UTF-8\"\n";
						if (mail(trim($to), trim($subj), $message, $headers)) {
							$_SESSION['success'] = "Your new password has been sent to your email id";
							header('location:login.php');
						} else {
							$_SESSION['error'] = "Sorry, some errors occurred. Please try again later.";
							header('location:login.php');
						}
					}
					sendEmail(TO, FROM, SUBJECT, 'Forgot Password', $name, $get_pass);
				}else {
					$_SESSION['error'] = "Error occured while updating";
					header('location:login.php');
				}
			}else{
				$_SESSION['error'] = "User doesn't exists";
				header('location:login.php?forgot_password');
			}
		}else{
			$_SESSION['error'] = "Enter the correct captcha value";
			header('location:login.php');
		}
	}else{
		$_SESSION['error'] = "Fill up all the mandatory fields";
		header('location:login.php');
	}	
}elseif(isset($_POST['edit_password']) && $_POST['edit_password']=='Save') {
	$fav->postDataExist('current_password');
	$fav->postDataExist('password');
	$fav->postDataExist('cpassword');
	if(!$fav->foundErrors()) {
		$id = $_SESSION['user_id'];
		$table = $_SESSION['login_type'];
		$current_password = $fav->preventInjuctionPost('current_password');
		$password = $fav->preventInjuctionPost('password');
		$cpassword = $fav->preventInjuctionPost('cpassword');
		if($password != $cpassword) {
			$_SESSION['warning'] = "Passwords doesn't match";
			header('location:change_password.php'); 
		}
		
		$current_password = $functions->generate_password($current_password);
		$password = $functions->generate_password($password);
		$check_sql="select * from $table ";
		$where ="where password='$current_password' and id='$id'";
		$order = NULL;		
		$check=$db->select($check_sql, $where, $order);		
		$count=$db->countResult();
		if($count == 1) {
			$res =$db->update($table, array('password'=>$password),array('id'=>'id= '.$id)); 					
			if($res) {
				$_SESSION['success'] = "Your password has been updated successfully";
				header('location:change_password.php');
			}else {
				$_SESSION['error'] = "Error occured while updating";
				header('location:change_password.php');
			}
		}else {			
			$_SESSION['error'] = "Current Password provided is wrong";
			header('location:change_password.php');
		}
	}else{
		$_SESSION['error'] = "Fill up the mandatory fields";
		header('location:change_password.php');
	}
}elseif(isset($_POST['add_event']) && $_POST['add_event']=='Register') {
	$fav->postDataExist('event');
	if(!$fav->foundErrors()) {
		$id = $_SESSION['user_id'];
		$username = $_SESSION['username'];
		$login_type = $_SESSION['login_type'];
		$ambassador_id = '';
		if($login_type == 'student'){
			$check_sql="select * from student ";
			$where ="where id='$id'";
			$order = NULL;		
			$check=$db->select($check_sql, $where, $order);	
			$count=$db->countResult();
			if($count > 0) {
				$result = $db->fetchData();
				$ambassador_id = $result[0]['ambassador'];
			}
		}
		if(!empty($id)){
			$event = $fav->preventInjuctionPost('event');
			$url = $_SERVER['HTTP_REFERER'];
			$events = unserialize(events);
			if(!isset($events[$event])) {
				$_SESSION['warning'] = "Event doesn't exists";
				header('location:'.$url); 
			}
			
			$check_sql="select * from participants ";
			$where ="where event_id='$event' and participant_id='$id'";
			$order = NULL;		
			$check=$db->select($check_sql, $where, $order);	
			$count=$db->countResult();
			if($count > 0) {
				$_SESSION['warning'] = "You are already registered to this event";
				header('location:'.$url);
			}else {			
				$res = $db->insert('participants', array('', $event, $id, $username, $login_type, $ambassador_id, 1, '', date('Y-m-d')));
				if($res) {
					$_SESSION['success'] = "You successfully registered to the event";
					header('location:'.$url);
				}else {
					$_SESSION['error'] = "Error occured while registering";
					header('location:'.$url);
				}
			}
		}else{
			header('location:login.php');
		}
	}else{
		$_SESSION['error'] = "Fill up the mandatory fields";
		header('location:'.$url);
	}
}elseif(isset($_POST['group_event_add']) && $_POST['group_event_add']=='Submit') {
	$fav->postDataExist('event_id');
	if(!$fav->foundErrors()) {
		$id = $_SESSION['user_id'];
		$event = $fav->preventInjuctionPost('event_id');
		$participants_name = $_POST['u_name'];
		$username = $_SESSION['username'];
		$login_type = $_SESSION['login_type'];
		$ambassador_id = '';
		
		$check_sql="select * from participants order by id desc limit 1";
		$where = NULL;
		$order = NULL;		
		$check=$db->select($check_sql, $where, $order);		
		$count=$db->countResult();
		if($count == 1) {
			$result = $db->fetchData();
			$last_id = $result[0]['id'];
		}
		$event_no = $event.''.$last_id;
		
		if(!empty($id)){
			$events = unserialize(group_events);
			$url = $_SERVER['HTTP_REFERER'];
			if(!isset($events[$event])) {
				$_SESSION['warning'] = "Event doesn't exists";
				header('location:'.$url); 
			}
			
			/*$check_sql="select * from participants ";
			$where ="where event_id='$event' and participant_id='$id'";
			$order = NULL;		
			$check=$db->select($check_sql, $where, $order);	
			$count=$db->countResult();
			if($count > 0) {
				$_SESSION['warning'] = "You are already registered to this event";
				header('location:'.$url);
			}else {			
				$res = $db->insert('participants', array('', $event, $id, $username, $login_type, $ambassador_id, 2, date('Y-m-d')));
			}*/
			foreach($participants_name as $participants){
				$user = substr($participants, 0, 4);
				if($user == 'pras'){
					$table = 'student';
				}elseif($user == 'prac'){
					$table = 'ambassador';
				}
				$check_sql="select * from $table ";
				$where ="where username='$participants' and verification = 1";
				$order = NULL;		
				$check=$db->select($check_sql, $where, $order);	
				$count=$db->countResult();
				if($count == 1) {
					$result = $db->fetchData();
					$student_id = $result[0]['id'];
				}else{
					$_SESSION['warning'] = "Student doesn't exists";
					header('location:'.$url);
					return false;
				}
				
				$check_sql="select * from participants ";
				$where ="where event_id='$event' and participant_id='$student_id'";
				$order = NULL;		
				$check=$db->select($check_sql, $where, $order);	
				$count=$db->countResult();
				if($count > 0) {
					$_SESSION['warning'] = "You are already registered to this event";
					header('location:'.$url);
					return false;
				}else {			
					$res = $db->insert('participants', array('', $event, $student_id, $participants, 'student', $ambassador_id, 2, $event_no, date('Y-m-d')));
				}
			}
			if($res) {
				$_SESSION['success'] = "You successfully registered to the event";
				header('location:'.$url);
			}else {
				$_SESSION['error'] = "Error occured while registering";
				header('location:'.$url);
			}
		}else{
			header('location:login.php');
		}
	}else{
		$_SESSION['error'] = "Fill up the mandatory fields";
		header('location:'.$url);
	}
}elseif(isset($_POST['remove_event'])) {
	$fav->postDataExist('remove_event');
	if(!$fav->foundErrors()) {
		$remove_event = $fav->preventInjuctionPost('remove_event');
		$events = unserialize(events);
		if(!isset($events[$remove_event])) {
			$_SESSION['warning'] = "Event doesn't exists";
			$response['status'] = "success";
			echo json_encode($response);
			exit; 
		}
		
		$trans_del=$db->delete("participants", "id=".$remove_event);
		if($trans_del) {
			$_SESSION['success'] = "Event removed successfully";
			$response['status'] = "success";
			echo json_encode($response);
			exit; 
		}else {
			$_SESSION['error'] = "Error occured while deleting";
			$response['status'] = "success";
			echo json_encode($response);
			exit; 
		} 
	}else{
		$_SESSION['error'] = "Error occured while deleting";
		$response['status'] = "success";
		echo json_encode($response);
		exit; 
	}
}elseif(isset($_GET['remove_id'])) {
	$fav->getDataExist('remove_id');
	if(!$fav->foundErrors()) {
		$remove_event = $fav->preventInjuctionGet('remove_id');
		$events = unserialize(events);
		if(!isset($events[$remove_event])) {
			$_SESSION['warning'] = "Event doesn't exists";
			header('location:my_account.php');
		}
		
		$trans_del=$db->delete("participants", "id=".$remove_event);
		if($trans_del) {
			$_SESSION['success'] = "Event removed successfully";
			header('location:my_account.php');
		}else {
			$_SESSION['error'] = "Error occured while deleting";
			header('location:my_account.php');
		} 
	}else{
		$_SESSION['error'] = "Error occured while deleting";
		header('location:my_account.php');
	}
}
ob_end_flush();
?>
   