<?php
ob_start();
session_start();
require_once 'includes/DbConnector.php';
require_once 'includes/FormActionValidator.php';
require_once 'includes/functions.php';;
$functions = new GlobalFunctions();
$db = new DbConnector();
$fav=new FormActionValidator();

//$page_host = 'http://'.$_SERVER[HTTP_HOST].'/pravega/';
//$page_url = $_SERVER["REQUEST_URI"];
//$page_link = explode('/', $page_url);
$account_type = $_GET['account'];
$vkey = $_GET['vkey'];
$uname = $_GET['uname'];
if(!empty($account_type) && !empty($vkey) && !empty($uname)) {
	
	$check_sql="select * from ".$account_type;
	$where =" where username='".$uname."' and verification_code ='".$vkey."'";
	$order = NULL;		
	$check=$db->select($check_sql, $where, $order);
	$table =  $account_type;
	$count=$db->countResult();
	if($count == 1) {
		$result = $db->fetchData();
		if(empty($result[0]['verification'])){
			$res = $db->update($table, array('verification'=>1),array("username"=>"username = '$uname'"));
			if($res){
				$_SESSION['success'] = "Your account is verified. Please login";
				header('location:login.php');
			}else {
				$_SESSION['error'] = "Wrong parameters";
				header('location:login.php');
				return false;
			}
		}else{
			$_SESSION['success'] = "Your account is already verified. Please login";
			header('location:login.php');
		}
	}
	
} else {
	$_SESSION['error'] = "Wrong parameters";
	header('location:login.php');
	return false;
}

ob_end_flush();
?>