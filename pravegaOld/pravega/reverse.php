<?php
include('header.php');
?>
   	
	<p style="text-align:center"><h2><br>Gnidoc</h2></p>
                        <img src="img/reverse_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Sanal S Prasad</b><br>sanal@pravega.org</p>
                        
						<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 10;
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
                <h2>descriptions</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
<i>"Asking the right questions takes as much skill as giving the right answers"</i><br>-Robert Half<br><br>

Gnidoc is programming turned on its head. Participants will be given a compiled executable to which they can give inputs and receive the corresponding inputs. Using only this, they will have to search for and identify patterns and write their own code to imitate the executable exactly.<br> Remember: it's all about knowing how to ask the right questions! 
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
				
1. It is a team event with each team comprising of three participants.<br>
2. There will be a preliminary pen and paper round for selecting the six final participants. <br>
3. The questions will involve pattern recognition and cryptography. <br>
4. In the final round, the teams will be given an executable file. <br>
5. Teams will have to identify the code behind it by testing out different inputs and then will have to program it themselves. <br>
6. The team that cracks the largest number of programs wins.<br>
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
