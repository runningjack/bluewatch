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
    <?php /*$check_in_record = GuestsModel::GuestAllReservationCheckIn();
          $check_out_record = GuestsModel::GuestAllReservationCheckOut();//var_dump($check_in_record);exit;
          $booking = GuestsModel::GuestAllBooking();*/
          
          $this->load->model('menu');
 $this->load->model('Role');
       
$group = $_SESSION["login_detal"]->group_id;
$menu = (new Menu)->fetchEnabledModule($group);
//var_dump($group);exit;
          ?>

  <!-- Fixed navbar -->
  <?php //if($group=='15') {?>
  	<?php if(1) {?>
  
		  <div class="cl-mcont">
		  
			<div class="stats_bar">
				<div class="butpro butstyle" data-step="2" data-intro="<strong>Beautiful Elements</strong> <br/> If you are looking for a different UI, this is for you!.">
					<div class="sub"><h2>No of Committed Transactions</h2><span id="total_clientes"><?php echo $transaction_commited;?></span></div>
					<div class="stat"><span class="spk1"><canvas style="display: inline-block; width: 74px; height: 16px; vertical-align: top;" width="74" height="16"></canvas></span></div>
				</div>
				<div class="butpro butstyle">
                                    <div class="sub"><h2>value of committed transaction</h2><span>N<?php echo number_format($all_tran_sum['amount'],2); ?></span></div>
					<div class="stat"><span class="up"> </span></div>
				</div>
				<div class="butpro butstyle">
					<div class="sub"><h2>Number of Processed Transaction</h2><span>125</span></div>
					<div class="stat"><span class="down"> </span></div>
				</div>	
				<div class="butpro butstyle">
					<div class="sub"><h2>Value of Processed Transaction</h2><span>18</span></div>
					<div class="stat"><span class="equal"> =N= 300,000.00</span></div>
				</div>	
				<div class="butpro butstyle">
					<div class="sub"><h2>Value Expired Transaction</h2><span> =N= 400,000</span></div>
					<div class="stat"><span class="spk2"></span></div>
				</div>
				<div class="butpro butstyle">
					<div class="sub"><h2>Expired Transaction</h2><span>184</span></div>
					<div class="stat"><span class="spk3"></span></div>
				</div>	

			</div>

			<div class="row dash-cols">
			
					
				
				<div class="col-sm-8 col-md-8">
					<div class="block">
						
						
						<div class="content no-padding">
                                                    <div class="header no-border">
							<h2>Daily Committed Transaction </h2>
						</div>
							<table class="red">
								<thead>
									<tr>
										<!--<th><b>S/N</b></th>-->
                                                                                        <th><b>Patient Name</b></th>
							                                <th><b>Transaction Number</b></th>
                                                                                         <th><b>Transaction Date</b></th>
                                                                                        <th><b>Total Amount</b></th>
                                                                                          <th><b>Amount Paid</b></th>
                                                                                         <th><b>Status</b></th>
									</tr>
								</thead>
								<tbody class="no-border-x">
								<?php
                                                $counter = 1;//var_dump($results);exit;
                                                if(empty($results)){echo 'No transaction as been added';}else{
                                                foreach($results as $data) { ?>
                                                  <tr class="gradeA">
                                                <!--<td><?php 
                                                echo $counter;
                                                //var_dump($data); ?></td>-->
                                                <td class="center"><i class="fa fa-bolt"></i><?php echo $data->name ?></td>
                                                <td class="center"><a onClick="return popWindow(this);"  target="_blank"
                                                      href="<?php echo base_url("admin/report/transactiondetails/".$data->transaction_no);?>">
                                                          <?php echo $data->transaction_no ?></a></td>
                                                <td class="center"><?php echo $data->trans_date_time ?></td>
                                                <td class="center"><?php echo number_format($data->trans_total_amount,2) ?></td>
                                                <td class="center"><?php if($data->amount>0) echo number_format( $data->amount,2); ?></td>
                                                <td class="center"><?php echo $data->status ?></td>




                                                <?php $counter++;}}
                                                ?>


								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
        </div><?php }else{ echo 'Welcome ';}?><?php echo $_SESSION['user']?> 
		
		  







    
    
    
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