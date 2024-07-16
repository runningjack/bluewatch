

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Add Unit</h3>
                                                        
     
						</div>
						<div class="form-horizontal"  parsley-validate novalidate>
                 <div class="form-group">
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
							 
            <?php } ?>
                 <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
                  <strong>Success!</strong> Transaction ID was Generated Successfully. Click 
                  <a href="<?php echo base_url("admin/report/transactiondetails/".$tran_id);?>" target="_blank">here</a> to print.<br>
                <a href="<?php echo base_url("admin/transaction/start/");?>">Process another Transaction</a> 
	 </div>     
                     
 			</div>
       </div>									
			</div>
       </div>
    
        