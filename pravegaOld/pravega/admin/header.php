<?php
	ob_start();
	session_start();
	require_once 'includes/DbConnector.php';
	require_once 'includes/FormActionValidator.php';
	$db = new DbConnector();
	$fav = new FormActionValidator();
	require_once 'includes/common_functions.php';
	require_once 'includes/constants.php';
	require_once 'logcheck-admin.php';
	$log = new LoggedIn();
    $log->logincheck();
	//$emp_permissions = getPermissions($_SESSION['user_id']);
	$super_admin = true;
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Pravega 2015</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<link rel="stylesheet" href="prettify/prettify.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-fileupload.min.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-timepicker.min.css" type="text/css" />
</head>
<body>
<?php include('includes/messaging_code.php'); ?>
	<div class="mainwrapper">