

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
							 
            <?php } ?><?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/unit/add',$attributes);?>
								<table style="border: 0;" >
                                                                    <tr><td><strong>Unit Code:</strong></td><td><?php echo form_input($form_unit_code); ?></td></tr>
                                                                    <tr><td><strong>Unit Name:</strong></td><td><?php echo form_input($form_unit_name); ?></td></tr>
                                                                    <tr><td></td><td><input  class="btn btn-primary"  type="submit" value="Add Unit" name="Submit" /></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>
<?php echo form_close(); ?>
 			</div>
       </div>									
			</div>
       </div>
    
        