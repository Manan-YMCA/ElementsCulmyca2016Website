<?php
include('header.php');
?> 
    	
	<p style="text-align:center"><h2><br>Connect The Dots</h2></p>
                        <img src="img/connect_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Sanal S Prasad</b><br>sanal@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 11;
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
    <section id="enggdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
Programmers, you may start licking your lips! In Connect the Dots, we present you with a series of programming challenges where successfully solving the first problem gives you access to the second, solving the second problem gives the third, and so on until the end. Those that progress the farthest shall become the official Pravegeeks of 2015. Savvy? 

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
1.	It is a team event with each teams comprising of three participants.<br>
2.	There will be a preliminary pen and paper selection round for selecting the six teams in the final. The topics covered in prelims would be algorithms and basic math. Each team would be required to solve a programing problem using a computer (The computer will be provided) to proceed to the next level. The team that finishes first or makes it the farthest wins.<br>
3.	For the prelims, participants would need to have basic programing knowledge and some mathematical skills. <br>
4.	For the final round, the contestants need to know any one the following languages: C,C++,Java.				
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

