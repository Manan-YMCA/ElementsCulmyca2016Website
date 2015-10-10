<?php
include('header.php');
?> 
    	
	<p style="text-align:center"><h2><br>Bystander Effect</h2></p>
                        <img src="img/drama_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Dhruv Mehrotra</b><br>dhruv@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 22;
						$member_count = 10;
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
We live in an age of the sufferer and the witness. People being oppressed,all around us, and we watch, like silent spectators. We have eyes, but we forget we have hands. This Pravega '15, it's time to remind ourselves. 
Forget passivity. Act. Get involved. Try and rid the world of oppression. Raise awareness. Make a mark. Prove that you are no ordinary bystander, in our street play event, Bystander effect. 
<br><br>
We have watched and we have waited. Now we act. 
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
				
<b>1.	Concerning prelims:</b><br>
	a. There may or may not be prelims depending upon the number of teams who register. This information shall be intimated to participating teams well in advance.<br>
	b. If prelims have to be conducted, it will involve choosing a topic by a lottery, from a collection of topics that we have with us.<br>
	c. Teams will be given 30 minutes to gather their thoughts and ideas, and put up a 7+3 minute play on the topic that they have chosen. <br>


<b>2.	Concerning the finals:</b><br>
	a. Teams must perform a play, highlighting a social issue that concerned the Indian population, at some point of time in her glorious history. <br>
	b. It does not matter if the issue wasn’t a well-known one, or affected just a small group of individuals. We are looking out for how you present it to us, and how you make yourselves heard. <br>
	c. Your play can also include possible solutions to the issue that you are dealing with. <br>
	d. Teams shall have to make a poster highlighting their theme, and their message. This poster must be shown to the judges before the play..<br>


	e. The contestants are strictly advised not to disclose the name of their college/Institution to the Jury members/audience while introducing themselves on the stage.<br>

	f. Only one prop is allowed.  Face painting, costumes and usage of masks are not considered props.<br>

	g. Theme / plot / dialogue of the play shall not implicitly or explicitly hurt any
religious / nationalistic / patriotic feelings.<br>


<b>3.	Other mandatory guidelines:</b><br>
	a. One entry per college.<br>
	b. Maximum of 10 members allowed in each team. All must be from the same institution.<br>
	c. Time limit is 15+5 minutes (for the finals). Note that this INCLUDES the time that teams require for setup etc.<br>
	d. Use of mics , make up and music systems is strictly not allowed.  Teams can sing/dance by themselves to create the necessary effect.<br>

	e. Teams shall be allowed to use only English and/or Hindi as the language of the play. Any deviation from this rule, however small , can result in disqualification. <br>

	f. Use of vulgar language is prohibited. Points may be deducted for the same based on Judge’s discretion.<br>

	g. In case participants exceed the time limit Judges shall be free to disqualify the team.<br>

	h. Organizing committee shall not provide any Costume/Props. <br>

	i. The Organizing Committee reserves the right to change the venue, time and rules, if desired.<br>


	j. Decision of the judges will be final and binding. <br>
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
