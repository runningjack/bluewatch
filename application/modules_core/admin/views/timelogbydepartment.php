<?php
$departmentelement = array();
$departmentelement[] = "-Select Department-";
    foreach ($departments as $value) {
        $departmentelement[$value->id]= $value->title;
    }

 
?>

<div class="row">
        <div class="col-md-12">
          <div class="block-flat">
            <div class="header">              
              <h3>Employee Time Activities Log 
                <a target="_blank" 
                href="<?php echo base_url("admin/projectlogs/timelogbydepartmentexcel"); ?>">[Export to excel]</a></h3>

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

              <form action="<?php echo base_url("admin/projectlogs/timelogbydepartment"); ?>" method="POST">
  <div class="col-md-12" style="padding:40px ;">
    <div class="col-md-2">
       <?php echo form_dropdown('department', $departmentelement,'','required="" class="form-control" id="department"'); ?>
     </div>

    <div class="col-md-2">
      <input name="submit" type="submit"   class="btn btn-success" value="Filter Report ">
    </div>


  </div>
</form>
                                                        
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
                     $currentDate = date('Y-m-d'); // Get the current date
                    $currentWeek = date('W', strtotime($currentDate)); // Get the week number

     ?>
     
                <table class="table table-bordered"  >
                  <thead>
                                    <tr align="center" style="background-color: darkblue;color: #fff;">
                                    <td colspan="<?php echo $currentWeek+2 ?>"><strong>Summary Report</strong></td>
                                    
                                    </tr>

              
                    <tr>                      
                                            <th><strong>Project Name</strong></th>
                                            <th><strong>Client</strong></th>
                                            <?php for($i=1;$i<$currentWeek;$i++){ ?>
                                                   <th><strong>WK<?php echo $i ?></strong></th>
                                            <?php }?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                   // var_dump($project_select);//exit;
                   
                    ///echo "Current Week: " . $currentWeek;exit;
                    foreach ($project_select as $key => $value)
                     {  //exit;?>
                      <tr>
                        <td>
                          <?php echo($value->name); ?>
                        </td>
                        <td>
                          <?php echo($value->client_name); ?>
                        </td>
                        <?php for($i=1;$i<$currentWeek;$i++){ ?>
                               <td><?php echo $department_project_log[$value->id][$i] ?></td>
                        <?php }?>
                      </tr>
                      
              <?php } ?>

                                    <tr>
                       
                                            <th><strong><?php echo $activeUserCount->total_usage; ?></strong></th>
                      <th><strong><?php echo $hourly_sum->hours; ?></strong></th>
                                            <th><strong><?php echo $assign_role->hours; ?></strong></th>
                                            <th><strong><?php echo $project_count->total_project ?></strong></th>       
                    </tr>
                                                     </tbody>
                                                         </table>

      <table>
      
     
    <?php 
    $i=1;
    foreach($getAllDepartment as $dept) { //var_dump($dept);
    if($dept['hours'] > 0){
    ?>    
      <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $dept['department']->title ?></td>
      <td><?php echo $dept['hours'] ?></td>
      <td><a href="<?php echo base_url("admin/projectlogs/usageReportByDepartment");?>/<?php echo $dept['department']->id ?>">Break Down</a></td>
    </tr>  
      
      <?php $i++; 
    }
    }?>
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