<?php //var_dump($transaction_commited);exit;?>

<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Gbadeyanka Abass">
	
       <?php echo link_tag('bootstrap/images/favicon.png', 'shortcut icon'); ?>

	<title>Upperlink HMS V1.0</title>
	
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
	<!-- Custom styles for this template -->
	<?php echo link_tag("bootstrap/css/style.css"); ?>	

       
    

    
</head>














<body>
    <?php $check_in_record = GuestsModel::GuestAllReservationCheckIn();
          $check_out_record = GuestsModel::GuestAllReservationCheckOut();//var_dump($check_in_record);exit;
          $booking = GuestsModel::GuestAllBooking();?>

  <!-- Fixed navbar -->
  	
  
		  <div class="cl-mcont">
		  
			<div class="stats_bar">
				<div class="butpro butstyle" data-step="2" data-intro="<strong>Beautiful Elements</strong> <br/> If you are looking for a different UI, this is for you!.">
					<div class="sub"><h2>No of Committed Transactions</h2><span id="total_clientes"><?php echo $transaction_commited;?></span></div>
					<div class="stat"><span class="spk1"><canvas style="display: inline-block; width: 74px; height: 16px; vertical-align: top;" width="74" height="16"></canvas></span></div>
				</div>
				<div class="butpro butstyle">
                                    <div class="sub"><h2>Total Sales</h2><span>N<?php echo number_format($all_tran_sum['amount'],2); ?></span></div>
					<div class="stat"><span class="up"> 13,5%</span></div>
				</div>
				<div class="butpro butstyle">
					<div class="sub"><h2>VISITS</h2><span>125</span></div>
					<div class="stat"><span class="down"> 20,7%</span></div>
				</div>	
				<div class="butpro butstyle">
					<div class="sub"><h2>Pending Transaction</h2><span>18</span></div>
					<div class="stat"><span class="equal"> 0%</span></div>
				</div>	
				<div class="butpro butstyle">
					<div class="sub"><h2>Part Payment</h2><span>3%</span></div>
					<div class="stat"><span class="spk2"></span></div>
				</div>
				<div class="butpro butstyle">
					<div class="sub"><h2>Outstanding Payment</h2><span>184</span></div>
					<div class="stat"><span class="spk3"></span></div>
				</div>	

			</div>

			<div class="row dash-cols">
			
				<div class="col-sm-6 col-md-6">
					<div class="block">
						<div class="header no-border">
							<h2>Payment By Day</h2>
						</div>
						<div class="content blue-chart"  data-step="3" data-intro="<strong>Unique Styled Plugins</strong> <br/> We put love in every detail to give a great user experience!.">
							<div id="site_statistics" style="height:180px;"></div>
						</div>
						<div class="content">
							<div class="stat-data">
								<div class="stat-blue">
									<h2><?php echo number_format($all_tran_sum['amount'],2); ?></h2>
									<span>Total Monthly Sales</span>
								</div>
							</div>
							<div class="stat-data">
								<div class="stat-number">
									<div><h2><?php echo number_format($all_tran_sum['amount'],2); ?></h2></div>
									<div>Total Sales<br /><span>(Daily)</span></div>
								</div>
								<div class="stat-number">
									<div><h2>57000.00</h2></div>
									<div>Outstanding Payment<br /><span>(Daily)</span></div>
								</div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>	
				
				<div class="col-sm-6 col-md-6">
					<div class="block">
						<div class="header no-border">
							<h2>Monitor</h2>
						</div>
						<div class="content red-chart">
							<div id="site_statistics2" style="height:152px;"></div>
						</div>
						<div class="content no-padding">
							<table class="red">
								<thead>
									<tr>
										<th>Name</th>
										<th class="right"><span>25%</span>C.P.U</th>
										<th class="right"><span>29%</span>Memory</th>
										<th class="right"><span>16%</span>Disc</th>
									</tr>
								</thead>
								<tbody class="no-border-x">
									<tr>
										<td style="width:40%;"><i class="fa fa-sitemap"></i> Server load</td>
										<td class="text-right">0,2%</td>
										<td class="text-right">13,2 MB</td>
										<td class="text-right">0,1 MB/s</td>
									</tr>
									<tr>
										<td><i class="fa fa-tasks"></i> Apps</td>
										<td class="text-right">0,2%</td>
										<td class="text-right">13,2 MB</td>
										<td class="text-right">0,1 MB/s</td>
									</tr>
									<tr>
										<td><i class="fa fa-signal"></i> Process</td>
										<td class="text-right">0,2%</td>
										<td class="text-right">13,2 MB</td>
										<td class="text-right">0,1 MB/s</td>
									</tr>
									<tr>
										<td><i class="fa fa-bolt"></i> Wamp Server</td>
										<td class="text-right">0,2%</td>
										<td class="text-right">13,2 MB</td>
										<td class="text-right">0,1 MB/s</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row dash-cols">
				<div class="col-sm-6 col-md-6">
					<div class="block">
						<div class="header">
							<h2>Invoice <span class="pull-right">#45</span></h2>
							<h3>Your order has been delivered</h3>
						</div>
						<div class="content no-padding ">
							<ul class="items">
								<li>
									<i class="fa fa-file-text"></i>Filet Mignon <span class="pull-right value">$35</span>
									<small>Italian food</small>
								</li>
								<li>
									<i class="fa fa-file-text"></i>Blue beer<span class="pull-right value">$35</span>
									<small>Bar drinks</small>
								</li>
								<li>
									<i class="fa fa-file-text"></i>T-shirts<span class="pull-right value">$35</span>
									<small>Software development</small>
								</li>
								<li>
									<i class="fa fa-file-text"></i>Cloud App<span class="pull-right value">$35</span>
									<small>Game department</small>
								</li>
								<li>
									<i class="fa fa-file-text"></i>Black Metal Music<span class="pull-right value">$35</span>
									<small>Metal genre</small>
									
								</li>
							</ul>
						</div>
							<div class="total-data bg-blue" >
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<h2>Total <b class="caret"></b> <span class="pull-right">$25.3</span></h2>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Print receipt</a></li>
									<li><a href="#">Send invoice to...</a></li>
									<li><a href="#">Payment</a></li>
								</ul>
							</div>
					</div>
				</div>	
				<div class="col-sm-6 col-md-6">
						<ul class="nav nav-tabs">
						  <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
						  <li><a href="#profile" data-toggle="tab">Profile</a></li>
						  <li><a href="#messages" data-toggle="tab">Messages</a></li>
						</ul>
						<div class="tab-content">
						  <div class="tab-pane active cont" id="home">
								<h2 class="text-center">Our Experience</h2>
								<div id="piec" style="height:300px;margin-top:25px;"></div>
						  </div>
						  <div class="tab-pane cont" id="profile">
						  		<h2>Typography</h2>
								<p>Pellentesque ac quam hendrerit, viverra leo eu, <b>dapibus mi</b>. In at luctus massa. Morbi semper nulla eu velit facilisis pellentesque. Mauris adipiscing turpis in bibendum tempus. <i>Donec viverra</i>, lacus ac mollis rhoncus, libero risus placerat nisi, et viverra justo eros eget dui. Mauris convallis et tellus non <a href="#">placerat</a>.</p>
                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce gravida est eros, eget porta leo fringilla et. </p>
                <a href="#">Read more</a>
						  </div>
						  <div class="tab-pane" id="messages">
                <h2 class="hthin">A Lorem Ipsum Story</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a metus pulvinar turpis porttitor imperdiet vel nec justo. Nam id orci purus. Mauris arcu velit, auctor et aliquam quis, rhoncus a velit. Sed laoreet ultrices dolor eget vehicula. Morbi adipiscing euismod nisi, eget tincidunt arcu laoreet at.</p>
                <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam et tortor ultricies, mollis nunc eget, gravida sapien.</p>
              </div>
						</div>
				</div>		
			</div>

			<div class="row dash-cols">
        <div class="col-sm-6 col-md-6">
          <div class="widget-block  white-box calendar-box">
            <div class="col-md-6 blue-box calendar no-padding">
              <div class="padding ui-datepicker"></div>
            </div>
            <div class="col-md-6">
              <div class="padding">
                <h2 class="text-center">Monday</h2>
                <h1 class="day">2</h1>
              </div>
            </div>
          </div>
          
          <div class="widget-block photo white-box weather-box">
            <div class="col-md-6 padding photo">
              <h2 class="text-center">Monday</h2>
              <h1 class="day">10/12/2013</h1>
            </div>
            <div class="col-md-6 red-box">
              <div class="padding text-center">
                <canvas id="sun-icon" width="130" height="215"></canvas>
              </div>
            </div>
          </div>
        </div>
        
				<div class="col-sm-6 col-md-6">
					<ul class="nav nav-tabs">
					  <li class="active"><a href="#chat-1" data-toggle="tab">Adam</a></li>
					  <li><a href="#chat-2" data-toggle="tab">Mike</a></li>
					  <li><a href="#chat-3" data-toggle="tab">Lucy</a></li>
					</ul>
					<div class="tab-content no-padding">
					  <div class="tab-pane active cont" id="chat-1">
						<div class="chat-wi">
							<div class="chat-space nano nscroller">
								<div class="chat-content content">
									<div class="chat-conv">
										<img alt="Avatar" class="c-avatar ttip" src="images/avatar1_50.jpg" data-toggle="tooltip" title="MiguelMich" />
										<div class="c-bubble">
											<div class="msg">Hello, what can i do for you?</div>
											<div><small>12:20 p.m.</small></div>
											<span></span>
										</div>
									</div>
									<div class="chat-conv sent">
										<img alt="Avatar" class="c-avatar ttip" src="images/avatar_50.jpg" data-toggle="tooltip" title="Adam" />
										<div class="c-bubble">
											<div class="msg">Hi, i need support with my iPhone?</div>
											<div><small>12:25 p.m.</small></div>
											<span></span>
										</div>
									</div>
									<div class="chat-conv">
										<img alt="Avatar" class="c-avatar ttip" src="images/avatar1_50.jpg" data-toggle="tooltip" title="MiguelMich" />
										<div class="c-bubble">
											<div class="msg">Hello, how are you? i just though you were here, i'll see you tomorrow.</div>
											<div><small>12:30 p.m.</small></div>
											<span></span>
										</div>
									</div>
									<div class="chat-conv sent">
										<img alt="Avatar" class="c-avatar ttip" src="images/avatar_50.jpg" data-toggle="tooltip" title="Adam" />
										<div class="c-bubble">
											<div class="msg">Hi, i need support with my iPhone?</div>
											<div><small>12:25 p.m.</small></div>
											<span></span>
										</div>
									</div>									
								</div>
							</div>
							<div class="chat-in">
								<form action="cleanzone/dfgdfg" method="post" name="sd">
									<input type="submit" value="SEND" class="btn btn-info pull-right" />
									<div class="input">
										<input type="text" placeholder="Send a message..." name="msg" />
									</div>
									<div class="chat-tools">
										<ul class="nav nav-pills">
										  <li class="active"><i class="fa fa-location-arrow"></i></li>
										  <li><i class="fa fa-camera"></i></li>
										  <li><i class="fa fa-microphone"></i></li>
										  <li><i class="fa fa-cloud"></i></li>
										</ul>
									</div>
								</form>
							</div>
						</div>						  
					  </div>
					  <div class="tab-pane cont" id="chat-2">
						<div class="chat-wi">
							<div class="chat-space nano nscroller">
								<div class="chat-content content">
									<div class="chat-conv sent">
										<img alt="Avatar" class="c-avatar ttip" src="images/avatar4_50.jpg" data-toggle="tooltip" title="Adam" />
										<div class="c-bubble">
											<div class="msg">Hey, are you there?</div>
											<div><small>12:25 p.m.</small></div>
											<span></span>
										</div>
									</div>
									<div class="chat-conv">
										<img alt="Avatar" class="c-avatar ttip" src="images/avatar1_50.jpg" data-toggle="tooltip" title="MiguelMich" />
										<div class="c-bubble">
											<div class="msg">I'm here, how was your day?</div>
											<div><small>12:20 p.m.</small></div>
											<span></span>
										</div>
									</div>										
									<div class="chat-conv sent">
										<img alt="Avatar" class="c-avatar ttip" src="images/avatar4_50.jpg" data-toggle="tooltip" title="Adam" />
										<div class="c-bubble">
											<div class="msg">It was fine, just making some designs...</div>
											<div><small>12:25 p.m.</small></div>
											<span></span>
										</div>
									</div>									
								</div>
							</div>
							<div class="chat-in">
								<form action="cleanzone/dfgdfg" method="post" name="sd">
									<input type="submit" value="SEND" class="btn btn-info pull-right" />
									<div class="input">
										<input type="text" placeholder="Send a message..." name="msg" />
									</div>
									<div class="chat-tools">
										<ul class="nav nav-pills">
										  <li class="active"><i class="fa fa-location-arrow"></i></li>
										  <li><i class="fa fa-camera"></i></li>
										  <li><i class="fa fa-microphone"></i></li>
										  <li><i class="fa fa-cloud"></i></li>
										</ul>
									</div>
								</form>
							</div>
						</div>						  
					  </div>
					  <div class="tab-pane" id="chat-3">
						<div class="chat-wi">
							<div class="chat-space nano nscroller">
								<div class="chat-content content">
									<div class="chat-conv">
										<img alt="Avatar" class="c-avatar ttip" src="images/avatar1_50.jpg" data-toggle="tooltip" title="MiguelMich" />
										<div class="c-bubble">
											<div class="msg">Hello, what can i do for you?</div>
											<div><small>12:20 p.m.</small></div>
											<span></span>
										</div>
									</div>
									<div class="chat-conv sent">
										<img alt="Avatar" class="c-avatar ttip" src="images/avatar3_50.jpg" data-toggle="tooltip" title="Lucy" />
										<div class="c-bubble">
											<div class="msg">Hi, i need support with my iPhone?</div>
											<div><small>12:25 p.m.</small></div>
											<span></span>
										</div>
									</div>
									<div class="chat-conv">
										<img alt="Avatar" class="c-avatar ttip" src="images/avatar1_50.jpg" data-toggle="tooltip" title="MiguelMich" />
										<div class="c-bubble">
											<div class="msg">Hello, how are you? i just though you were here, i'll see you tomorrow.</div>
											<div><small>12:30 p.m.</small></div>
											<span></span>
										</div>
									</div>
									<div class="chat-conv sent">
										<img alt="Avatar" class="c-avatar ttip" src="images/avatar3_50.jpg" data-toggle="tooltip" title="Lucy" />
										<div class="c-bubble">
											<div class="msg">Hi, i need support with my iPhone?</div>
											<div><small>12:25 p.m.</small></div>
											<span></span>
										</div>
									</div>									
								</div>
							</div>
							<div class="chat-in">
								<form action="cleanzone/dfgdfg" method="post" name="sd">
									<input type="submit" value="SEND" class="btn btn-info pull-right" />
									<div class="input">
										<input type="text" placeholder="Send a message..." name="msg" />
									</div>
									<div class="chat-tools">
										<ul class="nav nav-pills">
										  <li class="active"><i class="fa fa-location-arrow"></i></li>
										  <li><i class="fa fa-camera"></i></li>
										  <li><i class="fa fa-microphone"></i></li>
										  <li><i class="fa fa-cloud"></i></li>
										</ul>
									</div>
								</form>
							</div>
						</div>						  
					  </div>
					</div>
				</div>		
			
			</div>
			
			
			<div class="row dash-cols">
				<div class="col-sm-6 col-md-6 col-lg-4">
					<div class="widget-block">
						<div class="white-box padding">
							<div class="row info">
								<div>
									<h3>Your Goals</h3>
								</div>
								<div>
									<div id="com_stats" style="height:98px;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<div class="col-sm-6 col-md-6 col-lg-4">
					<div class="widget-block">
						<div class="white-box padding">
							<div class="row info text-shadow">
								<div class="col-xs-12">
									<h3>Comments</h3>
								</div>
								<div class="col-xs-12">
									<div id="com2_stats" style="height:98px;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<div class="col-sm-6 col-md-6 col-lg-4">
					<div class="widget-block">
						<div class="white-box">
							<div class="fact-data">
								<div class="epie-chart" data-percent="45"><span>0%</span></div>
							</div>
							<div class="fact-data no-padding text-shadow">
								<h3>Users sales</h3>
								<h2>4,522</h2>
								<p>Monthly sales from users.</p>
							</div>
						</div>
					</div>
				</div>	
			</div>

			<div class="row dash-cols">
				<div class="col-sm-6 col-md-6 col-lg-4">
					<div class="block">
						<div class="header">
							<h2><i class="fa fa-comment"></i>Comments</h2>
						</div>
						<div class="content no-padding">
							<div class="fact-data text-center">
								<h3>Positive</h3>
								<h2>60%</h2>
							</div>
							<div class="fact-data text-center">
								<h3>Negative</h3>							
								<h2>40%</h2>
							</div>
						</div>
					</div>
				</div>	
				<div class="col-sm-6 col-md-6 col-lg-4">
					<div class="block">
						<div class="header">
							<h2><i class="fa fa-bug"></i>Tickets</h2>
						</div>
						<div class="content no-padding">
							<div class="fact-data text-center">
								<h3>Frequency</h3>
								<h2>53%</h2>
							</div>
							<div class="fact-data text-center">
								<h3>Pending</h3>							
								<h2>13</h2>
							</div>
						</div>
					</div>
				</div>	
				<div class="col-sm-6 col-md-6 col-lg-4">
					<div class="block">
						<div class="header">
							<h2><i class="fa fa-comment"></i>Comments</h2>
						</div>
						<div class="content no-padding">
							<div class="fact-data text-center">
								<h3>Positive</h3>
								<h2>60%</h2>
							</div>
							<div class="fact-data text-center">
								<h3>Negative</h3>							
								<h2>40%</h2>
							</div>
						</div>
					</div>
				</div>					
			</div>
		
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
  
 
</body>