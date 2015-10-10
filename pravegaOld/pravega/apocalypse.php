<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>Apocalypse Now!</h2></p>
                        <img src="img/apocalypse_bg.jpg" height="430px"></img><br><br>  </header><br><br>
                        <p class="intro-text" style= "font-size:20px;text-align:center">Event Sponsored by<br>
							<a href="http://www.eoxys.com/" target="_blank">
								<img src="slogos/eoxys.png" width="15%"></img>											
							</a>
							<br><br>Coordinator<br><br><b>Ishan Bannerjee</b><br>ishan@pravega.org</p>
							
							<br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 9;
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
  

 <!-- detail section -->
    <section id="mathsdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
The world is hovering on the brink of collapse, held back only by the greed of man. In an almost 'apocalyptic' scenario, epidemics are raging through the peoples of a sadder and more desolate future.<br>
The ability to research and manufacture drugs to combat them lies with a few monolithic corporations, which have developed so far on a primal impulse special only to man—profit!<br>
Participants will form teams and take on the mantle of disease-ridden countries and money-minded companies and try to out-think their competition in order to survive and thrive.<br><br>

Cash Prizes worth <b>INR 30,000</b> and an <b>Internship</b> on the line!
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
				
1.	Participants will need to form teams of two in order to take part in this event.<br>
2.	This competition will occur in two stages - the prelims and the finals.<br>
3.	The prelims require the team to solve a set of game theory and mathematical optimization problems over a period of one and a half hours - the twelve teams to do best will proceed to the finals.<br>
4.	The finals will take place as a three-hour event.<br>
5.	Teams will be assigned the role of companies or countries; there will be six companies and six countries.<br>
6.	Company teams are required to maximise their profit in order to win the games.<br>
7.	Country teams are required to maximise the distance from midnight in their Apocalypse clocks - the closer this parameter of destruction reads to midnight, the nearer is the nation to the breakdown of civilisation.<br>
8.	The teams may interact with each other openly in the competition arena - formation of deals will occur through their computer terminals (these are provided by us).<br>
9.	The terminals will also give them vital statistics about themselves and relevant variables of other teams.<br>
10.	Companies may acquire resources from countries for money - they will need to do so in order to research cures to diseases.<br>
11.	The research of a company on a specific drug is successful after a length of time determined by a function of the rate of expenditure of money in that project; when this happens, that company possesses the blueprint for that drug with characteristics of efficacy and cost that depend on the manner in which that team invested in the research for that drug.<br>
12.	The blueprint may be traded.<br>
13.	If a company possesses the blueprint for a drug, they may put it into production at a certain cost.<br>
14.	After an interval of time determined by the nature of the drug, the company will possess marketable quantities of the doses of that drug.<br>
15.	Countries may buy drugs from companies and administer them to their populations - this reduces the rate at which the population is dying.<br>
16.	The algorithms by which the game will run will be revealed only at the beginning of the game - teams will also have to contend with surprise feature with which they may get ahead.<br>
17.	At the end of the game, the country and the company to do best in terms of distance from midnight and profit gained will be said to have won.<br>
				
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

        <footer><?php include('footer.php')?></footer>

</html>
