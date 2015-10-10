<?php
include('header.php');
?> 
    
	
	<p style="text-align:center"><h2><br>Dexter's Laboratory</h2></p>
                        <img src="img/experiment_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Akash Yadav</b><br>akash@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 7;
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
    <section id="phydetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">

<br>
<i>“Experiment is the sole source of truth. It alone can teach us something new; it alone can 

give us certainty.” 

― Henri Poincaré, Science and Hypothesis<br></i><br>

Love to fiddle around with instruments? Laughed at for carrying a screwdriver in your pocket?

Then this event might just be the event for you!

In the second edition of this novel superhit event from last year, we introduce more nuances, 

more twists and turns for the avid experimenters to exercise their mental faculty and come up 

with unique solutions. Divided into two sections, this event will challenge the competitor with 

interesting problems, and the participant will be judged on the basis of his/her experimental 

design, intuitive approach, data analysis and logical deduction. So, don the hat of Sherlock and 

hone up your physics knowledge, because you’ll need all of that here!
                </p>
 
			</div>
        </div>
    </section>
<!-- Pronights Section -->
    <section id="phyrules" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>rules</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
				
1.	Participants can make teams of maximum 3 people. <br>
2.	The event will consist of two rounds; the prelims will be a written test, of 45 minutes, consisting of MCQs.<br>
3.	6-8 teams will be selected after the first round and they will proceed to the final round to be conducted in the Physics Lab.<br>
4.	The final round will consist of questions which can only be tackled with clever experimentation. <br>
5.	The final result will be completely based on the judge’s decision.
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

