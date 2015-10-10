<?php
include('header.php');
?> 
    
	
	<p style="text-align:center"><h2><br>The Armchair Physicist</h2></p>
                        <img src="img/armchair_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Akash Yadav</b><br>akash@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 6;
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
                            <span class="group_event"><a id="pop_up" class="pop_up" href="group_event.php?event_id=<?= $event ?>&member_count=<?= $member_count ?>">Register</a></span>
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
For people to whom physics happens over a steaming cup of tea, a comfortable armchair and a 

black board, Armchair Physicist gives an opportunity to make good use of their mental acumen 

and solve challenging problems. In the second edition of the Armchair 

Physicist, we invite Physics lovers to take part in this event, which, through its two well-designed 

sections, will surely entertain them thoroughly. If Dexter's Laboratory is about bringing out the 

Sherlock Holmes in you, Armchair Physicist will surely tickle your little grey cells, much like his 

Belgian counterpart, Hercule Poirot!
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
				
1. Participants will make teams of maximum 3 people.<br>
2. This will be in two rounds. The prelims will be a written test of 1 hour, which includes MCQ and subjective questions. <br>
3. Based on the performance in the prelims, 5 teams will proceed towards the final round, which will be in the format of a quiz with several rounds. This part will have conceptual theoretical questions, interspersed with fun questions here and there.<br>
4. The final result will be completely based on the judge’s discretion.
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
 <footer><?php include('footer.php')?></footer>
</html>
