
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Sagnik Dasgupta" >

    <title>Pravega 2016</title>
	
    
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" async=true>
	<link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">



    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet">
	<link href="css/ticker.css" rel="stylesheet">
	<link href="css/ripple.css" rel="stylesheet">
	<link href="css/loader.css" rel="stylesheet">
	
    <!-- Custom Fonts -->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   	<link href="http://fonts.googleapis.com/css?family=Raleway:700|Alegreya+Sans:300,700,400italic" rel="stylesheet" type="text/css" >

</head>

	<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<!--loader-->
    
	<style>
	.loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: #000;
	-webkit-opacity: .99;
}
</style>
	<div class="loader">
		<div class="circle"></div>
		<div class="circle-small"></div>
		<div class="circle-big"></div>
		<div class="circle-inner-inner"></div>
		<div class="circle-inner"></div>
	</div>
	
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
		<a class="navbar-brand page-scroll" href="index.php">
		<img src="images/home/logo.png" alt="Logo" height="50"></img>
        </a>
            </div>
			<style>
				.sub:hover{
					box-shadow:none;
				}
				.active {
					outline: none;
					background-color: rgba(0,0,0,0);
				}
			</style>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse" style="padding-top: 20px;">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>

					<li style="background-color: rgba(0,0,0,0);">
                        <a class="button page-scroll"  href="#photos">Photos</a>
                    </li>
					<li>
						<a href="#" class="button dropdown-toggle page-scroll" data-toggle="dropdown">About</i>
							<span class="caret"></span>
						</a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
								<li><a class="button sub page-scroll" href="About.php">About Us</a></li>
								<li class="divider"></li>
								<li><a class=" button sub page-scroll" href="faq.php">FAQ</a></li>
							</ul>
					</li>
            
					<li>
                        <a class="button page-scroll" href="contact.php">Contact Us</a>
                    </li>
		    </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	<!-- Intro Header --> 
		<style>
						@media screen and (max-width: 768px){
						.logo{
						width:80%;
						}
						.container{
						padding-left:0;
						padding-right:0;
						}
						.intro-text{
						font-size:95% !important;
						}
						.button{
						width:80% !important;
						}
						}
						</style>
						<?php include('bg.php')?>
    <header class="intro">
        <div class="intro-body">	
			<div class="container">
                <div class="row"><br><br>
                    <div style="text-align:centre " class="row_inner">
          
					
                        <img src="images/home/blogo.png" class="logo" alt="Logo" style="margin-top:90px;"></img>
						<p class="intro-text ">The Science, Technical and Cultural Fest of <br> the Indian Institute of Science (IISc), Bangalore.</p>
						
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
												/*height: 30px;*/
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
										<!--<div id="news_holder" class="date button btn" style="width:800px;">-->
											<!--<?php include('ticker.php')?>-->
										<!--	<p style="text-transform: none; margin-bottom:10px">All the prizes of Pravega '15 have been released. If you do not receive the prize money by <br>Saturday, the 18th of April, please email us by 12 noon on Monday, April 20th.  Failing this, <br>we might be unable to complete the transaction.<br> For any further queries, you may contact <a href="mailto:core@pravega.org"><i>core@pravega.org</i></a></p>-->
										<!--</div>--><br><br><br>
<p align="center" style=" margin-top:-90px"><br><br><a href="sponsors.php" align="center" style="border: 1px solid #219ab3 !important;" target="_blank" class="btn  btn-default btn-lg button">Sponsors 2015</a></p>
						</div>
				  </div>
                </div>
				</div>
            </header>
	<body>		
<section id="photos"> 
<style>
@media screen and (max-width: 768px){
						div>img{
						width:100%;
						height:auto !important;
						}
						.mycarousel{
						width:96%;
						padding:0;
						margin:2%;
						}
					</style>
<div class="col-xs-12 mycarousel" >
                <h2 align="center">Photo Gallery</h2>
<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
     // width: 70%;
      margin: auto;
  }
  .control_icon{
  top: 50%;
position: absolute;
  }

					}
  </style>
<div class="container mycarousel" style="background:rgba(255,255,255,0.5); border-radius:7px; padding:0; z-index:99;">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
	<br>
    <div class="carousel-inner" role="listbox">
      <div class="item active ">
        <img src="images/pic1.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item">
        <img src="images/pic2.jpg" alt="pic2"  style="height:450px">
      </div>
   
      <div class="item">
        <img src="images/pic3.jpg" alt="pic3"  style="height:450px">
      </div>

      <div class="item">
        <img src="images/pic4.jpg" alt="pic4" style="height:450px">
      </div>
      <div class="item  ">
        <img src="images/pic5.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic6.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic7.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic8.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic9.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic10.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic11.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic12.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic13.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic14.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic15.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic16.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic17.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic18.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic19.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic20.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic21.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic22.jpg" alt="pic1" style="height:450px">
      </div>
	  
      <div class="item  ">
        <img src="images/pic23.jpg" alt="pic1" style="height:450px">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="control_icon fa fa-chevron-left"></span> 
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="control_icon fa fa-chevron-right"></span>
<span class="sr-only">Next</span>
    </a><br>
  </div>
</div>
</div>
</section>

</body>
    <!-- Footer -->
		<footer><?php include('footer.php')?></footer> 

<!--<script src="js/jquery-1.11.0.js" ></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
	$(window).load(function() {
	$(".loader").animate({
		opacity:0
	},1000,"linear",function(){$(".loader").fadeOut();});
})
</script>
	<script src="js/jquery.animate-enhanced.min.js" async=true></script> 
<!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <!-- Custom Theme JavaScript -->
<script>
	function tick(){
		$('#ticker li:first').slideUp( function () { $(this).appendTo($('#ticker')).slideDown(); });
	}
	setInterval(function(){ tick () }, 3000);
</script>
    <script src="js/grayscale.js"></script>
	<script>
	 $('.button').mousedown(function (e) {
    var target = e.target;
    var rect = target.getBoundingClientRect();
    var ripple = target.querySelector('.ripple');
    $(ripple).remove();
    ripple = document.createElement('span');
    ripple.className = 'ripple';
    ripple.style.height = ripple.style.width = Math.max(rect.width, rect.height) + 'px';
    target.appendChild(ripple);
    var top = e.pageY - rect.top - ripple.offsetHeight / 2 -  document.body.scrollTop;
    var left = e.pageX - rect.left - ripple.offsetWidth / 2 - document.body.scrollLeft;
    ripple.style.top = top + 'px';
    ripple.style.left = left + 'px';
    return false;
});
</script>
	<script src="js/parallax.min.js"></script>
	<script src="js/parallax2.min.js"></script>
	<script>
	$('.scene').parallax({
  frictionX: 0.1,
  frictionY: 0.1
});

moveBubbles();
setInterval(function(){
  moveBubbles();
}, 8000);

function moveBubbles () {
  $('.scene>li>div').each(function() {

    var random = Math.ceil(Math.random() * 100);
    var random2 = Math.ceil(Math.random() * 100);

    var whatWay = Math.ceil(Math.random() * 2);

    if(whatWay == 1) {
      $(this).transition({ 
        x: "+=" + random + "",
        y: "+=" + random2 + ""
      }, 8000, "linear");

    } else {

      $(this).transition({ 
        x: "-=" + random + "",
        y: "-=" + random2 + ""
      }, 8000, "linear");
    }
  });
}
</script>
</html>