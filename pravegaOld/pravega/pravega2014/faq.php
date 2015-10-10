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
		<title>Frequently Asked Questions | Pravega &ndash; the IISc Science, Tech and Cultural Fest</title>
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
		<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="js/accordion.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		
		
		<script src="js/jquery.poshytip.min.js"></script>  
		<script src="js/poshytip_init.js"></script>  
		<link rel="stylesheet" href="js/poshytip/tip-twitter.css" />
		<link rel="stylesheet" href="css/accordion.css" />
		
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
																<h2>Frequently Asked Questions</h2>
																
															</header>
															
															<div class="row">
																<section class="1u"></section>
																<div class="10u hyphenate">
																	<span class="toggle-collapse-all"> Collapse all </span>
																	<span class="toggle-expand-all"> Expand all </span>
																	<br><br>
																	
																	<!-- toggle -->
																	
																	<div class="toggle-trigger">What is Pravega?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Pravega 2013&ndash;2014 is the first edition of IISc's Science, Tech and Cultural festival being held from 31st January&ndash;2nd February, 2014.
																			Spanning across three days, Pravega promises to be an eclectic blend of cutting edge Science, awe-inspiring technology and breathtaking cultural performances.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">When is Pravega scheduled to be held?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Pravega is scheduled to be held from 31st January&ndash;2nd February, 2014 (Friday, Saturday and Sunday).</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">Where will Pravega happen?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>In the lush green 443 acre IISc campus situated inside Bangalore city. An island of peace and serenity amidst the buzz of metropolitan life. IISc combines the best of both worlds!</p>
																		</div>
																	</div>
																	
																	<div class="toggle-trigger">What do I need to bring to Pravega?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>The only thing that participants must compulsorily bring to Pravega is their college ID cards. Workshop participants must also bring their workshop tickets.</p>
																		</div>
																	</div>
																	
																	<div class="toggle-trigger">Will entry to Pravega be charged?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Entry to Pravega is free for the public!</p>
																			<p>However, if you want to participate in any events at Pravega, you will have to register and pay a single fee of Rs. 150 which will allow you to participate in all the events of Pravega. Apart from this, you will also be given a complimentary ticket to attend the Professional Night on the second day of Pravega!</p>
																			<p>For those of you interested only in the mind-boggling quizzes of Pravega, we have a separate method of registration: you can avoid the Rs. 150 registration fee for the whole fest, and instead opt to pay Rs. 100 per team per quiz (i.e., Exquizite and Science Quizine) you want to participate in. Your team will also get the compilmentary tickets to the second day's Professional Nights.</p> 
																		</div>
																	</div>
																	
																	<div class="toggle-trigger">Will entry to Pravega's pro-nights be charged?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Entry to Pravega's pronights on 1st February will be free for fest participants and quiz participants.</p>
																			<p>People who purchase Pravega merchandise at the fest will also receive complimentary tickets.</p>
																			<p>Those who do not fall into either of the above categories but would still like to attend the pro-night can purchase tickets for Rs. 50 during the fest itself.</p> 
																		</div>
																	</div>

																	<div class="toggle-trigger">What is the guiding spirit behind Pravega?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Pravega aims to be a festival that help youngsters see the beauty of science and engineering and pursue it with enthusiasm in their lives. The spotlight is on the joy and excitement of innovation, well away from yawn-inducing textbook style pontification.</p>
																			<p>Interesting knowledge in any form&mdash;from differential equations to good poetry&mdash;will be appreciated at Pravega!</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">Is the fest open to the general public? </div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>One of the motives behind Pravega is to create a buzz about Science in the general public and in children. So yes, the public is welcome to visit Pravega and enjoy the exhibitions, science demonstrations, talks, etc. </p>
																			<p>However, the competitions and workshops are exclusively for students.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">Who is Pravega actually for? Kids? Undergrads? Post grads? Adults?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>The exhibitions, lectures, and demonstrations at Pravega are general and can be enjoyed by children and the general public.</p>
																	
																			<p>Pravega's competitions have been designed keeping an age-group of 16&ndash;25 in mind.</p>

																			<p>Unless mentioned, Pravega's competitions feature content roughly of undergraduate complexity.</p>
																			<p>However, there is no reason why high school students should not be able to compete with undergraduates in certain areas&mdash;and we encourage you to do so.
																			There are some  competitions specifically for school students too.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">Will engineering students be able to participate in the science events? And vice versa?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>By all means!</p>
																			<p>The events at Pravega are designed not so much to require technical knowledge, but instead to call upon the ingenuity of participants. Only fundamentals in Science at the +2 level are required to tackle the Science competitions at Pravega. However, a certain amount of background knowledge may come in handy and some preparation is encouraged.</p>
																		</div>
																	</div>
																	
																	<div class="toggle-trigger">Will I get a certificate of participation from Pravega?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Yes, all participants in Pravega events will get a certificate of participation from Pravega.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">Do I need to do an online registration?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Absolutely. Registrations will open soon!</p>
																			<p>Doing an online registration ensures that you spend more time having fun, and less time filling forms when you come for the fest.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">How is the Bangalore weather? Do I need to carry jackets? Umbrellas?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Bangalore weather during the end of January tends to be pleasantly cold with possible unexpected showers.The temperature generally varies between 18&ndash;25&deg;C.</p>
																			<p>Pullovers/Jackets are recommended and umbrellas might also come in handy. </p>
																		</div>
																	</div>

																	<div class="toggle-trigger">How does one get to IISc after arriving at Bangalore?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Please take a look at the <a href="http://www.iisc.ernet.in/about-iisc/howtoreach.php">instructions on the IISc website</a>.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">I am an outstation participant. What are the things I should get?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Enthusiasm&mdash;that's compulsory. The other essential thing is a valid college/school identity card if you wish to participate in any competitions/workshops.</p>
																			<p>When you do the online registration, you will get a full checklist that you can use for your reference. </p>
																		</div>
																	</div>

																	<div class="toggle-trigger">What is the best time to arrive?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>It is recommended that outstation participants arrive the morning of 31st January. This will give you time to get ready leisurely, and be in time for the formal inauguration. Arriving early morning also gives you a chance to thwart Bangalore's morning traffic.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">Will accommodation be made available for outstation participants?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>In-campus accommodation is limited and will be allotted taking into consideration various factors such as the participant's travel distance, workshop participation, etc.</p>
																			<p>We have identified various reasonably-priced lodges around IISc where you can stay for the duration of the fest. A document containing details of these is available on the <a href="hospitality#alt_acco">Hospitality page</a>.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">What kind of food will be available at Pravega?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Swishwifflingly scrumdiddlyumptious food, we assure you.</p>
																			<p>The best way to come to Pravega is with a full mind and an empty stomach.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">What are the other places I can see in Bangalore?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>This should help:
																			<a href="http://en.wikipedia.org/wiki/List_of_tourist_attractions_in_Bangalore">Tourist attractions in Bangalore</a></p>
																		</div>
																	</div>

																	<div class="toggle-trigger">Is pre-registration compulsory for all events?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Pre-registration will be required for some events while spot registration may be done for others. Check the page of the event you are interested in for more details.</p>
																		</div>
																	</div>
																	
																	<div class="toggle-trigger">Are cross-college teams allowed?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Yes, cross-college teams are allowed in all competitions.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">How does one do the money transfer to register for workshops?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>We encourage e-payment for both convenience and environmental reasons. Online payment either through debit or credit cards can be done. You can also transfer money to our account and email us a screenshot of the transaction.</p>
																			<p>We also accept DDs sent to us by post. The tracking ID should be intimated to us by email.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">When will prizes be awarded?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>In most competitions, prizes will be handed over within a month of the completion of the fest. Certificates at Pravega 2014 will have to be collected in-person after the completion of the event.</p>
																		</div>
																	</div>

																																		<div class="toggle-trigger">Can I leave and re-enter the festival?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Yes. You can if you carry the Id-card/wrist-band provided to you when you register.</p>
																		</div>
																	</div>
																			
																	<div class="toggle-trigger">Will there be ATMs? Banks? Drug stores? Mobile Recharge?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Yes, IISc has 4  ATMs and two banks&mdash;The State Bank of India and Canara bank. There is one medical store as well as a general store for daily requirements. Mobile recharges can be done at the general stores as well as a few other places within the campus. It might also be convenient and faster for you to use online recharge websites like freecharge.com.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">What about lost and found? First Aid?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>To benefit the scatterbrain in all of us, a Lost and Found system will be set up.</p>
																			<p>First Aid boxes will be available at all event locations.</p>
																		</div>
																	</div>		

																	<div class="toggle-trigger">What about the disabled?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Though the IISc Campus is yet completely wheelchair-friendly, Pravega is very sensitive to the needs of the disabled. On prior request, we will make arrangements to ensure accessibility for any specific events or shows. Please send a mail to <a href="mailto:contact@pravega.org">contact@pravega.org</a>.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">How do I get a press pass?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>Please mail <a href="mailto:contact@pravega.org">contact@pravega.org</a> or call +91-8970043793.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">I am a teacher. Can I bring my class on a field trip?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<p>It would be our pleasure! However, first send a mail to <a href="mailto:contact@pravega.org">contact@pravega.org</a> to register and confirm your participation.</p>
																		</div>
																	</div>

																	<div class="toggle-trigger">What am I not allowed to bring to the venue?</div>
																	<div class="toggle-container">
																		<div class="block">
																			<ul class="accordion">
																				<li>Explosives, inflammables and firecrackers. Dr. Filibuster's Fabulous Wet-Start, No-Heat Fireworks are a strict no!</li>
																				<li>Knives, guns, lightsabers etc.</li>
																				<li>Alcoholic drinks.</li>
																				<li>Pets.</li>
																				<li>Cigarettes</li>
																				<li>Drugs & Drug Paraphernalia</li>
																			</ul>
																		</div>
																	</div>

																	<div class="toggle-trigger">I have a question that was not answered here. What do I do?</div>
																	<div class="toggle-container">
																		<div class="block">
																		<p>You can send a mail to <a href="mailto:contact@pravega.org">contact@pravega.org</a>. We typically respond in a few hours.</p>
																		</div>
																	</div>
																	
																	<p class="clear"></p>
																	<!-- ENDS toggle -->
																</div>
																<section class="1u"></section>
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