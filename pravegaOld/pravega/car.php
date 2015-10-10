<?php
include('header.php');
?> 
    	
	<p style="text-align:center"><h2><br>fifth gear</h2></p>
                        <img src="img/car_bg.jpg" height="430px"></img></p></header>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinators<br><br><b> T Sarat Chandra Kanth</b><br>sarat@pravega.org<br>8762 728 624<br><br> <b> Rahul C</b><br>rahul@pravega.org<br>9611 343 121</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 13;
						$member_count = 4;
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
 <!-- detail section -->
    <section id="enggdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
Who will have the skill to put together the beast on wheels that will negotiate all the loops, jumps and twists in our specially constructed racing track, with both speed and style? This event will bring all your racing fantasies to life, with the fastest finisher putting their name onto Pravega’s engineering hall of fame. 
                
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
1. Teams can have a maximum of 4 members.<br>
2. Participants have to bring their own car.<br>
3. The track will be 40 cm wide.<br>
4. The cars will hit the track one at a time.<br>
5. The car must be self-built.<br>
6. Only electric cars with less than 15V battery are allowed.<br>
7. The objective is to cover the track as quickly as possible.<br>
8. Refer to the problem statement for further details.<br><br>

<b>Note:</b> Participants with Engine Cars please contact the coordinator before registering. 			

<p style="text-align:center"><br><br><a href="fifth_gear_problem_statement.pdf" style="border: 1px solid #219ab3 !important;" class="btn  btn-default btn-lg button" target="_blank">Problem Statement</a></p>	
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
