<?php

$projelement = array();
               $projelement[''] = '--Select Project--';
                foreach ($user_proj_list as $value) {
                    $projelement[$value->id] = $value->name.'('.$value->team_name.')';
                }

$hourselement = array();
$hourselement[''] = '--Select Hours--';
for ($hour = 1; $hour <= 23; ++$hour) {
    $hourselement[$hour] = $hour;
}
               ?>

<script type="text/JavaScript"> 
    
    function randomNumber(limit){
	return Math.floor(Math.random()*limit);
        
}
    
$(function() {
$("#project_id").change(function(){	
         //$("#loadlga").html("<img src='images/zoho-busy.gif' alt='loading' />").css("display", "inline");
         var project_id = document.getElementById('project_id').value; 
         $("#loadtask").html("<img src='<?php echo base_url('bootstrap/images/zoho-busy.gif'); ?>' alt='loading' />").css("display", "inline");
 		
 		$("#project_task").load("<?php echo base_url('admin/ajax/projecttask'); ?>",{non: randomNumber(9), valu: project_id }, function(response, status, xhr){
           
           $("#loadtask").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		 //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";		         
		 
	});
});


  </script>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Edit Daily Activity Log</h3>
                                                        
     
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
              echo form_open('admin/projectlogs/updateactivity/', $attributes); ?>
								<table class="table table-bordered" >

<tr><td><strong>
<input type="hidden" name="log_id" value="<?php echo $id; ?>"/>
<input type="hidden" name="team_lead_id" value="<?php echo $log_details['team_lead_id']; ?>"/>
<input type="hidden" name="project_manager_id" value="<?php echo $log_details['project_manager_id']; ?>"/>

Project Name:</strong></td><td> <?php echo form_dropdown('project_id', $projelement, $log_details['project_id'], 'id ="project_id" required="" class="form-control"'); ?></td></tr>
<tr><td><strong>Project Task: <span id="loadtask"></span>
</strong></td><td> 
<select name="project_task" id="project_task" required class="form-control">
<option value="<?php echo $log_details['project_task']; ?>"><?php echo $log_details['task_name']; ?></option>
</select>
</td>
</tr>
<tr><td><strong>Date :</strong></td><td><input type="date" name="log_date"

value="<?php echo date('Y-m-d', strtotime($log_details['log_date'])); ?>"
class="form-control">
 
 </td></tr>
 


<tr>
<td>
<strong>Hours Spent</strong>
</td>
<td>

 <?php echo form_dropdown('hours', $hourselement, $log_details['hours'], 'id ="hours" required="" class="form-control"'); ?>
 
</td>
</tr>


<tr><td></td><td><input type='submit' name='submit' value='Update Log' class="btn btn-warning"></td></tr> 
   
        
        
        </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        