<?php $menu = 'dashboard'; ?>
<?php include('header.php'); ?>
<?php include('navigation.php'); ?>
    <!-- START OF RIGHT PANEL -->
    <div class="rightpanel"> 
		<?php include('top.php'); ?>   
        <div class="maincontent">
        	<div class="contentinner content-dashboard">
                <div class="row-fluid">
                	<div class="span12">
                    	<ul class="widgeticons row-fluid">
                                <li class="one_fifth"><a href="student_registration.php"><img src="img/gemicon/location.png" alt="" /><span></span> Student Registration</a></li>
                                <li class="one_fifth"><a href="ambassador_registration.php"><img src="img/gemicon/location.png" alt="" /><span></span> Ambassador Registration</a></li>
                                <li class="one_fifth"><a href="single_events.php"><img src="img/gemicon/location.png" alt="" /><span></span> Single Events</a></li>
                                <li class="one_fifth"><a href="group_events.php"><img src="img/gemicon/location.png" alt="" /><span></span> Group Events</a></li>
                        </ul>
                    </div><!--span8-->
                </div><!--row-fluid-->
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->

<?php include('footer.php'); ?> 
