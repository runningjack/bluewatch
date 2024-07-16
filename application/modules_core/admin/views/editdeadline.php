<?php

$sessionelement = array();
               $sessionelement[''] = '--Select Session--';
                foreach ($session as $value) {
                    $sessionelement[$value->session_name] = $value->session_name;
                }
                
                
$semesterelement = array();
               $semesterelement[''] = '--Select Semester--';
                foreach ($semester as $value) {
                    $semesterelement[$value->semester_name] = $value->semester_name;
                }
?>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Edit Deadline details for <?php  echo ($deadline_details["programme_name"]);?> </h3>
                                                        
     
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
              echo form_open('admin/deadline/edit/'.$id,$attributes);?>
								<table class="table table-bordered"  >
                                                                    <tr><td width="50%"><strong>Set Registeration End Date for Returning:</strong></td><td> <div class="form-group">
                
                <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input class="form-control" size="20" name="returning_end" id="returning_end" type="text" value="<?php if(isset($deadline_details['returning_registration_end'])){echo $deadline_details['returning_registration_end'];}?>" readonly>
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>	
                                                                        
                                                                        </td></tr>
                                                                    <tr><td><strong>Set Registeration End Date for New:</strong></td><td>
                                                                        <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input class="form-control" size="20" name="new_end" id="new_end" type="text" value="<?php if(isset($deadline_details['new_registration_end'])){echo $deadline_details['new_registration_end'];}?>" readonly>
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
                                                                        
                                                                        </td></tr>
                                                                    <tr><td><strong>Set Current Session for Returning:</strong></td><td><?php echo form_dropdown('session_returning', $sessionelement, $deadline_details['current_session_returning'],'required="" class="form-control"'); ?></td></tr>
                                                                    <tr><td><strong>Set Current Session for New:</strong></td><td><?php echo form_dropdown('session_new', $sessionelement, $deadline_details['current_session_new'],'required="" class="form-control"'); ?></td></tr>
                                                                    
                                                                    <tr><td><strong>Current Semester New:</strong></td><td><?php echo form_dropdown('semester_new', $semesterelement, $deadline_details['current_semester_new'],'required="" class="form-control"'); ?></td></tr>
                                                                     <tr><td><strong>Current Semester Returning:</strong></td><td><?php echo form_dropdown('semester_returning', $semesterelement, $deadline_details['current_semester_returning'],'required="" class="form-control"'); ?></td></tr>
                                                                                 <tr><td><strong>Student Should Register By:</strong></td><td>
                                                                                         <select name="reg_by" id="reg_by">
                                                                                             <option value="">--Select--</option>
                                                                                             <option value="session" <?php if($deadline_details['register_by']=='session')echo'selected'?>>Session</option>
                                                                                             <option value="Semester" <?php if($deadline_details['register_by']=='semester')echo'selected'?>>Semester</option>
                                                                                             </select>
                                                                                     </td></tr>
                                                                    <tr><td></td><td><input type='submit' name='submit' class="btn btn-primary" value='Update'></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        