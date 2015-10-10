<?php 
$menu = 'Group Events';
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
                           	<li><a href="#tabs-2"><span class="icon-edit"></span> Group Events</a></li>
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
										<th class="head1">Event name</th>
										<th class="head1">Usernames</th>
										<th class="head1">Names</th>
										<!--<th class="head0">Action</th>-->
									</tr>
								</thead>
								<tbody>
                                	<?php
									$events = unserialize(group_events);
									$query = "select * from participants where event_type=2 order by event_id desc";
									$where = NULL;
									$order = NULL;
									$db->select($query, $where, $order);
									$count=$db->countResult();
									if($count>0){
										$result = $db->fetchData();
										$no=0;
										$group_event_lists = array();
										for ($x = 0; $x < count($result); $x++){
											$total_result = array();
											$no++;
											$event_id = $result[$x]['event_id'];
											$username = $result[$x]['username'];
											$event_no = $result[$x]['event_no'];
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
											$total_result = $result[$x];
											$total_result['name'] = $uname;
											$group_event_lists[$event_no][] = $total_result;
									?>
                                	<?php } } //echo "<pre>"; print_r($group_event_list);exit;
									foreach($group_event_lists as $group_event_list){
										$unames = array();
										$onames = array();
										foreach($group_event_list as $group_event_li){
											$unames[] = $group_event_li['username'];
											$onames[] = $group_event_li['name'];
										}
										$participants_name = implode(', ', $unames);
										$participants_oname = implode(', ', $onames);
										$event_id = $group_event_list[0]['event_id'];
										$event_name = $events[$event_id];
									?>
										<tr>
                                            <td class="center"><?= $event_name;?></td>
                                            <td class="center"><?= $participants_name;?></td>
                                            <td class="center"><?= $participants_oname;?></td>
                                            <!--<td class="center">
                                                <a href="pravega_action.php?group_event_delete_id=<?php echo $result[$x]['id'];?>" class="btn"><span class="icon-trash"></span> Delete</a>
                                            </td>-->
										</tr>
                                    <?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div><!--#tabs-->
				</div><!--widgetcontent-->
			</div>
        </div><!--contentinner-->
    </div><!--maincontent-->

<?php include('footer.php'); ?> 
