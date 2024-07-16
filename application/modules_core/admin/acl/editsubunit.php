<?php

$unitselement = array();
               $unitselement[''] = '--Select Units--';
                foreach ($units as $value) {
                    $unitselement[$value->unit_id] = $value->unit_name;
                }
?>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Edit Sub-Unit</h3>
                                                        
     
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
							 
            <?}?><?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/subunit/edit/'.$id,$attributes);?>
								<table class="table table-bordered" id="datatable2" >
                                                                    <tr><td width="30%" ><strong>Unit Name:</strong></td><td > 
                                                                        <?php // var_dump($subunit_details["unit_id"]);
                                                                        echo form_dropdown('unit_id', $unitselement,$subunit_details["unit_id"],'required="" class="form-control"'); ?></td></tr>
                                                                    <tr><td><strong>Sub-Unit Code:</strong></td><td><?php echo form_input($form_subunit_code); ?></td></tr>
                                                                    <tr><td><strong>Sub-Unit Name:</strong></td><td><?php echo form_input($form_subunit_name); ?></td></tr>
                                                                    <tr><td><strong>Sub-Unit Cost:</strong></td><td class="input-group">
                                                                         <span class="input-group-addon">=N=</span>
                                                                                <?php echo form_input($form_subunit_cost); ?>
                                                                        <span class="input-group-addon">.00</span></td></tr>
                                                                    
                                                                    
                                                                    <tr><td></td><td><input  class="btn btn-primary"  type='submit' name='submit' value='Edit Sub-Unit'></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        