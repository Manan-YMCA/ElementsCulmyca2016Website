<?php  
	ob_start();
	session_start();
	require_once 'includes/DbConnector.php';
	require_once 'includes/constants.php';
	$db = new DbConnector();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php
    if (isset($_SESSION['success'])) {
        $style = "background-color:#060;display:block";
        $message = $_SESSION['success'];
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        $style = "background-color:#F00;display:block";
        $message = $_SESSION['error'];
        unset($_SESSION['error']);
    }
            
    ?>
    <div style="<?= $style ?>" id="form_msg">
        <?= $message ?>
    </div>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pravega 2015</title>
		<!--<script src="js/pace.min.js"></script>-->
		<!--<div > <link href="css/pace.css" rel="stylesheet" /></div>-->
    <script src="js/jquery-1.11.0.js"></script>
	<script src="js/hide.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">



    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet">
	<link href="css/ticker.css" rel="stylesheet">
	<link href="css/vertical_menu.css" rel="stylesheet">
	
    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   	<link href="http://fonts.googleapis.com/css?family=Raleway:700|Alegreya+Sans:300,700,400italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                
        <a class="navbar-brand page-scroll" href="http://www.airbusgroup.com/int/en.html" target="_blank">
		<img src="images/home/airbus.png" style="padding-top: 5px;" alt="Logo"></img> &nbsp&nbsp&nbsp&nbsp</a>
		<a class="navbar-brand page-scroll" href="index.php">
		<img src="images/home/logo.png" alt="Logo" height="50"></img>
         </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse" style="padding-top: 20px;">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
					
		            <li>
                        <a class="page-scroll" href="talks.php">Talks</a>
                    </li>
					
					<li>
                        <a class="page-scroll" href="pronights.php">ProNights</a>
					</li>
					<li>
                        <a class="page-scroll" href="sponsors.php">Sponsors</a>
					</li>
					
					<li>
                        <a class="page-scroll" href="hospitality.php">hospitality</a>
                    </li>
					
					<li>
                        <a class="page-scroll" href="contact.php">Contact Us</a>
                    </li>
					
					<li>
						<a href="#" class="dropdown-toggle page-scroll" data-toggle="dropdown">More</i>
							<span class="caret"></span>
						</a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
								<li><a class="page-scroll" href="About.php">About Us</a></li>
								<li class="divider"></li>
								<li><a class="page-scroll" href="faq.php">FAQ</a></li>
							</ul>
					</li>
            
			<?php if(!empty($_SESSION['user'])){ ?>
            <li>
					<a href="#" class="dropdown-toggle page-scroll" data-toggle="dropdown"> hi, <?= $_SESSION['user'] ?> </i>

<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							
							<li><a class="page-scroll" href="my_account.php">My account</a></li>
							<li class="divider"></li>
							<li><a class="page-scroll" href="change_password.php">Change Password</a></li>
							<li class="divider"></li>
							<li><a class="page-scroll" href="logout.php">Logout</a></li>
						</ul>
			</li>
            <?php }else { ?>
			<li>
					<a class="page-scroll" href="login.php">Login</a>
			</li>
			<li>
					<a href="#" class="dropdown-toggle page-scroll" data-toggle="dropdown"> Register </i>

<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							
							<li><a class="page-scroll" href="student_registration.php">Student Registration</a></li>
							<li class="divider"></li>
							<li><a class="page-scroll" href="ambassador_registration.php">College Ambassador Registration</a></li>
						</ul>
			</li>
            <?php } ?>
		    </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>