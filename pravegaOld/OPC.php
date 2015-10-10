<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>Online Programming Contest</h2></p>
                        <img src="img/opc_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinators<br><b>Sanal S Prasad</b><br>sanal@pravega.org<br><br><b>Sabareesh R</b><br>sabareesh@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 12;
						$member_count = 3;
						$check_sql="select * from participants ";
						$where ="where event_id='$event' and participant_id='$id'";
						$order = NULL;		
						$check=$db->select($check_sql, $where, $order);	
						$count=$db->countResult();
						if($count > 0) {
						?>
							<span style="font-size:14px; color: #9F0">You are already registered</span>
                        <?php
						}else {
						?>
                            <span class="group_event"><a class="pop_up" href="group_event.php?event_id=<?= $event ?>&member_count=<?= $member_count ?>">Register</a></span>
                        <?php } ?>
						
						</div>
						</div></div></div>
    </header>

 <!-- detail section -->
    <section id="enggdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
We take our code seriously. Do you?
Join us for the latest edition of our online programming challenge, where we take the exhilaration of algorithmic problem solving to ever greater heights. Last year, we saw intense competition between the best teams in the country, and Pravega’s OPC has now become an event pencilled into every aspiring programmer’s calendar. Team up with friends from your institution and get set for an algorithmic intoxication!
                </p>
 
			</div>
        </div>
    </section>
<!-- rules Section -->
    <section id="enggrules" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>rules</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
1. This is an Online Programming Contest to be held on 10<sup>th</sup>&nbspJanuary 2015, 9 pm onwards.<br>
2. Participation can be in teams of at most 3.<br>
3. The contest will be hosted on CodeChef platform.<br>
4. All rules and regulations of CodeChef contests apply here as well.<br>
5. The winner will be decided on the basis of number of problems solved and time spent on solving each problem. There will be penalties for wrong submissions.<br>
6. Each participant will have to register on Pravega website in order to be eligible to win the contest prizes.<br>
7. The duration of the contest is 3 hours.<br>


                </p>
			</div>
        </div>
    </section>


	
	
	
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

      <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA"></script>-->




    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>
	<script src="js/drop_sub.js"></script>

</body>

</html>
