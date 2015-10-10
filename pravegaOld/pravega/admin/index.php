<?php
	ob_start();
	session_start();
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Pravega 2015</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
</head>

<body class="loginbody">

<div class="loginwrapper">
	<div class="loginwrap zindex100 animate2 bounceInDown">
        <h1 class="logintitle">
            <span class="iconfa-lock"></span> Sign In 
            <span class="subtitle">Hello! Sign in to get you started!</span>
            <span class="subtitle" style="color:#F00">
            <?php
				if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
					echo $_SESSION['error'];
					unset ($_SESSION['error']);
				}
			?>
            </span>
        </h1>
        <div class="loginwrapperinner">
            <form id="loginform" name="login" method="post" action="pravega_action.php">
                <p class="animate4 bounceIn"><input type="text" id="username" name="username" placeholder="Username" /></p>
                <p class="animate5 bounceIn"><input type="password" id="password" name="password" placeholder="Password" /></p>
                <p class="animate6 bounceIn"><input type="submit" name="get_login" id="login" class="btn btn-default btn-block" value="LOGIN" /></p>
            </form>
        </div>
    </div>
    <div class="loginshadow animate3 fadeInUp"></div>
</div>

<script type="text/javascript">
jQuery.noConflict();

jQuery(document).ready(function(){
	
	var anievent = (jQuery.browser.webkit)? 'webkitAnimationEnd' : 'animationend';
	jQuery('.loginwrap').bind(anievent,function(){
		jQuery(this).removeClass('animate2 bounceInDown');
	});
	
	jQuery("#loginform").validate({
		rules: {
			username: "required",
			password: "required"
		},
		messages: {
			username: "Please enter the username",
			password: "Please enter the password"
		}
	});
});
</script>
</body>
</html>
