<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>Lumière</h2></p>
                        <img src="img/foto_bg.jpg" height="430px"></img></header>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><b><br>Arnab Maji</b><br>arnab@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 103;
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
    

 <!-- detail section -->
    <section id="enggdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">

Pravega is back! So is online photography contest, Lumiere!<br><br>
Be you an amateur trying to improve your skills taking shots regularly or a pro, Lumiere 2015 brings you a great chance to flaunt your photography skills. It is time to take out your camera, be it a point and shoot or a DSLR, clean up your kits and get to work! Show your skill to win the competition and prize money that you deserve after all your efforts to shoot a perfect composition!
<br><br>Lumiere is an online photography contest which gives you opportunity to take your shot anywhere you wish, provided you fulfill the criteria for the contest.
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
				
1.	Theme for the contest is <b>Architecture</b>.<br>

2. Lumiere is a single theme based competition.<br>

3. Participants need to register on pravega.org.<br>

4. Applicants will have to send their entries (max 2 per person) to arnab@pravega.org.<br> 
 Rename your photo to [Name]-[College]-[Lumiere15] and mail it to arnab@pravega.org.<br> Example: If Rajesh from IISc Bangalore has to submit an entry the file name should be Rajesh-IIScBangalore-Lumiere15.<br>

5. The winners will be decided by judges. All the judges’ decisions will be final.<br>

6. All the entries will be uploaded onto the Pravega Facebook Page.<br>

7. Posting offensive comments on opponent's entry is strictly NOT allowed. Otherwise action will be taken accordingly.<br>

8. In photo editing only cropping and adjustment of hue/saturation; brightness/Contrast; levels are allowed. Photo-morphing, manipulations or local editing is not allowed.<br>

9. Do not include your credentials (name, address, watermarks etc.) in the picture or the frame. Such photos will not be considered for the contest.<br>




<br>
<b>Judging Criteria</b>:<br>

10. Judging will be done on the basis of basic rules of photography, composition, colours, creativity and aptness to the theme. <br>

11. The number of likes, shares are not included in the Judging criteria. <br>
(Though contestants are free to publicize their own compositions not violating the rules of the contest)



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
