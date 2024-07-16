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
              <h3>Employee Time Activities Log</h3>

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
<?php /*?>

              <form action="<?php echo base_url("admin/projectlogs/usageReport"); ?>" method="POST">
  <div class="col-md-12" style="padding:40px ;">
 
    
    <?php 
$date = date('Y-m-d', time());
    ?>

    <div class="col-md-2">
       
      <input name="start_date" type="date" max="<?php echo $date; ?>"  class="form-control" placeholder="start date"  >
    </div>

    <div class="col-md-2">
       
       <input name="end_date" type="date"  max="<?php echo $date; ?>" class="form-control" placeholder="end date"  >
     </div>

    <div class="col-md-2">
      <input name="submit" type="submit"   class="btn btn-success" value="Filter Report ">
    </div>


  </div>
</form>
<? */?>
                                                        
    <!--   <a href="<?php echo base_url('admin/projectlogs/activities'); ?>">    
          <button class="btn btn-primary" type="button">Log New Activities (<?php echo $new_dept[0]->title ?>)</button></a> -->
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
/*
                                                            ?>
                <table class="table table-bordered" id="datatable2" >
                  <thead>
                                    <tr align="center" style="background-color: darkblue;color: #fff;">
                                    <td colspan="5"><strong>Summary Report</strong></td>
                                    
                                    </tr>

              
                    <tr>
                       
                                            <th><strong>Active User Count</strong></th>
                      <th><strong>Hours Sum</strong></th>
                                            <th><strong>Assign Role</strong></th>
                                            <th><strong>Project Count</strong></th>       
                    </tr>
                  </thead>
                  <tbody>

                                    <tr>
                       
                                            <th><strong><?php echo $activeUserCount->total_usage; ?></strong></th>
                                            <th><strong><?php echo $hourly_sum->hours; ?></strong></th>
                                            <th><strong><?php echo $assign_role->hours; ?></strong></th>
                                            <th><strong><?php echo $project_count->total_project ?></strong></th>       
                    </tr>
                                                     </tbody>
                                                         </table>
                                                         
                                                          <?php */ 
                                                          
                                                          
                                                          
                                                         // var_dump($new_dept[0]);
                                                          ?>
                                                          
                                                          
                                                          
                                                          
                                                           
<table>
    <tr>
        <th></th>
        <th colspan="2">Previous Month</th>
        <th colspan="2">Month to Date</th>
    </tr>
    <tr>
        <th></th>
        <th>Logged</th>
        <th>Approved</th>
        <th>Logged</th>
        <th>Approved</th>
    </tr>
    <tr>
        <td>Cumulative Hours</td>
        <td><?php echo number_format($lastMonthData["getAllDepartment"][0]["hours"]) ?></td>
        <td><?php echo number_format($lastMonthData["getAllDepartment"][0]["approved_hours"]) ?></td>
        <td><?php echo $thisMonthData["getAllDepartment"][0]["hours"] ?></td>
        <td><?php echo $thisMonthData["getAllDepartment"][0]["approved_hours"] ?></td>
    </tr>
    <tr>
        <td>Total Expected Hours</td>
        <td><?php echo number_format($lastMonthData["getAllDepartment"][0]["number_of_days"] * $lastMonthData["staffNumber"] * 8) ?></td>
        <td><?php echo number_format($lastMonthData["getAllDepartment"][0]["number_of_days"] * $lastMonthData["staffNumber"] * 8) ?></td>
        <td><?php echo number_format($thisMonthData["getAllDepartment"][0]["number_of_days"] * $lastMonthData["staffNumber"] * 8) ?></td>
        <td><?php echo number_format($thisMonthData["getAllDepartment"][0]["number_of_days"] * $lastMonthData["staffNumber"] * 8) ?></td>
    </tr>
    <tr>
        <td>Staff No</td>
        <td><?php echo $lastMonthData["getAllDepartment"][0]["staff_count"] ?></td>
        <td><?php echo $lastMonthData["getAllDepartment"][0]["staff_count"] ?></td>
        <td><?php echo $thisMonthData["getAllDepartment"][0]["staff_count"] ?></td>
        <td><?php echo $thisMonthData["getAllDepartment"][0]["staff_count"] ?></td>
    </tr>
    <tr>
        <td>Days No</td>
        <td><?php echo $lastMonthData["getAllDepartment"][0]["number_of_days"] ?></td>
        <td><?php echo $lastMonthData["getAllDepartment"][0]["number_of_days"] ?></td>
        <td><?php echo $thisMonthData["getAllDepartment"][0]["number_of_days"] ?></td>
        <td><?php echo $thisMonthData["getAllDepartment"][0]["number_of_days"] ?></td>
    </tr>
    <tr>
        <td>Total Staff No
        
        
        </td>
        <td><?php echo $lastMonthData["staffNumber"] ?></td>
        <td><?php echo $lastMonthData["staffNumber"] ?></td>
        <td><?php echo $lastMonthData["staffNumber"] ?></td>
        <td><?php echo $lastMonthData["staffNumber"] ?></td>
    </tr>
    <tr>
        <td>Performance%</td>
        <td><?php 
        
        if($lastMonthData["getAllDepartment"][0]["hours"]>0)
        echo number_format($lastMonthData["getAllDepartment"][0]["hours"]/($lastMonthData["getAllDepartment"][0]["number_of_days"] 
        * $lastMonthData["staffNumber"] * 8) * 100,2) ?>%</td>
        <td><?php 
        if($lastMonthData["getAllDepartment"][0]["approved_hours"]>0)
        echo number_format($lastMonthData["getAllDepartment"][0]["approved_hours"]/($lastMonthData["getAllDepartment"][0]["number_of_days"] 
        * $lastMonthData["staffNumber"] * 8) * 100,2) ?>%</td>
      <td><?php 
      if($thisMonthData["getAllDepartment"][0]["hours"]>0)
        echo number_format($thisMonthData["getAllDepartment"][0]["hours"]/($thisMonthData["getAllDepartment"][0]["number_of_days"] 
        * $thisMonthData["staffNumber"] * 8) * 100,2) ?>%</td>
        <td><?php
        if($thisMonthData["getAllDepartment"][0]["approved_hours"]>0) 
        echo number_format($thisMonthData["getAllDepartment"][0]["approved_hours"]/($thisMonthData["getAllDepartment"][0]["number_of_days"] 
        * $thisMonthData["staffNumber"] * 8) * 100,2) ?>%</td>
    </tr>
</table>
 
 <hr/>
   <!--   <table>
      
     
      
    <tr>
      <td>SN</td>
      <td>Department</td>
      <td colspan="4"><center>Hours</center></td>
      <td>Staff Count</td>
       
 
    </tr>   
    
    <tr>
      <td></td>
      <td></td>
      <td>Logged Hours</td>
      <td>Approved Hours</td>
      <td>Rejected Hours</td>
      <td>Total Expected Hours</td>
      <td></td>
      <td>No of Days</td>
      
  
    </tr> 
    <?php 
    $i=1;
    foreach($getAllDepartment as $dept) { //var_dump($dept);
    if($dept['hours'] > 0){
    ?>    
      <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $dept['department'][0]->title ?></td>
      <td><?php echo $dept['hours'] ?></td>
      <td><?php echo $dept['approved_hours'] ?></td>
      <td><?php echo $dept['rejectd_hours'] ?></td>
       <td><?php echo $number_of_days*$dept['staff_count']*8 ?></td>
      <td><?php echo $dept['staff_count'] ?></td>
      <td> <?php echo $number_of_days ?></td>
      
    </tr>  
      
      <?php $i++; 
    }
    }?>
    </table>-->
  
    <br/>
    <br/>
    <table>
    <tr><td colspan="4" style="text-align: center;"><strong>Weekends and Holidays</strong></td></tr>
    <tr>
    <td>#</td>
    <td>Date</td>
    <td>Description</td>
    <td>Type</td>
    </tr>
    <?php 
    
    $count = 1;
    
    foreach($holidays as $h) {?>
    
    <tr> <td><?php print($count); ?></td>
    <td><?php print($h->holiday_date); ?></td> 
    <td><?php print($h->decription); ?></td> 
     
    <td><?php print($h->type); ?></td></tr>
    <?php
    $count++;
     }?>

</table>  
 


 
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        th[colspan="2"] {
            text-align: center;
        }
    </style>
























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