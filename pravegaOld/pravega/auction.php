<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>The Auction</h2></p>
                        <img src="img/auction_bg.jpg" height="430px"></img>
                        <p class="intro-text" style= "font-size:20px;text-align:center"><br>Coordinator<br><br><b>Ishan Bannerjee</b><br>ishan@pravega.org</p>
                        <br>
                        <?php
						$id = $_SESSION['user_id'];
						$event = 23;
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
    <section id="mathsdetails" class=" about container-fluid content-section text-center">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>description</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
An auction with the delicious twist that Pravega always offers. Everyone has an initial sum of money and goods are captured through a bidding process. However, although the goods go to the highest bidder, they will be sold at the price offered by the second- highest bidder. What’s more, the money devalues with each round but the value of goods remains the same, meaning that in order to buy the same item, one will need to splash more cash later in the game than at the outset. The net value of each player will be the value of their money added to the value of their goods. Who will do the business and put themselves on the rich list?
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
				
1)	Contestants are given some amount of money at the beginning of the game. They will not receive any money after this.<br>
2)	The game is split into rounds. In each round a fixed number of items are auctioned.<br>
3)	The goods are auctioned as follows: <br>
&nbsp&nbsp&nbsp&nbsp a)	The contestants will write down their bids. The bid values are not disclosed to other participants.<br>
&nbsp&nbsp&nbsp&nbsp b)	The highest bidder will win the item being auctioned, but will have to pay the second highest bidders price.<br>
&nbsp&nbsp&nbsp&nbsp c)	If someone is forced to pay more money than they currently possess, they are out of the game.<br>
4)	The objective of the game is to maximize one’s total value. The value a contestant has is the sum of the value of the money he possesses plus that of the items he has.<br>
5)	At the instant an item is bought it has a certain fixed value. This price does not change from item to item.<br>
6)	At the end of each round, the value of the money a contestant has decreases by 10%. The initial value of some amount of money is the same as the amount.<br>
7)	At the end of each round, the value of a contestant’s goods increases by 10%.<br>
8)	At the end of all the rounds , the contestant with the highest value wins <br>

				
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
