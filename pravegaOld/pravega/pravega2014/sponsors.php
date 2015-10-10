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
		<title>Sponsors | Pravega &ndash; the IISc Science, Tech and Cultural Fest</title>
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
																<h2>Sponsors</h2>
															</header>
															<div class="row">
																<h2 style="text-align:center;">Platinum Sponsor</h2>
																<section class="4u"></section>
																<div class="4u" style="text-align:center;">
																	<a href="http://www.mercedes-benz.co.in/" target="_blank">
																		<img src="images/logos/benz.png" width="80%" height="80%">
																	</a>
																</div>
																<section class="4u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Gold Sponsor</h2>
																<section class="4u"></section>
																<div class="4u" style="text-align:center; margin-top:10px;">
																	<a href="http://www.zeiss.co.in/" target="_blank">
																		<img src="images/logos/zeiss.png" width="70%" height="70%">
																	</a>
																</div>
																<section class="4u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Silver Sponsors</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<div class="row">
																		<section class="2u"></section>
																		<div class="4u" style="margin-right: 15px;">
																			<a href="http://www.boschindia.com/" target="_blank">
																				<img src="images/logos/bosch.png" width="300" style="padding-right:45px; vertical-align: middle;"></a>
																		</div>
																		<div class="4u" style="margin-left: 15px;">
																			<a href="http://www.india.basf.com/" target="_blank">
																				<img src="images/logos/basf.jpg" width="295" style="padding-left:45px; padding-right: 45px; vertical-align: middle;"></a>
																		</div>
																		<section class="2u"></section>
																	</div>
																	<br><br>
																	<div class="row">
																		<section class="2u"></section>
																		<div class="4u" style="margin-right: 15px;">	
																			<a href="http://idbi.com/" target="_blank">
																				<img src="images/logos/idbi.png" width="290" style="margin-left: -35px; padding-left:45px; vertical-align: middle;"></a>
																		</div>
																		<section class="4u">
																			<a href="http://siemens.com/" target="_blank">
																				<img src="images/logos/siemens.png" width="290" style="margin-left: -10px; padding-left:45px; vertical-align: middle;"></a>
																		</section>
																	</div>
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Institutional Associates</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="http://www.india.diplo.de/Vertretung/indien/en/02__Bangalore/Bangalore.html" target="_blank">
																		<img src="images/logos/german_consulate.gif" style="padding-right:45px; vertical-align: middle;"></a>
																	<a href="http://www.swissnexindia.org/" target="_blank">
																		<img src="images/logos/swissnex.png" width="325" style="padding-left:45px; vertical-align: middle;"></a>
																	<a href="http://www.daaddelhi.org/" target="_blank">
																		<img src="images/logos/daad.png" width="325" style="padding-left:45px; vertical-align: middle;"></a>
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Print Media Partner</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="http://www.thehindu.com/" target="_blank">
																		<img src="images/logos/the_hindu.png" style="vertical-align: middle;"></a>
												
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															
															<div class="row">
																<h2 style="text-align:center;">Media Partners</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="https://www.facebook.com/thetestament2012" target="_blank">
																		<img src="images/logos/testament.jpg" width="150" style="vertical-align: middle;"></a>
																	<div class="people_desc" style="font-style: normal; font-size:19px;">
																		<a href="https://www.facebook.com/thetestament2012" target="_blank">The Testament</a>
																	</div>
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Online Education Partner</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="http://www.oneindia.in/" target="_blank">
																		<img src="images/logos/one_india.png" width="300" style="margin-left:40px; vertical-align: middle;"></a>
												
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Event Partners</h2>
																<section class="2u"></section>
																<div class="4u" style="text-align:center; vertical-align: middle; margin-top:30px;">
																	<a href="http://www.ablab.in/" target="_blank">
																		<img src="images/logos/ablab-solutions.png" width="300" style="vertical-align: middle; padding-right:15px;"></a><br>
																		<a href="connect_the_dots" style="text-decoration: none;">(Connect the Dots)</a>
																</div>
																<div class="4u" style="text-align:center; vertical-align: middle; ">
																	<a href="http://www.d-sil.com/" target="_blank">
																		<img src="images/logos/didactic_systems.png" width="200" style="vertical-align: middle; padding-right:15px;"></a><br>
																		<a href="experimental_physics" style="text-decoration: none;">(Experimental Physics)</a>
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Online Transaction Partner</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="http://explara.com/" target="_blank">
																		<img src="images/logos/explara.png" style="padding-top: 15px; vertical-align: middle;"></a>
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Recharge Partner</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="http://paytm.com/" target="_blank">
																		<img src="images/logos/paytm.png" width="300" style="padding-top: 15px; vertical-align: middle;"></a>
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Banking Partner</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="www.hdfcbank.com/?" target="_blank">
																		<img src="images/logos/hdfc.png" width="300" style="padding-top: 15px; vertical-align: middle;"></a>
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Digital Production Partner</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="http://totalproductions.net/" target="_blank">
																		<img src="images/logos/total_productions.png" width="300" style="padding-top: 15px; vertical-align: middle;"></a>
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Merchandise Partner</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="http://twenteez.com/" target="_blank">
																		<img src="images/logos/twenteez_logo.png" style="vertical-align: middle;"></a>
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Travel Partner</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="http://uber.com/" target="_blank">
																		<img src="images/logos/uber.png" style="width: 300px; vertical-align: middle;"></a>
																</div>
																<section class="2u"></section>
															</div>
															<hr>
															
															<div class="row">
																<section class="1u"></section>
																<div class="10u" style="text-align:center;">
																<h2 style="text-align:center;">Outreach Sponsors</h2>
																<br>
																	<div class="row">
																		<section class="2u"></section>
																		<div class="4u">
																			<a href="http://www.ablab.in/" target="_blank">
																				<img src="images/logos/ablab-solutions.png" width="300" style="padding-right:15px;"></a>
																		</div>
																		<div class="4u">
																			<a href="http://www.avianaerospace.com/?/" target="_blank">
																				<img src="images/logos/avian_aerospace.png" width="300" style="padding-left:15px;">
																			</a>
																		</div>
																		<section class="2u"></section>
																	</div>
																	<div class="row">
																		<section class="2u"></section>
																		<div class="4u">
																			<a href="http://www.eisystems.in/" target="_blank">
																				<img src="images/logos/eisystems.png" width="300"></a>
																		</div>
																		
																		<div class="4u">
																			<a href="http://robo-galaxy.com/" target="_blank">
																				<img src="images/logos/robogalaxy.png" style="margin-top:0px; vertical-align:middle;"></a>
																			</a>
																		</div>
																		<section class="2u"></section>
																	</div>
																	
																	<div class="row">
																		<section class="2u"></section>
																		<div class="4u">
																			<a href="http://www.codeinstruct.com/" target="_blank">
																				<img src="images/logos/code_instruct.png" width="250"></a>
																		</div>
																		
																		<div class="4u">
																			
																		</div>
																		<section class="2u"></section>
																	</div>
																	
																</div>
																<section class="1u"></section>
															</div>
															<hr>
															
															<div class="row">
																<h2 style="text-align:center;">Online Knowledge Partner</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="http://www.xquizit.org" target="_blank">
																		<img src="images/logos/xquizit.png" style="vertical-align: middle; width:200px;"></a>
												
																</div>
																<section class="2u"></section>
															</div>
															
															<hr style="margin-top:3em;">
															<div class="row">
																<h2 style="text-align:center;">Health Partner</h2>
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																	<a href="http://www.manipalhospitals.com/" target="_blank">
																		<img src="images/logos/manipal.png" width="290" style="padding-left:25px; vertical-align: middle;"></a>
																	<br>Manipal Hospitals (Malleshwaram)
																</div>
																<section class="2u"></section>
															</div>
										
															
															<hr style="margin-top:3em;">
															<div class="row">
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																<h2 style="text-align:center;">Online Publicity Partner</h2>
																	<a href="http://gonitsora.com/" target="_blank">
																		<img src="images/logos/gonitsora.png" width="500" style="padding-right:15px;"></a>
																	
																</div>
																<section class="2u"></section>
															</div>
															
															<hr style="margin-top:3em;">
															<div class="row">
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																<h2 style="text-align:center;">Online Programming Partner</h2>
																	<a href="http://codechef.com/" target="_blank">
																		<img src="images/logos/codechef.png" width="400" style="padding-right:15px;"></a>
																	
																</div>
																<section class="2u"></section>
															</div>
															
															<hr style="margin-top:3em;">
															<div class="row">
																<section class="2u"></section>
																<div class="8u" style="text-align:center;">
																<h2 style="text-align:center;">Online Competitions Partner</h2>
																	<a href="http://dare2compete.com/" target="_blank">
																		<img src="images/logos/dare2compete.png" width="300" style="padding-right:15px;"></a>
																	
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
</html>