<?php
include('header.php');
?> 
    
	
	<p style="text-align:center"><h2><br>Microsoft Machine Learning Challenge</h2></p>
                        <img src="img/microsoft_bg.png" height="430px"></img></header>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Naren Manjunath</b><br>naren@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 24;
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
						

 <!-- detail section -->
    <section id="phydetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>Winners</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
The winning teams are: <br><br>
1. <b>Pranav M Shyam</b> and <b>Sripada K S Bhatt</b> from RV College of Engineering, Bangalore.<br>
2. <b>Soumyadeep Mukherjee</b>, <b>Kumar Agarwal</b> and <b>Yogesh Poddar</b> from IIT Kharagpur.<br><br>

They each won a cash prize of Rs. 30,000!
			   </p>
			</div>
        </div>
    </section>
<!-- Pronights Section >
    <section id="phyrules" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>rules</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
				
1. The contest is open to anyone pursuing an <b>Undergraduate or a Masters Degree</b>.<br>
2. Teams can have a maximum of 3 members. Inter- college teams are allowed.<br>
3. All participants must register for Pravega in order to be considered for evaluation.<br>
4. The contest is open until the end of January 26. Entries after January 26 will not be accepted.<br>
5. Results will be declared on or before February 1. The decision of the judges is final and binding.<br>
6. Submissions will be accepted from January 18 onwards. Details on how to submit are mentioned in the Problem Statement.<br>
                </p>
				
				<p class="col-lg-10 col-lg-offset-1" style="text-align: center">
					<a href="microsoft_problem_statement.pdf" class="btn btn-default btn-lg" target="_blank" style="align:center">problem statement</a>
				</p>
				</div>
        </div>
    </section-->
			 
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
