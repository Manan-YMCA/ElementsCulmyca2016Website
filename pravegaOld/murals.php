<?php
include('header.php');
?> 
    					<p style="text-align:center"><h2><br>Molecular Murals</h2></p>
                        <img src="img/murals_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Avishek Das</b><br>avishek@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 5;
						$member_count = 2;
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
A palette of chemicals waiting to paint a T-shirt canvas!<br>

Let salts be your reactants, your wit be your catalyst and a colourful T-shirt, your product. Watch while inorganic chemical reactions transform a mundane white T-shirt into an ensemble of colours.
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
				1.	Each team will have 2 members.
				<br>
				2.	Participants are required to synthesize their own colours from the inorganic chemicals provided, and use them to paint on T-shirts. A sheet will be provided for putting down the reactions involved. Estimated duration is 3.5 hours.
<br>
				3.	The criteria for judging include creativity, number of colours synthesized and the reactions employed.
<br>
				4.	Plain T-shirt (white), paintbrushes, pencils, paper, gum (for thickening the colours) and spare cloth will be provided.
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
