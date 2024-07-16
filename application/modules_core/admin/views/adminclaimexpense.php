<?php


$expensecat = array();
$expensecat[''] = '--Select Expense Category--';
foreach ($expense_cat as $value) {
    $expensecat[$value->expense_category_id] = $value->expense_category_name;
}


$directorelement = array();
$directorelement[''] = '--Select Director --';
                 foreach ($directors as $value) {
                      $directorelement[$value->emplid]= $value->first_name.' '.$value->last_name;
                  }

               ?>

<script type="text/JavaScript"> 
    
    function randomNumber(limit){
	return Math.floor(Math.random()*limit);
        
}
    
$(function() {
  var stat = 'adm';
$("#exp_cat").change(function(){	
         //$("#loadlga").html("<img src='images/zoho-busy.gif' alt='loading' />").css("display", "inline");
         var exp_cat = document.getElementById('exp_cat').value; 
         
         $("#loadtask").html("<img src='<?php echo base_url('bootstrap/images/zoho-busy.gif'); ?>' alt='loading' />").css("display", "inline");
 		
 		$("#exp_line").load("<?php echo base_url('admin/ajax/expensecat'); ?>",{non: randomNumber(9), valu: exp_cat, stat: stat }, function(response, status, xhr){
           $("#exp_line").val(<?php echo $_POST['exp_line']; ?>); 
           $("#loadtask").css("display", "none");
           $('#exp_line').trigger("change");
           if(status == 'error'){
             $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
                  '<br />Error Code: '+xhr.status+
                  '<br />Error Message: '+xhr.statusText);
         }
      //if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
     });
     //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";             
     
  }).trigger('change');

$('#exp_line').change(function() {
      var exp_line = $('#exp_line').val();
      $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/ajax/getExpLineRemainder');?>",
                data: {
                  exp_line: exp_line,
                  stat: stat
                },
                dataType: "json",
                success: function(response) {
                  if (response.status) {
                     $('#amount').prop('disabled', true);
                          if (Number(response.bal) > 0) {
                            $('#amount').prop('disabled', false);
                          }
                          $('#exp_line_balance1').text(response.bal);
                          $('#exp_line_balance').show();
                      }
                }
            });
    });

$("#amount").on('change keydown paste input', function(){
      var amount = Number($("#amount").val());
      var bal = Number($('#exp_line_balance1').text());
      $('#invalid').text('');
      if (amount > bal) {
        $('#invalid').text("Amount exceeds balance. please change").css("color","red");
        $("#amount").val('');
      }
    });
});


  </script>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Admin Expenses Request</h3>
                                                        
     
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
              echo form_open('admin/adminexpense/claimexpense/', $attributes); ?>
								<table class="table table-bordered" >

 
<input type="hidden" name="log_id" value="<?php echo $id; ?>"/>
<input type="hidden" name="team_lead_id" value="<?php echo $log_details['team_lead_id']; ?>"/>
<input type="hidden" name="project_manager_id" value="<?php echo $log_details['project_manager_id']; ?>"/>
<tr><td><strong>Expense Category:</strong></td>
<td> <?php echo form_dropdown('exp_cat', $expensecat, $_POST['exp_cat'], 'id ="exp_cat" required="" class="form-control"'); ?></td></tr>
 
<tr><td><strong>Expense Line : <span id="loadtask"></span>
</strong></td><td> 
<select name="exp_line" id="exp_line" required class="form-control">
<option value="">--Select Expense Category to load--</option>
</select>
</td>
</tr>



<tr><td><strong>Date :</strong></td><td><input type="date" name="log_date"

value="<?php echo (isset($_POST['log_date'])) ? $_POST['log_date'] : date('Y-m-d'); ?>"
class="form-control">
 
 </td></tr>


 <tr><td><strong>Description :</strong></td><td>
<textarea name="desc" id="desc" class="form-control"><?=$_POST['desc']?></textarea>
 
 </td></tr>


 <tr><td><strong>Beneficiary :</strong></td><td>
 <input type="text" name="beneficiary" value="<?=$_POST['beneficiary']?>" class="form-control">
 
 </td></tr>
 


<tr>
<td>
<strong>Amount :</strong>
</td>
<td>
<input name="amount" id="amount" step="0.01" class="form-control" type="number" min="1" <?=$_POST['amount']?> disabled required>
<p id="exp_line_balance" style="display: none;">Available Balance: <span id="exp_line_balance1"></span></p><p><span id="invalid"></span></p>
 
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
<tr>
 <td>
  <label >
       <strong>Assign Director :</strong></label>
 </td>
 <td>
    <?php echo form_dropdown('director', $directorelement,'', ' id= "director" required="" class="form-control"'); ?> 
 </td>
</tr>

<tr><td></td><td><input type='submit' name='submit' value='Submit Expense' class="btn btn-warning"></td></tr> 
   
        
        
        </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        