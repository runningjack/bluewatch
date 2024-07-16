

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Transaction Processing</h3>
                                                        
     
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
                     
                    <?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/batch/edit/'.$id,$attributes);?>
                    <table>
                        
                        <tr><td><strong>Batch Name:</strong></td><td> <?php 
                         echo form_input($batch_name); ?></td></tr>
                                                                    <tr><td><strong>Start Date:<?php // var_dump($batch_details["start_date"]);exit; ?></strong></td><td>
                                                                       <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input class="form-control" size="20" type="text" value="<?php echo $batch_details['start_date'];?>" name="batch_start" readonly="">
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  					
                </div>
                         
                                                                        </td></tr>
                                                                    <tr><td><strong>End Date:</strong></td><td>
                                                                        
                                                                <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                                                                  <input class="form-control" size="20" type="text" name="batch_end" value="<?php if(isset($batch_details['end_date']))echo $batch_details['end_date'];?>" readonly="">
                                                                  <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                                                </div>					
                                                           
                                                                        </td></tr>
                      
                      
                         <tr>
                            <td colspan="2">
                                 <input type="submit" style=" float: right;" class="btn btn-blue" name="reject" id="Add" value="Edit Batch"/></td> 
                            </tr>
                     </table>
                        
                        
                  <?  echo form_close();
       
?>

	         </div>     
                     
 			</div>
       </div>									
			</div>
       </div>
    
        