<?php  
	ob_start();
	session_start();
	require_once 'includes/DbConnector.php';
	$db = new DbConnector();
?>

<?php
include('header.php');
?> 

                        <img src="images/home/blogo.png" alt="Logo" style="margin-top:90px;"></img>
						<p>30<sup>th</sup>&nbspJanuary to 1<sup>st</sup>&nbspFebruary, 2015</p>
						<p class="intro-text ">The Science, Technical, and Cultural Fest of <br> the Indian Institute of Science (IISc), Bangalore.</p>
						
    <style>
											.ticker_visible
											{
												transition: margin-top, 1s;
												
												margin: auto;
												margin-top: 0px;
												position: absolute;
											}
											
											.ticker_top
											{
												transition: margin-top, 1s;
												
												margin: auto;
												margin-top: -30px;
												position:absolute
											}
											
											.ticker_bottom
											{
												margin: auto;
												margin-top: 30px;
												position: absolute;
											}
											
											.ticker
											{
												width: 780px;
												margin-left: -389px;
												display: inline-block;
												text-transform: none;
											}
											
											.ticker a
											{
												text-decoration: none;
												color: rgba(255,255,255,0.8);
											}
											
											#news_holder.date
											{
												font-size: 13px !important;
												font-weight:300;
												line-height: 210%;
												letter-spacing: 0.1em;
												margin-top: 11px;
												overflow: hidden;
												height: 30px;
												width: 1000px;
												position: relative;
												padding: 0px 0px;
												display: inline-block;
												background: rgba(255,255,255,0.1);
												border-radius: 3px;
												color: rgba(255,255,255,0.8);
												cursor: pointer;
											}
										</style>
										<div id="news_holder" class="date button btn" style="width:800px;">
											<?php include('ticker.php')?>
										</div>
</p>
                        <div style="width:100%; display:table; height:90px; margin-bottom:20px;margin-top: 100px;">
                        	<ul class="pravega_footer">
                            	<li style="margin-right: 60px;"><a class="" href="http://www.iisc.ernet.in" target="_blank"><img src="images/home/iisc.png" /></a></li>
                            	<!--li style="padding-top: 60px;"><a href="About.php">ABOUT US</a></li>
                            	<li style="padding-top: 60px;"><a href="sponsors.php">SPONSORS</a></li>
                            	<li style="padding-top: 60px;"><a href="contact.php">CONTACT US</a></li>
                            	<li style="margin-right: 60px;padding-top: 60px;"><a href="javascript:void(0)">HOSPITALITY</a></li-->
                            	<li style="margin-right: 60px;padding-top: 40px;"><img src="images/home/social.png" align="left" usemap="#Map" />
                                  <map name="Map">
                                    <area shape="rect" coords="3,2,33,31" href="https://www.facebook.com/PravegaIISc?fref=ts" target="_blank">
                                    <area shape="rect" coords="41,2,72,33" href="http://www.youtube.com/user/IIScPravega" target="_blank">
                                    <area shape="rect" coords="81,3,110,31" href="https://plus.google.com/+PravegaOrg" target="_blank">
                                  </map>
                            	</li>
                            	<!--li style="padding-top: 30px;"><a href=""><img src="images/home/gplay.png" /></a></li>
                            	<li style="padding-top: 27px;"><a href=""><img src="images/home/wstore.png" /></a></li-->
                            </ul>
                        </div>
						</div>
				  </div>
                </div>
            </header>

	

    
    <!-- Map Section -->
   <!-- <div id="map"></div>-->

    <!-- Footer -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

      <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA"></script>


<script>

	function tick(){
		$('#ticker li:first').slideUp( function () { $(this).appendTo($('#ticker')).slideDown(); });
	}
	setInterval(function(){ tick () }, 5000);


</script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>
	<script src="js/ripple.js"></script>
	<script src="js/ticker.js"></script>
	
	
</body>

</html>
