<html lang="en">
	<head>
		<title>Event Winners | Pravega &ndash; the IISc Science, Tech and Cultural Fest</title>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700,900" rel="stylesheet" />
		<script src="js/jquery.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>

		<link rel="stylesheet" href="css/modal.css" />
		
		<script src="js/view_winners.js"></script>
		<script>
			var timer = setInterval(makeGetRequest, 30000);
		</script>
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
	</head>
	<body class="no-sidebar" onload="makeGetRequest();">
			<!-- Header Wrapper -->
			<a href="http://www.iisc.ernet.in"><img src="images/iisc_logo.png" style="position:absolute; margin-top:32px; margin-left:25px; left:0; z-index:1;" height="50px"></a>
			<div id="header-wrapper" class="wrapper" style="background-size:cover; height: 225px;">
				<div class="container">
					<div class="row">
						<div class="12u">
							<!-- Header -->
								<div id="header">
									<div id="tiles">
										<span>
											<a href="http://pravega.org"><img id="pravega_logo" src="images/pravega_logo_noglow<?php if (mt_rand(1, 20) == 10) echo "_sanskrit"; ?>.png" draggable="false" style="-moz-user-select: none; -webkit-user-select: none; user-select: none; "></a>
										</span>
									</div>
								</div>
							<!-- /Header -->
						</div>
					</div>
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
											<div class="12u skel-cell-mainContent" style="margin-top: -25px;">
												<!-- Content -->
													<div id="content">
														<article class="is is-post">
															<header class="style1">
																<h2>Event Winners</h2>
															</header>
													
															<div class="row">
																<div class="2u">
																	<div id="sidebar">
																		<b><a href="view_winners">View Winners</a></b><br>
																		<a href="participant_info">Participant Info</a><br>
																		<a href="extra_ticket">Extra Bands</a>
																	</div>
																</div>
																<center>If the number of emails is less than the number of names, the extra email has not been registered. Please make sure they are registered before giving prizes.</center>
																<div class="10u" style="text-align:center;" id="winners">
																</div>
														</div>
														</article>
													</div>											
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