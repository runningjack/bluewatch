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
        
        
          $("#state_id").change(function(){	
       
         var state_id = document.getElementById('state_id').value; 
         $("#loadlga").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 		
 		$("#lga_id").load("<?php echo base_url('admin/ajax/load_lga'); ?>",{non: randomNumber(9), valu: state_id }, function(response, status, xhr){
           
           $("#loadlga").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		 //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";		         
		 
	});
        
            $("#programme_id").change(function(){	
       
         var programme_id = document.getElementById('programme_id').value; 
         $("#loaddegree").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 		
 		$("#degree_id").load("<?php echo base_url('admin/ajax/load_degree'); ?>",{non: randomNumber(9), valu: programme_id }, function(response, status, xhr){
           
           $("#loaddegree").css("display", "none");
           
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
//var_dump($student_details);
$progelement = array();
               $progelement[''] = '--Select faculty--';
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
                
  $stateelement = array();
              $stateelement[''] = '--Select State--';
                foreach ($state as $value) {
                    $stateelement[$value->state_id] = $value->state_name;
                } 
 $statuselement = array();
              $statuselement[''] = '--Select Status--';
                foreach ($status as $value) {
                    $statuselement[$value->status_id] = $value->status_name;
                } 
                
                
  $programmeelement = array();
              $programmeelement[''] = '--Select programme--';
                foreach ($programme as $value) {
                    $programmeelement[$value->programme_id] = $value->programme_name;
                } 
                
                
$degreeelement = array();
              $degreeelement[''] = '--Select Honour type--';
                foreach ($degree as $value) {
                    $degreeelement[$value->degree_id] = $value->degree_name;
                } 
                
                
$lgaelement = array();
              $lgaelement[''] = '--Select LGA --';
                foreach ($lga as $value) {
                    $lgaelement[$value->lga_id] = $value->lga_name;
                } 
                
$deptelement = array();
              $deptelement[''] = '--Select Department --';
                foreach ($dept as $value) {
                    $deptelement[$value->department_id] = $value->department_name;
                }
                
                
 $dept_optionelement = array();
              $dept_optionelement[''] = '--Select programme --';
               if($dept_option) foreach ($dept_option as $value) {
                    $dept_optionelement[$value->courseoption_id] = $value->programme_option;
                }                
                
                    
$programmetypeelement = array();
              $programmetypeelement[''] = '--Select programme type--';
                foreach ($programmetype as $value) {
                    $programmetypeelement[$value->programmet_id] = $value->programmet_name;
                }  
                            
                
   $entry_yearelement = array();             
               
   $entry_yearelement[''] = '--Select programme type--';
                for($i=2001; $i<=2014;$i++){
                    $entry_yearelement[$i] = $i;
                }  
                
               // print_r($entry_yearelement);
?>

<div class="row">
				<div class="col-md-7">
					<div class="block-flat">
						<div class="header">							
							<h3>Add New Student</h3>
                                                        
     
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
                                                          <div class="alert alert-danger alert-white rounded" id="errordisplay">   
<?php echo validation_errors(); ?>                                                          
  <?php //display error message
                                                            if(!empty($message_error)) {?>
            
                 
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 
							 
            <?php } ?>
                </div>
                <?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/student/edit/'.$id,$attributes);?>
                                                            
                                                           
                                                            <table class="table table-bordered" >
                                                                <tr><td colspan="4"><strong>New Student Profile:</strong></td></tr>
                                                                
                                              <tr><td><strong>Surname:</strong></td><td><?php echo form_input($form_surname); ?></td></tr>
                                              <tr><td><strong>Firstname:</strong></td><td><?php echo form_input($form_firstname); ?></td></tr>
                                              <tr><td><strong>Othername:</strong></td><td><?php echo form_input($form_othername); ?></td></tr>
                                              <tr><td><strong>Matric Number:</strong></td><td><?php echo form_input($form_matricno); ?></td></tr>
                                              <tr><td><strong>Jamb Number:</strong></td><td><?php echo form_input($form_jambno); ?></td></tr>
                                              <tr><td><strong>Email:</strong></td><td><?php echo form_input($form_email); ?></td></tr>
                                              
                                                                    <tr><td><strong>State:</strong></td>
                                                                        <td> <?php echo form_dropdown('state_id', $stateelement,$student_details["state_of_origin"],'required="" class="form-control" id="state_id"'); ?></td></tr>
                                                                  
                                                                    <tr><td><strong>Local Government :</strong></td><td>
                                                                            <span id="loadlga"></span>
                                                         <?php echo form_dropdown('lga_id', $lgaelement,$student_details["local_gov"],'required="" class="form-control" id="lga_id"'); ?>
                                                                                              
                                                                          </td></tr>
                                                                    
                                                                    <tr><td><strong>Programme:</strong></td>
                                                                        <td> <?php echo form_dropdown('programme_id', $programmeelement,$student_details["stdprogramme_id"],'required="" class="form-control" id="programme_id"'); ?></td></tr>
                                                                    
                                                                    <tr><td><strong>Honour:</strong></td>
                                                                        <td>  <span id="loaddegree"></span>
                                                                            
                                                                            <?php echo form_dropdown('degree_id', $degreeelement,$student_details["stddegree_id"],'required="" class="form-control" id="degree_id"'); ?>
                                                                           </td></tr>
                                                                    <tr><td><strong>Faculty:</strong></td>
                                                                        <td> <?php echo form_dropdown('faculty_id', $progelement,$student_details["stdfaculty_id"],'required="" class="form-control" id="faculty_id"'); ?></td></tr>
                                                                    
                                                                    
                                                                    <tr><td><strong>Department :</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                                             <?php echo form_dropdown('department_id', $deptelement,$student_details["stddepartment_id"],'required="" class="form-control" id="department_id"'); ?>
                                                                         
                                                                           </td></tr>
                                                                    <tr><td><strong>Department Option:</strong></td><td>
                                                                            <span id="loaddeptoption"></span>
                                                                            <?php echo form_dropdown('dept_option', $dept_optionelement,$student_details["stdcourse"],'required="" class="form-control" id="dept_option"'); ?>
                                                                         
                                                                          
                                                                          </td> </tr>
                                                                     <tr><td><strong>Level:</strong></td><td>
                                                                            <span ></span>
                                                <?php echo form_dropdown('level_id', $levelelement,$student_details["level"],'required="" class="form-control" id="level_id"'); ?></td></tr>
                                                                     
                                           <tr><td><strong>Student Status :</strong></td><td>
                                                                            <span ></span>
                                                <?php echo form_dropdown('status_id', $statuselement,$student_details["status"],'required="" class="form-control" id="status_id"'); ?></td></tr>                              
                                                                                                                
                                                                    
                                                                              
                                                     
                                       <tr><td><strong>Student Type :</strong></td>
                                                                        <td><select name="std_type" id="std_type" required="" class="form-control">
                                                                                <option value="">--Select Student Type--</option>
                                                                                <option value="new" <?php if( $student_details["student_type"]=='new')echo 'selected';?>>New</option>
                                                                                <option value="Returning" <?php if( $student_details["student_type"]=='returning')echo 'selected';?>>Returning</option>
                                                                        </select></td></tr> 
                                       
                                        <tr><td><strong>Programme Type :</strong></td><td>
                                                                            <span ></span>
                                                <?php echo form_dropdown('programme_type', $programmetypeelement,$student_details["programme_id"],'required="" class="form-control" id="programme_type"'); ?></td></tr>                              
                                       
                                        
                                         <tr><td><strong>Entry Year:</strong></td><td>
                                                                            <span ></span>
                                                <?php echo form_dropdown('entry_year', $entry_yearelement,$student_details["year_of_entry"],'required="" class="form-control" id="entry_year"'); ?></td></tr>                              
                                                                                                                
                                                     
                                                     
                                                                       
                                       <tr><td></td><td><input type='submit' name='submit'  class="btn btn-primary" value='Update Student'></td></tr> 
                                                                       
                                                                            
                                                                         
                                                                            
                                                                            
                                                                            </table>
                                                                        
                                                                       
 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        