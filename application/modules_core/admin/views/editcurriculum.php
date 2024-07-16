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
                
                $deptelement = array();
               $deptelement[''] = '--Select Department--';
                foreach ($dept as $value) {
                    $deptelement[$value->department_id] = $value->department_name;
                }
?>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Edit Course Curriculum </h3>
                                                        
     
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
              echo form_open('admin/academycourses/edit/'.$id,$attributes); //var_dump($courseoption_details);die;?>
								<table class="table table-bordered" >
                                                                    <tr><td><strong>Faculty Name:</strong></td>
                                                                        <td> <?php echo form_dropdown('faculty_id', $progelement,$curriculum_details['faculty_id'],'required="" class="form-control" id="faculty_id"'); ?></td></tr>
                                                                    <tr><td><strong>Department Name:</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                                  <?php echo form_dropdown('department_id', $deptelement,$curriculum_details['department_id'],'required="" class="form-control" id="department_id"'); ?>
                                                                        
                                                                        </td></tr>
                                                                    
                                                                     <tr><td><strong>Level:</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                <?php echo form_dropdown('level_id', $levelelement,$curriculum_details['level_id'],'required="" class="form-control" id="level_id"'); ?></td></tr>
                                                                     
                                       <tr><td><strong>Semester :</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                <?php echo form_dropdown('semester_id', $semesterelement,$curriculum_details['course_semester'],'required="" class="form-control" id="semester_id"'); ?></td></tr>                              
                                                                                                                     <tr><td><strong>Course Code:</strong></td><td>
                                                                            <span id="loadcourseofstudy"></span>
                                                                            <?php echo form_input($form_course_code); ?>
                                                                            </td></tr>
                                                                    
                                                                     <tr><td><strong>Course Title:</strong></td><td>
                                                                            <span id="loadcourseofstudy"></span>
                                                                            <?php echo form_input($form_course_title); ?>
                                                                            </td></tr>
                                                                     
                                                                     <tr><td><strong>Course Unit:</strong></td><td>
                                                                            <span id="loadcourseofstudy"></span>
                                                                            <?php echo form_input($form_course_unit); ?>
                                                                            </td></tr>
                                                                    
                                                                    <tr><td></td><td><input type='submit' name='submit'  class="btn btn-facebook" value='Update Course'></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>


 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        