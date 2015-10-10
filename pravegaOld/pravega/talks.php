<?php
include('header.php');
?> 
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
 width: 24%;
  height: 219px;
  overflow: hidden;
  position: relative;
  display: inline-block;
  vertical-align: top;
  border: 1px solid #fff;
  box-shadow: 0 0 5px #ddd;
  margin: 1em;
  margin-left: 1.2em;
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
}</style>
    					<p style="text-align:center"><h2><br>Talks</h2></p>
                     <p  class="col-lg-10" style="text-align: justify; font-size:20px; padding-left: 4%;"> 
					 Excellence is a pursuit that is beyond boundaries. Science is only one road to excellence; at 
Pravega, one of our primary objectives is to find newer, creative ways to achieve excellence, 
whether the means are scientific, cultural, technological or otherwise. To this end, we have 
invited several personalities who have taken up the quest for excellence, and on their journey 
have inspired the people around them. Pravega’s lecture series, ‘Pursuit of Excellence’, is the 
perfect platform to hear their story and gain some valuable insight into what makes them tick, 
and absorb some of the passion, dedication and energy with which their work is infused.</p>
<div class="thumbcontainer">
<figure>
    <a href="rb.pdf" target="_blank">
		<img src="img/rb_thumb.jpg" alt="Thumb">
		<figcaption><div>Dr.Balasubramaniam</div></figcaption>
	</a>
</figure>
  
<figure>
    <a href="sp.pdf" target="_blank">
		<img src="img/sp_thumb.jpg" alt="Thumb">
		<figcaption><div>Dr. Sharan Patil</div></figcaption>
	</a>
</figure>
  
  
<figure>
    <a href="rk.pdf" target="_blank">
		<img src="img/rk.jpg" alt="Thumb">
		<figcaption><div>Riyas Komu</div></figcaption>
	</a>
</figure>  
</div>
						</div>
						</div></div></div>
    </header>
	

 
		

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

   



    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>
	<script src="js/drop_sub.js"></script>

</body>
<footer><?php
include('footer.php');
?> </footer>
</html>
