<?php
	include('db_config.php');
	
	if (isset($_COOKIE['email']))
	{
		$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
		
		$query = "SELECT hash FROM sessions WHERE email=?";
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "s", $_COOKIE['email']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $result);
		mysqli_stmt_fetch($stmt);

		if ($result == $_COOKIE['hash'])
		{
			mysqli_stmt_close($stmt);

			$logged = 1;
			$query = "UPDATE sessions SET expiry=? WHERE email=?";
			
			$expiry = time() + 3600;
			
			$stmt = mysqli_prepare($link, $query);
			mysqli_stmt_bind_param($stmt, "is", $expiry, $_COOKIE['email']);
			mysqli_stmt_execute($stmt);
			
			setcookie("email", $_COOKIE['email'], $expiry);
			setcookie("name", $_COOKIE['name'], $expiry);
			setcookie("hash", $_COOKIE['hash'], $expiry);
		}
		
		else $logged = 0;
	}
		else
			$logged = 0;
?>
<!DOCTYPE HTML>

<html lang="en">

	<head>
		<title>Exhibitions | Pravega &ndash; the IISc Science, Tech and Cultural Fest</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<script type="text/javascript">
			if (top.location != location) { top.location.href = location.href; }
		</script>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700,900" rel="stylesheet" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		
		
		<script src="js/jquery.poshytip.min.js"></script>  
		<script src="js/poshytip_init.js"></script>  
		<link rel="stylesheet" href="js/poshytip/tip-twitter.css" />
		
		<script src="js/modal.js"></script>
		<link rel="stylesheet" href="css/modal.css" />
		
		<script src="js/hyphenate.js"></script>
		<script src="js/custom.js"></script> 
		<script src="js/ga.js"></script> 
	</head>
	<body class="no-sidebar">
		
		<div id="mask"></div>
		
		<div id="login-box" class="login-popup">
			<a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
			  <div class="left_half">
				  <form method="post" class="signin" action="login.php">
						<fieldset class="textbox">
						<label class="username">
						<span>Email Address</span>
						<input id="username" name="email" value="" type="text" autofocus autocomplete="on" placeholder="Email Address">
						</label>
						
						<label class="password">
						<span>Password</span>
						<input id="password" name="password" value="" type="password" placeholder="Password">
						</label>
						
						<span style="text-align:center;">
							<input class="button_modal" type="submit" value="Sign in">
						</span>
						<br>
						<span style="text-align:center;">
						<a class="forgot" href="forgot_pass.php">Forgot your password?</a>
						</span>
						</fieldset>
				  </form>
				</div>
				 
				 <div class="right_half">
					<p style="color:#dadada; font-weight:100;">Don't have an account?</span>
					<form class="signin" action="registration_form.php">
						<fieldset class="textbox">
						<input class="button_modal" type="submit" value="Register">
						</fieldset>
					</form>
				</div>
		</div>

		<!-- Header Wrapper -->
		
			<a href="http://www.iisc.ernet.in"><img src="images/iisc_logo.png" style="position:absolute; margin-top:32px; margin-left:25px; left:0; z-index:1;" height="50px"></a>
			

			<div id="header-wrapper" class="wrapper" style="background-size:cover;">
				
				<div class="not-mobile" id="profile-bar">
					<span id="countdown" style="position: absolute; left: 50%; margin-left:-256px; font-weight: 700; ; color: rgba(255,255,255,0.8)">
						<?php
							$date = date("j");
							if ($date < 19 && $date > 20)
								echo "Just " .(31-$date) ." day to go!";
							else
								echo "";
						?>
					</span>
					<?php
						if ($logged == 1)
						{
							echo "<a href='profile'>".$_COOKIE['name']."</a>";
							echo "<span style='margin-left:0.75em; margin-right:0.75em'>|</span><a href='logout'>Logout</a>";
						}
						else echo '<a class="login-window" href="#login-box">Login/Register</a>';
					?>
				</div>
				
				<div class="container">
					<div class="row">
						<div class="12u">
						
							<!-- Header -->
								<div id="header">
																
									<div id="tiles">
									<div id="tile-firstrow">
										<a href="tech_events"><div id="tile1" class="the_tile" title="Technical Events"></div></a>
										<a href="cultural"><div id="tile2" class="the_tile" title="Cultural Events"></div></a>
										<a href="quizzes"><div id="tile3" class="the_tile" title="Quizzes"></div></a>
									</div>
									<span>
										<a href="http://pravega.org"><img id="pravega_logo" src="images/pravega_logo_noglow<?php if (mt_rand(1, 20) == 10) echo "_sanskrit"; ?>.png" draggable="false" style="-moz-user-select: none; -webkit-user-select: none; user-select: none; "></a>
									</span>
									<div id="tile-firstmobilerow">
										<a href="tech_events"><div id="tile1" class="the_tile" title="Technical Events"></div></a>
										<a href="cultural"><div id="tile2" class="the_tile" title="Cultural Events"></div></a>
										<a href="quizzes"><div id="tile3" class="the_tile" title="Quizzes"></div></a>
									</div>
									<div  style="display: inline-block;">
										<a href="speakers"><div id="tile4" class="the_tile" title="Guest Speakers"></div></a>
										<a href="exhibitions"><div id="tile5" class="the_tile" title="Exhibitions and Workshops"></div></a>
										<a href="pronights"><div id="tile6" class="the_tile" title="Pro-Nights"></div></a>
									</div>
									</div>
									
									<!-- Nav -->
										<nav id="nav">
										<ul>
											<li class="current_page_item"><a href="about_pravega">About</a>
												<ul>
													<li><a href="about_pravega">About Pravega</a></li>
													<li><a href="about_iisc">About IIS<div style="text-transform:lowercase; display:inline;">c</div></a></li>
													<li><a href="advisory">Advisory Committee</a></li>
													<li><a href="organizing_team">Organizing Team</a></li>
													<li><a href="faq">FAQ</a></li>
												</ul>	
											</li>
											<li><a href="sponsors">Sponsors</a></li>
											<li><a href="hospitality">Hospitality</a></li>
											<li><a href="schedule">Schedule</a></li>
											<li><a href="contact">Contact</a></li>
										</ul>
										</nav>
									<!-- /Nav -->

								</div>
							<!-- /Header -->

						</div>
					</div>
				</div>
				<div id="social-media" class="only-desktop">
					<a target="_blank" href="https://www.facebook.com/PravegaIISc"><div class="sm-icon" id="fb"></div></a>
					<a target="_blank" href="https://plus.google.com/114655802356939440546"><div class="sm-icon" id="gplus"></div></a>
					<a target="_blank" href="http://twitter.com/PravegaIISc"><div class="sm-icon" id="twitter"></div></a>
				</div>
			</div>
		<!-- /Header Wrapper -->
		
		<!-- Main Wrapper -->
			<div class="wrapper wrapper-style2">
				
				<div class="container">
					<div class="row">
						<div class="12u">
							
							<!-- Main -->
								<div id="main">
									<div>
										<div class="row">
											<div class="12u skel-cell-mainContent">
											
												<!-- Content -->
													<div id="content">
														<article class="is is-post">
															<header class="style1">
																<h2>Exhibitions & Workshops</h2>
																
															</header>
															<div class="row">
																<div class="12u" style="text-align:center; border-top-style: 0px solid; padding-top: 0px; margin-top: 25px;" align="center">
																	<div style="width: 450px; margin:auto;cursor: pointer; margin-bottom: 15px;" align="center">
																		<span id="workshops_button" class="subject_nav_button" style="border-radius:5px 0px 0px 5px; border-right: 1px solid black;">Workshops</span>
																		<span id="exhibitions_button" class="subject_nav_button" style="border-radius:0px 5px 5px 0px; margin-left: -6px; border-left: 1px solid black;">Exhibitions</span>
																	</div>
																</div>
															</div>
															<div class="row" id="content_dynamic">
																
															</div>
															
															<div style="display: none;" id="workshops">
																<section class="1u"></section>
																	<div class="5u hyphenate people_desc" style="text-align:center; padding-right: 10px; border-right-style: solid; border-right-width: 1px; font-style:normal; font-size:18px;">
																		<h2>Workshops in IISc</h2><br>
																			<a href="mobile_making">
																			<img src="images/logos/mobile_building.jpg" width="250" style="padding-left:15px;"></a>
																			<br>
																			<a href="mobile_making">Mobile Making</a>
																			<br>
																			<br>
																			<br>
																			
																			<a href="rc_cars">
																			<img src="images/logos/rc_cars.png" width="300" style="padding-left:15px;"></a>
																			<br>
																			<a href="rc_cars">RC Cars</a>
																			<br>
																			<br>
																			<br>
																			
																			<a href="satellite">
																			<img src="images/events/satellite_workshop.png" width="300" style="padding-left:15px;"></a>
																			<br>
																			<a href="satellite">Satellite Designing and Launching</a>
																			<br>
																			<br>
																			<br>
																			
																			<a href="flying_machine_nano">
																			<img src="images/events/flying_machine_nano.jpg" width="300" style="padding-left:15px;"></a>
																			<br>
																			<a href="flying_machine_nano">Flying Machine Nano</a>
																			<br>
																			<br>
																			<br>
																			
																			<a href="ggd_workshop">
																			<img src="images/events/ggd_workshop.jpg" width="300" style="padding-left:15px;"></a>
																			<br>
																			<a href="ggd_workshop">Gesture Game Development</a>
																			<br>
																			<br>
																			<br>
																			
																			<a href="cloud_computing_workshop">
																			<img src="images/events/cloud_computing.png" width="250" style="padding-left:15px;"></a>
																			<br>
																			<a href="cloud_computing_workshop">Cloud Computing & Google App Engine</a>
																			<br>
																			<br>
																			<br>

																	</div>
																	<div class="5u hyphenate people_desc" style="padding-left: 0px; text-align:center; font-style:normal; font-size:18px;">
																		<h2>Outreach Workshops</h2><br>
																		
																		<a href="http://www.avianworkshops.com/carnival.html" target="_blank">
																			<img src="images/logos/aerocarnival.jpg" width="300" style="padding-left:15px;"></a>
																			<br>
																			<!--<a href="http://www.ablab.in/" target="_blank"> -->
																				<a href="http://www.avianworkshops.com/carnival.html" target="_blank">Aero Carnival</a>
																			<br>
																			<br>
																			
																		<a href="http://ablab.in/pravegyan14/" target="_blank">
																			<img src="images/logos/pravegyaan.png" width="300" style="padding-left:15px;"></a>
																			<br>
																			<a href="http://ablab.in/pravegyan14/" target="_blank">Pravegyaan</a>
																			<br>
																			<br>
																		<a href="mechfest">
																			<img src="images/logos/eisystems.png" width="300" style="padding-left:15px;"></a>
																			<br>
																			<a href="mechfest">EI Systems Mechfest</a>
																			<br>
																			<br>
																			<br>
																		<a href="http://www.codeinstruct.com/android-app-challenge" target="_blank">
																			<img src="images/logos/code_instruct.png" width="250" style="padding-left:15px;"></a>
																			<br>
																			<a href="http://www.codeinstruct.com/android-app-challenge" target="_blank">Code Instruct</a>
																			<br>
																			<br>
																			<br>
																		<a href="http://robo-galaxy.com/" target="_blank">
																			<img src="images/logos/robogalaxy.png" style="padding-left:15px;"></a>
																			<br>
																			<a href="http://robo-galaxy.com/" target="_blank">Robogalaxy</a>
																		
																	</div>
																	<section class="1u"></section>
															</div>
															<div style="display:none;" id="exhibitions">
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<img src="images/exhibition1.jpg" style="display: inline-block;"><br>
																	<p>Motomatic hybrid transmission (MHT) is an indigenously developed hybrid drive solution suitable for Hybrid Electric Vehicles for Indian scenario. This concept is based on implementation of 'Intelligent Driver Logic' programmed in our vehicle to achieve maximum mileage benefits. Heart of this concept is patented an electric CVT which is all geared transmission and hence is very efficient. This transmission concept elegantly integrates hybrid modes like Series mode, Power-split mode, Parallel mode, Mechanical drive and Electric drive mode. The Motomatic CVT ensures that engine runs under most efficient operating conditions in all circumstances, hence disconnects the driver skill on vehicle mileage to larger extent.</p>
																</div>
																<section class="2u"></section>
															</div>
														</article>
														
													</div>
												<!-- /Content -->
											
											</div>
										</div>
									</div>
								</div>
							<!-- /Main -->
							
						</div>
					</div>
				</div>
			</div>
		<!-- /Main Wrapper -->
		
	</body>
	<script>
		var workshops_button = document.getElementById("workshops_button");
		var exhibitions_button = document.getElementById("exhibitions_button");

		var workshops = document.getElementById("workshops").innerHTML;
		var exhibitions = document.getElementById("exhibitions").innerHTML;
		var content = document.getElementById("content_dynamic");

		var current = null;

		workshops_button.onclick = function(){
			if (current != "#workshops")
			{
				content.innerHTML = workshops;
				history.pushState(null, "", "#workshops");
				current = "#workshops";
				workshops_button.classList.add("selected");
				
				exhibitions_button.classList.remove("selected");
			}
		};

		exhibitions_button.onclick = function(){
			if (current != "#exhibitions")
			{
				content.innerHTML = exhibitions;
				history.pushState(null, "", "#exhibitions");
				current = "#exhibitions";
				exhibitions_button.classList.add("selected");
				
				workshops_button.classList.remove("selected");
			}
		};

		window.onpopstate = function(event) {load_content()};

		function load_content(hash)
		{
			
			if (hash == null)
			{
				hash = location.hash;
			}
			
			else hash = "#" + hash;

			if (hash != current)
			{
				switch(hash)
				{
					case '#workshops':
						content.innerHTML = workshops;
						current = "#workshops";
						
						workshops_button.classList.add("selected");
						exhibitions_button.classList.remove("selected");
						break;
					
					case '#exhibitions':
						content.innerHTML = exhibitions;
						current = "#exhibitions";
						
						workshops_button.classList.remove("selected");
						exhibitions_button.classList.add("selected");
						break;
						
					case '#login-box':
						if (current == null)
						{
							content.innerHTML = workshops;
							current = "#workshops";
							
							workshops_button.classList.add("selected");
							exhibitions_button.classList.remove("selected");
							register_button.classList.remove("selected");
						}
						break;
						
					default:
						content.innerHTML = workshops;
						current = "#workshops";
						
						workshops_button.classList.add("selected");
						exhibitions_button.classList.remove("selected");
						break;
				}
			}
		}
</script>
</html>