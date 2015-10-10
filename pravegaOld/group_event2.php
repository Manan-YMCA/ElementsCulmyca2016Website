<h2 style="color: #000;font-size: 16px;font-weight: bold">Group Event</h2><br>
<p style="color: #000;font-size: 14px;font-weight: bold">Incase you do not have a Pravega Username,<br> you can get it <a href="student_registration.php">here</a></p><br><br>
<form id="group_events" class="group_events" name="group_events" method="post" action="pravega_action.php">
<input type="hidden" name="event_id"  value="<?= $_GET['event_id'] ?>" required="required" style="float:left;" />
<?php
$member_count = $_GET['member_count'];
for($i = 1; $i <= $member_count; $i++){
?>
    <label style="display:block; width:100%; height:40px;">
        <strong style="color:#000; float:left;">Member <?= $i ?> username<span></span></strong>
        <input type="text" name="u_name[]"  title="" style="float:left; color:#000;" />
    </label>
<?php } ?>
		<br />
        <div style="width:100%">
        <input type="submit" name="group_event_add" class="btn_send" value="Submit" />
        </div>
</form>
	