<?php
include('header.php');
?> 
    
	<p style="text-align:center"><h2><br>pronights</h2></p>
<style>

*, *::before, *::after{
  -moz-box-sizing: border-box;
       box-sizing: border-box;
  
  -webkit-transition: all 0.3s ease-in-out;
          transition: all 0.3s ease-in-out;
}


.thumbcontainer{
  width: 100%;
  margin: auto;
  display: block;
  text-align: center;
}

.hero{
  width: 100%;
  height: 40%;
  background: #3498db;
  display: table;
}

h1{
  color: #2c3e50;
  text-align: center;
  margin: 0;
  padding: 0;
  display: table-cell;
  vertical-align: middle;
  text-align: center;
  color: #fff;
  font-weight: 300;
  font-size:15px;
}

figure{
  width: 26%;
  height: 300px;
  overflow: hidden;
  position: relative;
  display: inline-block;
  vertical-align: top;
  border: 1px solid #fff;
  box-shadow: 0 0 5px #ddd;
  margin: 1em;
}

figcaption{
  position: absolute;
  left: 0; right: 0;
  top: 0; bottom: 0;
  text-align: center;
  font-weight: bold;
  font-size:28px;
  width: 100%;
  height: 100%;
  display: table;
}

figcaption div{
  display: table-cell;
  vertical-align: middle;
  position: relative;
  top: 20px;
  opacity: 0;
  color: #2c3e50;
  text-transform: uppercase;
}

figcaption div:after{
  position: absolute;
  content: "";
  left: 0; right: 0;
  bottom: 40%;
  text-align: center;
  margin: auto;
  width: 0%;
  height: 2px;
  background: #2c3e50;
}

figure img{
  -webkit-transition: all 0.5s linear;
          transition: all 0.5s linear;
  -webkit-transform: scale3d(1, 1, 1);
          transform: scale3d(1, 1, 1);
}

figure:hover figcaption{
 background: rgba(255,255,255,0.5);
}

figcaption:hover div{
  opacity: 1;
  top: 0;
}

figcaption:hover div:after{
  width: 50%;
}

figure:hover img{
  -webkit-transform: scale3d(1.2, 1.2, 1);
          transform: scale3d(1.2, 1.2, 1);
}

</style>

<div class="thumbcontainer">
 
  <figure>
    <a href=""><img src="img/io_thumb.jpg" alt="Thumb">
    <figcaption><div>Indian Ocean</div></figcaption>
	</a>
  </figure>
  
  <figure>
    <img src="img/nyk_thumb.jpg" alt="Thumb">
    <figcaption><div>Electronyk</div></figcaption>
  </figure>
  
  
  <figure>
    <img src="img/parvaaz_thumb.jpg" alt="Thumb">
    <figcaption><div>Parvaaz</div></figcaption>
  </figure>  
</div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

      <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA"></script>-->




    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>
	<script src="js/drop_sub.js"></script>

</body>

</html>
