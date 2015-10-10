<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>Samasya</h2></p>
                        <img src="img/samasya_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Ishan Bannerjee</b><br>ishan@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 102;
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
    <section id="mathsdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
True to its name, this is the ultimate problem-solving event. A selection from around a dozen questions representative of all the branches of mathematics 
accessible to high school or beginning undergraduate students will have to be solved in three hours. Any technique is accepted, the more creative the better,
 as long as it can be explained logically. Have you got what it takes? Well, then, prove it! <br><br>
 Samasya is a Math Olympiad, with questions requiring knowledge of only high school mathematics. That being said some questions may involve basic college 
 mathematics. However, questions are optional and a contestant can always avoid answering questions that involve any knowledge of college mathematics.
 
				</p>
 
			</div>
        </div>
    </section>
<!-- Pronights Section -->
    <section id="mathsrules" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>rules</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
1.	The duration of the Olympiad is for 3 hours.<br>
2.	Not all questions are compulsory; the contestant should answer questions as instructed in the question paper.<br>
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
