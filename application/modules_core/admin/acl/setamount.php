<script type="text/JavaScript"> 
    
    function randomNumber(limit){
	return Math.floor(Math.random()*limit);
        
}
    
    $(function() {
$("#faculty_id").change(function(){	
         //$("#loadlga").html("<img src='images/zoho-busy.gif' alt='loading' />").css("display", "inline");
         var faculty_id = document.getElementById('faculty_id').value; 
         $("#loaddepartment").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 		
 		$("#department_id").load("<?php echo base_url('admin/ajax/load_departments'); ?>",{non: randomNumber(9), valu: faculty_id }, function(response, status, xhr){
           
           $("#loaddepartment").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		 //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";		         
		 
	});
   $("#department_id").change(function(){	
       
         var department_id = document.getElementById('department_id').value; 
         $("#loaddeptoption").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 		
 		$("#dept_option").load("<?php echo base_url('admin/ajax/load_dept_option'); ?>",{non: randomNumber(9), valu: department_id }, function(response, status, xhr){
           
           $("#loaddeptoption").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		 //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";		         
		 
	});
        
        
        // js for from
        
        $("#from_faculty_id").change(function(){	
         //$("#loadlga").html("<img src='images/zoho-busy.gif' alt='loading' />").css("display", "inline");
         var from_faculty_id = document.getElementById('from_faculty_id').value; 
         $("#from_loaddepartment").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 		
 		$("#from_department_id").load("<?php echo base_url('admin/ajax/load_departments'); ?>",{non: randomNumber(9), valu: from_faculty_id }, function(response, status, xhr){
           
           $("#from_loaddepartment").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		 //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";		         
		 
	});
   $("#from_department_id").change(function(){	
       
         var from_department_id = document.getElementById('from_department_id').value; 
         $("#from_loaddeptoption").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 		
 		$("#from_dept_option").load("<?php echo base_url('admin/ajax/load_dept_option'); ?>",{non: randomNumber(9), valu: from_department_id }, function(response, status, xhr){
           
           $("#from_loaddeptoption").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		 //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";		         
		 
	});
        
            $("#from_level_id").change(function(){	
       
         var level_id = document.getElementById('from_level_id').value; 
         var department_id = document.getElementById('from_department_id').value; 
         
         $("#from_loadcourses").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 		
 		$("#course_id").load("<?php echo base_url('admin/ajax/load_academy_coursesbylevelanddept'); ?>",{non: randomNumber(9), dept: department_id, level: level_id }, function(response, status, xhr){
           
           $("#from_loadcourses").css("display", "none");
           
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

<?php

$facelement = array();
               $facelement['general'] = 'General';
                foreach ($fac as $value) {
                    $facelement[$value->faculty_id] = $value->faculty_name;
                }
                
   $levelelement = array();
               $levelelement['general'] = 'General';
                foreach ($level as $value) {
                    $levelelement[$value->level_id] = $value->level_name;
                }
  $semesterelement = array();
              $semesterelement['general'] = 'General';
                foreach ($semester as $value) {
                    $semesterelement[$value->semester_name] = $value->semester_name;
                } 
                
 $stateelement =  array();
              $stateelement['general'] = 'General';
                foreach ($state as $value) {
                    $stateelement[$value->state_id] = $value->state_name;
                }   
$programmeelement =  array();
              $programmeelement['general'] = 'General';
                foreach ($programme as $value) {
                    $programmeelement[$value->programme_id] = $value->programme_name;
                }                
   $entry_yearelement = array();             
               
   $entry_yearelement['general'] = 'General';
                for($i=2001; $i<=2014;$i++){
                    $entry_yearelement[$i] = $i;
                }  
  $entry_modeelement = array();             
               
   $entry_modeelement['general'] = 'General';
              foreach ($entry_mode as $value) {
                    $entry_modeelement[$value->entry_id] = $value->entry_name;
                }                
  
  $itemselement[''] = '--Select Fee Item--';
              foreach ($items as $value) {
                    $itemselement[$value->fee_id] = $value->fee_name;
                }               
                
  $sessionelement = array();             
               
   $sessionelement[''] = '--Select Session--';
              foreach ($session as $value) {
                    $sessionelement[$value->session_id] = $value->session_name;
                }                                            
                
?>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Fees Items Configurations</h3>
                                                        
     
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
             <div class="alert alert-danger alert-white rounded" id="errordisplay">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?}?><?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/payment/setamount/',$attributes);?>
                                                            
                                                           
								
                                                            <table class="table table-bordered" >
                                                                
                                                                <tr><td colspan=""><strong>Amount :</strong></td><td><input type="number" name="amount" id="amount" required="" class="form-control" /></td></tr>
                                                            
                                                                <tr><td><strong>Fee Item :</strong></td>
                                                                        <td>
                                                                        <?php echo form_dropdown('item_id', $itemselement,'','required="" class="form-control" id="item_id"'); ?>
                                                                        </td></tr> 
                                                                
                                                                <tr><td><strong>Session :</strong></td>
                                                                        <td>
                                                                            <?php echo form_dropdown('session', $sessionelement,'','required="" class="form-control" id="session"'); ?>
                                                                            
                                                                            
                                                                        </td></tr> 
                                                                 
                                                                
                                                                <tr><td><strong>Programme :</strong></td>
                                                                        <td>
                                                                        <?php echo form_dropdown('programme', $programmeelement,'','required="" class="form-control" id="programme"'); ?>
                                                                        </td></tr>    
                                                                
                                                                <tr><td><strong>Faculty Name:</strong></td>
                                                                        <td> <?php echo form_dropdown('faculty_id', $facelement,'','required="" class="form-control" id="faculty_id"'); ?></td></tr>
                                                                   
                                                                    
                                                                    
                                                                    <tr><td><strong>Department :</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                                            <select name="department_id" id="department_id" required  class = "form-control" >
                                                                                <option value="general">General</option>                                                                            
                                                                            </select></td></tr>
                                                                    <tr><td><strong>Department Option:</strong></td><td>
                                                                            <span id="loaddeptoption"></span>
                                                                            <select name="dept_option" id="dept_option" required  class = "form-control" >
                                                                                <option value="general">General</option>                                                                            
                                                                            </select></td> </tr>
                                                                     <tr><td><strong>Level:</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                <?php echo form_dropdown('level_id', $levelelement,'','required="" class="form-control" id="level_id"'); ?></td></tr>
                                                                     
                                      <tr><td><strong>Entry Year:</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                <?php echo form_dropdown('entry_year', $entry_yearelement,'','required="" class="form-control" id="entry_year"'); ?></td></tr>                                                                       
                                                              
                                       <tr><td><strong>Programme Type :</strong></td><td>
                                           <select name="programme_type" id="programme_type" required="" class="form-control">
                                                                                <option value="general">General</option>
                                                                                <option value="full">Full</option>
                                                                                <option value="part">Part</option>
                                                                        </select></td></tr> 
                                       <tr><td><strong>Student Type :</strong></td>
                                                                        <td><select name="student_type" id="student_type" required="" class="form-control">
                                                                                <option value="general">General</option>
                                                                                <option value="new">New</option>
                                                                                <option value="returning">Returning</option>
                                                                        </select></td></tr> 
                                       
                                       
                                                                    <tr><td><strong>Entry Mode :</strong></td>
                                                                        <td>
                                                                            <?php echo form_dropdown('entry_mode', $entry_modeelement,'','required="" class="form-control" id="entry_mode"'); ?>
                                                                            
                                                                            
                                                                        </td></tr> 
                                                                    
                                                                    <tr><td><strong>Nationality :</strong></td>
                                                                        <td><select name="nationality" id="nationality" required="" class="form-control">
                                                                                <option value="general">General</option>
                                                                                <option value="Nigerian">Nigeria</option>
                                                                                <option value="non">Non-Nigeria</option>
                                                                        </select></td></tr> 
                                                                       
                                                                         <tr><td><strong>State :</strong></td>
                                                                        <td>
                                                                        <?php echo form_dropdown('state', $stateelement,'','required="" class="form-control" id="state"'); ?>
                                                                        </td></tr>     
                                                                     <tr><td></td><td><input type='submit' class="btn btn-primary" name='submit' value='Add Amount'></td></tr>        
                                                                            </table>
                                                                        
                                                                        
 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        