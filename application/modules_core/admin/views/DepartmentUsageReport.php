<?php
$statuselement = array();
    foreach ($task_status as $value) {//// var_dump($value);exit;
        $statuselement[$value->status_id]= $value->status;
    }

$projectelement = array();
//var_dump($project_list);exit;
$projectelement[] = "Select Projects";
foreach($project_list as $projects)
{
  if($projects->status=='Active')
  $projectelement[$projects->proj_id] = $projects->name;

}

//var_dump($projectelement);exit;

?>

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Employee Time Activities Log   <a href="<?php echo base_url("admin/projectlogs/usageReportByDepartment/")?>/<?php echo $department_id ?>/3">[Export to Excel]</a></h3>

              <?php // display sucess message
                                                           if (!empty($_GET['success'])) {
                                                               ?>
                                                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $_GET['success']; ?>!
							 </div>
                                                           <?php
                                                           }?>
                                                            
                                                            <?php //display error message
                                                            if (!empty($_GET['error'])) {
                                                                ?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $_GET['error']; ?>
							 </div>
							 
            <?php
                                                            }

                                                         //var_dump($results); exit;

                                                            ?>


                                                        
    <!--   <a href="<?php echo base_url('admin/projectlogs/activities'); ?>">    
          <button class="btn btn-primary" type="button">Log New Activities</button></a> -->
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
                                                            if (!empty($message_error)) {
                                                                ?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?php
                                                            }

                                                         //var_dump($results); exit;

                                                            ?>
								<table class="table table-bordered" id="datatable2" >
									<thead>
                                    <tr align="center" style="background-color: darkblue;color: #fff;">
                                    <td colspan="5"><strong>Attendance Sheet Report</strong></td>
                                    
                                    </tr>

              
										<tr>
											 
                                            <th>Employee Name</th>
											<th>Employee Email</th>
                                            <?php foreach($date_list as $date){ ?>
                                            <th><?php echo $date; ?></th>  
                                            <?php } ?>     
										</tr>
									</thead>
									<tbody>
<?php  foreach($department_employee as $employee){ ?>
                                    <tr>
											 
                                            <th><strong><?php echo ($employee->first_name.' '.$employee->last_name.' '.$employee->middle_name); ?></strong></th>
											<th><strong><?php echo $employee->work_email; ?></strong></th>
                                    
                                            <?php foreach($date_list as $date){ ?>
                                            <th><strong><?php echo $depatment_hour_list[$employee->id][$date]; ?></strong></th>  
                                            <?php } ?>
                                        </tr>

                                        <?php }?>
                                                     </tbody>
                                                         </table>

       
  
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
   function loadTasks()
   {
 
var project_id = document.getElementById('project_id').value; 
 
$("#loadtask").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 


$.ajax({
                     url:'<?php echo base_url('admin/projectlogs/load_project_task');?>',
                     type:"POST",
                     data: {
                      project_id: project_id 
                      },
                     dataType:'html',
                      success: function(response){
                        $("#loadtask").css("display", "none");
                        $('#task_done').html(response); 
                   }
                 });

   }



    
    function randomNumber(limit){
	return Math.floor(Math.random()*limit);
        
}
    
/*     function loadTask() {
$("#project_id").change(function(){	
  document.getElementById('project_id').value; 
  alert("jjjj");
          var project_id = document.getElementById('project_id').value; 
         $("#loadtask").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 		
 		$("#taskdone").load("<?php echo base_url('admin/ajax/load_departments'); ?>",{non: randomNumber(9), valu: faculty_id }, function(response, status, xhr){
           
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


}
 */
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
        </script>