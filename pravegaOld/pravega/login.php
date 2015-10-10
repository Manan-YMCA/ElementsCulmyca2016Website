<?php
include('testheader.php');
if (isset($_SESSION['user'])) {
	header('location:my_account.php');
	return false;
}
?> 
    
<!-- About Section -->
    <header class="intro">
        <div class="intro-body">
   <section id="" class=" container-fluid content-section text-center">
        <div class="row">
		<p><br><br></p>
            <div class="col-lg-10 col-lg-offset-1">
                <h2>Login</h2>
                <p class="col-lg-10 col-lg-offset-1" style="text-align: justify">
                	<form id="register_form" name="register" method="post" enctype="multipart/form-data" action="pravega_action.php">
                    		<label>* Required fields</label><br>
                            <p class="register"><input class="register_input" name="username" placeholder="Username / Email ID *" required></p>
                            
                            <p class="register"><input class="register_input" type="password" name="password" placeholder="Password *" title="Email" required /></p>
                            <p class="register"><a href="forgot_password.php" style="font-size:14px;">forgot password</a><input class="register_input signup" type="submit" name="get_login" id="button" class="send_color sign_submit" value="Login" style="width:40%; margin-left:10px;" /></p>
                    </form>
                </p>
			</div>
        </div>
    </section>
	</div>
    </header>
	

    <!-- Map Section -->
   <!-- <div id="map"></div>-->

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; Pravega 2015</p>
        </div>
    </footer>

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
