<?php
	session_start();

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
																<h2>Register</h2>
																
															</header>
													
															<div class="row">
																<div class="12u" style="text-align:center;">
																<?php 
																	if ($_SESSION['success'] == 1)
																	{
																?>
																	<h2><?php echo $_SESSION['name']; ?> (<?php echo $_SESSION['email']; ?>) has been successfully confirmed your registration at Pravega.</h2><br>
																	<script>
																		window.open("pdf.php?name=<?php echo $_SESSION['name']; ?>&college=<?php echo $_SESSION['college']; ?>");
																	</script>
																<?php
																	}
																	elseif ($_SESSION['return'] == 1) echo "<h2>Your account is missing some details. Please fill them in now.</h2><br>";
																	elseif ($_SESSION['errors'] == 1) echo "<h2>There were some errors in your submission, which are marked in red.<br>Please correct them and submit again.</h2><br>";
																?>
																<form method="post" action="register_existing.php" class="signin">
																	<table style="border-collapse:collapse;">
																	<tr>
																		<td class="form_labels">Email Address:</td>
																		<td>
																			<input type="hidden" name="returning" value="<?php if (isset($_SESSION['return'])) echo $_SESSION['return']; else echo 0;?>">
																			<input required autofocus class="text <?php if (isset($_SESSION['errors_email'])) echo "error";?>" type="email" name="email" placeholder="Email Address" <?php if($_SESSION['errors_email'] == 1 || $_SESSION['return']) echo 'value="'. $_SESSION['email']. '"';?>>
																		</td>
																	</tr>
																	<tr>
																		<td class="form_labels">Emergency Contact Number:</td>
																		<td><input required class="text <?php if(isset($_SESSION['errors_emergency_contact'])) echo "error";?>" type='tel' pattern='\d{10}' maxlength="10" name="emergency_contact" placeholder="Emergency Number (10 digit)" <?php if(isset($_SESSION['emergency_contact'])) echo 'value="'. $_SESSION['emergency_contact']. '"';?>></td></td>
																	</tr>
																	<tr>
																		<td class="form_labels">Number of Agam Tickets:</td>
																		<td><input required class="text" maxlength="2" name="num_bands" value="<?php if(isset($_SESSION['num_bands'])) echo $_SESSION['num_bands']; else echo '1';?>"></td></td>
																	</tr>
																
																<?php
																	if ($_SESSION['return'])
																	{
																?>
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
																	
																<?php
																	}
																?>
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
<?php
	}
	session_destroy();
?>
</html>