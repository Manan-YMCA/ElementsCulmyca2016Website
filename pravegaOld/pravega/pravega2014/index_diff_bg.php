<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Pravega &ndash; The IISc Science, Tech, and Cultural Fest</title>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700,900" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrollto.js"></script>
		<script src="js/jquery.dropotron.home.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/jquery.peelback.js"></script>
		
		<script src="js/modal.js"></script>
		<link rel="stylesheet" href="css/modal.css" />
		
		<script src="js/change_bg.js"></script>
		
		<script src="js/jquery.poshytip.min.js"></script>  
		<script src="js/poshytip_init.js"></script>  
		<link rel="stylesheet" href="js/poshytip/tip-twitter.css" />
		
		<script>
		$(function() {
			$('body').peelback({
				adImage  : 'images/corner.png',
				peelImage  : 'images/peel-image.png',
				clickURL : '',
				smallSize: 50,
				bigSize: 600,
				gaTrack  : false,
				gaLabel  : 'Updates!',
				autoAnimate: true
			});
			
			
			$('#title2').click(function(){
				if ($(window).width() > 360)
				{
					$.scrollTo('#intro-wrapper', 400, {offset:50}, {easing:'swing'});
				}
			});
			
		});

		</script>
  
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
	</head>
	
	<body class="homepage">

		<div id="mask"></div>
		
		<div id="login-box" class="login-popup">
			<a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
			  <form method="post" class="signin" action="database_test/login.php">
					<fieldset class="textbox">
					<label class="username">
					<span>Email Address</span>
					<input id="username" name="email" value="" type="text" autocomplete="on" placeholder="Email Address">
					</label>
					
					<label class="password">
					<span>Password</span>
					<input id="password" name="password" value="" type="password" placeholder="Password">
					</label>
					
					<input class="button_modal" type="submit" value="Sign in">
					
					<p>
					<a class="forgot" href="#">Forgot your password?</a>
					</p>
					</fieldset>
			  </form>
			</div>

	<canvas id="canvas" style="display:none; z-index:30; position:absolute;"></canvas>
		<!-- Header Wrapper -->
			<div id="header-wrapper" class="wrapper">
				<div id="overlay0" class="overlay" style="background: url('images/vdot.png');"></div>
				<div id="overlay1" class="overlay hide" style="background: url('images/tile1.png');"></div>
				<div id="overlay2" class="overlay hide" style="background: url('images/tile2.png');"></div>
				<div id="overlay3" class="overlay hide" style="background: url('images/tile3.png');"></div>
				<div id="overlay4" class="overlay hide" style="background: url('images/tile4.png');"></div>
				<div id="overlay5" class="overlay hide" style="background: url('images/tile5.png');"></div>
				<div id="overlay6" class="overlay hide" style="background: url('images/tile6.png');"></div>
				
				<div class="not-mobile" id="profile-bar">
					<?php
						if (isset($_SESSION['email']))
						{
							setcookie(session_name(), session_id(), time()+60, "/");
							echo "<a href='database_test/profile.php'>".$_SESSION['name']."</a>";
							echo "<span style='margin-left:0.75em; margin-right:0.75em'>|</span><a href='database_test/logout.php'>Logout</a>";
						}
						else echo '<a class="login-window" href="#login-box">Login/Register</a>';
					?>
				</div>
				
				<div class="container">
					<div class="row">
						<div class="12u" style="height:100%;">
						
						<!-- Header -->
							<div id="header">
							
							<div id="presenters">
								<a href="http://www.iisc.ernet.in">
									<div id="iisc_link">
									</div>
								<a>
							</div>
							
								<!-- Logo -->
									<div id="logo">
										<a id="logo_link" href="http://pravega.org">
											<img id="pravega_logo" src="images/pravega_logo_noglow.png" draggable="false" style="-moz-user-select: none; -webkit-user-select: none; user-select: none; ">
											<img id="pravega_logo_nodot" src="images/pravega_logo_noglow_nodot.png"  draggable="false" style="-moz-user-select: none; -webkit-user-select: none; user-select: none; ">
										</a>
										<span id="byline" class="byline">science, tech, and cultural fest</span>
										<div id="date" class="date">January 31&ndash;February 2, 2014</div>
									</div>
								<!-- /Logo -->
								
								<div id="tiles">
									<div style="display: inline-block;">
										<a href="tech_events.html"><div id="tile1" class="the_tile" title="Technical Events"></div></a>
										<a href="cultural.html"><div id="tile2" class="the_tile" title="Cultural Events"></div></a>
										<a href="quizzes.html"><div id="tile3" class="the_tile" title="Quizzes"></div></a>
									</div><br class="only-mobile">
									<div  style="display: inline-block;">
										<a href="speakers.html"><div id="tile4" class="the_tile" title="Guest Speakers"></div></a>
										<a href="exhibitions.html"><div id="tile5" class="the_tile" title="Exhibitions and Workshops"></div></a>
										<a href="pronights.html"><div id="tile6" class="the_tile" title="Pro-Nights"></div></a>
									</div>
								</div>
								
								<!-- Nav -->
										<nav id="nav">
										<ul>
											<li class="current_page_item"><a href="about_pravega.html">About</a>
												<ul>
													<li><a href="about_pravega.html">About Pravega</a></li>
													<li><a href="about_iisc.html">About IISc</a></li>
													<li><a href="committees.html">Organizing Committee</a></li>
													<li><a href="faq.html">FAQ</a></li>
												</ul>	
																			
											</li>
											<!--<li>
												<span>Events</span>
												<ul>
													<li><a href="#">Biology</a></li>
													<li><a href="#">Chemistry</a></li>
													<li><a href="#">Engineering</a></li>
													<li><a href="#">Mathematics</a></li>
													<li><a href="#">Physics</a></li>
													<li><a href="#">Multi-Disciplinary</a></li>
													<li><a href="#">Cultural</a></li>
												</ul>-->
											</li>
											<li><a href="sponsors.html">Sponsors</a></li>
											<li><a href="hospitality.html">Hospitality</a></li>
											<li><a href="contact2.html">Contact</a></li>
										</ul>
										</nav>
									<!-- /Nav -->
								
							</div>
						<!-- /Header -->
							
						</div>
					</div>
				</div>
				
				<div id="social-media" class="mobile-hide">
					<a target="_blank" href="http://facebook.com/PravegaIISc"><div class="sm-icon" id="fb"></div></a>
					<a target="_blank" href="https://plus.google.com/114655802356939440546"><div class="sm-icon" id="gplus"></div></a>
					<a target="_blank" href="http://twitter.com/PravegaIISc"><div class="sm-icon" id="twitter"></div></a>
				</div>
			</div>
		<!-- /Header Wrapper -->
		
		<!-- Intro Wrapper -->
			<div id="intro-wrapper" class="wrapper wrapper-style1">
				<div class="title" id="title2">
				<span id="caret_anim" style="float:left;"><img src="images/caret_down.png" height="11" width="18"></span>
				Welcome<span id="caret_anim"><img src="images/caret_down.png" height="11" width="18"></span></div>
				<div class="container">
					<div class="row">
						<div class="12u">
							
							<!-- Intro -->
								<section id="intro">
									<p class="style2">
										<span style="font-weight:100;">Pravega is IISc's three day <br class="mobile-hide" />Science, Tech, and Cultural fest,<br class="mobile-hide" /></span>
										this January 31st&ndash;February 2nd.
									</p>
									<p class="style2">
										<span style="font-size:0.75em">Presented by</span>
										<img id="iisc_logo" src="images/iisc_logo.png" height="140px" width="339px">
										<span style="font-weight:100; line-height:1em; display:inline;"><br/>India's premier research institution.</span>
									</p>
									
									<!--
									<p class="style3">Mauris tellus lacus, tincidunt eget mattis at, laoreet vel velit. 
									Aliquam diam ante, aliquet sit amet vulputate lorem at placerat at nisl. 
									Maecenas et gravida ligula sed lacus euismod tincidunt nullam eget justo orci.</p>
									-->
									
								</section>
							<!-- /Intro -->
							
						</div>
					</div>
				</div>
			</div>
		<!-- /Intro Wrapper -->
		
		
		
		<!-- Highlights Wrapper 
			<div class="wrapper wrapper-style3">
				<div class="title" id="events" onclick="$.scrollTo( '#events', 400, {easing:'swing'});">The Events</div>
				<div class="container">
					<div class="row">
						<div class="12u">
							

								<div id="highlights">
									<div>
										<div class="row">
											<div class="4u">
												<section class="highlight highlight-one">
													<a href="http://fav.me/d59i3b3" class="image image-full"><img src="images/pic02.jpg" alt="" /></a>
													<h3><a href="#">Publish or Perish</a></h3>
													<p>Eget mattis at, laoreet vel amet sed velit aliquam diam ante, dolor aliquet sit amet vulputate mattis amet laoreet lorem.</p>
													<ul class="actions">
														<li><a href="#" class="button button-style1">Learn More</a></li>
													</ul>
												</section>
											</div>
											<div class="4u">
												<section class="highlight highlight-two">
													<a href="http://fav.me/d4tqyby" class="image image-full"><img src="images/pic03.jpg" alt="" /></a>
													<h3><a href="#">Apocalypse Now!</a></h3>
													<p>Eget mattis at, laoreet vel amet sed velit aliquam diam ante, dolor aliquet sit amet vulputate mattis amet laoreet lorem.</p>
													<ul class="actions">
														<li><a href="#" class="button button-style1">Learn More</a></li>
													</ul>
												</section>
											</div>
											<div class="4u">
												<section class="highlight highlight-three">
													<a href="http://fav.me/d5w2dot" class="image image-full"><img src="images/pic04.jpg" alt="" /></a>
													<h3><a href="#">The Pravega Science Quiz</a></h3>
													<p>Eget mattis at, laoreet vel amet sed velit aliquam diam ante, dolor aliquet sit amet vulputate mattis amet laoreet lorem.</p>
													<ul class="actions">
														<li><a href="#" class="button button-style1">Learn More</a></li>
													</ul>
												</section>
											</div>
											
										</div>
									</div>
								</div>

							
						</div>
					</div>
				</div>
			</div>
		<!-- /Highlights Wrapper -->

		

	</body>
	
<script src="js/pong.js"></script>
</html>