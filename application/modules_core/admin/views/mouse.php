<?php //var_dump($transaction_commited);exit;
?>
 

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
<style type="text/css">
	.widget {
    min-width: 25%;
    max-width: 25%;
}
.fixed_height_390 {
    height: 400px;
}
</style>
 
 

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
	<?php if($group==8){}else{ ?>

       <div class="right_col" role="main" style="min-height: 310px;">

<!-- top tiles -->
<div class="row tile_count">
  <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
	<div class="left"></div>
	<div class="right">
	  <span class="count_top"><i class="fa fa-money"></i> <?php echo date('Y'); ?> Budget(M)</span>
	  <div class="count blue"><a href="<?php echo base_url('admin/report'); ?>"><?=number_format($total_budget, 2)?> </a></div>
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
	  <div class="count"><a href="<?php echo base_url('admin/report'); ?>"><?php echo $total_spent; ?> </a></div>
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
	  <span class="count_top"><i class="fa fa-tasks"></i> <?php echo date('Y'); ?> Total Project</span>
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
<br/>

<div class="row">
	<?php 
	$count = 1;
	foreach ($all_project as $a) { //var_dump($_SESSION['login_detal']->group_id);exit; 
		 if (!in_array(intval($_SESSION['login_detal']->group_id), array(1,7,2,9))) {
 if (!in_array($_SESSION['login_detal']->employee_id, $a['members'])) {
                    
                  continue;

                }
            }
	//var_dump( new DateTime($a["end_date"]));exit;?>
                    <div class="col-md-4 col-xs-12 widget widget_tally_box">
                      <div class="x_panel fixed_height_390">
                        <div class="x_title">
                          <h2><?php echo $a["client"]; ?> </h2>
						  <?php
						  if(new DateTime($a["end"]) < new DateTime()  ){
						  ?>
							<span class="label label-danger" style="color: white"> Project has elapsed end date</span>
						  <?php
						  }
						  ?>
						  
                       <div class="clearfix"></div>
                         
                        </div>
                        <div class="x_content">
												<div>

                            <ul class="list-inline widget_tally">
                            	<li>
                                <p>
                                  <span class="count">Project Name</span>
																	<span><b><?php echo $a["project"]; ?></b></span>
                                </p>
                              </li>
                              <li>
                                <p>
                                  <span class="count">Start Date</span>
																	<span class="month"><?php $strt = new DateTime($a['start']); echo $strt->format('d-F-Y'); ?> </span>
                                </p>
                              </li>
                              <li>
															<p> 
																<span class="count">End Date</span>
																 <span class="month"><?php $end = new DateTime($a['end']); echo $end->format('d-F-Y'); ?> </span>
															 </p>
                              </li>
															<li>
															<p> <span class="count">Tentative Date</span>
																<span class="month"><?php if(!empty($a['actual'])){ $strt = new DateTime($a['start']); echo $strt->format('d-F-Y');} ?> </span>
															 </p>
                              </li>
                              
                            </ul>
                          </div>

			<div class="flex">
				<ul class="list-inline count2">
					<li>
						<p><?php echo number_format(intval($a['budget'])/1000000, 5, '.', ','); ?>(M)</p>
						<span>
						Project Budget</span>
					</li>
					<li>
						<p><?php echo number_format(intval($a['cost'])/1000000, 5, '.', ','); ?>(M)</p>
						<span>Personel Cost</span>
					</li>
					<li>
						<p><?php echo number_format(intval($a['expenses'])/1000000, 5, '.', ','); ?>(M)</p>
						<span>Total Expense</span>
					</li>
				</ul>
			</div>
		 
			</div>
 
                        </div>
                      </div>
                    
<?php if ($count == 8) {
	//break;
}
      $count++;  }?>

                   


                  </div>



</div>
			<?php }?>

 
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
		<?php echo $analytic_dept_budget; ?>, 
		<?php echo $sales_dept_budget; ?>,  
		<?php echo $app_dept_budget; ?>,
	  <?php echo $deliver_dept_budget; ?>,
	  <?php echo $inf_dept_budget; ?>],
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

 