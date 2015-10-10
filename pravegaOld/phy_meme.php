<?php
include('header.php');
?> 
   	<p style="text-align:center"><h2><br>|Trollstein></h2></p>
                        <img src="img/meme_bg.png" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Akash Yadav</b><br>akash@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 101;
						$check_sql="select * from participants ";
						$where ="where event_id='$event' and participant_id='$id'";
						$order = NULL;		
						$check=$db->select($check_sql, $where, $order);	
						$count=$db->countResult();
						if($count > 0) {
						?>
							<span style="font-size:15px; color: #9F0">You are already registered</span>
                        <?php
						}else {
						?>
                        <form id="register_form" name="register_event" method="post" enctype="multipart/form-data" action="pravega_action.php">
                            <p class="register"><input type="hidden" value="<?= $event ?>" name="event"></p>
                            <p class="register"><input class="register_input signup" type="submit" name="add_event" id="button" class="send_color sign_submit" value="Register" style="width:40%; margin-left:10px;" /></p>
                    	</form>
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
In this online event, we reach out to students, who want everyone to have a good laugh with 

witty, humorous memes on physics and physicists. While the topic can be anything 

remotely associated with the sacred subject of physics, witty interpretations of deep 

physical truths or wacky tales from the life of a physicist will be most welcome.
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
				
1.	Make memes on physics<br>
2.	Applicants will have to send their entries (max 3 per person) to akash@pravega.org. Rename your meme to (Name)-(College)-(Trollstein15) and mail it akash@pravega.org. Example: If Rajesh from IISc Bangalore has to submit an entry the file name should be Rajesh-IIScBangalore-Trollstein15.<br>
3.	Tagging "friends" on the entry is not allowed, in order to gain likes! You can "Share" the page and the entry for that.<br>

4.	Posting offensive comments on opponent's entry is strictly NOT allowed. Otherwise action will be taken accordingly.<br>

5.	Do not include your credentials (name, address, watermarks etc.) on the meme. Such memes will not be considered for the contest.<br>

<b>Judging Criteria:</b><br>

6.	Meme should be original. No piracy.<br>
7.	Maximum 3 memes per participant.<br>
8.	Shortlisted ones to be put on Pravega Facebook Page.<br>
9.	People need to like the Pravega page first, and then the entry of their choice. Otherwise that "Like" will not be considered.<br>
 
10.	Winners through Fb likes. Get maximum likes till January 20, 2015.<br>
11.	Much Fun!<br>

				
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
