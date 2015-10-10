    <!-- START OF LEFT PANEL -->
    <div class="leftpanel">
        <div class="logopanel">
        	<h1><a href="dashboard.php">Pravega 2015</a></h1>
        </div><!--logopanel-->
        <div class="datewidget">Today is <?= date("l, F j, Y, g:i a") ?></div>
    	<!--<div class="searchwidget">
        	<form action="results.php" method="post">
            	<div class="input-append">
                    <input type="text" class="span2 search-query" placeholder="Search here...">
                    <button type="submit" class="btn"><span class="icon-search"></span></button>
                </div>
            </form>
        </div>--><!--searchwidget-->
        <!--<div class="plainwidget">
        	<small>Using 16.8 GB of your 51.7 GB </small>
        	<div class="progress progress-info">
                <div class="bar" style="width: 38%"></div>
            </div>
            <small><strong>38% full</strong></small>
        </div>--><!--plainwidget-->
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header">Main Navigation</li>
                <li class="<?php echo ($menu == 'dashboard') ? 'active' : ''; ?>"><a href="dashboard.php"><span class="icon-align-justify"></span> Dashboard</a></li>
                <li class="<?php echo ($menu == 'Student registration') ? 'active' : ''; ?>"><a href="student_registration.php"><span class="icon-picture"></span> Student Registration</a></li>
                <li class="<?php echo ($menu == 'Ambassador registration') ? 'active' : ''; ?>"><a href="ambassador_registration.php"><span class="icon-picture"></span> Ambassador Registration</a></li>
                <li class="<?php echo ($menu == 'Single Events') ? 'active' : ''; ?>"><a href="single_events.php"><span class="icon-picture"></span> Single Events</a></li>
                <li class="<?php echo ($menu == 'Group Events') ? 'active' : ''; ?>"><a href="group_events.php"><span class="icon-picture"></span> Group Events</a></li>
            </ul>
        </div><!--leftmenu-->
        
    </div><!--mainleft-->
    <!-- END OF LEFT PANEL -->