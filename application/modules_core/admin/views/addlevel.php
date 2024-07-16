<?php

$progelement = array();
               $countryelement[''] = '--Select Programme--';
                foreach ($prog as $value) {
                    $progelement[$value->programme_id] = $value->programme_name;
                }
?>

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Edit Level</h3>
                                                        
     
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
              echo form_open('admin/level/add/',$attributes);?>
								<table class="table table-bordered" id="datatable2" >
                                                                    <tr><td><strong>Programme Name:</strong></td><td> <?php echo form_dropdown('prog_id', $progelement,'','required="" class="form-control"'); ?></td></tr>
                                                                    <tr><td><strong>Level Name:</strong></td><td><?php echo form_input($form_level); ?></td></tr>
                                                                    <tr><td></td><td><input type='submit' name='submit' value='Add Level'></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        