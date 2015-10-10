<?php
include('testheader.php');
require_once 'logcheck-admin.php';
$log = new LoggedIn();
$log->logincheck();
?> 
<!-- About Section -->
    <header class="intro">
        <div class="intro-body">
   <section id="" class=" container-fluid content-section text-center">
        <div class="row">
		<p><br><br></p>
            <div class="col-lg-10 col-lg-offset-1">
                <h2>My account</h2>
                <a style="border: 1px solid #219ab3 !important;" class="btn  btn-default btn-lg button" href="https://in.explara.com/e/pravega-registration-2015" target="_blank" style="font-size:25px;">Pravega Registrations: Pay Online Now and get Rs 50 Off!</a><br />
                <a style="border: 1px solid #219ab3 !important;" class="btn  btn-default btn-lg button" href="https://in.explara.com/e/pravega-accommodation-2015" target="_blank" style="font-size:25px;">Accommodation Payment</a>
				<a style="border: 1px solid #219ab3 !important;" class="btn  btn-default btn-lg button" href="https://in.explara.com/e/pravega-workshops-2015" target="_blank" style="font-size:25px;">Book your workshop ticket now</a>

                <?php
				$id = $_SESSION['user_id'];
				$event = 1;
				$check_sql="select * from participants ";
				$where ="where participant_id='$id'";
				$order = NULL;		
				$check=$db->select($check_sql, $where, $order);	
				$count=$db->countResult();
				$events = unserialize(events);
				$group_events_values = unserialize(group_events);
				if($count > 0) {
					$single_events = array();
					$group_events = array();
					$result = $db->fetchData();
					foreach($result as $res){
						if($res['event_type'] == 1)
							$single_events[] = $res;
						if($res['event_type'] == 2)
							$group_events[] = $res;
					}
					if(count($single_events) > 0){
				?>
                	<span style="font-size:18px; display:block; margin-top:30px;">My Individual Events</span><br />
                	<table class='table table-striped table-bordered' align="center" style="width:60%">
                      <tr class='odd'>
                        <th style="width:20px;text-align:center;">Event No.</th>
                        <th style="width:50px;text-align:center;">Event Name</th>
                        <th style="width:50px;text-align:center;">Action</th>
                      </tr>
                      <?php
					  	$count = 1;
					  	foreach($single_events as $single_event){
							$event_id = $single_event['event_id'];
							$event_name = $events[$event_id];
					  ?>
                      <tr>
                        <td><?= $count ?></td>
                        <td><?= $event_name ?></td>
                        <td><a href="pravega_action.php?remove_id=<?= $single_event['id'] ?>" class="" remove_id="<?= $single_event['id'] ?>">Remove</a></td>
                      </tr>
                      <?php $count++; } ?>
                   	</table>
                <?php		
					}
					if(count($group_events) > 0){
				?>
                	<span style="font-size:18px; display:block; margin-top:30px;">My Group Events</span><br />
                	<table class='table table-striped table-bordered' align="center" style="width:60%">
                      <tr class='odd'>
                        <th style="width:20px;text-align:center;">Event No.</th>
                        <th style="width:50px;text-align:center;">Event Name</th>
                        <th style="width:50px;text-align:center;">Action</th>
                      </tr>
                      <?php
					  	$count = 1;
					  	foreach($group_events as $group_event){
							$event_id = $group_event['event_id'];
							$event_name = $group_events_values[$event_id];
					  ?>
                      <tr>
                        <td><?= $count ?></td>
                        <td><?= $event_name ?></td>
                        <td><a href="pravega_action.php?remove_id=<?= $group_event['id'] ?>" class="" remove_id="<?= $group_event['id'] ?>">Remove</a></td>
                      </tr>
                      <?php $count++; } ?>
                   	</table>
                <?php		
					}
				}
				?>
			</div>
        </div>
    </section>
	</div>
    </header>
	

    <!-- Map Section -->
   <!-- <div id="map"></div>-->

    <!-- Footer -->
   

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

      <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA"></script>




    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>
    <script src="js/script.js"></script>

</body>
<a href="https://plus.google.com/+PravegaOrg" rel="publisher">Google+</a>
</html>
