<?php
include('header.php');
?> 
    	
	<p style="text-align:center"><h2><br>Mad ads</h2></p>
                        <img src="img/madads_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Dhruv Mehrotra</b><br>dhruv@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 21;
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
    <section id="cultdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
Tired of those countless ads on TV? <br>
Don't you think they are boring? <br>
Do you have something innovative?<br> Do you think you can sell a product the way no one 

has ever? <br><br>
Then this event is for you! Show us your innovation and improvisation skills, in this Battle Of The Insane. 

Fight it out to prove. After all, paagalpanti bhi zaroori hai!
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
<b>Judgement criteria:</b><br>

The participants will be judged on the following:<br>
•	Stage presence <br>
•	Adherence to topic<br>
•	Team work/Co-ordination <br>
•	Spontaneity/creativity<br>
•	Clarity of message<br>
•	Jingle/slogan<br><br>

<b>Rules: </b><br>
•	The teams shall have to pick a product, via a lottery, on the spot , and make a mad-ad for the same. <br>

•	Teams have to make a new product name, punch line and advertise the product/brand given to them.<br>

•	Participants cannot copy existing advertisements. <br>

•	Different forms of expression like a short skit, jingles, slogans, banners or any other innovative form can be incorporated.<br>

•	The contestants are strictly advised not to disclose the name of their College/Institution to the Jury members/audience.<br>

•	Caution should be taken to refrain from displaying obscenity, violence, prejudice, defamation etc. In the ad. Not doing so may lead to disqualification. <br><br>


<b>Other mandatory guidelines:</b><br>
•	One entry per college.<br>
•	A team can consist of at most 5 members. Inidividual partipation is strictly not allowed.<br>
•	Time limit is 2 min + 30s for performing, and 15 min for discussion.<br>
•	The advertisement can be made in english and/or hindi. Any deviation from this rule, however small , can result in disqualification.<br>
•	The contestant may opt for a suitable dress code however the name of the college should not be displayed on the dresses in any form.<br>

•	In case participants exceed the time limit Judges shall be free to disqualify the team.<br>

•	Organizing committee shall not provide any Costume/Props. <br>

•	The Organizing Committee reserves the right to change the venue, time and rules, if desired.<br>


•	Decision of the judges will be final and binding. <br>
			
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
