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
				padding:7px;
			}
		</style>
	</head>
	<body class="no-sidebar" >
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
																<h2>Participant Info</h2>
															</header>
													
															<div class="row">
															<div class="2u">
																<div id="sidebar">
																	<a href="view_winners">View Winners</a><br>
																	<b><a href="participant_info">Participant Info</a></b>
																	<a href="extra_ticket">Extra Bands</a>
																</div>
															</div>
																<div class="10u" style="text-align:center;">
																<?php
																	if (isset($_GET['email']))
																	{
																		$email = $_GET['email'];
																		
																		include('db_config.php');
																		$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
																		$query = 'SELECT firstname, lastname, mobile, emergency_contact, college, paid, num_bands FROM usernames WHERE email="'.$email.'"';
																		$result = mysqli_query($link, $query);
																		
																		$row = mysqli_fetch_row($result);
																		$firstname = $row[0];
																		$lastname = $row[1];
																		$mobile = $row[2];
																		$emergency_contact = $row[3];
																		$college = $row[4];
																		$paid = $row[5];
																		$num_bands = $row[6];
																		
																	?>
																	<table class="abnormal">
																	<tr>
																		<td><b>Name</b></td>
																		<td><b>Mobile Number</b></td>
																		<td><b>Emergency Contact</b></td>
																		<td><b>College</b></td>
																		<td><b>Paid?</b></td>
																		<td><b>Number of Agam Tickets</b></td>
																	</tr>

																	<tr>
																		<td><?php echo $firstname . " " . $lastname; ?></td>
																		<td><?php echo $mobile; ?></td>
																		<td><?php echo $emergency_contact; ?></td>
																		<td><?php echo $college; ?></td>
																		<td><?php if ($paid) echo "Yes"; else echo "No"; ?></td>
																		<td><?php echo $num_bands; ?></td>
																	</tr>

																	<?php
																	}


																	else
																	{

																	?>

																	<form action="participant_info" method="get">
																		<table style="border-collapse:collapse;" class="normal">
																		<tr>
																			<td class="form_labels">Email Address:</td>
																			<td>
																				<input type="hidden" name="returning" value="<?php if (isset($_SESSION['return'])) echo $_SESSION['return']; else echo 0;?>">
																				<input required autofocus class="text <?php if (isset($_SESSION['errors_email'])) echo "error";?>" type="email" name="email" placeholder="Email Address" <?php if($_SESSION['errors_email'] == 1 || $_SESSION['return']) echo 'value="'. $_SESSION['email']. '"';?>>
																			</td>
																		</tr>
																		<tr style="background: transparent;">
																			<td style="text-align:center; padding-top:35px;" colspan="2">
																				<fieldset class="textbox">
																				<input class="button_modal textbox" style="display:inline-block; border:0px; border-radius: 3px;" type="submit" value="Get Info">
																				</fieldset>
																			</td>
																		</tr>
																		</table>
																	</form>

																	<?php
																	}
																	?>
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
