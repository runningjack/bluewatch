<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Employee Rate Update</h3>
                                                        
     
						</div>
						<div class="content">
							<div class="table-responsive">
                                                           <?php // display sucess message
                                                           if (!empty($sucess_message)) {
                                                               ?>
                                                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $sucess_message; ?>!
							 </div>
                                                           <?php
                                                           }?>
                                                            
                                                            <?php //display error message
                                                      //  var_dump($log_details);
                                                            if (!empty($message_error)) {
                                                                ?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?php
                                                            }?><?php $attributes = array('id' => 'usersform');
              echo form_open('admin/manageemployee/updaterate/'.$id, $attributes); ?>
								<table class="table table-bordered" >

<tr><td><strong>
 

Full Name:</strong></td><td>
<?php 
$employ_details = $employ_details[0];
echo $employ_details->first_name.' '.$employ_details->last_name.' '.$employ_details->middle_name
?></td></tr> 
 
 


<tr>
<td>
<strong>Employee Rate</strong>
</td>
<td>
<input type="number" name="employee_rate" id="employee_rate" class="form-control" value="<?php echo $employ_details->employee_rate  ?>"/>
</td>
</tr>


<tr><td></td><td><input type='submit' name='submit' value='Update Employee Rate' class="btn btn-warning"></td></tr> 
   
        
        
        </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        