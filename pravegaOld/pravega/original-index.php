<?php  
	ob_start();
	session_start();
	require_once 'includes/DbConnector.php';
	$db = new DbConnector();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pravega 2015-The IISc Science, Technology & Cultural Fest</title>
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
	<link href="css/ripple.css" rel="stylesheet">
	<link href="css/ticker.css" rel="stylesheet">
	<link href="css/vertical_menu.css" rel="stylesheet">
	
    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   
 <link href="http://fonts.googleapis.com/css?family=Raleway:700|Antic" rel="stylesheet" type="text/css">




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<a href="https://plus.google.com/+PravegaOrg" rel="publisher"></a>
	
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
		<img src="images/home/airbus.jpg" style="padding-top: 20px;" alt="Logo"></img> &nbsp&nbsp&nbsp&nbsp</a>
		<a class="navbar-brand page-scroll" href="index.php">
		<img src="images/home/logo.png" alt="Logo"></img>
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
                        <a class="button" href="Events.php">Events</a>
                    </li>
                    <li>
                        <a class="button" href="pronights.php">PRO NIGHTS</a>
                    </li>
                    <li>
                            <a href="#" class="dropdown-toggle page-scroll" data-toggle="dropdown"> more </i>
        
        <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    
                                    <li><a class="page-scroll" href="workshops.php">Workshops</a></li>
                                    <li class="divider"></li>
                                    <li><a class="page-scroll" href="javascript:void(0)">Lectures</a></li>
                                    <li class="divider"></li>
                                    <li><a class="page-scroll" href="exhibitions.php">Exhibitions</a></li>
                                </ul>
                    </li>
                   <li>
                        <a class="button" href="faq.php">FAQ</a>
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
    <!-- Intro Header -->
    <header class="intro" style="background-image:url(images/home/home_bg.jpg); background-repeat:no-repeat;">
        <div class="intro-body">
            <div class="container">
                <div class="row"><br><br><br>
                    <div style="text-align:centre" class="row_inner">
                    	<!--div class="wrapper">
                          <nav class="vertical">
                            <ul>
                              <li>
                                <label for="Multidisciplinary">Multidisciplinary</label>
                                <input type="radio" name="verticalMenu" id="Multidisciplinary" />
                                <div>
                                  <ul>
                                    <li><a href="idea.php">Idea Within</a></li>
                                    <li><a href="inquizitive.php">Inquizitive</a></li>
                                    <li><a href="sciencequizine.php">Science Quizine</a></li>
                                  </ul>
                                </div>
                              </li>
                              <li>
                                <label for="Physics">Physics</label>
                                <input type="radio" name="verticalMenu" id="Physics" />
                                <div>
                                  <ul>
                                    <li><a href="armchair.php">The Armchair Physicist</a></li>
                                    <li><a href="phy_meme.php">Trollstein</a></li>
                                    <li><a href="phy_story.php">Physics Yarns</a></li>
                                    <li><a href="experiment.php">Dexter’s Laboratory</a></li>
                                  </ul>
                                </div>
                              </li>
                              <li>
                                <label for="Chemistry">Chemistry</label>
                                <input type="radio" name="verticalMenu" id="Chemistry" />
                                <div>
                                  <ul>
                                    <li><a href="carbon.php">Carbon, Carbon Everywhere</a></li>
                                    <li><a href="sustain.php">Sustainability Challenge</a></li>
                                    <li><a href="murals.php">Molecular Murals </a></li>
                                  </ul>
                                </div>
                              </li>
                              <li>
                                <label for="Maths">Maths</label>
                                <input type="radio" name="verticalMenu" id="Maths" />
                                <div>
                                  <ul>
                                    <li><a href="apocalypse.php">Apocalypse Now!</a></li>
                                    <li><a href="samasya.php">Samasya</a></li>
                                    <li><a href="auction.php">The Auction </a></li>
                                  </ul>
                                </div>
                              </li>
                              <li>
                                <label for="Biology">Biology</label>
                                <input type="radio" name="verticalMenu" id="Biology" />
                                <div>
                                  <ul>
                                    <li><a href="CFTG.php">Colours from the gray</a></li>
                                    <li><a href="lexico.php">Lexico Bio</a></li>
                                    <li><a href="who.php">Whodunnit?</a></li>
                                  </ul>
                                </div>
                              </li>
                              <li>
                                <label for="Engineering">Engineering</label>
                                <input type="radio" name="verticalMenu" id="Engineering" />
                                <div>
                                  <ul>
                                    <li><a href="car.php">Fifth Gear</a></li>
                                    <li><a href="boat.php">High Tide</a></li>
                                    <li><a href="connect.php">Connect the Dots</a></li>
                                    <li><a href="OPC.php">Online Programming Contest</a></li>
                                  </ul>
                                </div>
                              </li>
                              <li>
                                <label for="Cultural">Cultural</label>
                                <input type="radio" name="verticalMenu" id="Cultural" />
                                <div>
                                  <ul>
                                    <li><a href="BoB/index.html" target="_blank">Battle of Bands</a></li>
                                    <li><a href="lasya.php">Lasya</a></li>
                                    <li><a href="drama.php">Bystander Effect </a></li>
                                    <li><a href="deca.php">Literary Decathlon</a></li>
                                    <li><a href="madads.php">Mad-Ads</a></li>
                                    <li><a href="javascript:void(0)">Lumière</a></li>
                                  </ul>
                                </div>
                              </li>
                              <li>
                                <label for="Online">Online</label>
                                <input type="radio" name="verticalMenu" id="Online" />
                                <div>
                                  <ul>
                                    <li><a href="OPC.php">Online Programming Contest</a></li>
                                    <li><a href="phy_meme.php">Trollstein</a></li>
                                    <li><a href="online.php">Online General Quiz</a></li>
                                  </ul>
                                </div>
                              </li>
                              <li>
                                <label for="Fun">Fun Events</label>
                                <input type="radio" name="verticalMenu" id="Fun" />
                                <div>
                                  <ul>
                                    <li><a href="fun.php">Treasure Hunt</a></li>
                                    <li><a href="fun.php">Laser Maze</a></li>
                                    <li><a href="fun.php">Walk on Water</a></li>
                                  </ul>
                                </div>
                              </li>
                            </ul>
                          </nav>
                        </div-->
                    
                    
                    
                        <img src="images/home/blogo.png" alt="Logo" style="margin-top:140px;"></img>
						<p>30<sup>th</sup>&nbspJanuary to 1<sup>st</sup>&nbspFebruary, 2015</p>
						<p class="intro-text ">The Science, Technical, and Cultural Fest of <br> the Indian Institute of Science (IISc), Bangalore.</p>
    <style>
											.ticker_visible
											{
												transition: margin-top, 1s;
												
												margin: auto;
												margin-top: 0px;
												position: absolute;
											}
											
											.ticker_top
											{
												transition: margin-top, 1s;
												
												margin: auto;
												margin-top: -30px;
												position:absolute
											}
											
											.ticker_bottom
											{
												margin: auto;
												margin-top: 30px;
												position: absolute;
											}
											
											.ticker
											{
												width: 780px;
												margin-left: -389px;
												display: inline-block;
												text-transform: none;
											}
											
											.ticker a
											{
												text-decoration: none;
												color: rgba(255,255,255,0.8);
											}
											
											#news_holder.date
											{
												font-size: 15px !important;
												font-weight:300;
												line-height: 210%;
												letter-spacing: 0.1em;
												margin-top: 11px;
												overflow: hidden;
												height: 30px;
												width: 1000px;
												position: relative;
												padding: 0px 0px;
												display: inline-block;
												background: rgba(255,255,255,0.1);
												border-radius: 3px;
												color: rgba(255,255,255,0.8);
												cursor: pointer;
											}
										</style>
										<div id="news_holder" class="date button" style="width:800px;">
											<?php include('ticker.php')?>
										</div>
</p>
                        <div style="width:100%; display:table; height:90px; margin-bottom:20px;margin-top: 100px;">
                        	<ul class="pravega_footer">
                            	<li style="margin-right: 60px;"><a class="" href="http://www.iisc.ernet.in"><img src="images/home/iisc.png" /></a></li>
                            	<li style="padding-top: 60px;"><a href="About.php">ABOUT US</a></li>
                            	<li style="padding-top: 60px;"><a href="sponsors.php">SPONSORS</a></li>
                            	<li style="padding-top: 60px;"><a href="contact.php">CONTACT US</a></li>
                            	<li style="margin-right: 60px;padding-top: 60px;"><a href="javascript:void(0)">HOSPITALITY</a></li>
                            	<li style="margin-right: 60px;padding-top: 40px;"><img src="images/home/social.png" usemap="#Map" />
                                  <map name="Map">
                                    <area shape="rect" coords="3,2,33,31" href="https://www.facebook.com/PravegaIISc?fref=ts" target="_blank">
                                    <area shape="rect" coords="41,2,72,33" href="http://www.youtube.com/user/IIScPravega" target="_blank">
                                    <area shape="rect" coords="81,3,110,31" href="https://plus.google.com/+PravegaOrg" target="_blank">
                                  </map>
                            	</li>
                            	<li style="padding-top: 30px;"><a href=""><img src="images/home/gplay.png" /></a></li>
                            	<li style="padding-top: 27px;"><a href=""><img src="images/home/wstore.png" /></a></li>
                            </ul>
                        </div>
				  </div>
                </div>
            </div>
        </div>
    </header>

	

    
    <!-- Map Section -->
   <!-- <div id="map"></div>-->

    <!-- Footer -->
    

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

      <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA"></script>


<script>

	function tick(){
		$('#ticker li:first').slideUp( function () { $(this).appendTo($('#ticker')).slideDown(); });
	}
	setInterval(function(){ tick () }, 5000);


</script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>
	<script src="js/ripple.js"></script>
	<script src="js/ticker.js"></script>
	
	
</body>

</html>
