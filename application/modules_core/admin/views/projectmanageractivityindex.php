<?php
$statuselement = array();
foreach ($task_status as $value) { //// var_dump($value);exit;
  $statuselement[$value->status_id] = $value->status;
}

$projectelement = array();
//var_dump($project_list);exit;
//$project_list[0] = "Select Projects";
// foreach ($project_list as $projects) {
//  // if ($projects->status == 'Active')
//     $projectelement[$projects->proj_id] = $projects->name;
// }
$projectelement = $project_list;



$customerElement = array();
$customerElement[] = "Select Customer";
foreach ($customers as $customer) {
  $customerElement[$customer->id] = $customer->name;
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
        } ?>

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

        <form action="<?php echo base_url("admin/projectlogs/activityteamprojmanager"); ?>" method="POST">
          <div class="col-md-12" style="padding:40px ;">


           
  <!-- <div class="col-md-2">
  <label>Customer</label>
    <?php echo form_dropdown('customer_id', $customerElement, '', '  class="form-control " id="customer_id" onchange="loadProject();"'); ?>
  </div>   -->



            <div class="col-md-2">
            <label>Project </label>
              <span id="loadproject"></span>

              <?php echo form_dropdown('project_id', $projectelement, '', 'required="" class="form-control" id="project_id" onchange="loadTasks();"'); ?>
            </div>


            <div class="col-md-2">
              <label>Start date</label>
              <input name="start_date" type="date" class="form-control" placeholder="Start date"  >
            </div>

            <div class="col-md-2">
            <label>End date</label>
              <input name="end_date" type="date" class="form-control" placeholder="End Date"  >
            </div>

            <div class="col-md-4">
            <label></label>
              <input style="margin-top: 25px;" name="submit" type="submit" class="btn btn-success" value="Filter Activity Log">

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
          } ?>

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


          <table class="table table-bordered">
            <thead>
              <?php
              
              foreach($results as $single)
              { 
                
                ?>
                <tr align="left" style="background-color: darkblue;color: #fff;">
                <td colspan="5"><strong><?php echo $single['current_date'] ?></strong></td>
              </tr>
              <tr>
                <td>
              
              <?php 
              //var_dump($single['project_list']);exit;
              foreach($single['project_list'] as $single_proj_log)
              {
                //var_dump($single_proj_log);exit;
                if($single_proj_log['project_log']['project_list_count']>0){
                  if($single_proj_log['project_log']['project_details']!=2){
                ?>
              <table>
               <tr align="center" style="background-color: darkblue;color: #fff;">
                <td colspan="9"><strong><?php 
                 echo $single_proj_log['project_log']['project_details'];
                // var_dump($single_proj_log['project_log']['project_list_count']);//exit;
                
                ?></strong></td>
              </tr>
              <tr>
                <!-- <th width="1%"><strong>S/N</strong></th> -->
                <th width="10%">Resource</th>
                <!-- <th width="4%"><strong>Date</strong></th> -->
                <th width="15%"><strong>Project Name</strong></th>
                <th width="15%"><strong>Task</strong></th>
                <th width="15%"><strong>Comment</strong></th>
                <th width="5%"><strong>Hours</strong></th>
                <!-- <th width="10%"><strong>Mg. Suggested Hours</strong></th> -->
                <th width="10%"><strong>Mg. Comment</strong></th>
                <th width="15%"><strong>Mg. Status</strong></th>
              </tr>
             <?php
            // var_dump($single_proj_log);exit;
             foreach ($single_proj_log['project_log']['project_list'] as $data) {
             //   var_dump($data->activity_id);exit;  
              ?>
                  <tr class="gradeA">
                    <?php //var_dump($data); exit; ?>
                    <!-- <td><?php
                        echo $counter;

                        
                        ?></td> -->
                     <td class="center"><?php echo $data->first_name.' '.$data->middle_name.' '.$data->last_name; ?></td>
                    <!-- <td class="center"><?php echo $data->log_date; ?></td> -->
                    <td class="center"><?php echo $data->name; ?></td>
                    <td class="center"><?php echo $data->task_name; ?></td>
                    <td class="center"><?php echo $data->comment; ?></td>
                    <td class="center"><?php echo $data->hours; ?></td>
                    <!-- <td class="center">
                    <input type="number" id="project_manager_hour_<?php echo $data->activity_id ?>" value="<?php echo $data->project_manager_sugested_hour; ?>" max="16" />  
                    </td> -->

                    <?php if($data->project_manager_status=="Approved"){?>


                      <td class="center">
                       <?php echo $data->project_manager_comment; ?> </td>
                    <td class="center">
                      <div id="display_<?php echo $data->activity_id ?>"></div>
                     <?php echo $data->project_manager_status ?>
                            </td>
                      
                  <?php  }else{?>
                    <td class="center">
                      <textarea rows="2" id="project_manager_comment_<?php echo $data->activity_id ?>"  ><?php echo $data->project_manager_comment; ?></textarea></td>
                    <td class="center">
                      <div id="display_<?php echo $data->activity_id ?>"></div>
                      <select style="display: inline !important; width:60% !important" class="form-control" id="project_manager_status_<?php echo $data->activity_id ?>" >
                        <option>-Status-</option>
                        <option value="Approved" <?php if($data->project_manager_status=="Approved") echo "Selected"; ?>>Approved</option>
                        <option value="Rejected" <?php if($data->project_manager_status=="Rejected") echo "Selected"; ?>>Rejected</option>
                      </select>
                      <button style="display: inline !important;"
                       onclick="SaveLogRecord(<?php echo $data->activity_id ?>, 
                       <?php echo $data->empl_id ?>,<?php echo $data->project_id ?>);" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Save" aria-describedby="tooltip547756">
                                                <i class="fa fa-save" aria-hidden="true"></i></button>
                    </td>

                    <?php }?>



                  <?php ++$counter;
                } ?>

              

             <?php 
                 } }}

              ?>
</table>

            <?php  
              
              ?>
              </td>
              </tr>
              
           
          <p><?php echo $links; ?></p>

        <?php
              } ?>

</tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- <div id="logModal" class="modal fade" role="dialog">
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
                  <table class="table table-bordered">

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
  </div> -->

  <script type="text/javascript">

    function SaveLogRecord(record_id,employee_id,project_id)
    {
      //alert(employee_id);
      $('#display_'+record_id).html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "inline");
      var status = $("#project_manager_status_"+record_id).val();  
      var mgr_comment = document.getElementById("project_manager_comment_"+record_id).value; 

      $.ajax({
        url: '<?php echo base_url('admin/projectlogs/update_project_log'); ?>',
        type: "POST",
        data: {
          employee_id:  employee_id ,
          record_id: record_id,
          status: status,
          mgr_comment: mgr_comment,
          project_id:project_id
        },
        dataType: 'html',
        success: function(response) {
          // $("#loadproject").css("display", "none");
          // $('#project_id').html(response);
          $('#display_'+record_id).html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "none");
    
        }
      });
    }

    
    function loadProject() {
      var customer_id = document.getElementById('customer_id').value;
      $("#loadproject").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "inline");
      $.ajax({
        url: '<?php echo base_url('admin/projectlogs/load_project'); ?>',
        type: "POST",
        data: {
          customer_id: customer_id
        },
        dataType: 'html',
        success: function(response) {
          $("#loadproject").css("display", "none");
          $('#project_id').html(response);
        }
      });
    }

    function loadTasks() {

      var project_id = document.getElementById('project_id').value;

      $("#loadtask").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "inline");



      $.ajax({
        url: '<?php echo base_url('admin/projectlogs/load_project_task'); ?>',
        type: "POST",
        data: {
          project_id: project_id
        },
        dataType: 'html',
        success: function(response) {
          $("#loadtask").css("display", "none");
          $('#task_done').html(response);
        }
      });

    }




    function randomNumber(limit) {
      return Math.floor(Math.random() * limit);

    }

    /*     function loadTask() {
    $("#project_id").change(function(){	
      document.getElementById('project_id').value; 
      alert("jjjj");
              var project_id = document.getElementById('project_id').value; 
             $("#loadtask").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "inline");
     		
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
    $(document).ready(function() {
      $('#logModal').on('show.bs.modal', function(e) {
        var member_id = "<?php echo $_SESSION['login_detal']->id; ?>";
        var date_range = '';

        $.ajax({
          url: '<?php echo base_url('admin/projectlogs/reviewlogActivities'); ?>',
          type: "POST",
          data: {
            member_id: member_id,
            date_range: date_range
          },
          dataType: 'json',
          success: function(response) {
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
          url: '<?php echo base_url('admin/projectlogs/reviewlogActivities'); ?>',
          type: "POST",
          data: {
            member_id: member_id,
            date_range: date_range,
            state: state
          },
          dataType: 'json',
          success: function(response) {
            // console.log(response);
            $('#logModal .table').html(response.content);
            $("#logModal input[name=userId]").val(response.user_id);
            $("#logModal input[name=dateRange]").val(response.dateRange);
          }
        });
      });
    });
  </script>