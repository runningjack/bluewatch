

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Add Fee Item</h3>
                                                        
     
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
							 
            <?}?><?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/payment/addfeeitem',$attributes);?>
								<table style="border: 0;" >
                                                                    <tr><td><strong>Fee Name:</strong></td><td><?php echo form_input($form_feeitem); ?></td></tr>
                                                                       <tr><td><strong>Status :</strong></td>
                                                                        <td><select name="status" id="status" required="" class="form-control">
                                                                              
                                                                                <option value="non-optional">Non-Optional</option>
                                                                                <option value="optional">Optional</option>
                                                                        </select></td></tr> 
                                                                    <tr><td></td><td><input  class="btn btn-primary"  type="submit" value="Add Fee Item" name="Submit" /></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>
<?php echo form_close(); ?>
 			</div>
       </div>									
			</div>
       </div>
    
        