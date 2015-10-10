<?php
include('header.php');
?> 
    	
	<p style="text-align:center"><h2><br>Who'dunnit?</h2></p>
                        <img src="img/who_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Tushar Mishra</b><br>tushar@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 2;
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
    <section id="biodetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
Here is the crime everyone craved to solve, right in the heart of Pravega. Participants will need to clear a first round consisting of several simple logical cases to earn the right to take on the big case. In the second round, there will be a crime scene and many clues to find. Several clues will consist of biological or chemical observations. Participants will need to extract the necessary information from these observations through tests, analysis and identification, either performing the tests or requesting for the results of that test to be given to them if it can’t be performed practically. We will be at pains to ensure that almost all the technical knowledge needed for this event is given in advance, and reasoning is the only prerequisite. In the end, each team will present their deductions, along with their reasoning and then let’s see if we can unearth the next Sherlock Holmes!
                </p>
 
			</div>
        </div>
    </section>
<!-- Pronights Section -->
    <section id="biorules" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>rules</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
				
•	Participants should come in teams of three.<br>
•	The event consists of three rounds. <br>
•	Preliminary round would consist of a question paper with 15-20 logical cases.<br>
•	 Teams would be required to solve the cases within an hour.<br>
•	The teams would be selected for the Forensic round on the basis of their scores in the first round.<br>
•	In the forensic round, the teams would be provided with <br>
&nbsp&nbsp&nbsp&nbsp&nbsp o	A general description of the crime scene.<br>
&nbsp&nbsp&nbsp&nbsp&nbsp o	A list of suspects and their history with the victim(s)<br>
&nbsp&nbsp&nbsp&nbsp&nbsp o	A general description of the victim. ( i.e. habits, medical history and so forth)<br>
&nbsp&nbsp&nbsp&nbsp&nbsp o	An autopsy report without actual conclusions <br>
&nbsp&nbsp&nbsp&nbsp&nbsp o	Other miscellaneous evidence and witness reports as and when asked for.<br>
•	The objective of the Forensic round is to solve the case and find "who-dun-it".<br>
•	The objective of the final round is to present the case with all the evidences and conclusions to judges.<br>				
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
