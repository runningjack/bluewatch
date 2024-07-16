<?php
$statuselement = array();
    foreach ($task_status as $value) {//// var_dump($value);exit;
        $statuselement[$value->status_id]= $value->status;
    }

  

?>

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3><?php print($project_details['name']); ?>  Team</h3>
                                                        
   <!--    <a href="<?php echo base_url('admin/projectlogs/activities'); ?>">    
          <button class="btn btn-primary" type="button">Log New Activities</button></a> -->
						</div>
						<div class="content">
							<div class="table-responsive">
                                                           <?php // display sucess message
                                                           if (!empty($sucess_message) || isset($_GET['success'])) {
                                                               ?>
                                                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $sucess_message; ?> <?php echo $_GET['success'] ?>!
							 </div>
                                                           <?php
                                                           }?>
                                                            
                                                            <?php //display error message
                                                            if (!empty($message_error) || isset($_GET['error'])) {
                                                                ?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; echo $_GET['error'] ?>
							 </div>
							 
            <?php
                                                            }

                                                         //var_dump($results); exit;
                                                         ?>

 
   
   

   <form method="POST"  action="<?php echo base_url("admin/manageproject/saveProjectRole"); ?>">
    <table style="margin-bottom: 20px;">
        <tr><td>
  <label for="email">Resources:</label>
  <input type="hidden" name="project_id" id="project_id" value="<?php echo $project_id ?>">
  </td>
  <td>
  <?php echo form_dropdown('employee_id', $employeelist,'','required="" class=" select2" id="employee_id"'); ?>
    </td>
    <td>
  <label for="pwd">Project Role: <span id="loadrole"></span></label> 
</td>
  <td>

  <?php echo form_dropdown('project_role_id', $projectRoles,'','required="" class=" select2" id="project_role_id"');  ?>
                                                       
</td>
                                                        
<td>
  <button type="submit" class="btn btn-primary">Add Team</button>
                                                        
</td>
        </tr></table>
</form> 



 
                

								<table class="table table-bordered" id="datatable2" >
									<thead>
                                    <tr align="center" style="background-color: darkblue;color: #fff;">
                                    <td colspan="5"><strong>Project Details</strong></td>
                                    <td></td>
                                    </tr>
										<tr>
											<th><strong>S/N</strong></th> 
                                            <th><strong>Full Name</strong></th>
                                            <th><strong>Project Role</strong></th>
										                       	<th><strong>Email</strong></th>
                                            <th><strong>Phone Number</strong></th> 
                                            <th></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$color = array(1 => 'green', 2 => 'red', 3 => 'yello', 4 => 'blue');
$counter = 1;
if (empty($results)) {
    echo 'No Room Type was set';
} else {

  $projectRoles = array_merge(array('--Select Profile--'), $projectRoles);
    foreach ($results as $data) {
   // var_dump($data);
        ?>
  <tr class="gradeA">
<td><?php
echo $counter;
  ?></td>
  <td class="center"><?php echo $data->first_name.' '.$data->last_name.' '.$data->middle_name; ?></td>
  <td class="center"><?php echo $data->resource_role_name; ?>

  <?php 
  
  echo form_dropdown('role_list['.$data->employee_id.']', $projectRoles,$data->project_role_id,'required="" class=" select2" onclick="update_role(this,'.$data->project_id.','.$data->employee_id.')"  ');  ?>

</td>
  <td class="center"><?php echo $data->work_email; ?></td>  
  <td class="center"><?php echo $data->mobile_phone; ?></td>


<td>
   
  <a href="<?php echo base_url('admin/manageproject/removeTeamMember/'.$data->employee_id.'/'.$data->project_id); ?>" class="btn btn-info" type="button" >Remove Resource</a>
   
</td>											
												
<?php ++$counter;
    } ?>
                                                         </tbody>
                                                         </table>
    <p><?php //echo $links; ?></p>
    
    <?php
}?> 
 			</div>
       </div>									
			</div>
       </div>


        <div id="logModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Review Weekly Activities</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-lg-12">
          <div class="table-responsive">
            <form id="logActivities">
              <input type="hidden" name="dateRange">
              <input type="hidden" name="userId">
            <table class="table table-bordered" >
              
            </table>
            <button class="btn btn-info stateButton" type="button" data-state="prev">Previous Week</button>
            <button class="btn btn-warning stateButton" type="button" data-state="next">Next Week</button>
            </form>
          </div>
      </div>
    </div>
  </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    
    <script type="text/javascript">

          $(document).ready(function(){
            $('#logModal').on('show.bs.modal', function(e) {
              var member_id = "<?php echo $_SESSION['login_detal']->id; ?>";
              var date_range = '';
        
              $.ajax({
                     url:'<?php echo base_url('admin/projectlogs/reviewlogActivities');?>',
                     type:"POST",
                     data: {
                      member_id: member_id,
                        date_range: date_range
                      },
                     dataType:'json',
                      success: function(response){
                       // console.log(response);
                        $('#logModal .table').html(response.content);
                         $("#logModal input[name=userId]").val(response.user_id);
                         $("#logModal input[name=dateRange]").val(response.dateRange);
                   }
                 });
             });

            $('.stateButton').on('click', function(e) {
              var member_id = $("#logModal input[name=userId]").val();
              var date_range = $("#logModal input[name=dateRange]").val();
              var state = $(this).data('state');
        
              $.ajax({
                     url:'<?php echo base_url('admin/projectlogs/reviewlogActivities');?>',
                     type:"POST",
                     data: {
                        member_id: member_id,
                        date_range: date_range,
                        state: state
                      },
                     dataType:'json',
                      success: function(response){
                       // console.log(response);
                        $('#logModal .table').html(response.content);
                         $("#logModal input[name=userId]").val(response.user_id);
                         $("#logModal input[name=dateRange]").val(response.dateRange);
                   }
                 });
             });
          });


// $("#employee_id").change(function(){	
       
//        var employee_id = document.getElementById('employee_id').value; 
//        $("#loadrole").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
       
//        $("#project_role").load("<?php echo base_url('admin/manageproject/loadRoleByDepartment'); ?>",{non: 5644, employee_id: employee_id }, function(response, status, xhr){
         
//         $("#loadrole").css("display", "none");
         
//          if(status == 'error'){
//              $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
//                                  '<br />Error Code: '+xhr.status+
//                                  '<br />Error Message: '+xhr.statusText);
//          }
//            //if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
//         });
//         //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";		         
       
//   });

function update_role(selectObject,project_id,employee_id)
{
//console.log(selectObject.value,project_id,employee_id);
window.location.replace("<?php echo base_url('admin/manageproject/update_role/'); ?>"
+"/"+selectObject.value+"/"+project_id+"/"+employee_id);



}
        </script>