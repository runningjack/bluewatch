<?php //var_dump($transaction_commited);exit;?>
 </div>

<link href="<?php echo base_url();?>new_gen/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>new_gen/fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>new_gen/css/animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->
<link href="<?php echo base_url();?>new_gen/css/custom.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>new_gen/css/maps/jquery-jvectormap-2.0.3.css" />
<link href="<?php echo base_url();?>new_gen/css/icheck/flat/green.css" rel="stylesheet" />
<link href="<?php echo base_url();?>new_gen/css/floatexamples.css" rel="stylesheet" type="text/css" />

<!--<script src="<?php echo base_url();?>new_gen/js/jquery.min.js"></script>-->
<script src="<?php echo base_url();?>new_gen/js/nprogress.js"></script>

 

<!-- New Implem ends here -->
<?php /*?>
	
	<!-- Bootstrap core CSS -->
       <?php echo link_tag("bootstrap/js/bootstrap/dist/css/bootstrap.css"); ?>
	
	<?php echo link_tag("bootstrap/js/bootstrap/dist/css/bootstrap.css"); ?>
	<?php echo link_tag("bootstrap/js/jquery.gritter/css/jquery.gritter.css"); ?>

	<?php echo link_tag("bootstrap/fonts/font-awesome-4/css/font-awesome.min.css"); ?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script <?php echo link_tag("bootstrap/assets/js/html5shiv.js"); ?>
	  <script <?php echo link_tag("bootstrap/js/respond.min.js"); ?>
	<![endif]-->
      
	<?php //echo link_tag("bootstrap/js/jquery.nanoscroller/nanoscroller.css"); ?>
	<?php echo link_tag("bootstrap/js/jquery.easypiechart/jquery.easy-pie-chart.css"); ?>
	<?php echo link_tag("bootstrap/js/bootstrap.switch/bootstrap-switch.css"); ?>
	<?php echo link_tag("bootstrap/js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css"); ?>
	<?php echo link_tag("bootstrap/js/jquery.select2/select2.css"); ?>
	<?php echo link_tag("bootstrap/js/bootstrap.slider/css/slider.css"); ?>
  <?php echo link_tag("bootstrap/js/jquery.fullcalendar/fullcalendar/fullcalendar.css"); ?>
 <?php echo link_tag("bootstrap/js/jquery.fullcalendar/fullcalendar/fullcalendar.print.css"); ?>
		

	<?php */?>
	<!-- Custom styles for this template -->
	<?php echo link_tag("bootstrap/css/style.css"); ?>

       <div class="right_col" role="main" style="min-height: 310px;">

<!-- top tiles -->
<div class="row tile_count">
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
	  <div class="count">2500</div>
	  <span class="count_bottom"><i class="green">4% </i> From last Week</span>
	</div>
  </div>
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
	  <div class="count">123.50</div>
	  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
	</div>
  </div>
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
	  <div class="count green">2,500</div>
	  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
	</div>
  </div>
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
	  <div class="count">4,567</div>
	  <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
	</div>
  </div>
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
	  <div class="count">2,315</div>
	  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
	</div>
  </div>
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
	  <div class="count">7,325</div>
	  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
	</div>
  </div>

</div>
<!-- /top tiles -->

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="dashboard_graph">

	  <div class="row x_title">
		<div class="col-md-6">
		  <h3>Network Activities <small>Graph title sub-title</small></h3>
		</div>
		<div class="col-md-6">
		  <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
			<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
			<span>April 3, 2019 - May 2, 2019</span> <b class="caret"></b>
		  </div>
		</div>
	  </div>

	  <div class="col-md-9 col-sm-9 col-xs-12">
		<div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
		<div style="width: 100%;">
		  <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height: 270px; padding: 0px; position: relative;"><canvas class="flot-base" width="1152" height="337" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 922px; height: 270px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 14px; text-align: center;">Jan 01</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 160px; text-align: center;">Jan 02</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 306px; text-align: center;">Jan 03</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 453px; text-align: center;">Jan 04</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 599px; text-align: center;">Jan 05</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 745px; text-align: center;">Jan 06</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 239px; left: 14px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 220px; left: 7px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 202px; left: 7px; text-align: right;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 184px; left: 7px; text-align: right;">30</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 165px; left: 7px; text-align: right;">40</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 147px; left: 7px; text-align: right;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 129px; left: 7px; text-align: right;">60</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 110px; left: 7px; text-align: right;">70</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 92px; left: 7px; text-align: right;">80</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 74px; left: 7px; text-align: right;">90</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 55px; left: 1px; text-align: right;">100</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 37px; left: 2px; text-align: right;">110</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 19px; left: 1px; text-align: right;">120</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 1px; text-align: right;">130</div></div></div><canvas class="flot-overlay" width="1152" height="337" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 922px; height: 270px;"></canvas></div>
		</div>
	  </div>
	  <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
		<div class="x_title">
		  <h2>Top Campaign Performance</h2>
		  <div class="clearfix"></div>
		</div>

		<div class="col-md-12 col-sm-12 col-xs-6">
		  <div>
			<p>Facebook Campaign</p>
			<div class="">
			  <div class="progress progress_sm" style="width: 76%;">
				<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80" aria-valuenow="79" style="width: 80%;"></div>
			  </div>
			</div>
		  </div>
		  <div>
			<p>Twitter Campaign</p>
			<div class="">
			  <div class="progress progress_sm" style="width: 76%;">
				<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60" aria-valuenow="59" style="width: 60%;"></div>
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-6">
		  <div>
			<p>Conventional Media</p>
			<div class="">
			  <div class="progress progress_sm" style="width: 76%;">
				<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40" aria-valuenow="39" style="width: 40%;"></div>
			  </div>
			</div>
		  </div>
		  <div>
			<p>Bill boards</p>
			<div class="">
			  <div class="progress progress_sm" style="width: 76%;">
				<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50" aria-valuenow="49" style="width: 50%;"></div>
			  </div>
			</div>
		  </div>
		</div>

	  </div>

	  <div class="clearfix"></div>
	</div>
  </div>

</div>
<br>

<div class="row">


  <div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320">
	  <div class="x_title">
		<h2>App Versions</h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="#">Settings 1</a>
			  </li>
			  <li><a href="#">Settings 2</a>
			  </li>
			</ul>
		  </li>
		  <li><a class="close-link"><i class="fa fa-close"></i></a>
		  </li>
		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
		<h4>App Usage across versions</h4>
		<div class="widget_summary">
		  <div class="w_left w_25">
			<span>0.1.5.2</span>
		  </div>
		  <div class="w_center w_55">
			<div class="progress">
			  <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
				<span class="sr-only">60% Complete</span>
			  </div>
			</div>
		  </div>
		  <div class="w_right w_20">
			<span>123k</span>
		  </div>
		  <div class="clearfix"></div>
		</div>

		<div class="widget_summary">
		  <div class="w_left w_25">
			<span>0.1.5.3</span>
		  </div>
		  <div class="w_center w_55">
			<div class="progress">
			  <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
				<span class="sr-only">60% Complete</span>
			  </div>
			</div>
		  </div>
		  <div class="w_right w_20">
			<span>53k</span>
		  </div>
		  <div class="clearfix"></div>
		</div>
		<div class="widget_summary">
		  <div class="w_left w_25">
			<span>0.1.5.4</span>
		  </div>
		  <div class="w_center w_55">
			<div class="progress">
			  <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
				<span class="sr-only">60% Complete</span>
			  </div>
			</div>
		  </div>
		  <div class="w_right w_20">
			<span>23k</span>
		  </div>
		  <div class="clearfix"></div>
		</div>
		<div class="widget_summary">
		  <div class="w_left w_25">
			<span>0.1.5.5</span>
		  </div>
		  <div class="w_center w_55">
			<div class="progress">
			  <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
				<span class="sr-only">60% Complete</span>
			  </div>
			</div>
		  </div>
		  <div class="w_right w_20">
			<span>3k</span>
		  </div>
		  <div class="clearfix"></div>
		</div>
		<div class="widget_summary">
		  <div class="w_left w_25">
			<span>0.1.5.6</span>
		  </div>
		  <div class="w_center w_55">
			<div class="progress">
			  <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
				<span class="sr-only">60% Complete</span>
			  </div>
			</div>
		  </div>
		  <div class="w_right w_20">
			<span>1k</span>
		  </div>
		  <div class="clearfix"></div>
		</div>

	  </div>
	</div>
  </div>

  <div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320 overflow_hidden">
	  <div class="x_title">
		<h2>Device Usage</h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="#">Settings 1</a>
			  </li>
			  <li><a href="#">Settings 2</a>
			  </li>
			</ul>
		  </li>
		  <li><a class="close-link"><i class="fa fa-close"></i></a>
		  </li>
		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">

		<table class="" style="width:100%">
		  <tbody><tr>
			<th style="width:37%;">
			  <p>Top 5</p>
			</th>
			<th>
			  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
				<p class="">Device</p>
			  </div>
			  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
				<p class="">Progress</p>
			  </div>
			</th>
		  </tr>
		  <tr>
			<td><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
			  <canvas id="canvas1" height="200" width="200" style="margin: 15px 10px 10px 0px; width: 160px; height: 160px;"></canvas>
			</td>
			<td>
			  <table class="tile_info">
				<tbody><tr>
				  <td>
					<p><i class="fa fa-square blue"></i>IOS </p>
				  </td>
				  <td>30%</td>
				</tr>
				<tr>
				  <td>
					<p><i class="fa fa-square green"></i>Android </p>
				  </td>
				  <td>10%</td>
				</tr>
				<tr>
				  <td>
					<p><i class="fa fa-square purple"></i>Blackberry </p>
				  </td>
				  <td>20%</td>
				</tr>
				<tr>
				  <td>
					<p><i class="fa fa-square aero"></i>Symbian </p>
				  </td>
				  <td>15%</td>
				</tr>
				<tr>
				  <td>
					<p><i class="fa fa-square red"></i>Others </p>
				  </td>
				  <td>30%</td>
				</tr>
			  </tbody></table>
			</td>
		  </tr>
		</tbody></table>
	  </div>
	</div>
  </div>


  <div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320">
	  <div class="x_title">
		<h2>Quick Settings</h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="#">Settings 1</a>
			  </li>
			  <li><a href="#">Settings 2</a>
			  </li>
			</ul>
		  </li>
		  <li><a class="close-link"><i class="fa fa-close"></i></a>
		  </li>
		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
		<div class="dashboard-widget-content">
		  <ul class="quick-list">
			<li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
			</li>
			<li><i class="fa fa-bars"></i><a href="#">Subscription</a>
			</li>
			<li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
			<li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
			</li>
			<li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
			<li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
			</li>
			<li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
			</li>
		  </ul>

		  <div class="sidebar-widget">
			<h4>Profile Completion</h4>
			<canvas width="187" height="100" id="foo" class="" style="width: 150px; height: 80px;"></canvas>
			<div class="goal-wrapper">
			  <span class="gauge-value pull-left">$</span>
			  <span id="gauge-text" class="gauge-value pull-left">3,200</span>
			  <span id="goal-text" class="goal-value pull-right">$5,000</span>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>

</div>
 
<!-- footer content -->

<footer>
  <div class="copyright-info">
	<p class="pull-right">Powered By <a href="bluechiptech.biz"> Bluechip Technology </a>  
	</p>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
 
<?php/* ?>

    
    
    
<?php echo "<script src='" . base_url('bootstrap/js/jquery.js') . "' type='text/javascript'></script>"; ?>

	<?php echo "<script src='" . base_url('bootstrap/js/jquery.nanoscroller/jquery.nanoscroller.js') . "' type='text/javascript'></script>"; ?>
	<?php echo "<script src='" . base_url('bootstrap/js/jquery.sparkline/jquery.sparkline.min.js') . "' type='text/javascript'></script>"; ?>
	<?php echo "<script src='" . base_url('bootstrap/js/jquery.easypiechart/jquery.easy-pie-chart.js') . "' type='text/javascript'></script>"; ?>
	<?php echo "<script src='" . base_url('bootstrap/js/behaviour/general.js') . "' type='text/javascript'></script>"; ?>
       <?php echo "<script src='" . base_url('bootstrap/js/jquery.ui/jquery-ui.js') . "' type='text/javascript'></script>"; ?>
	 <?php echo "<script src='" . base_url('bootstrap/js/jquery.nestable/jquery.nestable.js') . "' type='text/javascript'></script>"; ?>
	 <?php echo "<script src='" . base_url('bootstrap/js/bootstrap.switch/bootstrap-switch.min.js') . "' type='text/javascript'></script>"; ?>
	 <?php echo "<script src='" . base_url('bootstrap/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js') . "' type='text/javascript'></script>"; ?>
	 <?php echo "<script src='" . base_url('bootstrap/js/jquery.select2/select2.min.js') . "' type='text/javascript'></script>"; ?>
	 <?php echo "<script src='" . base_url('bootstrap/js/bootstrap.slider/js/bootstrap-slider.js') . "' type='text/javascript'></script>"; ?>
	 <?php echo "<script src='" . base_url('bootstrap/js/jquery.gritter/js/jquery.gritter.js') . "' type='text/javascript'></script>"; ?>
   
  
  
 <?php echo "<script src='" . base_url('bootstrap/js/skycons/skycons.js') . "' type='text/javascript'></script>"; ?>
 <?php echo "<script src='" . base_url('bootstrap/js/bootstrap.slider/js/bootstrap-slider.js') . "' type='text/javascript'></script>"; ?>
 <?php //echo "<script src='" . base_url('bootstrap/js/intro.js/intro.js') . "' type='text/javascript'></script>"; ?>
	
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
  
  <script type="text/javascript">
    $(document).ready(function(){
       App.init();
        App.dashBoard();        
        
          introJs().setOption('showBullets', false).start();
    });
  </script>
   
  <script src="js/behaviour/voice-commands.js"></script>
   <?php echo "<script src='" . base_url('bootstrap/js/bootstrap/dist/js/bootstrap.min.js') . "' type='text/javascript'></script>"; ?>
   <?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.js') . "' type='text/javascript'></script>"; ?>
   <?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.pie.js') . "' type='text/javascript'></script>"; ?>
   <?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.resize.js') . "' type='text/javascript'></script>"; ?>
   <?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.labels.js') . "' type='text/javascript'></script>"; ?>
  <?php */?>
<!---
New Implementation

--->




<script src="<?php echo base_url();?>new_gen/js/bootstrap.min.js"></script>

<!-- gauge js -->
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/gauge/gauge.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/gauge/gauge_demo.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo base_url();?>new_gen/js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo base_url();?>new_gen/js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo base_url();?>new_gen/js/icheck/icheck.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/moment/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/datepicker/daterangepicker.js"></script>
<!-- chart js -->
<script src="<?php echo base_url();?>new_gen/js/chartjs/chart.min.js"></script>

<script src="<?php echo base_url();?>new_gen/js/custom.js"></script>

<!-- flot js -->
<!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/flot/jquery.flot.time.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/flot/date.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/flot/jquery.flot.spline.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/flot/jquery.flot.stack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/flot/curvedLines.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/flot/jquery.flot.resize.js"></script>
<script>
  $(document).ready(function() {
	// [17, 74, 6, 39, 20, 85, 7]
	//[82, 23, 66, 9, 99, 6, 2]
	var data1 = [
	  [gd(2012, 1, 1), 17],
	  [gd(2012, 1, 2), 74],
	  [gd(2012, 1, 3), 6],
	  [gd(2012, 1, 4), 39],
	  [gd(2012, 1, 5), 20],
	  [gd(2012, 1, 6), 85],
	  [gd(2012, 1, 7), 7]
	];

	var data2 = [
	  [gd(2012, 1, 1), 82],
	  [gd(2012, 1, 2), 23],
	  [gd(2012, 1, 3), 66],
	  [gd(2012, 1, 4), 9],
	  [gd(2012, 1, 5), 119],
	  [gd(2012, 1, 6), 6],
	  [gd(2012, 1, 7), 9]
	];
	$("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
	  data1, data2
	], {
	  series: {
		lines: {
		  show: false,
		  fill: true
		},
		splines: {
		  show: true,
		  tension: 0.4,
		  lineWidth: 1,
		  fill: 0.4
		},
		points: {
		  radius: 0,
		  show: true
		},
		shadowSize: 2
	  },
	  grid: {
		verticalLines: true,
		hoverable: true,
		clickable: true,
		tickColor: "#d5d5d5",
		borderWidth: 1,
		color: '#fff'
	  },
	  colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
	  xaxis: {
		tickColor: "rgba(51, 51, 51, 0.06)",
		mode: "time",
		tickSize: [1, "day"],
		//tickLength: 10,
		axisLabel: "Date",
		axisLabelUseCanvas: true,
		axisLabelFontSizePixels: 12,
		axisLabelFontFamily: 'Verdana, Arial',
		axisLabelPadding: 10
		  //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
	  },
	  yaxis: {
		ticks: 8,
		tickColor: "rgba(51, 51, 51, 0.06)",
	  },
	  tooltip: false
	});

	function gd(year, month, day) {
	  return new Date(year, month - 1, day).getTime();
	}
  });
</script>

<!-- worldmap -->
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/maps/jquery-jvectormap-2.0.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/maps/gdp-data.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/maps/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>new_gen/js/maps/jquery-jvectormap-us-aea-en.js"></script>
<!-- pace -->
<script src="js/pace/pace.min.js"></script>
<script>
  $(function() {
	$('#world-map-gdp').vectorMap({
	  map: 'world_mill_en',
	  backgroundColor: 'transparent',
	  zoomOnScroll: false,
	  series: {
		regions: [{
		  values: gdpData,
		  scale: ['#E6F2F0', '#149B7E'],
		  normalizeFunction: 'polynomial'
		}]
	  },
	  onRegionTipShow: function(e, el, code) {
		el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
	  }
	});
  });
</script>
<!-- skycons -->
<script src="js/skycons/skycons.min.js"></script>
<script>
  var icons = new Skycons({
	  "color": "#73879C"
	}),
	list = [
	  "clear-day", "clear-night", "partly-cloudy-day",
	  "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
	  "fog"
	],
	i;

  for (i = list.length; i--;)
	icons.set(list[i], list[i]);

  icons.play();
</script>

<!-- dashbord linegraph -->
<script>
  Chart.defaults.global.legend = {
	enabled: false
  };

  var data = {
	labels: [
	  "Symbian",
	  "Blackberry",
	  "Other",
	  "Android",
	  "IOS"
	],
	datasets: [{
	  data: [15, 20, 30, 10, 30],
	  backgroundColor: [
		"#BDC3C7",
		"#9B59B6",
		"#455C73",
		"#26B99A",
		"#3498DB"
	  ],
	  hoverBackgroundColor: [
		"#CFD4D8",
		"#B370CF",
		"#34495E",
		"#36CAAB",
		"#49A9EA"
	  ]

	}]
  };

  var canvasDoughnut = new Chart(document.getElementById("canvas1"), {
	type: 'doughnut',
	tooltipFillColor: "rgba(51, 51, 51, 0.55)",
	data: data
  });
</script>
<!-- /dashbord linegraph -->
<!-- datepicker -->
<script type="text/javascript">
  $(document).ready(function() {

	var cb = function(start, end, label) {
	  console.log(start.toISOString(), end.toISOString(), label);
	  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	  //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
	}

	var optionSet1 = {
	  startDate: moment().subtract(29, 'days'),
	  endDate: moment(),
	  minDate: '01/01/2012',
	  maxDate: '12/31/2015',
	  dateLimit: {
		days: 60
	  },
	  showDropdowns: true,
	  showWeekNumbers: true,
	  timePicker: false,
	  timePickerIncrement: 1,
	  timePicker12Hour: true,
	  ranges: {
		'Today': [moment(), moment()],
		'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Last 7 Days': [moment().subtract(6, 'days'), moment()],
		'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		'This Month': [moment().startOf('month'), moment().endOf('month')],
		'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	  },
	  opens: 'left',
	  buttonClasses: ['btn btn-default'],
	  applyClass: 'btn-small btn-primary',
	  cancelClass: 'btn-small',
	  format: 'MM/DD/YYYY',
	  separator: ' to ',
	  locale: {
		applyLabel: 'Submit',
		cancelLabel: 'Clear',
		fromLabel: 'From',
		toLabel: 'To',
		customRangeLabel: 'Custom',
		daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
		monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		firstDay: 1
	  }
	};
	$('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
	$('#reportrange').daterangepicker(optionSet1, cb);
	$('#reportrange').on('show.daterangepicker', function() {
	  console.log("show event fired");
	});
	$('#reportrange').on('hide.daterangepicker', function() {
	  console.log("hide event fired");
	});
	$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
	  console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
	});
	$('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
	  console.log("cancel event fired");
	});
	$('#options1').click(function() {
	  $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
	});
	$('#options2').click(function() {
	  $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
	});
	$('#destroy').click(function() {
	  $('#reportrange').data('daterangepicker').remove();
	});
  });
</script>
<script>
  NProgress.done();
</script>
<!-- /datepicker -->
<!-- /footer content -->
</body>

</html>

 
</body>