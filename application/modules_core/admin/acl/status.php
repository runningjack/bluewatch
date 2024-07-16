

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Transaction Status</h3>
                                                        
     
						</div>
						<div class="form-horizontal"  parsley-validate novalidate>
                 <div class="form-group">
                                                           <?php // display sucess message
                                                           if(!empty($sucess_message)){?>
                                                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $sucess_message;?>!
                                                                <br/>
                                <a href="<?php echo base_url("admin/transaction/printreciept/".$trans_id);?>">Print Receipt  </a>							 </div>
                                                           <?php }?>
                                                            
                                                            <?php //display error message
                                                            if(!empty($message_error)) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?}?>
                 <div class="alert alert-success alert-white rounded">
                     
                     <?php 
                    
                     $attributes = array( 'id' => 'usersform');
              echo form_open('admin/transaction/status',$attributes);?>
                  
<table>
                     <tr><td><strong>Transaction Id :</strong></td><td><?php echo form_input($form_transaction_id); ?></td>
                         <td colspan="8">
                             <input   style="float: right;" class="btn btn-primary"  type='submit' name='fetch' value='View Transaction Details'></td>
                         </tr>
                       
                    
                     </table>	<br/><br/>							
<?php       $obj  = new batchmodel();
            $current_batch = $obj->getcurrentbatch();//var_dump($current_batch["batch_id"]);
            echo form_close();
        // var_dump($trans_status);//exit;
                    if(isset($trans_details['trans_total_amount'])){ 
                         $attributes = array( 'id' => 'usersform');
                        echo form_open('admin/transaction/commit',$attributes);?>
                     <input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>"/>
                     <input type="hidden" name="amount" value="<?php echo $trans_details["trans_total_amount"]-$previous_amount; ?>"/>
                     <table>
                         <tr><td colspan="3">Transaction Details</td></tr>
                           <tr><td >Batch</td><td><?php echo $current_batch["batch_name"];?></td></tr>
                            <tr><td >Batch Closing Date</td><td><?php echo $current_batch["end_date"];?></td></tr>                           
                         <tr><td width="300px">Full Name</td><td><?php  echo $trans_details["name"]?></td></tr>
                         <tr><td>Transaction Number</td><td><?php  echo $trans_details["transaction_no"]?></td></tr>
                         <tr><td>Total Amount Paid</td><td>  <?php  echo number_format($previous_amount,2);?></td></tr>
                          <tr><td>Amount</td><td><?php  echo number_format($trans_details["trans_total_amount"],2) ?></td></tr>
                       <!--  <tr><td>Amount Owning</td><td><?php  echo number_format($trans_details["trans_total_amount"]-$previous_amount,2) ?></td></tr>-->
                         <tr><td>Bank Payment Status</td><td><?php  echo $trans_details["status"]?></td></tr>
                         <tr><td>Supervisor Status</td><td><?php  echo $trans_status["supervisor_status"]?></td></tr>
                         <tr><td>Payment Date :</td>
                             <td colspan="2">
                          
                <!--  <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">-->
               <input class="form-control" size="20" type="text" disabled value="<?php echo date("Y/m/d");?>" name="payment_date" readonly="">
                  <!--  <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  					
                </div>-->
                             
                             </td></tr>
                       <!--  <tr><td>Tendered Amount</td><td class="input-group">
                          <!--<span class="input-group-addon">=N=</span>-->
                            <input type="hidden" name="tendered_amount" disabled="" value="<?php echo $trans_details["trans_total_amount"]; ?>"  id="tendered_amount"/>
                            <!-- <span class="input-group-addon">.00</span>  </td></tr>-->
                           
                     </table>       
                        
                        
                    <? } echo form_close();
                       
                    
?>

	         </div>     
                     
 			</div>
       </div>									
			</div>
       </div>
    
        