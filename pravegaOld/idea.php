<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>The Idea Within</h2></p>
                        <img src="img/idea_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Shalaka Shinde</b><br>ideawithin@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 15;
						$member_count = 4;
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
    <section id="chemdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
<i>"You grow ravenous. You run fevers. You know exhilarations. You can't sleep at night, because your beast-creature ideas want out and turn you in your bed. It is a grand way to live."
<br>–Ray Bradbury, Zen in the Art of Writing</i>
<br><br>

Are you that kind of an idea-machine? A one man thinktank?
Are you committed to improve society with your smart solutions and innovative ideas?
GE and Pravega provide you with a platform to wow the world with your ideas!
<br>
<b>
Lots of exciting prizes and goodies to be won, including an internship at GE!<br>
Theme: Affordable Transport and Energy</b>
                </p>
 
			</div>
        </div>
    </section>
<!-- rules Section -->
    <section id="chemrules" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>rules</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
•	Participation can be as individuals or as a team of two.<br>
•	All participants must register for Pravega'15 by sending a mail to the event coordinator. <br>
•	Idea presented must be original. Any instances of plagiarism will lead to disqualification. At all stages, all <br>&nbsp sources must be duly cited. <br>
•	The contest is open to all undergraduates and postgraduates. <br>
•	The decision of judges is final and binding. <br>
•	Selected teams will have to present their work at Pravega 2015. <br>
•	There will be no extension in the deadlines. All papers/abstracts received late will be disqualified. <br>
•	<b>Important Dates:</b>&nbsp 31<sup>st</sup>&nbspDecember, 2014: Abstract submission<br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
10th January, 2015: Confirmation of selected abstracts for presentation.<br> 	
•	The participants must submit a description (2 pages maximum) outlining the specific problem being <br>&nbsp addressed, proposed solution and a rough sketch of how they plan to proceed from the idea to <br>&nbsp a realizable solution. <br>
•	The abstract must be sent in pdf format to the email-address provided. <br>
•	The following details must be mentioned clearly on the abstract: <br>
•	Name of Participant(s) <br>
•	Institution<br>
•	Course enrolled in along with year of study<br>
•	Selected Participants will be notified by email. <br>
•	25th January, 2015: Submission of final presentation<br>
•	Participants must submit their final presentation in pdf format to the email address provided. <br>
•	The presentation must not be more than 15 minutes long. <br>
•	In case a participant wants to present a model/prototype, he/she must submit a video recording of <br>&nbsp the same “<i>in action</i>” along with the presentation. <br>
•	30th January- 1st February,2015: Final presentation at Pravega'15<br>
•	Participants will be required to present their work to a panel of experts at Pravega'15. <br>
•	Participants will be notified of the exact date, time and venue along with the email confirming selection <br>&nbsp of abstracts<br>
•	All submissions/communications are to be mailed to ideawithin@pravega.org.

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
