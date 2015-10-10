<?php
if (isset($_SESSION['success'])) {
?>
	<div class="" id="message_alert" style="background-color:#060">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?= $_SESSION['success'] ?></strong>
    </div>
<?php
    unset($_SESSION['success']);
    unset($_SESSION['error']);
}elseif (isset($_SESSION['error'])) {
?>
	<div class="" id="message_alert" style="background-color:#F00">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?= $_SESSION['error'] ?></strong>
    </div>
<?php
    unset($_SESSION['error']);
    unset($_SESSION['success']);
}elseif (isset($_SESSION['warning'])) {
?>
	<div class="" id="message_alert" style="background-color:#CF3">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?= $_SESSION['warning'] ?></strong>
    </div>
<?php
    unset($_SESSION['warning']);
}elseif (isset($_SESSION['info'])) {
?>
	<div class="" id="message_alert" style="background-color:#33F">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?= $_SESSION['info'] ?></strong>
    </div>
<?php
    unset($_SESSION['info']);
}
?>