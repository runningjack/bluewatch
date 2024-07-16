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

$progelement = array();
               $countryelement[''] = '--Select faculty--';
                foreach ($prog as $value) {
                    $progelement[$value->faculty_id] = $value->faculty_name;
                }
                
   $levelelement = array();
               $levelelement[''] = '--Select Level--';
                foreach ($level as $value) {
                    $levelelement[$value->level_id] = $value->level_name;
                }
  $semesterelement = array();
              $semesterelement[''] = '--Select Semester--';
                foreach ($semester as $value) {
                    $semesterelement[$value->semester_name] = $value->semester_name;
                }               
?>

<div class="row">
				<div class="col-md-10">
					<div class="block-flat">
						<div class="header">							
							<h3>Course Curriculum Configurations</h3>
                                                        
     
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
							 
            <?php } ?><?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/curriculum/add/',$attributes);?>
                                                            
                                                            <table class="table table-bordered" >
                                                                <tr><td>
								
                                                            <table class="table table-bordered" >
                                                                <tr><td colspan="4"><strong>Curriculum to Configure:</strong></td></tr>
                                                                    <tr><td><strong>Faculty Name:</strong></td>
                                                                        <td> <?php echo form_dropdown('faculty_id', $progelement,'','required="" class="form-control" id="faculty_id"'); ?></td></tr>
                                                                    <tr><td><strong>Department :</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                                            <select name="department_id" id="department_id" required  class = "form-control" >
                                                                                <option value="">--Select Faculty to Display Departments--</option>                                                                            
                                                                            </select></td></tr>
                                                                    <tr><td><strong>Department Option:</strong></td><td>
                                                                            <span id="loaddeptoption"></span>
                                                                            <select name="dept_option" id="dept_option" required  class = "form-control" >
                                                                                <option value="">--Select Department to Load Department Options--</option>                                                                            
                                                                            </select></td> </tr>
                                                                     <tr><td><strong>Level:</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                <?php echo form_dropdown('level_id', $levelelement,'','required="" class="form-control" id="level_id"'); ?></td></tr>
                                                                     
                                       <tr><td><strong>Semester :</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                <?php echo form_dropdown('semester_id', $semesterelement,'','required="" class="form-control" id="semester_id"'); ?></td></tr>                              
                                                                                                                
                                                                    
                                                                    <tr><td><strong>Status :</strong></td>
                                                                        <td><select name="status" id="status" required="" class="form-control">
                                                                                <option value="">--Select Status--</option>
                                                                                <option value="Core">Core</option>
                                                                                <option value="Elective">Elective</option>
                                                                        </select></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>
                                                                        
                                                                        </td><td>
                                                                       	
                                                            <table class="table table-bordered" >
                                                                <tr><td colspan="4"><strong>Select From:</strong></td></tr>
                                                                    <tr><td><strong>Faculty Name:</strong></td>
                                                                        <td> <?php echo form_dropdown('from_faculty_id', $progelement,'','required="" class="form-control" id="from_faculty_id"'); ?></td></tr>
                                                                    <tr><td><strong>Department Name:</strong></td><td>
                                                                            <span id="from_loaddepartment"></span>
                                                                            <select name="from_department_id" id="from_department_id" required  class = "form-control" >
                                                                                <option value="">--Select Faculty to Display Departments--</option>                                                                            
                                                                            </select></td></tr>
                                                                    
                                                                     <tr><td><strong>Level:</strong></td><td>
                                                                            <span id="from_loaddepartment"></span>
                                                <?php echo form_dropdown('from_level_id', $levelelement,'','required="" class="form-control" id="from_level_id"'); ?></td></tr>
                                                                     
                                         <tr><td><strong>Academy Course:</strong></td><td>
                                                                            <span id="from_loadcourses"></span>
                                                                            <select name="course_id" id="course_id" required  class = "form-control" >
                                                                                <option value="">--Select Level to Display Available Courses --</option>                                                                            
                                                                            </select></td></tr>                             
                                                               
                                                                     
                                       
                                                                    <tr><td></td><td><input type='submit' name='submit'  class="btn btn-facebook" value='Add Course'></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>     
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            </td>
                                                                
                                                                
                                                                
                                                                
                                                                </tr>
                                                                        </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        