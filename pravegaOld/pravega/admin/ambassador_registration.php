<?php 
$menu = 'Ambassador registration';
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
                           	<li><a href="#tabs-2"><span class="icon-edit"></span> Ambassador Registration</a></li>
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
										<th class="head0">Name</th>
										<th class="head1">Username</th>
										<th class="head1">Email</th>
										<th class="head0">Mobile</th>
										<th class="head0">College</th>
										<th class="head0">City</th>
										<th class="head0">DOB</th>
										<th class="head1">Verification</th>
										<th class="head0">Action</th>
									</tr>
								</thead>
								<tbody>
                                	<?php
									$query = "select * from ambassador order by register_date desc";
									$where = NULL;
									$order = NULL;
									$db->select($query, $where, $order);
									$count=$db->countResult();
									if($count>0){
										$result = $db->fetchData();
										$no=0;
										for ($x = 0; $x < count($result); $x++){
											$no++;
									?>
										<tr>
                                        	<!--<td class="aligncenter"><span class="center"><input type="checkbox" /></span></td>-->
                                            <td class="center"><?= $result[$x]['name'];?></td>
                                            <td class="center"><?= $result[$x]['username'];?></td>
                                            <td class="center"><?= $result[$x]['email'];?></td>
                                            <td class="center"><?= $result[$x]['mobile'];?></td>
                                            <td class="center"><?= $result[$x]['college'];?></td>
                                            <td class="center"><?= $result[$x]['city'];?></td>
                                            <td class="center"><?= $result[$x]['dob'];?></td>
                                            <td class="center"><?= !empty($result[$x]['verification']) ? 'Yes' : 'No'; ?></td>
                                            <td class="center">
                                            	<a href="pravega_action.php?ambassador_view_id=<?php echo $result[$x]['id'];?>" class="btn pop_up cboxElement"><span class="icon-eye-open"></span> View</a>
                                            	<!--<a href="pravega_action.php?ambassador_edit_id=<?php echo $result[$x]['id'];?>" class="btn pop_up"><span class="icon-edit"></span> Edit</a>
                                                <a href="pravega_action.php?patient_delete_id=<?php echo $result[$x]['id'];?>" class="btn"><span class="icon-trash"></span> Delete</a>-->
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
