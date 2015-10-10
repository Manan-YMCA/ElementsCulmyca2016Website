<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>Lexico Bio</h2></p>
                        <img src="img/lexico_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Tushar Mishra</b><br>tushar@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 100;
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
                            <p class="register"><input class="register_input signup" type="submit" name="add_event" id="button" class="send_color sign_submit" value="Register" style="width:20%" /></p>
                    	</form>
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
It’s hard to spell out in words why biology is so interesting. It’s even harder to spell out interesting words from biology. The smash hit from last year is back, with an ever- expanding catalogue of lexicographic brutalities for grammatical connoisseurs to subjugate. This is the place where it’s cool to sneer at those poor creatures who don’t know that ‘haemorrhage’ is spelt with two Rs, or that ‘ichthyosis’ is just the convoluted way that it is. Pravega presents its very own spelling bee, with all the standard rules but a wicked twist in theme. For those who would rather spend an evening with a Dickens classic and a cappuccino than a pipette and microscope, here is their chance to turn the tables on their supposedly scientific friends, right here in the temple of science.
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
				
<b>First round:</b><br>
•	All participants will be asked to spell ten words on a sheet of paper.<br>
•	Participants must write their name before submitting the sheet.<br>
•	A maximum of 20 best participants will be selected for the second round.<br><br>
<b>Second round:</b><br>
•	Each participant will come on stage and be asked to spell a single word.<br>
•	If the participant answers wrongly, he/she is knocked out of the competition.<br>
•	The participant can ask for the word to be pronounced again if necessary. <br>
•	Participants cannot take too much time to answer. If anyone is found guilty of time-wasting, they will not get any chocolates in the next round!<br>
•	There will be two such rounds and so the participants who spell both words correctly will proceed to the final round.<br><br>
<b>Third round:</b><br>
•	This round is a rapid fire round.<br>
•	Participants have 60 seconds to spell as many words correctly as possible.<br>
•	Participants will need to spell each word backwards. Don’t worry, the words are simple!<br>
•	Participants get two points for each word answered correctly.<br>
•	If a word is answered incorrectly you get zero points for that word.<br>
•	You can choose to pass the question and move on to the next question but you will receive minus one for each pass.<br>
•	At the end of 60 seconds a signal will be raised indicating that the time is up. You can complete the word currently being spelt if you have already started spelling it.<br>
•	The person with the highest number of words will be the winner of Lexico Bio. Anyone with five or more words will get a chocolate for their efforts.
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
