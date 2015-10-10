<?php
	session_start();

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
			
			mysqli_stmt_reset($stmt);
			$query = "SELECT city, codechef, mobile, college FROM usernames WHERE email=?";
			$stmt = mysqli_prepare($link, $query);
			mysqli_stmt_bind_param($stmt, "s", $_COOKIE['email']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $city, $codechef, $mobile, $college);
			mysqli_stmt_fetch($stmt);
		}
		
		else $logged = 0;
	}
		else
			$logged = 0;
?>

<html lang="en">

	<head>
		<title>Update Profile | Pravega &ndash; the IISc Science, Tech and Cultural Fest</title>
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
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		
		<script src="js/jquery.poshytip.min.js"></script>  
		<script src="js/poshytip_init.js"></script>  
		<link rel="stylesheet" href="js/poshytip/tip-twitter.css" />
		
		<script src="js/modal.js"></script>
		<link rel="stylesheet" href="css/modal.css" />
		
		<script src="js/hyphenate.js"></script> 
		
		<script type="text/javascript">
		 var RecaptchaOptions = 
		 {
			theme : 'clean'
		 };
		</script>
		
		
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
						<input id="username" name="email" value="" type="text" autocomplete="on" placeholder="Email Address">
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
			<!-- <img src="images/mock_sponsor.png" style="position:absolute; margin-top:15px; margin-right:15px; right:0; z-index:1;" height="60px"> -->

			<div id="header-wrapper" class="wrapper" style="background-size:cover;">
				
				<div class="not-mobile" id="profile-bar">
					<?php
						if ($logged == 1)
						{
							echo "<a href='profile.php'>".$_COOKIE['name']."</a>";
							echo "<span style='margin-left:0.75em; margin-right:0.75em'>|</span><a href='logout.php'>Logout</a>";
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
										<a href="tech_events.php"><div id="tile1" class="the_tile" title="Technical Events"></div></a>
										<a href="cultural.php"><div id="tile2" class="the_tile" title="Cultural Events"></div></a>
										<a href="quizzes.php"><div id="tile3" class="the_tile" title="Quizzes"></div></a>
									</div>
									<span>
										<a href="http://pravega.org"><img id="pravega_logo" src="images/pravega_logo_noglow.png" draggable="false" style="-moz-user-select: none; -webkit-user-select: none; user-select: none; "></a>
									</span>
									<div id="tile-firstmobilerow">
										<a href="tech_events.php"><div id="tile1" class="the_tile" title="Technical Events"></div></a>
										<a href="cultural.php"><div id="tile2" class="the_tile" title="Cultural Events"></div></a>
										<a href="quizzes.php"><div id="tile3" class="the_tile" title="Quizzes"></div></a>
									</div>
									<div  style="display: inline-block;">
										<a href="speakers.php"><div id="tile4" class="the_tile" title="Guest Speakers"></div></a>
										<a href="exhibitions.php"><div id="tile5" class="the_tile" title="Exhibitions and Workshops"></div></a>
										<a href="pronights.php"><div id="tile6" class="the_tile" title="Pro-Nights"></div></a>
									</div>
									</div>
									
									<!-- Nav -->
										<nav id="nav">
										<ul>
											<li class="current_page_item"><a href="about_pravega.php">About</a>
												<ul>
													<li><a href="about_pravega.php">About Pravega</a></li>
													<li><a href="about_iisc.php">About IIS<div style="text-transform:lowercase; display:inline;">c</div></a></li>
													<li><a href="committees.php">Organizing Committee</a></li>
													<li><a href="faq.php">FAQ</a></li>
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
											<li><a href="sponsors.php">Sponsors</a></li>
											<li><a href="hospitality.php">Hospitality</a></li>
											<li><a href="contact.php">Contact</a></li>
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
				<!--<div class="title">No Sidebar</div>-->
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
																<h2>Update Profile</h2>
																
															</header>
													
															<div class=row>
																<div class="12u" style="text-align:center;">
																<?php if ($_SESSION['errors'] == 1) echo "<h2>There were some errors in your submission, which are marked in red.<br>Please correct them and submit again.</h2><br>";?>
																<form method="post" action="update.php" class="signin">
																	<input type="hidden" name="email" value="<?php echo $_COOKIE['email']; ?>">
																	<table style="border-collapse:collapse;">
																	
																	<tr>
																		<td class="form_labels">Mobile Number:</td>
																		<td><input required class="text <?php if(isset($_SESSION['errors_mobile'])) echo "error";?>" type='tel' pattern='\d{10}' maxlength="10" name="mobile" placeholder="Mobile Number (10 digit)" <?php if(isset($_SESSION['mobile'])) echo 'value="'. $_SESSION['mobile']. '"'; else echo 'value="'.$mobile.'"'; ?>></td>
																	</tr>
																	
																	<tr>
																		<td class="form_labels">College:</td>
																		<td><input required class="text <?php if(isset($_SESSION['errors_college'])) echo "error";?>" type="text" maxlength="10" name="college" placeholder="College" <?php if(isset($_SESSION['college'])) echo 'value="'. $_SESSION['college']. '"'; else echo 'value="'.$college.'"'; ?>></td>
																	</tr>
																	
																	<tr>
																		<td class="form_labels">City:</td>
																		<td>																				<select required id="city" name="city" value="">
																				<option disabled="disabled" selected="selected">Select</option>
																				<option disabled="disabled">Top Metropolitan Cities</option>
																					<option value="Ahmedabad">Ahmedabad</option> 
																					<option value="Bangalore">Bangalore/Bengaluru</option>
																					<option value="Chandigarh">Chandigarh</option>
																					<option value="Chennai">Chennai</option>
																					<option value="Gurgaon">Gurgaon</option>
																					<option value="Hyderabad">Hyderabad</option>
																					<option value="Kolkata">Kolkata</option>
																					<option value="Mumbai">Mumbai</option>
																					<option value="New Delhi">New Delhi</option>
																					<option value="Noida">Noida</option>
																					<option value="Pune">Pune</option>
																					<option value="Trivandrum">Trivandrum</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Andhra Pradesh</option>
																					<option value="Anantapur">Anantapur</option>
																					<option value="Guntakal">Guntakal</option>
																					<option value="Guntur">Guntur</option>
																					<option value="Hyderabad">Hyderabad</option>
																					<option value="Kakinada">Kakinada</option>
																					<option value="Kurnool">Kurnool</option>
																					<option value="Nellore">Nellore</option>
																					<option value="Nizamabad">Nizamabad</option>
																					<option value="Rajahmundry">Rajahmundry</option>
																					<option value="Tirupati">Tirupati</option>
																					<option value="Vijayawada">Vijayawada</option>
																					<option value="Visakhapatnam">Visakhapatnam</option>
																					<option value="Warangal">Warangal</option>
																					<option value="Andra Pradesh-Other">Andra Pradesh &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Arunachal Pradesh</option>
																					<option value="Itanagar">Itanagar</option>
																					<option value="Arunachal Pradesh-Other">Arunachal Pradesh &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Assam</option>
																					<option value="Guwahati">Guwahati</option>
																					<option value="Silchar">Silchar</option>
																					<option value="Assam-Other">Assam &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Bihar</option>
																					<option value="Bhagalpur">Bhagalpur</option>
																					<option value="Patna">Patna</option>
																					<option value="Bihar-Other">Bihar &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Chhattisgarh</option>
																					<option value="Bhillai">Bhillai</option>
																					<option value="Bilaspur">Bilaspur</option>
																					<option value="Raipur">Raipur</option>
																					<option value="Chhattisgarh-Other">Chhattisgarh &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Goa</option>
																					<option value="Panjim/Panaji">Panjim/Panaji</option>
																					<option value="Vasco Da Gama">Vasco Da Gama</option>
																					<option value="Goa-Other">Goa &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Gujarat</option>
																					<option value="Ahmedabad">Ahmedabad</option>
																					<option value="Anand">Anand</option>
																					<option value="Ankleshwar">Ankleshwar</option>
																					<option value="Bharuch">Bharuch</option>
																					<option value="Bhavnagar">Bhavnagar</option>
																					<option value="Bhuj">Bhuj</option>
																					<option value="Gandhinagar">Gandhinagar</option>
																					<option value="Gir">Gir</option>
																					<option value="Jamnagar">Jamnagar</option>
																					<option value="Kandla">Kandla</option>
																					<option value="Porbandar">Porbandar</option>
																					<option value="Rajkot">Rajkot</option>
																					<option value="Surat">Surat</option>
																					<option value="Vadodara/Baroda">Vadodara/Baroda</option>
																					<option value="Valsad">Valsad</option>
																					<option value="Vapi">Vapi</option>
																					<option value="Gujarat-Other">Gujarat &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Haryana</option>
																					<option value="Ambala">Ambala</option>
																					<option value="Chandigarh">Chandigarh</option>
																					<option value="Faridabad">Faridabad</option>
																					<option value="Gurgaon">Gurgaon</option>
																					<option value="Hisar">Hisar</option>
																					<option value="Karnal">Karnal</option>
																					<option value="Kurukshetra">Kurukshetra</option>
																					<option value="Panipat">Panipat</option>
																					<option value="Rohtak">Rohtak</option>
																					<option value="Haryana-Other">Haryana &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Himachal Pradesh</option>
																					<option value="Dalhousie">Dalhousie</option>
																					<option value="Dharmasala">Dharmasala</option>
																					<option value="Kulu/Manali">Kulu/Manali</option>
																					<option value="Shimla">Shimla</option>
																					<option value="Himachal Pradesh-Other">Himachal Pradesh &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Jammu and Kashmir</option>
																					<option value="Jammu">Jammu</option>
																					<option value="Srinagar">Srinagar</option>
																					<option value="Jammu and Kashmir-Other">Jammu and Kashmir &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Jharkhand</option>
																					<option value="Bokaro">Bokaro</option>
																					<option value="Dhanbad">Dhanbad</option>
																					<option value="Jamshedpur">Jamshedpur</option>
																					<option value="Ranchi">Ranchi</option>
																					<option value="Jharkhand-Other">Jharkhand &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Karnataka</option>
																					<option value="Bangalore">Bengaluru/Bangalore</option>
																					<option value="Belgaum">Belgaum</option>
																					<option value="Bellary">Bellary</option>
																					<option value="Bidar">Bidar</option>
																					<option value="Dharwad">Dharwad</option>
																					<option value="Gulbarga">Gulbarga</option>
																					<option value="Hubli">Hubli</option>
																					<option value="Kolar">Kolar</option>
																					<option value="Mangalore">Mangalore</option>
																					<option value="Mysore">Mysore</option>
																					<option value="Karnataka-Other">Karnataka &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Kerala</option>
																					<option value="Calicut">Calicut</option>
																					<option value="Cochin">Cochin</option>
																					<option value="Ernakulam">Ernakulam</option>
																					<option value="Kannur">Kannur</option>
																					<option value="Kochi">Kochi</option>
																					<option value="Kollam">Kollam</option>
																					<option value="Kottayam">Kottayam</option>
																					<option value="Kozhikode">Kozhikode</option>
																					<option value="Palakkad">Palakkad</option>
																					<option value="Palghat">Palghat</option>
																					<option value="Thrissur">Thrissur</option>
																					<option value="Trivandrum">Trivandrum</option>
																					<option value="Kerela-Other">Kerela &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Madhya Pradesh</option>
																					<option value="Bhopal">Bhopal</option>
																					<option value="Gwalior">Gwalior</option>
																					<option value="Indore">Indore</option>
																					<option value="Jabalpur">Jabalpur</option>
																					<option value="Ujjain">Ujjain</option>
																					<option value="Madhya Pradesh-Other">Madhya Pradesh &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Maharashtra</option>
																					<option value="Ahmednagar">Ahmednagar</option>
																					<option value="Aurangabad">Aurangabad</option>
																					<option value="Jalgaon">Jalgaon</option>
																					<option value="Kolhapur">Kolhapur</option>
																					<option value="Mumbai">Mumbai</option>
																					<option value="Mumbai Suburbs">Mumbai Suburbs</option>
																					<option value="Nagpur">Nagpur</option>
																					<option value="Nasik">Nasik</option>
																					<option value="Navi Mumbai">Navi Mumbai</option>
																					<option value="Pune">Pune</option>
																					<option value="Solapur">Solapur</option>
																					<option value="Maharashtra-Other">Maharashtra &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Manipur</option>
																					<option value="Imphal">Imphal</option>
																					<option value="Manipur-Other">Manipur &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Meghalaya</option>
																					<option value="Shillong">Shillong</option>
																					<option value="Meghalaya-Other">Meghalaya &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Mizoram</option>
																					<option value="Aizawal">Aizawal</option>
																					<option value="Mizoram-Other">Mizoram &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Nagaland</option>
																					<option value="Dimapur">Dimapur</option>
																					<option value="Nagaland-Other">Nagaland &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Orissa</option>
																					<option value="Bhubaneshwar">Bhubaneshwar</option>
																					<option value="Cuttak">Cuttak</option>
																					<option value="Paradeep">Paradeep</option>
																					<option value="Puri">Puri</option>
																					<option value="Rourkela">Rourkela</option>
																					<option value="Orissa-Other">Orissa &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Punjab</option>
																					<option value="Amritsar">Amritsar</option>
																					<option value="Bathinda">Bathinda</option>
																					<option value="Chandigarh">Chandigarh</option>
																					<option value="Jalandhar">Jalandhar</option>
																					<option value="Ludhiana">Ludhiana</option>
																					<option value="Mohali">Mohali</option>
																					<option value="Pathankot">Pathankot</option>
																					<option value="Patiala">Patiala</option>
																					<option value="Punjab-Other">Punjab &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Rajasthan</option>
																					<option value="Ajmer">Ajmer</option>
																					<option value="Jaipur">Jaipur</option>
																					<option value="Jaisalmer">Jaisalmer</option>
																					<option value="Jodhpur">Jodhpur</option>
																					<option value="Kota">Kota</option>
																					<option value="Udaipur">Udaipur</option>
																					<option value="Rajasthan-Other">Rajasthan &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Sikkim</option>
																					<option value="Gangtok">Gangtok</option>
																					<option value="Sikkim-Other">Sikkim &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Tamil Nadu</option>
																					<option value="Chennai">Chennai</option>
																					<option value="Coimbatore">Coimbatore</option>
																					<option value="Cuddalore">Cuddalore</option>
																					<option value="Erode">Erode</option>
																					<option value="Hosur">Hosur</option>
																					<option value="Madurai">Madurai</option>
																					<option value="Nagerkoil">Nagerkoil</option>
																					<option value="Ooty">Ooty</option>
																					<option value="Salem">Salem</option>
																					<option value="Thanjavur">Thanjavur</option>
																					<option value="Tirunalveli">Tirunalveli</option>
																					<option value="Trichy">Trichy</option>
																					<option value="Tuticorin">Tuticorin</option>
																					<option value="Vellore">Vellore</option>
																					<option value="Tamil Nadu-Other">Tamil Nadu &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Tripura</option>
																					<option value="Agartala">Agartala</option>
																					<option value="Tripura-Other">Tripura &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Union Territories</option>
																					<option value="Chandigarh">Chandigarh</option>
																					<option value="Daman & Diu">Daman & Diu</option>
																					<option value="Delhi">Delhi</option>
																					<option value="Pondichery">Pondichery</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Uttar Pradesh</option>
																					<option value="Agra">Agra</option>
																					<option value="Aligarh">Aligarh</option>
																					<option value="Allahabad">Allahabad</option>
																					<option value="Bareilly">Bareilly</option>
																					<option value="Faizabad">Faizabad</option>
																					<option value="Ghaziabad">Ghaziabad</option>
																					<option value="Gorakhpur">Gorakhpur</option>
																					<option value="Kanpur">Kanpur</option>
																					<option value="Lucknow">Lucknow</option>
																					<option value="Mathura">Mathura</option>
																					<option value="Meerut">Meerut</option>
																					<option value="Moradabad">Moradabad</option>
																					<option value="Noida">Noida</option>
																					<option value="Varanasi/Banaras">Varanasi/Banaras</option>
																					<option value="Uttar Pradesh-Other">Uttar Pradesh &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">Uttaranchal</option>
																					<option value="Dehradun">Dehradun</option>
																					<option value="Roorkee">Roorkee</option>
																					<option value="Uttaranchal-Other">Uttaranchal &ndash; Other</option>
																				<option disabled="disabled"></option>
																				<option disabled="disabled" style="background-color:#154b9e; color:white;">West Bengal</option>
																					<option value="Asansol">Asansol</option>
																					<option value="Durgapur">Durgapur</option>
																					<option value="Haldia">Haldia</option>
																					<option value="Kharagpur">Kharagpur</option>
																					<option value="Kolkatta">Kolkatta</option>
																					<option value="Siliguri">Siliguri</option>
																					<option value="West Bengal - Other">West Bengal - Other</option>
																			</select>
</td>
																	</tr>
																	<tr>
																		<td class="form_labels">CodeChef ID (optional):</td>
																		<td><input class="text" name="codechef" type="text" placeholder="CodeChef ID (optional)" <?php if(isset($_SESSION['codechef'])) echo 'value="'. $_SESSION['codechef']. '"'; else echo 'value="'.$codechef.'"' ?>></td>
																	</tr>
																	<tr>
																		<td style="text-align:center; padding-top:35px;" colspan="2">
																			<fieldset class="textbox">
																			<input class="button_modal textbox" style="display:inline-block; border:0px;" type="submit" value="Update">
																			</fieldset>
																		</td>
																	</tr>
																	</table>
																</form>
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
	
<script>
	function selectElementByName(id, name)
	{	
		f = document.getElementById(id);
		for (i=0; i<f.options.length; i++)
		{
			if(f.options[i].value == name)
			{
				f.options.selectedIndex = i;
				break;
			}
		}
	}
	
	<?php
		if (isset($_SESSION['city']))
			echo 'selectElementByName("city",  "' .$_SESSION["city"] . '");';
		else echo 'selectElementByName("city",  "' .$city . '");';
	?>
</script>

<?php
	session_destroy();
?>
	

	
		
</html>