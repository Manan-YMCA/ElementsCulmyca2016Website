<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>Colours From The Grey</h2></p>
                        <img src="img/CFTG_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Tushar Mishra</b><br>tushar@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 1;
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
Get ready for an intellectual feast in the second edition of Colours from the Gray. Participating teams will be given questions on various fields in biology from a common bank. They will need to answer a minimum number of questions from each field to render themselves eligible for the big prize, so only the fittest all-round specimens will survive. And in case they needed any more competitive incentive, it’s arranged that once a team answers a question, no other team will be given access to that question. 
As a combination of knowledge, reasoning, suspense and strategy, this one is going to be a classic.
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
								
•	Participants will have to come in teams of three.<br>
•	The event consists of two rounds. <br>
•	Preliminary round would constitute of 25-30 questions (pen and paper round).<br>
•	Five teams would be selected for the finals on the basis of their score in the first round.<br>
•	Participants will be provided with laptops for the final round.<br>
•	Final round would consist of following domains/sub-disciplines :<br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp1.	Ecology and Evolutionary Biology<br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp2.	Genetics<br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp3.	Physiology <br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp4.	Biochemistry/ Molecular Biology<br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp5.	Neuroscience<br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp6.	Interdisciplinary<br>
•	Each domain would consist of at least 10 questions.<br>
•	Each team is allowed to view 4 out of 10 questions. The team is supposed to answer 2 of them correctly to complete a domain.<br>
•	The answers will be corrected in real time by judges.<br>
•	After a question has been answered by two teams, it will be locked out for other teams.<br>
•	 The aim of the game is to complete all the domains. The team who finishes all the domains first would be declared winner.<br>
•	Any further rules or queries will be clarified on the day of the event itself.<br>
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