<?php 
$menu = 'Single Events';
include('header.php');
include('navigation.php'); ?>
    <!-- START OF RIGHT PANEL -->
    <div class="rightpanel"> 
		<?php include('top.php'); ?>   
        <div class="maincontent">
        	<div class="contentinner content-dashboard">
				<div class="widgetcontent">
					<div id="tabs">
						<ul>
                           	<li><a href="#tabs-2"><span class="icon-edit"></span> Single Events</a></li>
						</ul>
						<div id="tabs-2">
                            <table class="table table-bordered" id="dyntable">
                                <colgroup>
                                    <!--<col class="con0" style="align: center; width: 4%" />-->
                                    <col class="con1" />
                                    <col class="con0" />
                                    <col class="con1" />
                                    <col class="con0" />
                                    <col class="con1" />
                                </colgroup>
								<thead>
									<tr>
                          				<!--<th class="head0 nosort"><input type="checkbox" class="checkall" /></th>-->
										<th class="head1">Username</th>
										<th class="head1">Name</th>
										<th class="head1">Event name</th>
										<!--<th class="head1">Ambassador Id</th>-->
										<th class="head0">Action</th>
									</tr>
								</thead>
								<tbody>
                                	<?php
									$events = unserialize(events);
									$query = "select * from participants where event_type=1 order by register_date desc";
									$where = NULL;
									$order = NULL;
									$db->select($query, $where, $order);
									$count=$db->countResult();
									if($count>0){
										$result = $db->fetchData();
										$no=0;
										for ($x = 0; $x < count($result); $x++){
											$no++;
											$event_id = $result[$x]['event_id'];
											$username = $result[$x]['username'];
											$user = substr($username, 0, 4);
											$uname = '';
											if($user == 'pras'){
												$nquery = "select * from student where username = '$username'";
												$nwhere = NULL;
												$norder = NULL;
												$db->select($nquery, $nwhere, $norder);
												$ncount=$db->countResult();
												if($ncount == 1){
													$nresult = $db->fetchData();
													$uname = $nresult[0]['name'];	
												}
											}elseif($user == 'prac'){
												$nquery = "select * from ambassador where username = '$username'";
												$nwhere = NULL;
												$norder = NULL;
												$db->select($nquery, $nwhere, $norder);
												$ncount=$db->countResult();
												if($ncount == 1){
													$nresult = $db->fetchData();
													$uname = $nresult[0]['name'];	
												}
											}
									?>
										<tr>
                                        	<!--<td class="aligncenter"><span class="center"><input type="checkbox" /></span></td>-->
                                            <td class="center"><?= $result[$x]['username'];?></td>
                                            <td class="center"><?= $uname;?></td>
                                            <td class="center"><?= $events[$event_id];?></td>
                                            <!--<td class="center"><?= $result[$x]['ambassador_id'];?></td>-->
                                            <td class="center">
                                            	<!--<a href="pravega_action.php?student_view_id=<?php echo $result[$x]['id'];?>" class="btn pop_up cboxElement"><span class="icon-eye-open"></span> View</a>
                                            	<a href="pravega_action.php?student_edit_id=<?php echo $result[$x]['id'];?>" class="btn pop_up"><span class="icon-edit"></span> Edit</a>-->
                                                <a href="pravega_action.php?event_delete_id=<?php echo $result[$x]['id'];?>" class="btn"><span class="icon-trash"></span> Delete</a>
                                            </td>
										</tr>
                                	<?php } } ?>
								</tbody>
							</table>
						</div>
					</div><!--#tabs-->
				</div><!--widgetcontent-->
			</div>
        </div><!--contentinner-->
    </div><!--maincontent-->

<?php include('footer.php'); ?> 
