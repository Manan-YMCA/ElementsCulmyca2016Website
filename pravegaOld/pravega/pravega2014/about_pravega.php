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
<!--
                                                       ,C@@@@@@@@G;                                                          
                                                     L@@@@@@@@@@@@@@G.                                                       
                                                   ,@@@@@@@@@@@@@@@@@@1                                                      
                                                  ,@@@@@@@@@@@@@@@@@@@@1                                                     
                                                  f@@@@@@@@@@@@@@@@@@@@8                                                     
                                                  G@@@@@@@@@@@@@@@@@@@@@,                                                    
                                                  t@@@@@@@@@@@@@@@@@@@@0                                                     
                                                   0@@@@@@@@@@@@@@@@@@@:                                                     
                                                    C@@@@@@@@@@@@@@@@8,                                                      
                                                     .G@@@@@@@@@@@@8;                                                        
                                                        .tG8@@@0f:                                                           
                                                                                                                             
                                                                                                                             
                                                                                        ::                                   
                                                                                       C@@@8;                                
                                                                                     :8@@@@@@@C                              
                                                                                    f@@@@@@@@@@@t                            
                            ,f0@@@@@@@@L,                                         ,8@@@@@@@@@@@@@0.                          
                        .L@@@@@@@@@@@@@@@@;                                      t@@@@@@@@@@@@@@@@8.                         
                      t@@@@@@@@@@@@@@@@@@@@0,                                  .0@@@@@@@@@@@@@@@@@@G                         
                    C@@@@@@@@@@@@@@@@@@@@@@@@i                                1@@@@@@@@@@@@@@@@@@@@@1                        
                  t@@@@@@@@@@@@@@@@@@@@@@@@@@@t                             .0@@@@@@@@@@@@@@@@@@@@@@0                        
                .0@@@@@@@@@@@@@@@@@@@@@@@@@@@@@t                           :@@@@@@@@@@@@@@@@@@@@@@@@@:                       
               ,@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@t                             i8@@@@@@@@@@@@@@@@@@@@@;                       
              :@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@i                              .L@@@@@@@@@@@@@@@@@@@i                       
             .8@@@@1    i8@@@@@@@@@@@@@@@@@@@@@@@@:                                f@@@@@@@@@@@@@@@@@;                       
              ,8@1        ,0@@@@@@@@@@@@@@@@@@@@@@8.                                ,8@@@@@@@@@@@@@@8.                       
                            t@@@@@@@@@@@@@@@@@@@@@@0                                  G@@@@@@@@@@@@@C                        
                             ;@@@@@@@@@@@@@@@@@@@@@@G                                  0@@@@@@@@@@@@;                        
                              i@@@@@@@@@@@@@@@@@@@@@@f                                 :@@@@@@@@@@@G                         
                               1@@@@@@@@@@@@@@@@@@@@@@1                                 G@@@@@@@@@@,                         
                                f@@@@@@@@@@@@@@@@@@@@@@:                                t@@@@@@@@@1                          
                                 C@@@@@@@@@@@@@@@@@@@@@@,                               1@@@@@@@@1                           
                                  G@@@@@@@@@@@@@@@@@@@@@0                               t@@@@@@@t                            
                                   0@@@@@@@@@@@@@@@@@@@@@C                              C@@@@@@t                             
                                   .8@@@@@@@@@@@@@@@@@@@@@f                            .@@@@@@t                              
                                    ,@@@@@@@@@@@@@@@@@@@@@@1                           f@@@@@f                               
                                     ;@@@@@@@@@@@@@@@@@@@@@@;                         f@@@@@f                                
                                      i@@@@@@@@@@@@@@@@@@@@@@,                       f@@@@@L                                 
                                       t@@@@@@@@@@@@@@@@@@@@@8.                     t@@@@@L                                  
                                        f@@@@@@@@@@@@@@@@@@@@@0                    1@@@@@L                                   
                                         C@@@@@@@@@@@@@@@@@@@@@L                  1@@@@@L                                    
                                          G@@@@@@@@@@@@@@@@@@@@@t                1@@@@@C                                     
                                           0@@@@@@@@@@@@@@@@@@@@@i              1@@@@@C                                      
                                           .8@@@@@@@@@@@@@@@@@@@@@:            1@@@@@G                                       
                                            ,@@@@@@@@@@@@@@@@@@@@@@,          i@@@@@G                                        
                                             ;@@@@@@@@@@@@@@@@@@@@@8.        i@@@@@G                                         
                                              i@@@@@@@@@@@@@@@@@@@@@0       ;@@@@@G                                          
                                               t@@@@@@@@@@@@@@@@@@@@@C     ;@@@@@G                                           
                                                f@@@@@@@@@@@@@@@@@@@@@f   ;@@@@@0                                            
                                                 C@@@@@@@@@@@@@@@@@@@@@1 ;@@@@@0                                             
                                                  G@@@@@@@@@@@@@@@@@@@@@t@@@@@0                                              
                                                   0@@@@@@@@@@@@@@@@@@@@@@@@@0.                                              
                                                   .8@@@@@@@@@@@@@@@@@@@@@@@8.                                               
                                                    ,@@@@@@@@@@@@@@@@@@@@@@8.                                                
                                                     ;@@@@@@@@@@@@@@@@@@@@8.                                                 
                                                      i@@@@@@@@@@@@@@@@@@8.                                                  
                                                       t@@@@@@@@@@@@@@@@8,                                                   
                                                        f@@@@@@@@@@@@@@@,                                                    
                                                         C@@@@@@@@@@@@@,                                                     
                                                          G@@@@@@@@@@@,                                                      
                                                           0@@@@@@@@@:                                                       
                                                            t@@@@@@f                              
-->
	<head>
		<title>About Pravega | Pravega &ndash; the IISc Science, Tech and Cultural Fest</title>
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
																<h2>About Pravega</h2>
																
															</header>
															
															<div class=row>
																<section class="1u"></section>
																<section class="5u hyphenate">
																	<p>Pravega is the Sanskrit word for acceleration &mdash; the derivative of velocity. It reflects the nature and potential of the fest to rapidly grow and become one of the best and most well-known science festivals in India.</p>
																	<p>Pravega will be a fest combining the best of science, technology, and culture. In its conception, it is the first and the largest of its kind, and is designed to attract those students who are the brightest, most creative, and most passionate about knowledge of any form. It will grow into a platform for the methodical science and experience of IISc to mingle with the exuberant and keen nature of the youth of India, each gaining from their interaction with the other.</p>
																	<p>Pravega is hoped to grow into a fest on the scale of other well-known fests, which are often conducted by the IITs. For the metropolitan city of Bangalore, it will be the only fest with such a vision, and will come to be associated with the student community of the city itself.</p>
																	<p>To meet this standard, the organizing team of Pravega has planned numerous events and exhibitions. As a rule, each event is an original creation, and will not be found anywhere else. The events are broadly categorized by the subject they concern, apart from the multi-disciplinary events, such as the quizzes planned. The events are designed to be intellectually stimulating and fun, sure to stay on the minds of the participants well after the fest has concluded.</p>
																</section>
																<section class="5u hyphenate">
																	<p>Another prominent feature of the fest will be the lectures held. Many distinguished guest speakers are being invited to deliver lectures here at the Institute. IISc is regularly host to lectures delivered by top personalities of the field, including Nobel Laureates, Fields Medal winners, recipients of the most prestigious national awards such as the Bhatnagar and SASTRA Ramanujan prizes, and many others. Similarly highly accomplished speakers are expected for the academic programme of Pravega.</p>
																	<p>As mentioned before, Pravega will become the premier fest of this scale and scope organised by any college in India. The emphasis on science competitions and lectures together is perhaps to be expected from an institution such as IISc, but is nevertheless completely unprecedented at this level. Apart from science, medicine and engineering colleges in Bangalore, a significant number of participants are anticipated from the IITs, IISERs and NITs in the neighbouring states, as well as other institutions.</p>
																	<p>One of the most anticipated aspects of Pravega is the scientifically and culturally eclectic atmosphere it will foster, by attracting passionate and intellectual students of all disciplines. It will be a forum where participants will continuously encounter, exchange, and imbibe new ideas and personalities and as a result will stretch and broaden their minds to new horizons. And where better than the Indian Institute of Science for such a platform?</p>
																</section>
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