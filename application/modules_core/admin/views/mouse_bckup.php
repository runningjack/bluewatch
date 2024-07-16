<?php //var_dump($transaction_commited);exit;?>
 

<link href="<?php echo base_url(); ?>new_gen/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>new_gen/fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>new_gen/css/animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->
<link href="<?php echo base_url(); ?>new_gen/css/custom.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>new_gen/css/maps/jquery-jvectormap-2.0.3.css" />
<link href="<?php echo base_url(); ?>new_gen/css/icheck/flat/green.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>new_gen/css/floatexamples.css" rel="stylesheet" type="text/css" />

<!--<script src="<?php echo base_url(); ?>new_gen/js/jquery.min.js"></script>-->
<script src="<?php echo base_url(); ?>new_gen/js/nprogress.js"></script>

 
 

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
	<?php echo link_tag('bootstrap/css/style.css'); ?>

       <div class="right_col" role="main" style="min-height: 310px;">

<!-- top tiles -->
<div class="row tile_count">
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-money"></i> <?php echo date(Y); ?> Budget(M)</span>
	  <div class="count blue"><?php echo number_format($total_budget, 2); ?></div>
		<span class="count_bottom"><i class="green">100% </i> 	
		For 
	<?php	if ($dept) {
    echo $dept;
} else {
    ?>
		all Units
		<?php
}?></span>
	</div>
  </div>
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-money"></i> Amount Spent(M)</span>
	  <div class="count"><?php echo $total_spent; ?></div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>
		<?php
        $perc = ($total_spent / $total_budget) * 100;
        ?>
		
		<?php echo number_format($perc, 2); ?>% </i>
		For 
	<?php	if ($dept) {
            echo $dept;
        } else {
            ?>
		all Units
		<?php
        }?>
	</span>
	</div>
  </div>
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-tasks"></i> <?php echo date(Y); ?> Total Project</span>
	  <div class="count blue"><?php echo $total_project; ?></div>
	  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>100% </i> For all Units</span>
	</div>
  </div>
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-tasks"></i> Closed Project </span>
	  <div class="count"><?php echo $total_closedProject; ?></div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-desc"></i>
		<?php
        $perclosed = ($total_closedProject / $total_project) * 100;
        ?>
		<?php echo number_format($perclosed, 2); ?>% </i> For all Units</span>
	</div>
  </div>
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-tasks"></i> On Hold Project</span>
	  <div class="count"><?php echo $total_onHoldProject; ?></div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>
		<?php
        $peronhold = ($total_onHoldProject / $total_project) * 100;
        ?>
		<?php echo number_format($peronhold, 2); ?></i> For all Units</span>
	</div>
  </div>
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
		<span class="count_top"><i class="fa fa-tasks"></i> Active Project</span>
		
		<div class="count"><?php echo $total_onActiveProject; ?></div>
		<?php
        $peronactive = ($total_onActiveProject / $total_project) * 100;
        ?>
	  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php echo number_format($peronactive, 2); ?>% </i> For all Units</span>
	</div>
  </div>

</div>
<!-- /top tiles -->

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="dashboard_graph">

	  <div class="row x_title">
		<div class="col-md-6">
		  <h3>Budget Expense <small>By Department</small></h3>
		</div>
		<div class="col-md-6">
		   
		</div>
	  </div>





	  <div class="col-md-9 col-sm-9 col-xs-12">
		<div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
		<div style="width: 100%;">
		  <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height: 330px; padding: 0px; position: relative;"><canvas class="flot-base" width="1152" height="337" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 922px; height: 270px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 14px; text-align: center;">Jan 01</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 160px; text-align: center;">Jan 02</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 306px; text-align: center;">Jan 03</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 453px; text-align: center;">Jan 04</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 599px; text-align: center;">Jan 05</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 115px; top: 252px; left: 745px; text-align: center;">Jan 06</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 239px; left: 14px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 220px; left: 7px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 202px; left: 7px; text-align: right;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 184px; left: 7px; text-align: right;">30</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 165px; left: 7px; text-align: right;">40</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 147px; left: 7px; text-align: right;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 129px; left: 7px; text-align: right;">60</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 110px; left: 7px; text-align: right;">70</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 92px; left: 7px; text-align: right;">80</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 74px; left: 7px; text-align: right;">90</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 55px; left: 1px; text-align: right;">100</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 37px; left: 2px; text-align: right;">110</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 19px; left: 1px; text-align: right;">120</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 1px; text-align: right;">130</div></div></div><canvas class="flot-overlay" width="1152" height="337" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 922px; height: 270px;"></canvas></div>
		</div>
	  </div>
	  <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
		<div class="x_title">
		  <h2>Deparment Budget Expense</h2>
		  <div class="clearfix"></div>
		</div>
	 
		<div class="col-md-12 col-sm-12 col-xs-6">
		  <div>
			<p>BI and Analytics</p>
			<?php
            $bi_spent_per = ($spent_analytic_dep / $analytic_dept_budget) * 100;
            ?>
			<div class="">
			  <div class="progress progress_sm" style="width: 76%;">
				<div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo $bi_spent_per; ?>" aria-valuenow="79" style="width: 80%;"></div>
			  </div>
			</div>
		  </div>
		  <div>
			<p>Sales Department</p>
			<div class="">
			<?php
            $sale_spent_per = ($spent_sales_dept / $sales_dept_budget) * 100;
            ?>
			  <div class="progress progress_sm" style="width: 76%;">
				<div class="progress-bar bg-blue" role="progressbar" data-transitiongoal="<?php echo $sale_spent_per; ?>" aria-valuenow="59" style="width: 100%;"></div>
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-6">
		  <div>
			<p>Business Application Development</p>
			<?php
            $app_spent_per = ($spent_app_dept / $app_dept_budget) * 100;
            ?>
			<div class="">
			  <div class="progress progress_sm" style="width: 76%;">
				<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $app_spent_per; ?>" aria-valuenow="39" style="width: 40%;"></div>
			  </div>
			</div>
		  </div>
		  <div>
			<p>Infrastructure Deparment</p>
			<?php
            if ($inf_dept_budget > 0) {
                $inf_spent_per = ($spent_inf_dept / $inf_dept_budget) * 100;
            }
            ?>
			<div class="">
			  <div class="progress progress_sm" style="width: 76%;">
				<div class="progress-bar bg-purple" role="progressbar" data-transitiongoal="<?php echo $inf_spent_per; ?>" aria-valuenow="49" style="width: 50%;"></div>
			  </div>
			</div>

			<p>Solutions and Product Deparment</p>
			<?php
            $deliver_spent_per = ($spent_deliver_dept / $deliver_dept_budget) * 100;
            ?>
			<div class="">
			  <div class="progress progress_sm" style="width: 76%;">
				<div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="<?php echo $deliver_spent_per; ?>" aria-valuenow="49" style="width: 50%;"></div>
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
		<h2>Budget Breakdown by Exp category</h2>
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
			<span>Administrative</span>
		  </div>
		  <div class="w_center w_55">
			<div class="progress">
			  <div class="progress-bar bg-green" 
				<?php $admin_er = ($admin_exp/($total_budget*1000000))*100 ?>
							role="progressbar" 
							aria-valuenow="60" 
							aria-valuemin="0" 
							aria-valuemax="100" 
							style="width: <?php echo number_format($admin_er,0) ?>%;">
				<span class="sr-only">60% Complete</span>
			  </div>
			</div>
		  </div>
		  <div class="w_right w_20">
			<span>123M</span>
		  </div>
		  <div class="clearfix"></div>
		</div>

		<div class="widget_summary">
		  <div class="w_left w_25">
			<span>Operating</span>
		  </div>
		  <div class="w_center w_55">
			<div class="progress">
			  <div class="progress-bar bg-green"
			<?php	$op_exp = ($op_exp/($total_budget*1000000))*100 ?>
				 role="progressbar" 
				aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" 
				style="width: <?php echo number_format($op_exp,0) ?>%;">
				<span class="sr-only">60% Complete</span>
			  </div>
			</div>
		  </div>
		  <div class="w_right w_20">
			<span>53M</span>
		  </div>
		  <div class="clearfix"></div>
		</div>
		<div class="widget_summary">
		  <div class="w_left w_25">
			<span>Marketing</span>
		  </div>
		  <div class="w_center w_55">
			<div class="progress">
			  <div class="progress-bar bg-green" role="progressbar" 
				aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" 
				<?php	$mark_exp = ($mark_exp/($total_budget*1000000))*100 ?>
				style="width: <?php echo number_format($mark_exp,0) ?>%;">
				<span class="sr-only">60% Complete</span>
			  </div>
			</div>
		  </div>
		  <div class="w_right w_20">
			<span>23M</span>
		  </div>
		  <div class="clearfix"></div>
		</div>
		<div class="widget_summary">
		  <div class="w_left w_25">
			<span>Comp<u>n</u> Cost</span>
		  </div>
		  <div class="w_center w_55">
			<div class="progress">
			  <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0"
				<?php	$comp_exp = ($comp_exp/($total_budget*1000000))*100 ?> 
				aria-valuemax="100" style="width: 5%;">
				<span class="sr-only"><?php echo number_format($comp_exp,0) ?>% Complete</span>
			  </div>
			</div>
		  </div>
		  <div class="w_right w_20">
			<span>3M</span>
		  </div>
		  <div class="clearfix"></div>
		</div>
		<div class="widget_summary">
		  <div class="w_left w_25">
			<span>Staff Cost</span>
		  </div>
		  <div class="w_center w_55">
			<div class="progress">
			  <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0"
				<?php	$staff_exp = ($staff_exp/($total_budget*1000000))*100 ?> 
				 aria-valuemax="100" style="width: <?php echo number_format($staff_exp,0) ?>%;">
				<span class="sr-only">60% Complete</span>
			  </div>
			</div>
		  </div>
		  <div class="w_right w_20">
			<span>1M</span>
		  </div>
		  <div class="clearfix"></div>
		</div>

			<div class="widget_summary">
		  <div class="w_left w_25">
			<span>Other Direct Cost</span>
		  </div>
		  <div class="w_center w_55">
			<div class="progress">
			  <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" 
				<?php	$other_exp = ($other_exp/($total_budget*1000000))*100 ?> 
				aria-valuemax="100" style="width: 2%;">
				<span class="sr-only">60% Complete</span>
			  </div>
			</div>
		  </div>
		  <div class="w_right w_20">
			<span>2M</span>
		  </div>
		  <div class="clearfix"></div>
		</div>

	  </div>
	</div>
  </div>

  <div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320 overflow_hidden">
	  <div class="x_title">
		<h2>Budget Usage</h2>
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
			  <p>Usage Chart</p>
			</th>
			<th>
			  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
				<p class="">Department</p>
			  </div>
			  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
				<p class="">Usage</p>
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
					<p><i class="fa fa-square blue"></i>Analytics </p>
				  </td>
				  <td><?php echo number_format($analytic_dept_budget/1000000,2) ?>%</td>
				</tr>
				<tr>
				  <td>
					<p><i class="fa fa-square green"></i>Sales </p>
				  </td>
				  <td><?php echo number_format($sales_dept_budget/1000000,2); ?>%</td>
				</tr>
				<tr>
				  <td>
					<p><i class="fa fa-square purple"></i>BAD </p>
				  </td>
				  <td><?php echo number_format($app_dept_budget/1000000,2); ?>%</td>
				</tr>
				<tr>
				  <td>
					<p><i class="fa fa-square aero"></i>Product </p>
				  </td>
				  <td><?php echo number_format($deliver_dept_budget/1000000,2); ?>%</td>
				</tr>
				<tr>
				  <td>
					<p><i class="fa fa-square red"></i>Infrastructure </p>
				  </td>
				  <td><?php echo number_format($inf_dept_budget/1000000,2); ?>%</td>
				</tr>
			  </tbody></table>
			</td>
		  </tr>
		</tbody></table>
	  </div>
	</div>
  </div>


  <div class="col-md-4 col-sm-4 col-xs-12"> 
                    <div>
                      <div class="x_title">
                        <h2>Request Waiting Approval <a href="#" style="float:right;padding-left: 10px;" >[View All]</a></h2> 
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a href="#"><i class="fa fa-chevron-up"></i></a>
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
                          <li><a href="#"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <ul class="list-unstyled top_profiles scroll-view" tabindex="5001" style="overflow: hidden; outline: none; cursor: -webkit-grab;">
                        <li class="media event">
                          <a class="pull-left border-aero profile_thumb">
                            <i class="fa fa-user aero"></i>
                          </a>
                          <div class="media-body">
                            <a class="title" href="#">Olanrewaju Salam</a>
                            <p><strong>&#x20A6;2,300.00 </strong>GTB Cash Mgmt </p>
                            <p> <small>Transport</small>
                            </p>
                          </div>
                        </li>
                        <li class="media event">
                          <a class="pull-left border-green profile_thumb">
                            <i class="fa fa-user green"></i>
                          </a>
                          <div class="media-body">
                            <a class="title" href="#">Fasasi Lawal</a>
                            <p><strong>&#x20A6;2,500.00 </strong> FCMB CIM </p>
                            <p> <small>Internet and Recharge Card</small>
                            </p>
                          </div>
                        </li>
                        <li class="media event">
                          <a class="pull-left border-blue profile_thumb">
                            <i class="fa fa-user blue"></i>
                          </a>
                          <div class="media-body">
                            <a class="title" href="#">Udoka Chris</a>
                            <p><strong>&#x20A6;2,300.00 </strong>Airtel BI Assist</p>
                            <p> <small>Transport and car Allowance</small>
                            </p>
                          </div>
                        </li>
                        <li class="media event">
                          <a class="pull-left border-aero profile_thumb">
                            <i class="fa fa-user aero"></i>
                          </a>
                          <div class="media-body">
                            <a class="title" href="#">Ms. Mary Jane</a>
                            <p><strong>&#x20A6;2,300. </strong> Airtel BI Assist </p>
                            <p> <small>Internet and Recharge Card</small>
                            </p>
                          </div>
                        </li>
                       
                      </ul>
                    </div>
                  
	
	<!--<div class="x_panel tile fixed_height_320">
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
-->

  </div>

</div>
 
<!-- footer content -->

<footer>
  <div class="copyright-info">
	<p class="pull-right">Powered By <a href="bluechiptech.biz"> Bluechip Technologies </a>  
	</p>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
 
<?php; /* ?>




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

 

<script src="<?php echo base_url(); ?>new_gen/js/bootstrap.min.js"></script>

<!-- gauge js -->
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/gauge/gauge.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/gauge/gauge_demo.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo base_url(); ?>new_gen/js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo base_url(); ?>new_gen/js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo base_url(); ?>new_gen/js/icheck/icheck.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/moment/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/datepicker/daterangepicker.js"></script>
<!-- chart js -->
<script src="<?php echo base_url(); ?>new_gen/js/chartjs/chart.min.js"></script>

<script src="<?php echo base_url(); ?>new_gen/js/custom.js"></script>

<!-- flot js -->
<!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/flot/jquery.flot.time.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/flot/date.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/flot/jquery.flot.spline.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/flot/jquery.flot.stack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/flot/curvedLines.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/flot/jquery.flot.resize.js"></script>
<script>
  $(document).ready(function() {
	// [17, 74, 6, 39, 20, 85, 7]
	//[82, 23, 66, 9, 99, 6, 2]
	var data1 = [
	  [gd(2012, 1, 1), 17],
	  [gd(2012, 2, 1), 25],
	  [gd(2012, 3, 1), 36],
	  [gd(2012, 4, 1), 45],
	  [gd(2012, 5, 1), 60],
	  [gd(2012, 6, 1), 85],
	  [gd(2012, 7, 1), 7]
	];

	var data2 = [
	  [gd(2012, 1, 1), 82],
	  [gd(2012, 2, 1), 23],
	  [gd(2012, 3, 1), 66],
	  [gd(2012, 4, 1), 9],
	  [gd(2012, 5, 1), 119],
	  [gd(2012, 6, 1), 6],
	  [gd(2012, 7, 1), 9]
	];


		var data3 = [
	  [gd(2012, 1, 1), 25],
	  [gd(2012, 2, 1), 50],
	  [gd(2012, 3, 1), 60],
	  [gd(2012, 4, 1), 70],
	  [gd(2012, 5, 1), 10],
	  [gd(2012, 6, 1), 6],
	  [gd(2012, 7, 1), 5]
	];

		var data4 = [
	  [gd(2012, 1, 1), 10],
	  [gd(2012, 2, 1), 30],
	  [gd(2012, 3, 1), 40],
	  [gd(2012, 4, 1), 50],
	  [gd(2012, 5, 1), 60],
	  [gd(2012, 6, 1), 70],
	  [gd(2012, 7, 1), 80]
	];


		var data5 = [
	  [gd(2012, 1, 1), 90],
	  [gd(2012, 2, 1), 10],
	  [gd(2012, 3, 1), 40],
	  [gd(2012, 4, 1), 30],
	  [gd(2012, 5, 1), 15],
	  [gd(2012, 6, 1), 40],
	  [gd(2012, 7, 1), 50]
	];
	$("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
	  data1, data2,data3,data4,data5
	]
	, {
	  series: {
		lines: {
		  show: true,
		  fill: false
		},
		splines: {
		  show: false,
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
	  colors: ["red","blue","green","purple","orange"],
	  xaxis: {
		tickColor: "rgba(51, 51, 51, 0.06)",
		mode: "time",
		tickSize: [1, "month"],
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
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/maps/jquery-jvectormap-2.0.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/maps/gdp-data.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/maps/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>new_gen/js/maps/jquery-jvectormap-us-aea-en.js"></script>
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
	  "Analytics",
	  "Sales",
	  "BAD",
	  "Product",
	  "Infrastructure"
	],
	datasets: [{
	  data: [
		<?php echo $analytic_dept_budget ?>, 
		<?php echo $sales_dept_budget ?>,  
		<?php echo $app_dept_budget ?>,
	  <?php echo $deliver_dept_budget ?>,
	  <?php echo $inf_dept_budget ?>],
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

		App.init();
			App.dashBoard();        
			
				introJs().setOption('showBullets', false).start();

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
 


	

       
    

    
    
<?php echo "<script src='".base_url('bootstrap/js/jquery.nestable/jquery.nestable.js')."' type='text/javascript'></script>"; ?>
<?php echo "<script src='".base_url('bootstrap/js/behaviour/general.js')."' type='text/javascript'></script>"; ?>
 <?php echo "<script src='".base_url('bootstrap/js/jquery.ui/jquery-ui.js')."' type='text/javascript'></script>"; ?>
 <?php echo "<script src='".base_url('bootstrap/js/jquery.nanoscroller/jquery.nanoscroller.js')."' type='text/javascript'></script>"; ?>
 