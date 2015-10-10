<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/grayscale.css" rel="stylesheet">
<body class="intro">
 <style>
											.ticker1_visible
											{
												transition: margin-top, 1s;
												
												margin: auto;
												margin-top: 0px;
												position: absolute;
											}
											
											.ticker1_top
											{
												transition: margin-top, 1s;
												
												margin: auto;
												margin-top: -400px;
												position: absolute;
											}
											
											.ticker1_bottom
											{
												margin: auto;
												margin-top: 400px;
												position: absolute;
											}
											
											.ticker2_visible
											{
												transition: margin-top, 1s;
												
												margin: auto;
												margin-top: 0px;
												position: absolute;
											}
											
											.ticker2_top
											{
												transition: margin-top, 1s;
												
												margin: auto;
												margin-top: -400px;
												position: absolute;
											}
											
											.ticker2_bottom
											{
												margin: auto;
												margin-top: 400px;
												position: absolute;
											}
											
											.ticker1
											{
												width: 780px;
												/*margin-left: -389px;*/
												display: inline-block;
												text-transform: none;
											}
											.ticker2
											{
												width: 780px;
												/*margin-left: -389px;*/
												display: inline-block;
												text-transform: none;
											}
</style>

<section class="about container-fluid content-section text-center" style="background:none">
<h2><b>Updates</b></h2>
	<div class="row col-lg-12">
		<div id="news_holder" class="col-lg-4 col-lg-offset-2 " style=" overflow: hidden; height: 420px; text-align:justify; background: rgba(255,255,255,0.1); padding-top:17px; border-radius:4px;">
				<div id="" name="news" class="ticker1 ticker1_visible" >
					<ul style="font-size: 24px; line-height: 80px;">
						<li>1</li>
						
						<li>2</li>
						
						<li>3</li>
						
						<li>4</li>
						
						<li>5</li>
						</ul>
				</div>
				<div id="" name="news" class="ticker1 ticker1_bottom">
					<ul style="font-size: 24px; line-height: 80px;">
						<li>1</li>
						<li>2</li>
						<li>3</li>
						<li>4</li>
						<li>5</li>
						</ul>
				</div>
		</div>
		<div id="winners_holder" class="col-lg-4 col-lg-offset-1 " style=" overflow: hidden; height: 420px; text-align:justify; background: rgba(255,255,255,0.1); padding-top:17px; border-radius:4px;">
				<div id="" name="winners" class="ticker2 ticker2_visible" >
					<ul style="font-size: 24px; line-height: 80px;">
						<li>1</li>
						
						<li>2</li>
						
						<li>3</li>
						
						<li>4</li>
						
						<li>5</li>
						</ul>
				</div>
				<div id="" name="winners" class="ticker2 ticker2_bottom">
					<ul style="font-size: 24px; line-height: 80px;">
						<li>1</li>
						<li>2</li>
						<li>3</li>
						<li>4</li>
						<li>5</li>
						</ul>
				</div>
		</div>
	</div>
</body>
  <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
	
<script>
	function tick1(){
		$('#ticker1 li:first').slideUp( function () { $(this).appendTo($('#ticker1')).slideDown(); });
	}
	setInterval(function(){ tick1 () }, 5000);
</script>
<script>	
	function tick2(){
		$('#ticker2 li:first').slideUp( function () { $(this).appendTo($('#ticker2')).slideDown(); });
	}
	setInterval(function(){ tick2 () }, 5000);
</script>
    <!-- Custom Theme JavaScript -->
	    <script src="js/grayscale.js"></script>
		<script src="js/ticker1.js"></script>
		<script src="js/ticker2.js"></script>
</html>