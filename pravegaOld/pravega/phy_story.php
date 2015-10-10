<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>Physics Yarns</h2></p>
                        <img src="img/story_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Akash Yadav</b><br>akash@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 8;
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
    <section id="phydetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
“Individual science fiction stories may seem as trivial as ever to the blinder critics and 

philosophers of today - but the core of science fiction, its essence has become crucial to our 

salvation if we are to be saved at all.” 

-Isaac Asimov.

Want to save the world from an Alien Invasion?  Rip the space time continuum and travel 

through time?

Can you imagine beyond the restrictions of practicality? If yes this is “the” event for you.

Think about each and every miniscule detail of physics and make a working model of the Sci Fi stories that you read.
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
				
Team event, 3 people in a team.<br>
Preliminary test will be basic logic based question. <br>
Six teams will be selected for the final event. <br>
<b>FINAL EVENT-</b><br>
Brief - The final event is mostly about how well you can “observe” from a story and try to get the laws which in its best way describe the observation. The participants have to convince the co-members and judges of the events why their conclusion is a good explanation.<br>
<b>Details – </b><br>
1.	Hard copy of a narration will be provided to each of the six teams. <br>
2.	There will be three different narrations, and each narration will be given to two teams.<br>
3.	All kinds of discussion amongst team members as well as teams are allowed.<br>
4.	One hour will be allotted for teams to come up with the observations and conclusions.<br>
5.	Out of the two  teams which received the same narration, one by one they will have to present their findings to other members convince them about the validity of their logics with as less assumptions as possible. (Other team with the same clue will be out of this discussion).<br>
6.	Each team will be given 10-15 minutes to explain and then the other team members and judges can break into the discussion.<br>
<b>Recognitions-<br>
Teams will be judged on –</b><br>
1.	The conclusions and observations they make.<br>
2.	The way they describe their work.<br>
3.	The proficiency of answering the questions raised by others.<br>
4.	The participation of the Team in discussions of others research.<br>

				
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
