<?php
	include('db_config.php');
	
	session_start();
	
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
			
	//EVENT DATA LOADING
	
	$rules_set = 1;
	
	$name = "Inquizitive";
	$db_event_name = $name;
	include("event_data_load.php");
	
?>
<!DOCTYPE HTML>

<html lang="en">

	<head>
		<title><?php echo $name; ?> | Pravega &ndash; the IISc Science, Tech and Cultural Fest</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<script type="text/javascript">
			if (top.location != location) { top.location.href = location.href; }
		</script>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700,900" rel="stylesheet" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.js"></script>
		<script src="js/jquery.scrollto.js"></script>
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

	<body class="left-sidebar" onload="<?php if($_SESSION['login'] == 1) echo "location.hash = 'register';";?> load_content();">
		<div id="mask"></div>
		<div id="full-picture" class="login-popup" style="padding: 30px;">
			<a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close"  style="margin-top: -48px"/></a>
			<img src="" id="full-size-image" style="vertical-align: middle; border-radius: 3px;"></img>
		</div>
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
					<span style="float:left; width:45%; text-align:left;">
						<a href="quizzes">Quizzes</a> > <?php echo '<a href="'.$file_name.'">'.$name.'</a>'; ?> </span>					
					
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
											<div class="3u" style="padding-left:65px;">
												
												<!-- Sidebar -->
													<div id="sidebar">
														<section class="is">
															<header>
																<h2><a href="tech_events">Events</a></h2>
															</header>
															
															<ul>
															<?php
																$subject_list=array("Math", "Physics", "Chemistry", "Biology", "Engineering", "Multi-Disciplinary", "Cultural", "Quizzes");
																
																for ($i=0; $i<sizeof($subject_list); $i++)
																{
																	echo '<li>';
																		 
																	echo '<a href="'.strtolower($subject_list[$i]).'">';
																	echo $subject_list[$i];
																	echo "</a>";
																	if ($subject_list[$i] == $subject_name)
																	{
																		echo "<ul style='margin-left:20px;'>";
																		for ($j=0; $j<sizeof($event_links); $j++)
																		{
																			echo "<li>";
																			if ($name == $subject_events[$j])
																				echo "<b>";
																				
																			echo '<a href="'.$event_links[$j].'">';
																			echo $subject_events[$j];
																			echo "</a>";
																			if ($name == $subject_events[$j])
																				echo "</b>";
																			echo "</li>";
																		}
																		echo "</ul>";
																	}
																}
															?>
															</ul>
														</section>
														
													</div>
												<!-- /Sidebar -->
												
											</div>
											<div class="9u skel-cell-mainContent">
												<!-- Content -->
													<div id="content">
														<article class="is is-post">
															<header class="style1">
																<h2><?php echo $name; ?></h2>
																
															</header>
															<?php
																if (isset($_SESSION['success']))
																{
															?>
																	<hr style="margin:1.5em 0em 1.5em 0em;">
																		<div style="text-align:center;"><h2>You have registered your team successfully.</h2></div>
																	<hr style="margin:1.5em 0em 1.5em 0em;"><br>
															<?php
																}
															?>		
															<div class="row">
																<div class="12u" align="center">
																	<h3><?php echo $oneline_desc; ?></h3>
																</div>
															</div>
															<div class="row">
																<div class="12u" style="text-align:center; border-top-style: 0px solid; padding-top: 0px; margin-top: 25px;" align="center">
																	<div style="width: 450px; margin:auto;cursor: pointer;" align="center">
																		<span id="desc_button" class="subject_nav_button" style="border-radius:5px 0px 0px 5px; border-right: 1px solid black;">Description</span>
																		<span id="rules_button" class="subject_nav_button" style="border-left: 0px solid; margin-left: -6px; border-right: 1px solid black;">Rules</span>
																		<span id="register_button" class="subject_nav_button" style="border-radius:0px 5px 5px 0px; margin-left: -6px; border-left: 1px solid black;">Register</span>
																	</div>
																</div>
															</div>
															
															<div class="row">
																<span id="register_content" style="display:none;">
																	<div align="center">
																		<h2 id="register">Register</h2>
																		<?php
																			if ($logged == 1 && $registered == 0)
																			{
																		?>
																			<form method="post" action="register_event.php" class="signin">
																			<input type="hidden" name="event_name" value="<?php echo $name;?>">
																			<table style="border-collapse:collapse;">
																			<tr>
																				<td style="padding-top:15px;"><h3>Team Member 1</h3></td>
																			</tr>
																			
																			<tr>
																				<td class="form_labels">Email Address:<div style="font-size:13px; margin-top:-7px;">(As registered here)</div></td>
																				<td><?php echo $_COOKIE['email']; if (isset($_SESSION['errors_activation1'])) echo '<br><span style="color: red; font-size:13px; margin-top:-7px;">(not activated)</span>'; else if (isset($_SESSION['errors_in_team1'])) echo '<br><span style="color: red;  font-size:13px; margin-top:-7px;">(already registered)</span>' ?><input name="email1" type="hidden" value="<?php echo $_COOKIE['email']; ?>"></td>
																			</tr>
																			
																			<tr>
																				<td style="padding-top:15px;"><h3>Team Member 2</h3></td>
																			</tr>
																			<tr>
																				<td class="form_labels">Email Address:<div style="font-size:13px; margin-top:-7px;">(As registered here)</div></td>
																				<td><input required autocomplete class="text <?php if (isset($_SESSION['errors_email2']) || isset($_SESSION['errors_activation2']) || isset($_SESSION['errors_in_team2']))echo "error";?>" type="email" name="email2" placeholder="Email Address<?php if ($_SESSION['errors_email2'] == 1) echo " not found, or duplicate."; else if ($_SESSION['errors_activation2'] == 1) echo " not activated."; else if (isset($_SESSION['errors_in_team2'])) echo " already registered."; ?>" <?php if ((!isset($_SESSION['errors_email2'])) && (!isset($_SESSION['errors_activation2'])) && (!isset($_SESSION['errors_in_team2']))) echo 'value="'. $_SESSION['email2']. '"';?>></td>
																			</tr>
																			
																			<tr>
																				<td style="text-align:center; padding-top:35px;" colspan="2">
																					<fieldset class="textbox">
																					<input class="button_modal textbox" style="display:inline-block; border:0px;" type="submit" value="Register">
																					</fieldset>
																				</td>
																			</tr>
																			</table>
																		</form>
																		<?php
																			}
																			elseif ($logged == 0)
																			{
																		?>
																			You need to be <a class="login-window" href="#login-box" onclick="document.getElementById('username').focus(); $.scrollTo(0, 400, {offset:50}, {easing:'swing'}); load_modal(this);">logged in</a> to register.
																		<?php
																			}
																			
																			else if ($registered == 1)
																				echo "You have already registered for this event.";
																		?>
																	</div>
																</span>
																<span id="desc" style="display:none;">
																	<img onclick="load_image(this); return false;"  style="cursor: pointer; position: relative; display: inline-block; width: 600px; left:50%; margin-left: -300px;" src="images/events/inquizitive.jpg" /><br><br>
																	<?php
																		for ($i=0; $i < sizeof($desc); $i++)
																		{
																			echo "<p>";
																			echo $desc[$i];
																			echo "</p>\r\n";
																		}
																	?>
																		
																	<p style="text-align:center;">
																		<a href="" class="button button-style1" id="big_register_button" onclick="big_reg_button(); return false;">Register now!</a>
																	</p>
																</span>
																<span id="rules_content" style="display:none;">
																
																	<h3 style="text-align:center;">Rules:</h3>
																	
																		<ol>
																			<?php
																				for ($i=0; $i < sizeof($rules); $i++)
																				{
																					echo "<li>";
																					echo $rules[$i];
																					echo "</li>\r\n";
																				}
																			?>
																		</ol>
																	
																</span>
																
																<div class="2u"></div>
																<section class="8u hyphenate" id="content_dynamic">
																	
																</section>
																	
																
																<div class="2u">
																</div>
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
	<script src="js/subj_nav.js"></script> 
	<?php
		session_destroy();
	?>
</html>