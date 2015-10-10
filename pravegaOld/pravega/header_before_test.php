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
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/jquery.colorbox-min.js"></script>
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
	<link href="css/ripple.css" rel="stylesheet">
	<link href="css/vertical_menu.css" rel="stylesheet">
    <link rel="stylesheet" href="css/colorbox.css">
	<link href="css/loader.css" rel="stylesheet">
	
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
			<style>
				.sub:hover
				{
					box-shadow:none;
				}
			</style>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse" style="padding-top: 20px;">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
					                  
		            <li>
                        <a class="button page-scroll" href="talks.php">Talks</a>
                    </li>
					
					<li>
                        <a class="button page-scroll" href="pronights.php">ProNights</a>
					</li>
					<li>
                        <a class="button page-scroll" href="sponsors.php">Sponsors</a>
					</li>
					<li>
                        <a class="button page-scroll" href="hospitality.php">hospitality</a>
                    </li>
					
					<li>
                        <a class="button page-scroll" href="contact.php">Contact Us</a>
                    </li>
					
					<li>
						<a href="#" class="button dropdown-toggle page-scroll" data-toggle="dropdown">More</i>
							<span class="caret"></span>
						</a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
								<li><a class="button sub page-scroll" href="About.php">About Us</a></li>
								<li class="divider"></li>
								<li><a class=" button sub page-scroll" href="faq.php">FAQ</a></li>
							</ul>
					</li>
            
			<?php if(!empty($_SESSION['user'])){ ?>
            <li>
					<a href="#" class=" dropdown-toggle page-scroll button" data-toggle="dropdown"> hi, <?= $_SESSION['user'] ?> </i>

<span class="caret"></span></a>
						<ul class=" dropdown-menu" role="menu" aria-labelledby="dLabel">
							
							<li><a class="button sub page-scroll" href="my_account.php">My account</a></li>
							<li class="divider"></li>
							<li><a class="button sub page-scroll" href="change_password.php">Change Password</a></li>
							<li class="divider"></li>
							<li><a class="button sub page-scroll" href="logout.php">Logout</a></li>
						</ul>
			</li>
            <?php }else { ?>
			<li>
					<a class="button page-scroll" href="login.php">Login</a>
			</li>
			<li>
					<a href="#" class="button dropdown-toggle page-scroll" data-toggle="dropdown"> Register </i>

<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							
							<li><a class="button sub page-scroll" href="student_registration.php">Student Registration</a></li>
							<li class="divider"></li>
							<li><a class="button sub page-scroll" href="ambassador_registration.php">College Ambassador Registration</a></li>
						</ul>
			</li>
            <?php } ?>
		    </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	<!-- Intro Header --> 
	
	<!--SIDE BAR-->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row"><br><br>
                    <div style="text-align:centre " class="row_inner">
                    	<div class="wrapper">
                          <nav class="vertical">
                            <ul>
                              <li class="button" style="padding:0; text-align:left; font-size:18px;">
                                <label for="Multidisciplinary">Multidisciplinary</label>
                                <input type="checkbox" class="menu_check" name="verticalMenu" id="Multidisciplinary" />
                                <div>
                                  <ul>
                                    <li><a href="idea.php">The Idea Within</a></li>
                                    <li><a href="inquizitive.php">Inquizitive</a></li>
                                    <!--li><a href="sciencequizine.php">Science Quizine</a></li-->
                                  </ul>
                                </div>
                              </li>
                              <li class="button" style="padding:0; text-align:left;">
                                <label for="Physics">Physics</label>
                                <input type="checkbox" class="menu_check" name="verticalMenu" id="Physics" />
                                <div>
                                  <ul>
                                    <li><a href="armchair.php">The Armchair Physicist</a></li>
                                    <li><a href="phy_meme.php">Trollstein</a></li>
                                    <li><a href="phy_story.php">Physics Yarns</a></li>
                                    <li><a href="experiment.php">Dexter’s Laboratory</a></li>
                                  </ul>
                                </div>
                              </li>
                              <li class="button" style="padding:0; text-align:left;">
                                <label for="Chemistry">Chemistry</label>
                                <input type="checkbox" class="menu_check" name="verticalMenu" id="Chemistry" />
                                <div>
                                  <ul>
                                    <li><a href="carbon.php">Carbon, Carbon Everywhere</a></li>
                                    <li><a href="sustain.php">Sustainability Challenge</a></li>
                                    <li><a href="murals.php">Molecular Murals </a></li>
                                  </ul>
                                </div>
                              </li >
                              <li class="button" style="padding:0; text-align:left;">
                                <label for="Maths">Maths<new>NEW</new></label>
                                <input type="checkbox" class="menu_check" name="verticalMenu" id="Maths" />
                                <div>
                                  <ul>
                                    <li><a href="apocalypse.php">Apocalypse Now!<new>NEW</new></a></li>
                                    <li><a href="samasya.php">Samasya</a></li>
                                    <li><a href="auction.php">The Auction </a></li>
                                  </ul>
                                </div>
                              </li>
                              <li class="button" style="padding:0; text-align:left;">
                                <label for="Biology">Biology</label>
                                <input type="checkbox" class="menu_check" name="verticalMenu" id="Biology" />
                                <div>
                                  <ul>
                                    <li><a href="CFTG.php">Colours From the Grey</a></li>
                                    <li><a href="lexico.php">Lexico Bio</a></li>
                                    <li><a href="who.php">Who'dunnit?</a></li>
                                  </ul>
                                </div>
                              </li>
                              <li class="button" style="padding:0; text-align:left;">
                                <label for="Engineering">Engineering<new>NEW</new></label>
                                <input type="checkbox" class="menu_check" name="verticalMenu" id="Engineering" />
                                <div>
                                  <ul>
									<li><a href="microsoft.php">Microsoft Machine Learning Challenge<new>NEW</new></a></li>
                                    <li><a href="car.php">Fifth Gear<new>NEW</new></a></li>
                                    <li><a href="boat.php">High Tide</a></li>
                                    <li><a href="connect.php">Connect the Dots</a></li>
                                    <li><a href="OPC.php">Online Programming Contest<new>NEW</new></a></li>
									<li><a href="reverse.php">Gnidoc</a></li>
                                  </ul>
                                </div>
                              </li>
                              <li class="button" style="padding:0; text-align:left;">
                                <label for="Cultural">Cultural<new>NEW</new></label>
                                <input type="checkbox" class="menu_check" name="verticalMenu" id="Cultural" />
                                <div>
                                  <ul>
                                    <li><a href="BoB/index.html" target="_blank">Battle of Bands</a></li>
                                    <li><a href="lasya.php">Lasya<new>NEW</new></a></li>
                                    <li><a href="drama.php">Bystander Effect </a></li>
                                    <li><a href="deca.php">Literary Decathlon</a></li>
                                    <li><a href="madads.php">Mad-Ads</a></li>
                                    </ul>
                                </div>
                              </li>
                              <li class="button" style="padding:0; text-align:left;">
                                <label for="Online">Online<new>NEW</new></label>
                                <input type="checkbox" class="menu_check" name="verticalMenu" id="Online" />
                                <div>
                                  <ul>
                                    <li><a href="OPC.php">Online Programming Contest<new>NEW</new></a></li>
                                    <li><a href="phy_meme.php">Trollstein</a></li>
                                    <!--li><a href="online.php">Online General Quiz</a></li-->
                                  </ul>
                                </div>
                              </li>
							  <li class="button" style="padding:0; text-align:left;">
                                <label for="Inhouse Workshops">Workshops<new>NEW</new></label>
                                <input type="checkbox" class="menu_check" name="verticalMenu" id="Inhouse Workshops" />
                                <div>
                                  <ul>
                                    <li><a href="w_gamedev.php">Game Development<new>NEW</new></a></li>
                                    <li><a href="w_automobile.php">Automobile Mechanics & IC Engines<new>NEW</new></a></li>
                                    <li><a href="w_hci.php">Human Robot Interaction<new>NEW</new></a></li>
									<li><a href="w_ehacking.php">Ethical Hacking<new>NEW</new></a></li>
									<li><a href="w_blueprint.php">Automobile Blueprint<new>NEW</new></a></li>
									<li><a href="w_winguav.php">Fixed Wing UAV<new>NEW</new></a></li>
									<li><a href="w_cansat.php">CanSat<new>NEW</new></a></li>
									<li><a href="w_robotics.php">Mobile Controlled Robotics<new>NEW</new></a></li>
									<li><a href="workshops.php">Outreach Workshops<new>NEW</new></a></li>
                                  </ul>
                                </div>
                              </li>
                              <li class="button" style="padding:0; text-align:left;">
                                <label for="Fun">Fun Events</label>
                                <input type="checkbox" class="menu_check" name="verticalMenu" id="Fun" />
                                <div>
                                  <ul>
                                    <li><a href="treasure.php">Treasure Hunt</a></li>
                                    <li><a href="fun.php">Laser Maze</a></li>
                                    <li><a href="fun.php">Walk on Water</a></li>
                                  </ul>
                                </div>
                              </li>
                            </ul>
                          </nav>
                        </div>