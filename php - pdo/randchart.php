<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 03/04/2019
 * Time: 09:59
 */


$page="randchart";
include "./header.php";
include "./navbar.php";?>

<script src="js/randchart.js"></script>

<div class="container"><br/><br/>

	<button type="button" class="btn btn-primary" onclick="randchart_draw();">Generate random temperatures</button>

	<div class="container" style="padding-bottom: 25px;">
		  <div class="row">
			  <div class="col-lg-4"></div>
			  <div class="col-lg-4">
				  <div id="randchart_container_id">
					  <!--<canvas id="randchart_canvas_id" ></canvas>-->
				  </div>
			  </div>
			  <div class="col-lg-4"></div>
		  </div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>


	<br/><br/>
	<?php

  	include "./footer.php";
?></div>
