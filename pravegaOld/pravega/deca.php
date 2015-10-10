<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>Literary Decathlon</h2></p>
                        <img src="img/deca_bg.jpg" height="430px"></img><br>
                        
						
						
						</div>
						</div></div></div>
    </header>

 <!-- detail section -->
    <section id="cultdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><b>Anurag Limdi</b><br>anurag@pravega.org</p>
                <br>        
		                <?php
						$id = $_SESSION['user_id'];
						$event = 20;
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
						
				<br><br><br><br>		
				<h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
The Literary Decathlon is an amalgamation of various literary posers, that will test the 
literary and vocabulary skills, as well as the general awareness of the participants. This 
is a pioneering event that has been designed to suit the diversity among the 
participants as well as the audience. The name is derived for its having ten rounds, 
including a special qualifier round, which is called the Mixed Bag. This assortment 
involves some of the most classic puzzles ever posed in literary sphere. Progressive 
rounds test the speaking skills of the participants as well as their ability to display 
quick wit to a given situation. In a nutshell, the decathlon tests all types of literary 
skills and the one team which endures all, wins eternal glory… Not really. Cash prizes!<br><br>
                </p>
			</div>
        </div>
    </section>

    <section id="cultrules" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>rules</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">

<b>Rules for Literary Decathlon</b><br>

• Each team consists of three people.

• The preliminary round is a written round (1.5 hours long) and 6 teams will be selected for 

the Stage Finals. 
<br>
• The Finals will consist of nine rounds and teams will be eliminated at select rounds.
<br>
• Each round has its own points system and teams will be eliminated based on their 
cumulative scores. 
<br>
• For more information please refer to the Greenhorn Guide to the Literary Decathlon (AKA 
Literary Decathlon for Noobs)
<br>
For additional queries, please contact anshuman@pravega.org or anurag@pravega.org. We expect 
proper grammar and spelling in your mails. ;)<br>

<p style="text-align:center"><br><br><a href="A_Greenhorn_Guide_to_LD.pdf" target="_blank" style="border: 1px solid #219ab3 !important;" class="btn  btn-default btn-lg button">A Greenhorn Guide to the Literary Decathlon</a></p><br>


                </p>
			</div>
        </div>
    </section>
  
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>
	<script src="js/drop_sub.js"></script>

</body>

</html>
