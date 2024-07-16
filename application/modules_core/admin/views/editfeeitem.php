

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Edit Fee Item</h3>
                                                        
     
						</div>
						<div class="content">
							<div class="table-responsive">
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
							 
            <?php } ?><?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/payment/editfeeitem/'.$id,$attributes);?>
								<table class="table table-bordered" id="datatable2" >
                                                                    <tr><td><strong>Fee item:</strong></td><td><?php echo form_input($form_feeitem); ?></td></tr>
                                                                    <tr><td><strong>Status :</strong></td>
                                                                        <td><select name="status" id="status" required="" class="form-control">
                                                                              
                                                                                <option value="non-optional" <?php if($status == 'non-optional') echo 'Selected' ?> >Non-Optional</option>
                                                                                <option value="optional" <?php if($status == 'optional') echo 'Selected' ?> >Optional</option>
                                                                        </select></td></tr> 
                                                                    <tr><td></td><td><input type='submit' class="btn btn-primary" name='submit' value='Update Fee Item'></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        