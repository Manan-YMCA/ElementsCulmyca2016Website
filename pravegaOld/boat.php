<?php
include('header.php');
?> 
    	
	<p style="text-align:center"><h2><br>High Tide</h2></p>
                        <img src="img/boat_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinators<br><br><b> T Sarat Chandra Kanth</b><br>sarat@pravega.org<br><br> <b> Rahul C</b><br>rahul@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 14;
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
    </header>

 <!-- detail section -->
    <section id="enggdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
For all those who want to test their metal on water, Pravega presents an exciting RC Boat race. Manoeuvre your boat around 15 checkpoints and be the first to sail past the finish line to win this event. To foster collaboration, we allow intercollege teams of up to 5 members per team. So, do you have it in you to tame the tides?
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
2. The boat must be self-built.<br>
3. Participants bring their own remote controlled boats.<br>
4. Pool will be approx. 10feetx8feet and depth will be 15cm.<br>
5. Boat will only be tested on manoeuvring capabilities.<br>
6. Refer to the problem statement for further details.<br>
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
