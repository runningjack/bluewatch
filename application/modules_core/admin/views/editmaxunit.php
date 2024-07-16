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
							<h3>Edit Maximum and Minimum   </h3>
                                                        
     
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
              echo form_open('admin/maxunit/edit/'.$id,$attributes); //var_dump($maxunit_details);die;?>
								<table class="table table-bordered" >
                                                                    <tr><td><strong>Faculty Name:</strong></td>
                                                                        <td> <?php echo form_dropdown('faculty_id', $progelement,$maxunit_details['faculty_id'],'required="" class="form-control" id="faculty_id"'); ?></td></tr>
                                                                    <tr><td><strong>Department Name:</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                                  <?php echo form_dropdown('department_id', $deptelement,$maxunit_details['department_id'],'required="" class="form-control" id="department_id"'); ?>
                                                                        
                                                                        </td></tr>
                                                                    
                                                                    <tr><td><strong>Department Option:</strong></td><td>
                                                                            <span id="loaddeptoption"></span>
                                                                             <?php echo form_dropdown('department_id', $deptelement,$maxunit_details['department_id'],'required="" class="form-control" id="department_id"'); ?>
                                                                        </td> </tr>
                                                                    
                                                                     <tr><td><strong>Level:</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                <?php echo form_dropdown('level_id', $levelelement,$maxunit_details['level_id'],'required="" class="form-control" id="level_id"'); ?></td></tr>
                                                                     
                                       <tr><td><strong>Semester :</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                <?php echo form_dropdown('semester_id', $semesterelement,$maxunit_details['max_semester'],'required="" class="form-control" id="semester_id"'); ?></td></tr>                              
                                                                                
                                                                     
                                                                     <tr><td><strong>Maximum Unit :</strong></td>
                                                                        <td><input type="text" name="max" id = "max" required="" value="<?php echo $maxunit_details["max_no"]  ?>" class="form-control"/></td></tr> 
                                                                    
                                                                          <tr><td><strong>Minimum Unit :</strong></td>
                                                                        <td><input type="text" name="min" id="min" required="" value="<?php echo $maxunit_details["min_no"]?>" class="form-control"/></td></tr> 
                                             
                                                                    
                                                                    <tr><td></td><td><input type='submit' name='submit'  class="btn btn-facebook" value='Update Settings'></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>


 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        