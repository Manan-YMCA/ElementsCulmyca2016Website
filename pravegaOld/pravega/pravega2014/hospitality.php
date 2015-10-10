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
			
	if ($logged == 1)
	{
		$query = "SELECT firstname, lastname, id, gender, mobile, city FROM usernames WHERE email=?";
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "s", $_COOKIE['email']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $firstname, $lastname, $id, $gender, $mobile, $city);
		mysqli_stmt_fetch($stmt);
		
		$name = $firstname ." ".$lastname;
		$registered = 0;
		
		mysqli_stmt_close($stmt);
		
		$query = "SELECT email FROM accommodation WHERE email=?";
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "s", $_COOKIE['email']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $accommo_requested);
		mysqli_stmt_fetch($stmt);
		
		if ($accommo_requested != "")
			$accommo_requested = 1;
			
		else $accommo_requested = 0;
	}
?>
<!DOCTYPE HTML>

<html lang="en">

	<head>
		<title>Hospitality | Pravega &ndash; the IISc Science, Tech and Cultural Fest</title>
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
	<body class="no-sidebar" onload="<?php if($_SESSION['errors'] == 1 || $_SESSION['success'] == 1) echo "location.hash = 'request';";?> load_content();">
		
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
																<h2>Hospitality</h2>
																
															</header>
															
															<div class="row">
																<div class="12u" style="text-align:center; border-top-style: 0px solid; padding-top: 0px; margin-top: 25px;" align="center">
																	<div style="width: 750px; margin:auto;cursor: pointer;" align="center">
																		<span id="intro_button" class="subject_nav_button" style="border-radius:5px 0px 0px 5px; border-right: 1px solid black;">Introduction</span>
																		<span id="instructions_button" class="subject_nav_button" style="display: none; border-left: 0px solid; margin-left: -6px; border-left: 1px solid black; border-right: 1px solid black;">Instructions</span>
																		<span id="reaching_button" class="subject_nav_button" style="border-left: 0px solid; margin-left: -6px; border-left: 1px solid black;">Reaching IISc</span>
																		<span id="alt_acco_button" class="subject_nav_button" style="border-left: 0px solid; margin-left: -6px; border-left: 1px solid black; border-right: 1px solid black;">Alt. Acco.</span>
																		<span id="request_button" class="subject_nav_button" style="display:none; border-radius:0px 5px 5px 0px; margin-left: -6px; border-left: 1px solid black;">Request Form</span>
																	</div>
																</div>
															</div>
															
															<div class="row">
																
																<style>		
																	
																	tr:nth-child(even)
																	{
																		background-color: rgba(228,228,228, 0.5);
																	}
																	
																	tr.request:nth-child(even)
																	{
																		background-color: rgba(0,0,0,0);
																	}
																	
																	table.alt_acco
																	{
																		position: absolute;
																		width: 950px;
																		left: 50%;
																		margin-left: -475px;
																	}
																	
																	td
																	{
																		vertical-align: middle;
																	}
																</style>
																<span id="intro" style="display:none;">
																	<p>Your satisfaction is our topmost priority and the Hospitality Team will strive to ensure your comfort at Pravega 2014.</p>
																	<p>The IISc Campus is centrally located in the city and participants should have no problems in arriving at the venue. We have arranged for limited accommodation outside the campus on first-come-first-serve basis. Please check the Instructions Tab for more details. We have also made a list of affordable lodges surrounding the institute where you will find it convenient to book rooms and stay for the duration of the fest. Food stalls located throughout the campus will make sure your stomach voices no protestations during the fest.</p>
																	<p>There is a one time participation fee of Rs 150 that allows participants to take part in all events.</p>
																</span>
																<span id="instructions_content" style="display:none;">
																	<p>Those who require accommodation but did not apply for it can find other lodging, listed in the Alternate Accommodation tab.</p>
																	<p>Accommodation will be provided in decent lodges near IISc for those who have applied. The cost is Rs. 250 per person per day. Please note that if you wish to avail accommodation for 4 nights and 3 days, it shall be counted as 4 days and the amount to be paid for such a person is Rs. 1000 for all 4 days. Mattress/beds will be provided. We suggest participants to carry locks with multiple keys.</p>
																	<p>Participants who have not applied for accommodation will be directed to good nearby lodges where they can stay.</p>
																	<p>Please keep these numbers handy in case of any problem.<br>
																		Sri Vamsi Matta (Hospitality In-Charge) - +91 9611187793<br>
																		Neha Kondekar (Hospitality Enquiries)  - +91 9448173414<br>
																		Vaddi Yaswant (Hospitality Enquiries) - +91 8762617046<br>
																		Sabareesh Ramachandran - +91 9886275530
																	</p>
																</span>
																<span id="reaching_content" style="display:none;">
																	<h2>How to reach IISc from the Airport/Railway station/Majestic?</h2>
																	<p>Bangalore is connected by air, rail and road to all the metropolises and most major cities of the country. The Institute is known as "Tata Institute" to the locals. It is better to use the name "Tata Institute" with the taxi, auto-rickshaw drivers, and bus conductors. The institute is located between Malleswaram and Yeswantpur.</p>
																	
																	<h3>Reaching IISc from the Airport:</h3>
																	<p>IISc is about 35 kilometer (22 miles) from the airport (both domestic and international). Prepaid taxi service is available from the airport. The fare to IISc would be approximately INR 650. Shuttle bus services are available from the airport. The A/C bus fare is around INR 200. The more economical non A/C buses are also available. You can take buses to either Mekhri Circle or Malleshwaram. IISc is around 2 kilometer from these bus stops and you may take an auto to reach IISc. The fare for the auto would be around INR 25.</p>
																	
																	<h3>Reaching IISc from the City Railway Station/Majestic Bus Stand:</h3>
																	<p>The main railway station in Bangalore is called Bangalore City which is about 7 km from IISc. The railway station and the main bus stand (called as Majestic) are opposite to each other. Pre-paid taxi and auto-rickshaw facility is available at the Bangalore City Railway Station, near platform number 1. You could tell the person at the counter that you are travelling to Tata Institute. A trip to IISc may cost about INR 100 by auto. Travel by auto-rickshaws between 22:00 hours and 06:00 hours will cost 50% more. You can also use the bus services from platform Number 22 of Majestic bus station: <br><br>
																	Bus Route nos. 252 E, 258 C, 271 E, 273 C, 275, 99 A and B. <br><br>Alight at Malleshwaram 18th cross Bus Stop or Yeshwantpur circle Bus Stop.</p>
																	
																	<h3>Reaching IISc from Cantonment Railway Station:</h3>
																	<p>Another important railway station in Bangalore is Cantonment Railway Station, also known as Bangalore Cantt. The distance from this station to IISc is almost same as the Bangalore City railway station and it also has prepaid auto-rickshaw facility. You can also use the bus services from the bus stop just opposite to the station. Route Nos. 94 A and E, 252 A, 270 A, 272, 276 A.</p>
																	
																	<h3>Reaching IISc from Yeshwanthpur Railway Station:</h3>
																	<p>Yeshwanthpur is another important railway station in Bangalore. Yeshwanthpur is very close to IISc. There are two entrances to this station (one through Yeswanthpur Market, and the other via Tumkur Road). The auto-rickshaw ride from Yeshwanthpur to IISc will cost around INR 25 from the Market entrance, and around INR 40 from the Tumkur Road entrance. Prepaid auto-rickshaw facility is available near the Tumkur Road entrance.One can also walk down in about 10 minutes from the market side entrance (Platform no. 1) to IISc.</p>
																</span>
																<span id="alt_acco_content" style="display:none;">
																	<p>For all other participants of Pravega, given below are a list of hotels and lodges that are located near IISc. All of them are within a 2km radius from IISc and are accessible from IISc by public buses. The participants may directly contact the lodges and book their rooms. </p>
																	<p>Note: More lodges will be added below in a couple of days.</p>
																	
																	<table class="alt_acco">
																		<tr style="border-bottom: 1px solid black; font-weight: 700;">
																			<th>Name</th>
																			<th style="width: 100px;">Address</th>
																			<th>Phone/Contact</th>
																			<th style="width: 100px;">Approximate Cost</th>
																		</tr>

																		<tr>
																			<td>Platinum City</td>
																			<td>F block, #2 - HMT Watch Factory Road, Off Yeshwanthpur Tumkur Road NH-4 [Adj. to IPIRTI, Opp. NID & Near CMTI toll flyover]<span style="display: inline-block; width: 275px;"></span></td>
																			<td style="max-width:125px; min-width: 125px;">
																				Mobile: 9743974656 / 9342722792<br>
																				<a href="mailto:reservations_platinum@ibchotels-resorts.com">Email</a><br>
																				<a href="www.Ibchotels-resorts.com" target="_blank">Website</a>
																			</td>
																			<td>Rs. 650<br>(This discount can be availed by mentioning you are a Pravega participant)<span style="display: inline-block; width: 150px;"></span></td>
																		</tr>

																		<tr>
																			<td>Shiva International</td>
																			<td>Seshadri Road</td>
																			<td>080 66498581</td>
																			<td></td>
																		</tr>

																		<tr>
																			<td>Shiva Comfort and Lodging</td>
																			<td>Malleswaram</td>
																			<td>080 49156899</td>
																			<td></td>
																		</tr>

																		<tr>
																			<td>Ganesh Mahal Lodge</td>
																			<td>Malleswaram</td>
																			<td>080 23341468</td>
																			<td></td>
																		</tr>

																		<tr>
																			<td>Navanidhi Comforts</td>
																			<td>Yeshwantpur</td>
																			<td>080 66490753</td>
																			<td></td>
																		</tr>

																		<tr>
																			<td>Vishal Residency</td>
																			<td>Seshadripuram</td>
																			<td>080 23363042</td>
																			<td></td>
																		</tr>

																		<tr>
																			<td>GT Residency</td>
																			<td>Rajajinagar</td>
																			<td>080 41493476</td>
																			<td></td>
																		</tr>

																		<tr>
																			<td>Horizon Deluxe Lodge</td>
																			<td>Yeshwantpur</td>
																			<td>080 23475777</td>
																			<td></td>
																		</tr>

																		<tr>
																			<td>Sri Lakshmi Deluxe Lodge</td>
																			<td>Yeshwantpur</td>
																			<td>080 66366787</td>
																			<td></td>
																		</tr>

																		<tr>
																			<td>Akshara Regency</td>
																			<td>No. 4/20, Mathikere First Main Road, Gokula Ist Stage, Bangalore</td>
																			<td>080 2337 7746, 09036970369</td>
																			<td>Rs. 550-950 for 2 persons</td>
																		</tr>

																		<tr>
																			<td>Ujwal Residency</td>
																			<td>#50, Yeswathpur-Mathikere Main Road</td>
																			<td>080 40974573, 09986131989</td>
																			<td>Rs. 750-1000 for 2 persons</td>
																		</tr>

																		<tr>
																			<td>Sree Nandanam Residency</td>
																			<td>#11 Gokul First Stage, Mathikere Main Road</td>
																			<td>080 40926908, 40926909</td>
																			<td>Rs. 550-1000 Rs for two persons</td>
																		</tr>

																		<tr>
																			<td>Sri Akshaya Deluxe Lodges</td>
																			<td>#4 Mathikere Main Road</td>
																			<td>080 2347 0128, 09731925513</td>
																			<td>Rs. 500-800 for two persons</td>
																		</tr>

																		<tr>
																			<td>Krishinton Suites</td>
																			<td>#993, M.S. Ramaiah Main Road, Near IISc D-Gate, Mathikere</td>
																			<td>080 4259 5959</td>
																			<td>Rs. 1200-2000 for 2 persons</td>
																		</tr>

																		<tr>
																			<td>The Basil</td>
																			<td>8, Sampige Road, Malleshwaram</td>
																			<td>080-40402323</td>
																			<td>Rs. 2000 for 2 persons</td>
																		</tr>

																		<tr>
																			<td>New Sagar Comforts & Banquets</td>
																			<td>No.5 & 6-8, 11th Mn Rd, 2nd Phs, 1st STG, Yeshwanthpur Mn Rd, Gokula Extension</td>
																			<td>080-40084999, 41273453</td>
																			<td>Rs. 400-800</td>
																		</tr>
																	</table>
																	<div style="position: relative; height:1000px; z-index:-100;"></div>

																</span>
																<span id="request_content" style="display:none;">
																	<div align="center">
																		<h2 id="register">Register</h2>
																		<?php
																			if (!$logged || !$accommo_requested)
																			{
																		?>
																		<style>
																				option:disabled
																				{
																					background: rgb(19, 75, 156);
																					color: white;
																				}
																		</style>
																			The application period for accommodation has expired. However there are many lodging facilities listed on the alternate accommodation page. You can directly contact them and book your rooms.																
																		<?php
																			}																
																			else if ($accommo_requested && !isset($_SESSION['success']))
																				echo "You have already requested accommodation.";
																				
																		?>
																	</div>
																</span>
																
																<section class="2u"></section>
																<div class="8u hyphenate" id="content_dynamic">
																
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
	<script src="js/hosp_bar.js"></script>
	<script>
		function add_arrival_options()
		{
			var arrival_date = document.getElementsByName("arrival_date");
			var arrival_time = document.getElementsByName("arrival_time");
			arrival_date = arrival_date[1];
			arrival_time = arrival_time[1];
			
			arrival_time.innerHTML = "";
			var option = document.createElement("option");
			option.setAttribute("disabled", "disabled");
			option.setAttribute("selected", "selected");
			option.innerHTML = "Arrival Hour";
			arrival_time.appendChild(option);
			
			var start;
			
			switch (arrival_date.value)
			{
				case "January 30":
					start = 20;
					break;
					
				default:
					start = 1;
					break;
			}
		
			for (i=start; i<=24; i++)
			{
				var option = document.createElement("option");
				option.value = i;
				option.innerHTML = i;
				arrival_time.appendChild(option);
			}
		}
		
		function add_departure_options()
		{
			var departure_date = document.getElementsByName("departure_date");
			var departure_time = document.getElementsByName("departure_time");
			departure_date = departure_date[1];
			departure_time = departure_time[1];
			
			departure_time.innerHTML = "";
			var option = document.createElement("option");
			option.setAttribute("disabled", "disabled");
			option.setAttribute("selected", "selected");
			option.innerHTML = "Departure Hour";
			departure_time.appendChild(option);
			
			var end;
			
			switch (departure_date.value)
			{
				case "February 3":
					end = 9;
					break;
					
				default:
					end = 24;
					break;
			}
		
			for (i=1; i<=end; i++)
			{
				var option = document.createElement("option");
				option.value = i;
				option.innerHTML = i;
				departure_time.appendChild(option);
			}
		}
		
		function selectElementByName(id, name)
		{	
			f = document.getElementsByName(id);
			f = f[0];
			for (i=0; i<f.options.length; i++)
			{
				if(f.options[i].value == name)
				{
					f.options[0].removeAttribute("selected");
					f.options[i].setAttribute("selected", "selected");
					break;
				}
			}
		}
		
		<?php if (isset($_SESSION['arrival_date'])) echo 'selectElementByName("arrival_date",  "' .$_SESSION["arrival_date"] . '");'; ?>
		<?php if (isset($_SESSION['arrival_time'])) echo 'selectElementByName("arrival_time",  "' .$_SESSION["arrival_time"] . '");'; ?>
		<?php if (isset($_SESSION['departure_date'])) echo 'selectElementByName("departure_date",  "' .$_SESSION["departure_date"] . '");'; ?>
		<?php if (isset($_SESSION['departure_time'])) echo 'selectElementByName("departure_time",  "' .$_SESSION["departure_time"] . '");'; ?>
		<?php if (isset($_SESSION['reg_event'])) echo 'selectElementByName("reg_event",  "' .$_SESSION["reg_event"] . '");'; ?>
	</script>
	<?php
		session_destroy();
	?>
</html>