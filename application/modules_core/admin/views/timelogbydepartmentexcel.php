 <?php 
                    $currentDate = date('Y-m-d'); // Get the current date
                    $currentWeek = date('W', strtotime($currentDate)); // Get the week number

                    ?>
                
                <table class="table table-bordered" border="1" >
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
                  
                    foreach ($project_select as $key => $value)
                     {  
 //var_dump($department_project_log[$value->id]);exit;
                     ?>
                      <tr>
                        <td>
                          <?php echo($value->name); ?>
                        </td>
                        <td>
                          <?php echo($value->client_name); ?>
                        </td>
                        <?php for($i=1;$i<$currentWeek;$i++){ ?>
                               <td><?php 
                              // var_dump($department_project_log[$value->id]);exit;

                               echo $department_project_log[$value->id][$i] ?></td>
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