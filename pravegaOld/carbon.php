<?php
include('header.php');
?> 
    	<p style="text-align:center"><h2><br>Carbon, Carbon Everywhere</h2></p>
                        <img src="img/carbon_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Avishek Das</b><br>avishek@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 4;
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
An event to celebrate the omnipresence of Carbon, it is an Organic Chemistry Challenge that 
is bound to synthesize polymers of intellect.<br>

The event unfolds in two stages:<br>
• Exciting puzzles on Organic Chemistry to tease your brain while you sit on your 
armchair.<br>
• Getting off the armchair, you prepare yourself for some mind-boggling questions on 
stereoselective syntheses and enzyme catalyses.<br>

Inert to formulae?<br>
Well, we provide you with balls and sticks to make the experience that much more 
real. Join the game!
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
				2.	The first round is a general organic chemistry written quiz for 1 hour. 
<br>
				3.	5 teams proceed to the final round. The final round consists of two parts having questions from stereoselective reactions and enzyme catalysis. The participants have to explain their answer by making ball and stick models of the molecules. Estimated duration for this round is 2 hours.
<br>
				4.	Pen, paper, and ball and stick molecular model sets will be provided.
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
