<script type="text/JavaScript"> 
    
    function randomNumber(limit){
	return Math.floor(Math.random()*limit);
        
}
    
    $(function() {
$("#faculty_id").change(function(){	
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
				<div class="col-md-13">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Courses Curriculum</h3>

                                                        
      <a href="<?php echo base_url("admin/curriculum/add");?>">    
          <button class="btn btn-primary" type="button">Add New Curriculum </button></a>
          
           <form action="<?php echo base_url("admin/curriculum/index");?>" method="POST">
               <table class="table table-bordered" style=" width: 100%;" >
                                                                    <tr><td><strong>Faculty Name:</strong></td>
                                                                        <td> <?php echo form_dropdown('faculty_id', $progelement,'','required="" class="form-control" id="faculty_id"'); ?></td>
                                                                    <td><strong>Department Name:</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                                            <select name="department_id" id="department_id" required  class = "form-control" >
                                                                                <option value="">--Select Faculty to Display Departments--</option>                                                                            
                                                                            </select></td>
                                                                    
                                                                    
                                                                    </tr>
                                                                    
                                                                    
                                                                  
                                                                    <tr><td><strong>Department Option:</strong></td><td>
                                                                            <span id="loaddeptoption"></span>
                                                                            <select name="dept_option" id="dept_option" required  class = "form-control" >
                                                                                <option value="">--Select Department to Load Department Options--</option>                                                                            
                                                                            </select></td>
                                                                    <td><strong>Level:</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                <?php echo form_dropdown('level_id', $levelelement,'','required="" class="form-control" id="level_id"'); ?></td>
                                                                    
                                                                    </tr>                                                           
                                                                    <tr><td></td><td></td><td colspan="2"><input type='submit' name='submit'  class="btn btn-facebook" value='View Curriculum'></td></tr> 
                                                                       
                                                                                    </table>
     
     </form>
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
							 
            <?php } ?>
        <?php if($curriculum==''){ echo 'No Record Found';}else{?>
      <table class="table table-bordered"> 
          <tr><td><b><strong><?php echo $courseoption['department_name'];?></strong></b></td><td><b><strong><?php echo $courseoption['programme_option'];?></strong></b></td>  </tr> </table>
        <table class="table table-bordered"  >
       
       <?php foreach($curriculum as $c){ //var_dump($courseoption);exit;?>
         
        <thead>
	<tr>
            <th colspan="7"><b><strong><?php echo $c['semester_name']; $data = $c['data']; //var_dump($data); die();?></strong></b></th>
								</tr>
									</thead>
									<tbody>
        
									<thead>
										<tr>
											<th><b>S/N</b></th>
							<!--<th><b>Room Number</b></th>-->
										
                                                                                         <th><b>Course Code</b></th>
                                                                                          <th><b>Course Title</b></th>                                                                                     
                                                                                         <th><b>Unit</b></th>                                                                                        
                                                                                         
                                                                                         <th><b>Semester</b></th>
                                                                                         <th><b>Status</b></th>
                                                                                        
                                                                                         <th><b></b></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$counter = 1;
if(empty($data)){echo 'No Course of Studey as been added';}else{
foreach($data as $data) { //var_dump($data);exit;?>
  <tr class="gradeA">
<td><?php 
echo $counter;
//echo $data->amenity_id ?></td>

<td class="center"><?php echo $data->course_code ?></td>
<td class="center"><?php echo $data->course_title ?></td>

<td class="center"><?php echo $data->course_unit ?></td>


<td class="center"><?php echo $data->semester ?></td>
<td class="center"><?php echo $data->course_status ?></td>

<td>   
<a href="<?php echo base_url("admin/curriculum/delete/".$data->curriculum_id);?>"><button class="btn btn-danger" type="button">Delete</button>
</td>											
												
<?php $counter++;}
?>
                                                         </tbody>
                                                       
    
    
    <?}
                                                            }//end foreach
        }                                                   
                                                            
    ?> 
 		  </table>
                                                        </div>
       </div>									
			</div>
       </div>
    
        