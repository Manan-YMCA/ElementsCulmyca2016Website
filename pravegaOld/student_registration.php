<?php
include('testheader.php');
if (isset($_SESSION['user'])) {
	header('location:my_account.php');
	return false;
}
?>  
    
<!-- About Section -->
    <header class="intro">
        <div class="intro-body">
   <section id="" class=" container-fluid content-section text-center">
        <div class="row">
		<p><br><br></p>
            <div class="col-lg-10 col-lg-offset-1">
                <h2>Student Registration</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
                	<form id="register_form" name="register" method="post" enctype="multipart/form-data" action="mail.php">
                    		<label style="float:left">* Required fields</label><br>
                            <p class="register"><input class="register_input" name="name" id="name" placeholder="Name *" required></p>
                            
                            <p class="register"><input class="register_input" type="text" name="email" id="email" placeholder="Email ID *" title="Email" required email="true"/></p>
                            
                            <p class="register"><input class="register_input" type="password" name="password" id="password" placeholder="Password *" required title="Password"/></p>
                            <p class="register"><input class="register_input" type="password" name="cpassword" id="cpassword" required placeholder="Confirm Password *" title="Confirm Password"/></p>
                            <p class="register"><input class="register_input" type="text" name="mobile" id="mobile" required number="true" placeholder="Mobile *" title="Mobile *"/></p>
                            <p class="register">
                            	<select id="city" name="city" class="select_city" required>
                                    <option disabled="disabled" selected="selected">Select your city *</option>
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
                                        <option value="Andra Pradesh-Other">Andra Pradesh – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Arunachal Pradesh</option>
                                        <option value="Itanagar">Itanagar</option>
                                        <option value="Arunachal Pradesh-Other">Arunachal Pradesh – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Assam</option>
                                        <option value="Guwahati">Guwahati</option>
                                        <option value="Silchar">Silchar</option>
                                        <option value="Assam-Other">Assam – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Bihar</option>
                                        <option value="Bhagalpur">Bhagalpur</option>
                                        <option value="Patna">Patna</option>
                                        <option value="Bihar-Other">Bihar – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Chhattisgarh</option>
                                        <option value="Bhillai">Bhillai</option>
                                        <option value="Bilaspur">Bilaspur</option>
                                        <option value="Raipur">Raipur</option>
                                        <option value="Chhattisgarh-Other">Chhattisgarh – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Goa</option>
                                        <option value="Panjim/Panaji">Panjim/Panaji</option>
                                        <option value="Vasco Da Gama">Vasco Da Gama</option>
                                        <option value="Goa-Other">Goa – Other</option>
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
                                        <option value="Gujarat-Other">Gujarat – Other</option>
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
                                        <option value="Haryana-Other">Haryana – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Himachal Pradesh</option>
                                        <option value="Dalhousie">Dalhousie</option>
                                        <option value="Dharmasala">Dharmasala</option>
                                        <option value="Kulu/Manali">Kulu/Manali</option>
                                        <option value="Shimla">Shimla</option>
                                        <option value="Himachal Pradesh-Other">Himachal Pradesh – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Jammu and Kashmir</option>
                                        <option value="Jammu">Jammu</option>
                                        <option value="Srinagar">Srinagar</option>
                                        <option value="Jammu and Kashmir-Other">Jammu and Kashmir – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Jharkhand</option>
                                        <option value="Bokaro">Bokaro</option>
                                        <option value="Dhanbad">Dhanbad</option>
                                        <option value="Jamshedpur">Jamshedpur</option>
                                        <option value="Ranchi">Ranchi</option>
                                        <option value="Jharkhand-Other">Jharkhand – Other</option>
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
                                        <option value="Karnataka-Other">Karnataka – Other</option>
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
                                        <option value="Kerela-Other">Kerela – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Madhya Pradesh</option>
                                        <option value="Bhopal">Bhopal</option>
                                        <option value="Gwalior">Gwalior</option>
                                        <option value="Indore">Indore</option>
                                        <option value="Jabalpur">Jabalpur</option>
                                        <option value="Ujjain">Ujjain</option>
                                        <option value="Madhya Pradesh-Other">Madhya Pradesh – Other</option>
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
                                        <option value="Maharashtra-Other">Maharashtra – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Manipur</option>
                                        <option value="Imphal">Imphal</option>
                                        <option value="Manipur-Other">Manipur – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Meghalaya</option>
                                        <option value="Shillong">Shillong</option>
                                        <option value="Meghalaya-Other">Meghalaya – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Mizoram</option>
                                        <option value="Aizawal">Aizawal</option>
                                        <option value="Mizoram-Other">Mizoram – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Nagaland</option>
                                        <option value="Dimapur">Dimapur</option>
                                        <option value="Nagaland-Other">Nagaland – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Orissa</option>
                                        <option value="Bhubaneshwar">Bhubaneshwar</option>
                                        <option value="Cuttak">Cuttak</option>
                                        <option value="Paradeep">Paradeep</option>
                                        <option value="Puri">Puri</option>
                                        <option value="Rourkela">Rourkela</option>
                                        <option value="Orissa-Other">Orissa – Other</option>
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
                                        <option value="Punjab-Other">Punjab – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Rajasthan</option>
                                        <option value="Ajmer">Ajmer</option>
                                        <option value="Jaipur">Jaipur</option>
                                        <option value="Jaisalmer">Jaisalmer</option>
                                        <option value="Jodhpur">Jodhpur</option>
                                        <option value="Kota">Kota</option>
                                        <option value="Udaipur">Udaipur</option>
                                        <option value="Rajasthan-Other">Rajasthan – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Sikkim</option>
                                        <option value="Gangtok">Gangtok</option>
                                        <option value="Sikkim-Other">Sikkim – Other</option>
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
                                        <option value="Tamil Nadu-Other">Tamil Nadu – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Tripura</option>
                                        <option value="Agartala">Agartala</option>
                                        <option value="Tripura-Other">Tripura – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Union Territories</option>
                                        <option value="Chandigarh">Chandigarh</option>
                                        <option value="Daman &amp; Diu">Daman &amp; Diu</option>

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
                                        <option value="Uttar Pradesh-Other">Uttar Pradesh – Other</option>
                                    <option disabled="disabled"></option>
                                    <option disabled="disabled" style="background-color:#154b9e; color:white;">Uttaranchal</option>
                                        <option value="Dehradun">Dehradun</option>
                                        <option value="Roorkee">Roorkee</option>
                                        <option value="Uttaranchal-Other">Uttaranchal – Other</option>
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
                            </p>
                            <p class="register"><input class="register_input" type="text" name="college_name" id="college_name" required placeholder="College Name *" title="College Name"/></p>
                            <!--<p class="register"><input class="register_input" type="text" name="dob" id="dob" placeholder="Date of Birth *" required title="Date of Birth"/></p>-->
                            <p class="register">
                            	Date of birth *<br>
                            	<select name="day" class="select_city" required style="width:16%">
                                	<option value="">Day</option>
									<?php for($i=1;$i<=31;$i++):
                                    		if($i < 10)
												$i = '0'.$i;
									?>
                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php endfor;?>
                                </select>
                            	<select name="month" class="select_city" required style="width:17%;margin-left:4px;">
                                	<option value="">Month</option>
                                	<option value="january">january</option>
                                	<option value="february">february</option>
                                	<option value="march">march</option>
                                	<option value="april">april</option>
                                	<option value="may">may</option>
                                	<option value="june">june</option>
                                	<option value="july">july</option>
                                	<option value="august">august</option>
                                	<option value="september">september</option>
                                	<option value="october">october</option>
                                	<option value="november">november</option>
                                	<option value="december">december</option>
                                </select>
                            	<select name="year" class="select_city" required style="width:16%;margin-left:4px;">
                                	<option value="">Year</option>
									<?php for($j=2000;$j>=1970;$j--):?>
                                        <option value="<?php echo $j;?>"><?php echo $j;?></option>
                                    <?php endfor;?>
                                </select>
                        	</p>
                            <p class="register" style="margin-bottom:0;">
                            Where did you come to know about Pravega?<br>
                            <label class="check_label"><input class="check_know" type="checkbox" name="know[]" value="Social Media">Social Media</label><br>
                            <label class="check_label"><input class="check_know" type="checkbox" name="know[]" value="Newspaper">Newspaper</label><br>
                            <label class="check_label"><input class="check_know" type="checkbox" name="know[]" value="Radio">Radio</label><br>
                            <label class="check_label"><input class="check_know" type="checkbox" name="know[]" value="College Fest Websites">College Fest Websites</label><br>
                            <label class="check_label"><input class="check_know" type="checkbox" name="know[]" value="College Ambassador">College Ambassador</label>
                            <br><label class="check_label"><input class="check_know" type="checkbox" name="know[]" value="Posters">Posters</label><br>
                            <label class="check_label_other"><span style="float:left">Other</span><input class="register_input" type="text" name="other_know" placeholder="" title=""/></label>
                            </p>
                            <p class="register"><input class="register_input" type="text" name="ambassador_id" id="ambassador_id" placeholder="Your College Ambassador's ID" title="Your College Ambassador's ID"/></p>
                            <p class="register"><input class="register_input signup" type="submit" name="register" id="button" class="send_color sign_submit" value="Sign Up" /></p>
                    </form>
                </p>
			</div>
        </div>
    </section>
	</div>
    </header>
	

    <!-- Map Section -->
   <!-- <div id="map"></div>-->

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; Pravega 2015</p>
        </div>
    </footer>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

      <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA"></script>




    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>
    <script src="js/script.js"></script>

</body>
<a href="https://plus.google.com/+PravegaOrg" rel="publisher">Google+</a>
</html>
