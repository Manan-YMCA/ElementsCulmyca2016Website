<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>Lasya</h2></p>
                        <img src="img/lasya_bg.jpg" height="430px"></img><br>
                        
						
						
						</div>
						</div></div></div>
    </header>

 <!-- detail section -->
    <section id="cultdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Shamitha Govind</b><br>shamitha@pravega.org</p>
                <br>        
		                <?php
						$id = $_SESSION['user_id'];
						$event = 19;
						$member_count = 15;
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
						
				<br><br><br><br>		
				<h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
It's that time of the year again!<br>

We are here, with an event for those who crave to set the floor on fire! A fine blend of 
rhythm and poise with a touch of innovation, here's an opportunity to flaunt those 
amazing moves you have been practicing all year round.<br>
Be it hip-hop, folk, bollywood, jazz, or contemporary, put on your dancing shoes and 
prepare to get your boogie on.  With some insane shaking and shimmying, show us, 
that your troupe are the best dang dancers of Lasya @ Pravega'15!<br><br>


                </p>
			</div>
        </div>
    </section>

	<!-- Pronights Section -->
    <section id="cultrules" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>rules</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">

<b>Instructions for online prelims.</b><br>

• This is a team event with a Minimum of 4 members and a Maximum of 15 members.<br>
• A single team member should register here for the event.<br>
• Anyone with a valid school/ college ID card is allowed to participate.<br>
• Teams registered must submit their tracks (finals - 10 minutes) at least one and half 
hour before the event in a pen drive and CD in MP3 format and are requested to keep 
back up.<br>
• The following particulars are to be written on the CD: Name of the Team Leader, his Pravega username and phone number.<br>
• There will be 2 categories, i.e. <i>Bollywood Genre Category</i> and <i>Open Category</i> (no particular theme as such).<br>
• The last date for registration is 15<sup>th</sup>&nbspJanuary, 2015.<br>
• Team leaders must pick out spots at the specified time to decide the order of on-stage 
appearances.<br>
• Team members need not necessarily be from the same college.<br>
• Any number of teams is permitted from a college. But no participant can be a member 
of more than one team.<br>
• In addition to the maximum permissible number of dancers, each team can have a 
maximum of 3 non-dancers for music, lights, narration.<br>
• Remixes of songs can be used.<br>
• Variety in songs, costumes and proper utilization of properties yields extra marks.<br>
• Violation of rules will lead to disqualification.<br>
• Vulgarity in any form is strictly prohibited.<br>
• Use of water, fire or any inflammable substance is prohibited.<br>
• No additional time will be given for setting up the stage or props. Props include 
objects carried by participants, such as sticks, swords, pots etc.<br> 
• Chairs, tables, screens and backdrops come under stage settings.<br>
• The decision of the judges is final and no question will be entertained in this regard.<br>
• Teams should themselves clear the stage for the next team.<br><br>

<b>Judgment Criteria</b><br>
The participants will be judged on the following:<br><br>
<b>Category 1: Bollywood</b><br>
o Presentation<br>
o Choreography and synchronization<br>
o Song selection<br>
o Stage presence and style<br>
o Entertainment Factor!<br><br>
<b>Category 2: Open</b><br>
o Creativity and innovation<br>
o Choreography and coordination<br>
o Costumes, Song Selection and Properties<br>
o Stage presence and style<br>

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
