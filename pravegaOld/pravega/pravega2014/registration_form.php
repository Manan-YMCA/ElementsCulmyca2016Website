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
		}
		
		else $logged = 0;
	}
		else
			$logged = 0;
?>

<html lang="en">

	<head>
		<title>Register | Pravega &ndash; the IISc Science, Tech and Cultural Fest</title>
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
																<h2>Register</h2>
																
															</header>
													
															<div class=row>
																<div class="12u" style="text-align:center;">
																<?php if ($_SESSION['errors'] == 1) echo "<h2>There were some errors in your submission, which are marked in red.<br>Please correct them and submit again.</h2><br>";?>
																<form method="post" action="register.php" class="signin">
																	<table style="border-collapse:collapse;">
																	<tr>
																		<td class="form_labels">Email Address:</td>
																		<td><input required autofocus class="text <?php if (isset($_SESSION['errors_email']) || isset($_SESSION['errors_email_coll']))echo "error";?>" type="email" name="email" placeholder="Email Address<?php if ($_SESSION['errors_email_coll'] == 1) echo " already registered."; ?>" <?php if($_SESSION['errors_email_coll'] != 1) echo 'value="'. $_SESSION['email']. '"';?>></td>
																	</tr>
																
																	<tr>
																		<td class="form_labels">First Name:</td>
																		<td><input required class="text" type="text" name="first" placeholder="First Name"<?php if(isset($_SESSION['first_name'])) echo 'value="'. $_SESSION['first_name']. '"';?>></td>
																	</tr>
																	<tr>
																		<td class="form_labels">Last Name:</td>
																		<td><input required class="text" type="text" name="last" placeholder="Last Name" <?php if(isset($_SESSION['last_name'])) echo 'value="'. $_SESSION['last_name']. '"';?>></td>
																	</tr>
																	<tr>
																		<td class="form_labels">Password:</td>
																		<td><input required pattern='\S{8,72}' maxlength="72" class="text <?php if(isset($_SESSION['errors_pass'])) echo "error";?>" type="password" placeholder="Password (min. length 8)" name="password" id="password"></td>
																	</tr>
																	<tr>
																		<td class="form_labels">Verify Password:</td>
																		<td><input required class="text <?php if(isset($_SESSION['errors_verification'])) echo "error";?>" name="verify" type="password" placeholder="Verify Password" id="verify"></td>
																	</tr>
																	
																	<tr>
																		<td class="form_labels">Date of Birth:</td>
																		<td>
																			<select required id="day" name="day" value="" style="width:74px;">
																				<option selected disabled>Day</option>
																				<option value="01">1</option>
																				<option value="02">2</option>
																				<option value="03">3</option>
																				<option value="04">4</option>
																				<option value="05">5</option>
																				<option value="06">6</option>
																				<option value="07">7</option>
																				<option value="08">8</option>
																				<option value="09">9</option>
																				<option value="10">10</option>
																				<option value="11">11</option>
																				<option value="12">12</option>
																				<option value="13">13</option>
																				<option value="14">14</option>
																				<option value="15">15</option>
																				<option value="16">16</option>
																				<option value="17">17</option>
																				<option value="18">18</option>
																				<option value="19">19</option>
																				<option value="20">20</option>
																				<option value="21">21</option>
																				<option value="22">22</option>
																				<option value="23">23</option>
																				<option value="24">24</option>
																				<option value="25">25</option>
																				<option value="26">26</option>
																				<option value="27">27</option>
																				<option value="28">28</option>
																				<option value="29">29</option>
																				<option value="30">30</option>
																				<option value="31">31</option>
																			</select>
																			<select required id="month" name="month" value=""  style="width:121px;">
																				<option selected disabled>Month</option>
																				<option value="01">January</option>
																				<option value="02">February</option>
																				<option value="03">March</option>
																				<option value="04">April</option>
																				<option value="05">May</option>
																				<option value="06">June</option>
																				<option value="07">July</option>
																				<option value="08">August</option>
																				<option value="09">September</option>
																				<option value="10">October</option>
																				<option value="11">November</option>
																				<option value="12">December</option>
																			</select>
																			<select required id="year" name="year" style="width:75px;">
																				<option selected disabled value="empty">Year</option>
																					<option value="2000">2000</option>
																					<option value="1999">1999</option>
																					<option value="1998">1998</option>
																					<option value="1997">1997</option>
																					<option value="1996">1996</option>
																					<option value="1995">1995</option>
																					<option value="1994">1994</option>
																					<option value="1993">1993</option>
																					<option value="1992">1992</option>
																					<option value="1991">1991</option>
																					<option value="1990">1990</option>
																					<option value="1989">1989</option>
																					<option value="1988">1988</option>
																					<option value="1987">1987</option>
																					<option value="1986">1986</option>
																					<option value="1985">1985</option>
																					<option value="1984">1984</option>
																					<option value="1983">1983</option>
																					<option value="1982">1982</option>
																					<option value="1981">1981</option>
																					<option value="1980">1980</option>
																					<option value="1979">1979</option>
																					<option value="1978">1978</option>
																					<option value="1977">1977</option>
																					<option value="1976">1976</option>
																					<option value="1975">1975</option>
																					<option value="1974">1974</option>
																					<option value="1973">1973</option>
																					<option value="1972">1972</option>
																					<option value="1971">1971</option>
																					<option value="1970">1970</option>
																					<option value="1969">1969</option>
																					<option value="1968">1968</option>
																					<option value="1967">1967</option>
																					<option value="1966">1966</option>
																					<option value="1965">1965</option>
																					<option value="1964">1964</option>
																					<option value="1963">1963</option>
																					<option value="1962">1962</option>
																					<option value="1961">1961</option>
																					<option value="1960">1960</option>
																					<option value="1959">1959</option>
																					<option value="1958">1958</option>
																					<option value="1957">1957</option>
																					<option value="1956">1956</option>
																					<option value="1955">1955</option>
																					<option value="1954">1954</option>
																					<option value="1953">1953</option>
																					<option value="1952">1952</option>
																					<option value="1951">1951</option>
																					<option value="1950">1950</option>
																					<option value="1949">1949</option>
																					<option value="1949">1948</option>
																			</select>
																		</td>
																	</tr>
																	
																	<tr>
																		<td class="form_labels">Gender:</td>
																		<td>
																			<input style="width:25px; vertical-align: baseline;" class="text <?php if(isset($_SESSION['errors_gender'])) echo "error";?>" type='radio' name="gender" value="Male" <?php if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male') echo 'checked';?>>Male<span style="padding-left:25px;"></span>
																			<input style="width:25px; vertical-align: baseline;" class="text <?php if(isset($_SESSION['errors_gender'])) echo "error";?>" type='radio' name="gender" value="Female" <?php if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female') echo 'checked';?>>Female
																		</td>
																	</tr>
																	
																	<tr>
																		<td class="form_labels">Mobile Number:</td>
																		<td><input required class="text <?php if(isset($_SESSION['errors_mobile'])) echo "error";?>" type='tel' pattern='\d{10}' maxlength="10" name="mobile" placeholder="Mobile Number (10 digit)" <?php if(isset($_SESSION['mobile'])) echo 'value="'. $_SESSION['mobile']. '"';?>></td>
																	</tr>
																	
																	<tr>
																		<td class="form_labels">College:</td>
																		<td><input required class="text <?php if(isset($_SESSION['errors_college'])) echo "error";?>" type="text" maxlength="40" name="college" placeholder="College" <?php if(isset($_SESSION['college'])) echo 'value="'. $_SESSION['college']. '"';?>></td>
																	</tr>
																	
																	<tr>
																		<td class="form_labels">City:</td>
																		<td><select required id="city" name="city" value="">
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
																		<td class="form_labels">CodeChef ID:<div style="font-size:10pt; margin-top:-5px;">(needed to register for Online Programming Contest)</div></td>
																		<td><input class="text" name="codechef" type="text" placeholder="CodeChef ID (optional)" <?php if(isset($_SESSION['codechef'])) echo 'value="'. $_SESSION['codechef']. '"';?>></td>
																	</tr>
																	
																	<tr>
																		<td class="form_labels">Are you a bot?</td>
																		<td>
																			<div style="align:right;">
																				<?php
																				  require_once('php/recaptchalib.php');
																				  $publickey = "6LemeecSAAAAAEM4Bcu02YOPJjJUsh_3QTp8ZePJ";
																				  echo recaptcha_get_html($publickey);
																				?>
																			</div>
																		</td>
																	</tr>
																	<tr>
																		<td style="text-align:center; padding-top:35px;" colspan="2">
																			<fieldset class="textbox">
																			<input class="button_modal textbox" style="display:inline-block; border:0px;" type="submit" value="Register">
																			</fieldset>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="2"><center>If you have any technical difficulties, please email <a href="mailto:web@pravega.org">web@pravega.org</a></center></td>
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
	
	<?php if (isset($_SESSION['day'])) echo 'selectElementByName("day",  "' .$_SESSION["day"] . '");'; ?>
	<?php if (isset($_SESSION['month'])) echo 'selectElementByName("month",  "' .$_SESSION["month"] . '");'; ?>
	<?php if (isset($_SESSION['year'])) echo 'selectElementByName("year",  "' .$_SESSION["year"] . '");'; ?>
	<?php if (isset($_SESSION['city'])) echo 'selectElementByName("city",  "' .$_SESSION["city"] . '");'; ?>
</script>

<?php
	if (isset($_SESSION['errors_captcha']))
	{
?>
<script>
document.getElementById("recaptcha_response_field").id = "recaptcha_response_field_error";
</script>
<?php
	}
	session_destroy();
?>
</html>