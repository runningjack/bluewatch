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
?>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Add department</h3>
                                                        
     
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
              echo form_open('admin/courseoption/add/',$attributes);?>
								<table class="table table-bordered" >
                                                                    <tr><td><strong>Faculty Name:</strong></td>
                                                                        <td> <?php echo form_dropdown('faculty_id', $progelement,'','required="" class="form-control" id="faculty_id"'); ?></td></tr>
                                                                    <tr><td><strong>Department Name:</strong></td><td>
                                                                            <span id="loaddepartment"></span>
                                                                            <select name="department_id" id="department_id" >
                                                                                <option value="">--Select Faculty to Display Departments--</option>                                                                            
                                                                            </select></td></tr>
                                                                    <tr><td><strong>Course Option:</strong></td><td>
                                                                            <span id="loadcourseofstudy"></span>
                                                                            <?php echo form_input($form_courseoption); ?>
                                                                            </td></tr>
                                                                    
                                                                     <tr><td><strong>Course Duration:</strong></td><td>
                                                                            <span id="loadcourseofstudy"></span>
                                                                            <?php echo form_input($form_duration); ?>
                                                                            </td></tr>
                                                                    
                                                                    <tr><td></td><td><input type='submit' name='submit' value='Add Couese of Study'></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>
    
        