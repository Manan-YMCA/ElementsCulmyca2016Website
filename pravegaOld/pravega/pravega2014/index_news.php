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
<html>
	<head>
		<title>Pravega &ndash; The IISc Science, Tech, and Cultural Fest</title>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<script type="text/javascript">
			if (top.location != location) { top.location.href = location.href; }
		</script>
		<script src="js/jquery.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/jquery.dropotron.home.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
		

		<link rel="stylesheet" href="js/poshytip/tip-twitter.css" />
		
		<script>
		$(function() {
			$('body').peelback({
				adImage  : 'images/corner.png',
				peelImage  : 'images/peel-image.png',
				clickURL : 'tech_events',
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
		<script src="js/ga.js"></script> 
	</head>
	
	<body class="homepage">

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
						
						<label class="password">
						<span style="text-align: center; vertical-align: bottom;"><input type="checkbox" value="hi" style="width:auto; vertical-align: middle;">Remember me</span>
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
					<span id="countdown" style="position:  absolute; left: 50%; color: rgba(255,255,255,0.8)"></span>					
					<?php
						if ($logged == 1)
						{
							echo "<a href='profile'>".$_COOKIE['name']."</a>";
							echo "<span style='margin-left:0.75em; margin-right:0.75em'>|</span><a href='logout'>Logout</a>";
						}
						else echo '<a class="login-window" href="#login-box">Login/Register</a>';
					?>
					<script>
						var countdown = document.getElementById("countdown");
						var the_date = new Date();
						the_date = the_date.getDate();
						countdown.innerHTML = "Just ";
						countdown.innerHTML += 31 - the_date + " day to go!";
					</script>
				</div>
				<div class="container" style="height:auto;">
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
												width: 600px;
												margin-left: -300px;
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
												margin-top: 11px;
												overflow: hidden;
												height: 30px;
												width: 600px;
												position: relative;
												display: inline-block;
												background: rgba(255,255,255,0.1);
												border-radius: 3px;
												color: rgba(255,255,255,0.8);
												cursor: pointer;
											}
										</style>
										
									
										<div id="news_holder" class="date" onclick="document.location = 'news';">
											<?php 
												$xml = simplexml_load_file('news.xml');
												$path = "/news_items/news";
												$result = $xml->xpath($path);
											
												for ($i=0; $i < sizeof($result); $i++)
												{
													if ($i != 0)
														echo '<div name="news" class="ticker ticker_bottom">';
													else echo '<div name="news" class="ticker ticker_visible">';
													echo $result[$i];
													echo '</div>';
												}
											?>
										</div>
										
										
										<script>
											news = document.getElementsByName("news");
											current = 0;
											
											function update_news()
											{	
												news[current].classList.remove("ticker_visible");
												news[current].classList.add("ticker_top");
												news[(current+1)%news.length].classList.remove("ticker_bottom");
												news[(current+1)%news.length].classList.add("ticker_visible");
												setTimeout(function(){news[current].classList.remove("ticker_top"); news[current].classList.add('ticker_bottom'); current = (current + 1) % news.length;},1000);
											}
											
											var the_timeout = setInterval(function() {update_news()}, 5000);
											
											document.getElementById("news_holder").onmouseover = function(){console.log("hi");clearInterval(the_timeout)};
											document.getElementById("news_holder").onmouseout = function(){the_timeout = setInterval(function() {update_news()}, 5000)};
										</script>
									</div>
								<!-- /Logo -->
								
								<div id="tiles">
									<div style="display: inline-block;">
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
				New Events!<span id="caret_anim"><img src="images/caret_down.png" height="11" width="18"></span></div>
				<div class="container">
					<div class="row">
						<div class="12u">
							
							<!-- Intro -->
								<section id="intro" style="margin-top: 25px;">
									<p class="style2">
									<a href="science_slam">
										<img style="position: relative; display: inline; width:864px; height:610px; border-radius:2px; box-shadow: 0px 0px 20px white;" src="images/science_slam_poster.png" /></a>
								</section>
							<!-- /Intro -->
							
						</div>
					</div>
				</div>
			</div>
		<!-- /Intro Wrapper -->
	</body>
	
<script src="js/jquery.scrollto.js"></script>
<script src="js/jquery.peelback.js"></script>

<script src="js/modal.js"></script>
<link rel="stylesheet" href="css/modal.css" />

<script src="js/change_bg.js"></script>

<script src="js/jquery.poshytip.min.js"></script>  
<script src="js/poshytip_init.js"></script>  
<script src="js/pong.js"></script>
</html>