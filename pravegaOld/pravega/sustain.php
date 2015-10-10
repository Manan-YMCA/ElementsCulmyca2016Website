<?php
include('header.php');
?> 
    					<p style="text-align:center"><h2><br>Sustainability Challenge</h2></p>
                        <img src="img/sustain_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Avishek Das</b><br>avishek@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 3;
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
    <section id="chemdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
Here is another chance to tackle the crisis of environmental damage. An event for the true Chemical Engineer, it is a double-layered test of the participants’ affinity for a radical solution to industrial problems. Whether you atomize the economy or economize the atoms, an element of change is what we are looking for. <br>

Tread the path of Green Chemistry in two exciting rounds:<br>

• A written test that provokes the Physical Chemist in you.<br>

• An engrossing group discussion to substitute for existing pathways and come up with more favourable ones.

                </p>
 
			</div>
        </div>
    </section>
<!-- rules Section -->
    <section id="chemrules" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>rules</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
				1.	Each team will have 3 members.
				<br>
				2.	The first round will be a short written quiz on environmental chemistry. Questions will focus on the physical chemistry aspects. 
				<br>
				3.	4 teams proceed to the final round. The final round is a group discussion. Participants are required to provide green and environment-friendly alternatives to industrial chemical pathways that harm the environment.
				<br>
				4.	Estimated duration for the whole event is 3 hours.
				<br>
				5.	Paper and pen will be provided. Participants should bring scientific calculators.
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
