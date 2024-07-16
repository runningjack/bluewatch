<?php

$projelement = array();
               $projelement[''] = '--Select Project--';
                foreach ($user_proj_list as $value) {
                    $projelement[$value->id] = $value->name;
                }

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


$getRevenueHeadelement = array();
$getRevenueHeadelement[''] = '--Select Revenue Head --';
foreach ($getRevenueHead as $value) {
  $getRevenueHeadelement[$value->revenue_head] = $value->revenue_head;
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
           $("#project_task").val(<?php echo $_POST['project_task']; ?>).change(); 
           
           if(status == 'error'){
             $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
                  '<br />Error Code: '+xhr.status+
                  '<br />Error Message: '+xhr.statusText);
         }
      //if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
     });
     //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";             
     
  }).trigger('change');
});



  </script>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Log Project Expenses Request</h3>
                                                        
     
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
                                                            }?>
 <form action="<?=base_url('admin/projectexpense/claimexpense') ?>" method="post" accept-charset="utf-8" id="usersform"
  enctype="multipart/form-data" onSubmit="document.getElementById('submit').disabled=true;">
								<table class="table table-bordered" >


<tr><td><strong>Expense Head : </span>
</strong></td><td> 
<?php echo form_dropdown('expense_head', $getRevenueHeadelement, $_POST['expense_head'], 'id ="expense_head" required="" class="form-control"'); ?>
</td>
</tr>

<tr><td><strong>


Project Name:</strong></td><td> <?php echo form_dropdown('project_id', $projelement, $_POST['project_id'], '  id ="project_id" required="" class="select2 form-control"'); ?></td>
 
<!-- <tr><td><strong>Project Task : <span id="loadtask" style="display: none;"></span>
</strong></td><td> 
<select name="project_task" id="project_task" required class="form-control">
</select>
</td>
</tr> -->



<tr><td><strong>Date :</strong></td><td><input type="date" name="log_date"

value="<?php echo (isset($_POST['log_date'])) ? $_POST['log_date'] : date('Y-m-d'); ?>"
class="form-control">
 
 </td></tr>
 


<tr>
<td>
<strong>Amount :</strong>
</td>
<td>
<input name="amount" id="amount" step="0.01" class="form-control" type="number" min="1" value="<?=$_POST['amount']?>">
 
</td>
</tr>


<tr>
<td>
<strong>Description :</strong>
</td>
<td>
<textarea name="description" id="description" class="form-control"><?=$_POST['description']?></textarea>
 
</td>
</tr>

<tr>
<td>
<strong>File/Receipt/Evidence :</strong>
</td>
<td>
<input name="userfile" id="userfile" class="form-control" type="file">
 
</td>
</tr>


<tr><td></td><td><input type='submit' name='submit' id="submit" value='Submit Expense' class="btn btn-warning"></td></tr> 
   
        
        
        </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        