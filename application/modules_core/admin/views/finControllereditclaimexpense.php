<?php
//var_dump($log_details);exit;
extract($log_details);
 

$statuselement = array();
              $statuselement[''] = '--Status Element --';
               if ($director_status == 1) {
                foreach ($taskStatus as $value) {
                  if ($value->status_id != 5) {
                    continue;
                  }
                    $statuselement[$value->status_id]= $value->status;
                }
              } else {
                foreach ($taskStatus as $value) {
                  if ($value->status_id == 5) {
                    continue;
                  }
                    $statuselement[$value->status_id]= $value->status;
                }
              }
               // var_dump($directors);exit;
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
$("#exp_cat").change(function(){	
         //$("#loadlga").html("<img src='images/zoho-busy.gif' alt='loading' />").css("display", "inline");
         var exp_cat = document.getElementById('exp_cat').value; 
         $("#loadtask").html("<img src='<?php echo base_url('bootstrap/images/zoho-busy.gif'); ?>' alt='loading' />").css("display", "inline");
 		
 		$("#exp_line").load("<?php echo base_url('admin/ajax/expensecat'); ?>",{non: randomNumber(9), valu: exp_cat }, function(response, status, xhr){
           
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


$(window).load(function(){
    var exp_cat = document.getElementById('exp_cat').value; 
         $("#loadtask").html("<img src='<?php echo base_url('bootstrap/images/zoho-busy.gif'); ?>' alt='loading' />").css("display", "inline");
 		
 		$("#exp_line").load("<?php echo base_url('admin/ajax/expensecat'); ?>",{non: randomNumber(9), valu: exp_cat }, function(response, status, xhr){
        $("#exp_line").val(<?php echo $log_details['expense_line_id']; ?>); 
        //$("div.exp_line select").val(<?php echo $log_details['expense_line_id']; ?>);
           $("#loadtask").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
});


  </script>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Log Project Expenses Request (<?=$trans_id?>)</h3>
      
     
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
              echo form_open('admin/projectexpense/projectfinupdate/'.$log_id, $attributes); ?>
								<table class="table table-bordered" >

<tr><td><strong>
<input type="hidden" name="log_id" value="<?php echo $log_id; ?>"/>
<input type="hidden" name="team_lead_id" value="<?php echo $log_details['team_lead_id']; ?>"/>
<input type="hidden" name="project_manager_id" value="<?php echo $log_details['project_manager_id']; ?>"/>

Project Name:</strong></td><td> 
<?php echo $name;?></td></tr>
 
<tr><td><strong>Date :</strong></td><td> <?php echo $log_date;  ?> </td></tr>
 


<tr>
<td>
<strong>Amount :</strong>
</td>
<td>
<?php echo number_format($amount,2); ?> 
</td>
</tr>

<tr><td><strong>Description :</strong></td><td> <?php echo $description;  ?> </td></tr>

<tr>
<td>
<strong>File/Receipt/Evidence :</strong>
</td>
<td>
 
<a onclick="return popWindow(this);" href="<?php echo base_url('exp_files/'.$log_details['file_name']) ?>">
<?php 
$exp_init = new projectexpense();
$exp_init->photo($data->file_name); ?>
</a>
 
</td>

</tr>


<?php  
if ($director_status != 1) {   ?>
<tr>
 <td>
  <label><strong>Project Manager Name :</strong></label></td>
 <td>
    <?php   $proj_mana_details = $this->settingsmodel->getEmployeeDetails($log_details['project_manager_id']); 
            echo $proj_mana_details['first_name'].' '.$proj_mana_details['last_name']; ?>
 </td>
</tr>
<tr>
 <td>
  <label >
       <strong>Project Manager Status :</strong></label>
 </td>
 <td><?php echo $taskStatus_arr[$log_details['project_manager_status']];   ?> 
 </td>
</tr>
<tr>
 <td><label> <strong>Project Manager Comment :</strong></label></td>
 <td> <?php  echo $log_details['project_manager_comment'];  ?> 
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
<?php } ?>
<tr>
 <td>
  <label >
       <strong>Status :</strong></label>
 </td>
 <td>
    <?php echo form_dropdown('status', $statuselement,'', ' id= "status" required="" class="form-control"'); ?> 
 </td>
</tr>

 <tr>
 <td>
 <label >
  <strong>Comment :</strong>
 </label>
 </td>
 <td>
    <textarea col="3" row="3" class="form-control" name="comment" id="comment"></textarea>
 </td>      


<tr><td></td><td><input type='submit' name='submit' value='Update Expense Details' class="btn btn-success"></td></tr> 
   
        
        
        </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>



       
<script type="text/javascript">
function popWindow(b)
{   var src=b.href;
    var win=null;
    var h=550;
    var w=850;
    var t=parseInt((screen.height-h)/2);
    var l=parseInt((screen.width-w)/2);
    
    var settings="status=1,scrollbars=1,width=850,height=550";
	if(src)
	{
	  win=window.open (src,"STUDENT INFORMATION",settings);	
	  win.moveTo(t,l);
	}
	return false;
	 
}
</script>
    
        