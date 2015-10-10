<?php
include('header.php');
?> 
    
	
	<p style="text-align:center"><h2><br>Microsoft Machine Learning Challenge</h2></p>
                        <img src="img/armchair_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Akash Yadav</b><br>akash@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 6;
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
Microsoft and Pravega together bring you a chance to work on a problem that is both exciting and of great current interest. 

The event is a challenge in object recognition through machine learning. If you feel you are one of the best college programmers 
out there, you'll be getting excited about this one. You have until January 25 to send us a complete solution to the problem stated
below. The best solutions stand to win their authors a total prize money of Rs 60000 and possible internships at Microsoft!

                </p>
 
			</div>
        </div>
    </section>
<!-- Pronights Section -->
    <section id="rules" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>rules</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
				
1. The contest is open to anyone pursuing an undergraduate degree and is among teams of maximum 3 members. Inter- college teams are allowed.<br>
2. All participants must register for Pravega in order to be considered for evaluation.<br>
3. The contest is open until the end of January 26. Entries after January 26 will not be accepted.<br>
4. Results will be declared on or before February 1. The decision of the judges is final and binding.<br>
5. Submissions will be accepted from January 18 onwards. Watch this space for further details.<br>
                </p>
				
				<p class="col-lg-10 col-lg-offset-1" style="text-align: center">
					<a href="Problem_Statement.pdf" class="btn btn-default btn-lg" target="_blank" style="align:center">problem statement</a>
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
