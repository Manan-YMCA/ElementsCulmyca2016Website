<?php
require('php/fpdf/pdf_js.php');

class PDF_AutoPrint extends PDF_JavaScript
{
	function AutoPrint($dialog=false)
	{
		//Open the print dialog or start printing immediately on the standard printer
		$param=($dialog ? 'true' : 'false');
		$script="print($param);";
		$this->IncludeJS($script);
	}
}

if (isset($_GET['email']))
{
	$email = $_GET['email'];

	include('db_config.php');
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	$query = 'SELECT firstname, lastname, college FROM usernames WHERE email = "'.$email.'"';
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_row($result);

	$name = stripslashes($row[0]) . " " . stripslashes($row[1]);
	$college = stripslashes($row[2]);

	$pdf=new PDF_AutoPrint('L', 'mm', 'A4');
	$pdf->AddPage();
	$pdf->AddFont('Gill Sans','','gillsans_italic.php');
	$pdf->SetFont('Gill Sans','',26);
	$pdf->SetXY(102,-85);
	$pdf->Cell(168,0, stripslashes($name),0,1,'C');
	$pdf->SetXY(102,-53);
	$pdf->Cell(168,0, stripslashes($college),0,1,'C');
	$pdf->AutoPrint(false);
	$pdf->Output();
}

else
{
?>

<html lang="en">

	<head>
		<title>Register | Pravega &ndash; the IISc Science, Tech and Cultural Fest</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
		
		<link rel="stylesheet" href="css/modal.css" />
		<script src="js/hyphenate.js"></script> 
		<script src="js/custom.js"></script> 

	</head>
	<body class="no-sidebar">
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
																<h2>Print Certificate</h2>
																
															</header>
													
															<div class="row">
																<div class="12u" style="text-align:center;">
																<form method="get" action="print_certificate" class="signin">
																	<table style="border-collapse:collapse;">
																	<tr>
																		<td class="form_labels">Email Address:</td>
																		<td><input required autofocus class="text" type="email" name="email" placeholder="Email Address"></td>
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
</html>
<?php
}
?>