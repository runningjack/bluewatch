<?php
//var_dump($log_details);
extract($log_details);
$projelement = array();
               $projelement[''] = '--Select Project--';
               //if (!empty($user_proj_list)) {
                 foreach ($user_proj_list as $value) {
                    $projelement[$value->id] = $value->name.'('.$value->team_name.')';
                }
               //}
                

$hourselement = array();
$hourselement[''] = '--Select Hours--';
for ($hour = 1; $hour <= 23; ++$hour) {
    $hourselement[$hour] = $hour;
}

$expensecat = array();
$expensecat[''] = '--Select Expense Category--';
foreach ($expense_cat as $value) {
    $expensecat[$value->expense_category_id] = $value->expense_category_name;
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
           $("#project_task").val(<?php echo $log_details['task_id']; ?>); 
           $("#loadtask").css("display", "none");
           
           if(status == 'error'){
             $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
                  '<br />Error Code: '+xhr.status+
                  '<br />Error Message: '+xhr.statusText);
         }
      //if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
     });
     //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";             
     
  }).trigger("change");
});


  </script>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Log Project Expenses Request (<?=$log_details['trans_id'] ?>)</h3>
                                                        
     
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
                                                            }?><?php
              $attributes = array('id' => 'usersform', 'enctype' => 'multipart/form-data');
              echo form_open('admin/projectexpense/editclaimexpense/'.$id, $attributes); ?>
								<table class="table table-bordered" >

 
<tr><td><strong>
<input type="hidden" name="log_id" value="<?php echo $log_details['proj_exp_id']; ?>"/>
<input type="hidden" name="team_lead_id" value="<?php echo $log_details['team_lead_id']; ?>"/>
<input type="hidden" name="project_manager_id" value="<?php echo $log_details['project_manager_id']; ?>"/>

Project Name:</strong></td><td> <?php echo form_dropdown('project_id', $projelement, $log_details['project_id'], 'id ="project_id" required="" class="form-control"'); ?></td>
 
<tr><td><strong>Project Task : <span id="loadtask"></span>
</strong></td><td> 
<select name="project_task" id="project_task" required class="form-control">
<option value="<?php echo $log_details['project_task']; ?>"><?php echo $log_details['task_name']; ?></option>
</select>
</td>
</tr>





<tr><td><strong>Date :</strong></td><td><input type="date" name="log_date"

value="<?php echo $log_details['log_date']; ?>"
class="form-control">
 
 </td></tr>
 

<tr>
<td>
<strong>Description :</strong>
</td>
<td>
<textarea name="description" id="description" class="form-control"><?php echo $log_details['description']; ?></textarea>
 
</td>
</tr>

<tr>
<td>
<strong>Amount :</strong>
</td>
<td>
<input name="amount" id="amount" step="0.01" value = "<?php echo $log_details['amount']; ?>" class="form-control" type="number" min="1">
 
</td>
</tr>



<tr>
<td>
<strong>File/Receipt/Evidence :</strong>
</td>
<td>
<input name="userfile" id="userfile" class="form-control" type="file" value="<?php echo $log_details['file_name'];?>">

<?php if($log_details['file_name'] != 'default.jpg') { ?> <a onclick="return popWindow(this);" href="<?php echo base_url('exp_files/'.$log_details['file_name']) ?>">
<?php 
$exp_init = new projectexpense();
$exp_init->photo($log_details['file_name']); ?>
</a>
<?php } else{ ?>
<p>No File</p>
  <?php } ?>

 
</td>
</tr>


<tr><td></td><td><input type='submit' name='submit' value='Update Expense Details' class="btn btn-success"></td></tr> 
   
        
        
        </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        