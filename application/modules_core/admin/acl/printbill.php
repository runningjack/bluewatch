<<!DOCTYPE html>
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
	
	

	<?php echo link_tag("bootstrap/fonts/font-awesome-4/css/font-awesome.min.css"); ?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script <?php echo link_tag("bootstrap/assets/js/html5shiv.js"); ?>
	  <script <?php echo link_tag("bootstrap/js/respond.min.js"); ?>
	<![endif]-->
      
<?php echo link_tag("bootstrap/js/jquery.gritter/css/jquery.gritter.css"); ?>
<?php echo link_tag("bootstrap/js/jquery.nanoscroller/nanoscroller.css"); ?>
<?php echo link_tag("bootstrap/js/jquery.easypiechart/jquery.easy-pie-chart.css"); ?>
<?php echo link_tag("bootstrap/js/bootstrap.switch/bootstrap-switch.css"); ?>
<?php echo link_tag("bootstrap/js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css"); ?>
<?php echo link_tag("bootstrap/js/jquery.select2/select2.css"); ?>
<?php echo link_tag("bootstrap/js/bootstrap.slider/css/slider.css"); ?>
<?php echo link_tag("bootstrap/js/intro.js/introjs.css"); ?>
<?php echo link_tag("bootstrap/js/jquery.vectormaps/jquery-jvectormap-1.2.2.css"); ?>
<?php echo link_tag("bootstrap/js/jquery.magnific-popup/dist/magnific-popup.css"); ?>
<?php echo link_tag("bootstrap/js/jquery.niftymodals/css/component.css"); ?>
<?php echo link_tag("bootstrap/js/bootstrap.summernote/dist/summernote.css"); ?>
<?php echo link_tag("bootstrap/js/jquery.datatables/bootstrap-adapter/css/datatables.css"); ?>	
<?php echo link_tag("bootstrap/js/jquery.niftymodals/css/component.css"); ?>	
<?php echo link_tag("bootstrap/css/style.css");
?>	
  
       
    
</head>

<body>
    
    <div class="cl-mcont">

			<div class="row">
                            <div class="block-flat">
<div class="header">
    <span style=" float: left;"><img src="<?php echo base_url("bootstrap/images/logo.jpg/");?>"/></span>
    <center> 
        <div><p>
            <h2><strong> <?php echo system::$hotelname?></strong> </h2>
            </p>
            <p><h4><?php echo system::$hotelposteraddress?> </h4></p>
            <p><h4> <?php echo system::$hoteladdress?> </h4></p>
            <p><h4> Email:<?php echo system::$hotelemail?> </h4></p>
            
        
        </div></center>
    <span style=" float: right;"> <?php 
     
    ?></span>
    
    <h3 style="color: red;">
                            <?php echo validation_errors(); ?>   
                                                                    </h3>
<h3>
    <?php //print_r(($guest_details));
extract($guest_details);?>  </h3>
  <a href="<?php echo base_url("frontdesk/billing/printbill/".$id);?>"> 
    <?php // display sucess message
                                                           if(!empty($sucess_message)){?>
                                                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $sucess_message;?>!
							 </div>
                                                           <?php }?>
                                                            
                                                            <?php //display error message
                                                            if(!empty($message_error)) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?}?>
</div>
                                <h3 style="color: red;">
                            <?php //echo validation_errors(); ?>   
                                                                    </h3>
                          
                            <table class="no-border">
								
								<tbody class="no-border-y">
									<tr>
										<td  style="width:20%;"  ><strong>Full Name :</strong></td>
					<td><?php echo $Description.' '.$lastname.' '.$middlename.' '.$firstname ;?> </td>
										 <td style="width:20%;"></td>
                                                                                <td style="width:30%;"></td>
									</tr>
                                                                        <tr>
										<td style="width:20%;"><strong>ID Number:</strong></td>
										<td><?php echo $id_no;?></td>
                                                                                 <td style="width:20%;"></td>
                                                                                <td style="width:30%;"></td>
										
									</tr>
                                                                        <tr>
										<td style="width:20%;"><strong>Mobile Number:</strong></td>
                                                                                <td style="width:30%;" ><?php echo $mobilephone;?></td>
                                                                                <td style="width:20%;"></td>
                                                                                <td style="width:30%;"></td>
                                                                                
                                                                                
										
									</tr>
                                                                        <tr>
										<td style="width:20%;"><strong>Bill Number:</strong></td>
                                                                                <td style="width:30%;" ><?php echo $bill_id;?></td>
                                                                                <td style="width:20%;"></td>
                                                                                <td style="width:30%;"></td>
                                                                                
                                                                                
										
									</tr>
                                                                     
								</tbody>
							</table><br/>
                               <div class="content"> 
                                   
                                   <table id="room_property">
                                       <thead> <tr><td>Date</td><td>Details</td><td colspan="5"><center>Debit</center></td><td>Credit</td><td colspan="2">Balance</td></tr></thead>
                                       <tbody>
                                           <tr><td></td><td></td><td>Item Amount</td><td>VAT</td><td>Service</td><td>Tourism</td><td>Gross Amount</td><td></td><td></td><td></td></tr>
                                           <?php
                                           $deposit_sum = 0;//var_dump($transaction_details);
                                           if(($transaction_details )){
                                           foreach($transaction_details as $t){  
                                              // var_dump($t);?>
          <tr><td><?php echo $t->trans_date ;?></td><td><?php echo $t->details;?></td>
              <?php // if($t->trans_cat=='Debit')echo $t->actual_amount;?>
              <td><?php if($t->trans_cat=='Debit')echo $t->actual_amount;?></td>
              <td>    <?php if($t->trans_cat=='Debit')echo $t->std_tax;?></td>
              <td><?php if($t->trans_cat =='Debit')echo $t->std_svc;?></td>
              <td><?php if($t->trans_cat=='Debit')echo $t->std_tourism;?></td>
              <td><?php if($t->trans_cat=='Debit'){
                  $deposit_sum = $deposit_sum - $t->grossamount;
                  echo '<strong>'.number_format($t->grossamount,2).'</strong>';}?></td>
              
              <td> <?php if($t->trans_cat=='Credit'){
                  $deposit_sum = $deposit_sum + $t->std_amount;
                  echo '<strong>'.number_format($t->std_amount,2).'</strong>';}?></td>
              <td><?php 
              echo '<strong>'.number_format($deposit_sum,2).'</strong>';?></td>
              <td><?php if($deposit_sum>0){
                  echo 'CR';}else{
                  echo 'DR'; }?></td></tr>                                  
                                           <?php } }else{ echo'No Transaction Details Found<br/>';} ?>
                                           </tbody>
                                   </table>
                                   <table>
                                       <tr><td><Strong>I hereby certify that the above account is correct</Strong></td>
                                           <td><br/>Guest's Signature:________________________________
                                           </td></tr>
                                    <tr><td>Please Leave your key at Reception</td><td><br/>Reception's Signature:________________________________<br/>
                                       </td></tr>
                                   
                                   </table>
   
                                   </div>
                            </div>
        </div>
          </div>
    
    
    
    
<?php echo "<script src='" . base_url('bootstrap/js/jquery.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.select2/select2.min.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.parsley/parsley.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/bootstrap.slider/js/bootstrap-slider.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.nanoscroller/jquery.nanoscroller.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.nestable/jquery.nestable.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/behaviour/general.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.ui/jquery-ui.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/bootstrap.switch/bootstrap-switch.min.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js') . "' type='text/javascript'></script>"; ?>

<?php  echo "<script src='" . base_url('bootstrap/js/util.js') . "' type='text/javascript'></script>"; ?>
  <script type="text/javascript">
    $(document).ready(function(){
      //initialize the javascript
      App.init();
    });
    
   print();
  </script>
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
    <?php echo "<script src='" . base_url('bootstrap/js/behaviour/voice-commands.js') . "' type='text/javascript'></script>"; ?>
  <?php echo "<script src='" . base_url('bootstrap/js/bootstrap/dist/js/bootstrap.min.js') . "' type='text/javascript'></script>"; ?>
</body>


</html>
