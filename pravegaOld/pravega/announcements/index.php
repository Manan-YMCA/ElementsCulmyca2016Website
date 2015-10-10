<html>
<script type="text/javascript">    
     setInterval(function() {
                  window.location.reload();
                }, 15*600000);
</script>

<head>
	<link href="css/bootstrap.css" rel="stylesheet">
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
												/*margin-left: -389px;*/
												display: inline-block;
												text-transform: none;
												position: absolute;
												padding-top: 17px;
												padding-right: 15px;
											}
											
											.ticker2
											{
												display: inline-block;
												text-transform: none;
												position: absolute;
											}
											
</style>
<div class="" style="margin-top:0; text-align:center;">
<a class="navbar-brand page-scroll" href="" target="_blank">
		<img src="img/airbus.png" style="padding-top: 5px;" alt="Logo"></img> &nbsp&nbsp&nbsp&nbsp</a>
		<a class="navbar-brand page-scroll" href="index.php">
		<img src="img/logo.png" alt="Logo" height="50"></img>
        </a>
		</div>
<section class="about container-fluid content-section text-center" style="background:none">

<h2><b>Updates</b></h2>
	<div class="row col-lg-12">
		<div id="news_holder" class="col-lg-4 col-lg-offset-2 " style=" overflow: hidden; height: 420px; text-align:justify; background: rgba(255,255,255,0.1); padding-top:17px; border-radius:4px; position: absolute;">
				<?php 
					$xml = simplexml_load_file('news.xml');
					$path = "/news_items/news";
					$result = $xml->xpath($path);
					$start = 0;
				
					for ($i=0; $i < sizeof($result); $i++)
					{
						if ($i % 5 == 0)
						{
							if ($i != 0)
								echo '<div id="" name="news" class="ticker1 ticker1_bottom">';
							else echo '<div id="" name="news" class="ticker1 ticker1_visible" >';
							
							echo '<ul style="font-size: 28px;">';
							$start = 1;
							
						}
						
						echo '<li style="line-height: 35px; margin-bottom: 20px;">';
						echo $result[$i];
						echo "</li>";
						
						if (($i % 5 == 4 && $start==0) || ($i == sizeof($result)-1))
						{
							echo "</ul></div>";
							$start = 0;
						}
						$start = 0;
					}
				?>
				
			<!--	<div id="" name="news" class="ticker1 ticker1_bottom">
					<ul style="font-size: 24px; line-height: 80px;">
						<li>1</li>
						<li>2am</li>
						<li>3</li>
						<li>4</li>
						<li>5</li>
						</ul>
				</div>
				<div id="" name="news" class="ticker1 ticker1_bottom">
					<ul style="font-size: 24px; line-height: 80px;">
						<li>1</li>
						<li>2</li>
						<li>3am</li>
						<li>4</li>
						<li>5</li>
						</ul>
				</div>-->
		</div></div>
		
		<div id="winners_holder" class="col-lg-4 col-lg-offset-1 " style=" overflow: hidden; height: 420px; text-align:justify; background: rgba(255,255,255,0.1); padding-top:17px; border-radius:4px; position: absolute; left: 50%;">
		
			<?php 
				$xml = simplexml_load_file('winners.xml');
				$path = "/winners_list/winner";
				$result = $xml->xpath($path);
			
				$start = 0;
			
				for ($i=0; $i < sizeof($result); $i++)
				{
					if ($i % 2 == 0)
					{
						if ($i != 0)
							echo '<div id="" name="winners" class="ticker2 ticker2_bottom">';
						else echo '<div id="" name="winners" class="ticker2 ticker2_visible" >';
					}
						
					echo '<ul style="margin-top:20px; font-size: 24px; line-height: 40px;">';
											
					echo "<li>";
					echo $result[$i]->event;
					echo "<ul><li>1st: ";
					echo $result[$i]->first;
					echo "</li><li>2nd: ";
					echo $result[$i]->second;
					echo "</li><li>3rd: ";
					echo $result[$i]->third;
					echo "</li></ul>";
					echo "</li></ul>";
					
					if (($i % 2 == 0 && $start=0) || ($i == sizeof($result)-1))
					{
						echo "</div>";
						$start = 1;
					}
				}
			?>
				<div id="" name="winners" class="ticker2 ticker2_bottom">
				</div>
				
		</div>
	</div></section>
</body>
  <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
	<script src="js/jquery-1.11.0.js"></script>
    <script src="js/jquery.easing.min.js"></script>
	
<script>
	function tick1(){
		$('#ticker1 li:first').slideUp( function () { $(this).appendTo($('#ticker1')).slideDown(); });
		$('#ticker2 li:first').slideUp( function () { $(this).appendTo($('#ticker2')).slideDown(); });
	}
	setInterval(function(){ tick1 () }, 5000);
</script>

<!--<script>	
	function tick2(){
		$('#ticker2 li:first').slideUp( function () { $(this).appendTo($('#ticker2')).slideDown(); });
	}
	setInterval(function(){ tick2 () }, 5000);
</script>-->
    <!-- Custom Theme JavaScript -->
	    <script src="js/grayscale.js"></script>
		<script src="js/ticker1.js"></script>
		<!--<script src="js/ticker2.js"></script>-->
</html>