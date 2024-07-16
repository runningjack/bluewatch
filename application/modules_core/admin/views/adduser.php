<script type="text/JavaScript"> 
    
        //load courses that are already added
        $( document ).ready(function() {
       $("#employee_id").on('change', function(){

       	var empID = $(this).val();
       	$('#username').val('');
       	if (empID > 0) {
       	$.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/users/getUsername');?>",
        data: {
          id: empID,
        },
        dataType: "json",
        success: function(response) {
          if (response.status) {
            $('#username').val(response.username);
          }else{
           alert('Internal server error, Username could not be retrieved');
        }
          }
    });
       	}
       
		});
        
        });  

     </script>
    
     <?php

$employeelement = array();
               $employeelement[''] = '--Select Employee--';
                foreach ($employeelist as $value) {
                    $employeelement[$value->id] = $value->first_name.' '.$value->last_name;
                }

   $groupelement = array();
               $groupelement[''] = '--Select User Group--';
                foreach ($group as $value) {
                    $groupelement[$value->group_id] = $value->group_name;
                }

     $departmentelement = array();
               $departmentelement[''] = '--Select User Department--';
                foreach ($department as $value) {
                    $departmentelement[$value->id] = $value->title;
                }

?>
<div class="col-sm-4 col-md-6">
        <div class="block-flat">
           
          <div class="header">							
            <h3>Add New User</h3>
          </div>
             <?php if (isset($message_error)) {
    ?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?php
}?>
            <?php

//var_dump($modulesarray);

                ?>
          <div class="content">
              <?php $attributes = array('id' => 'usersform');
              echo form_open('admin/users/adduser', $attributes); ?>
             <div class="form-horizontal"  parsley-validate novalidate>
                 <div class="form-group">
                     <fieldset> <legend> Guest Personal Details </legend>
                          <table style="border: 0;">
                    <tr>
                        <td><label >
                                <strong>Employee Name :</strong></label></td><td>
                                    <?php echo form_dropdown('employee_id', $employeelement, '', ' id= "employee_id" required="" class="form-control"'); ?> </td>
                         </tr>
						 
						 <tr>
                        <td><label >
                                <strong>Role :</strong></label></td><td>
                                    <?php echo form_dropdown('group', $groupelement, '', ' id= "csGroup" required="" class="form-control"'); ?> </td>
                         </tr>

                         <tr>
                        <td><label >
                                <strong>Department :</strong></label></td><td>
                                    <?php echo form_dropdown('department_id', $departmentelement, '', ' id= "department" required="" class="form-control"'); ?> </td>
                         </tr>
						 <tr>   
                        
                        <td><label >
                                <strong>Username :</strong></label></td><td><?php echo form_input($form_username); ?> </td>
                                
                    </tr>
                    <tr>
                       <td><label >
                                <strong>Password :</strong></label></td><td><?php echo form_input($form_password); ?></td> 
                                </tr><tr> 
                        <td><label >
                                <strong>Confirm Password :</strong></label></td><td colspan=""><?php echo form_input($form_confirmpassword); ?></td>
                    </tr>
                    
                
                
                    <tr>
                       
                        <td><label >
                                </label></td><td colspan="4"><input type='submit' name='submit' value='Add User' class="btn btn-success"></td>
                    </tr>
                                     
                    </table>
                     </fieldset>
                   <?php echo form_close(); ?>
                  </div>     
                    
            </div>
              <?php echo form_close(); ?>
          </div>
        </div>				
      </div>
    