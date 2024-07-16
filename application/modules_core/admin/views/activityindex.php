<?php
$statuselement = array();
foreach ($task_status as $value) { 
  $statuselement[$value->status_id] = $value->status;
}

$projectelement = array();
$projectelement[] = "Select Projects";
foreach ($project_list as $projects) {
  if ($projects->status == 'Active')
    $projectelement[$projects->proj_id] = $projects->name;
}

$customerElement = array();
$customerElement[] = "Select Customer";
foreach ($customers as $customer) {
  $customerElement[$customer->id] = $customer->name;
}
?>

<div class="row">
  <div class="col-md-12">
    <div class="block-flat">
      <div class="header">
        <h3>Employee Time Activities Log</h3>

        <?php if (!empty($_GET['success'])) { ?>
          <div class="alert alert-success alert-white rounded">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div class="icon"><i class="fa fa-check"></i></div>
            <strong>Success!</strong> <?php echo $_GET['success']; ?>!
          </div>
        <?php } ?>

        <?php if (!empty($_GET['error'])) { ?>
          <div class="alert alert-danger alert-white rounded">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div class="icon"><i class="fa fa-times-circle"></i></div>
            <strong>Error!</strong> <?php echo $_GET['error']; ?>
          </div>
        <?php } ?>

        <form action="<?php echo base_url("admin/projectlogs/activityindex"); ?>" method="POST">
          <div class="col-md-12" style="padding:40px ;">
            <div class="col-md-2">
              <label>Customer</label>
              <?php echo form_dropdown('customer_id', $customerElement, '', 'class="form-control " id="customer_id" onchange="loadProject();"'); ?>
            </div>
            <div class="col-md-2">
              <label>Project</label>
              <span id="loadproject"></span>
              <?php echo form_dropdown('project_id', $projectelement, '', 'required="" class="form-control" id="project_id" onchange="loadTasks();"'); ?>
            </div>
            <div class="col-md-2">
              <label>Start date</label>
              <input name="start_date" type="date" class="form-control" placeholder="Start date">
            </div>
            <div class="col-md-2">
              <label>End date</label>
              <input name="end_date" type="date" class="form-control" placeholder="End Date">
            </div>
            <div class="col-md-4">
              <label></label>
              <input style="margin-top: 25px;" name="submit" type="submit" class="btn btn-success" value="Filter Activity Log">
              <a style="margin-top: 25px;" class="btn btn-success" href="<?php echo base_url("admin/projectlogs/multiactivity") ?>">Log Multiple Activities</a>
            </div>
          </div>
        </form>

      </div>
      <div class="content">
        <div class="table-responsive">
          <?php if (!empty($sucess_message)) { ?>
            <div class="alert alert-success alert-white rounded">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="icon"><i class="fa fa-check"></i></div>
              <strong>Success!</strong> <?php echo $sucess_message; ?>!
            </div>
          <?php } ?>

          <?php if (!empty($message_error)) { ?>
            <div class="alert alert-danger alert-white rounded">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="icon"><i class="fa fa-times-circle"></i></div>
              <strong>Error!</strong> <?php echo $message_error; ?>
            </div>
          <?php } ?>

          <table class="table table-bordered">
            <thead>
              <?php foreach($results as $single) { ?>
                <tr align="left" style="background-color: darkblue;color: #fff;">
                  <td colspan="6"><strong><?php echo $single['current_date'] ?></strong></td>
                </tr>
                <?php foreach($single['project_list'] as $single_proj_log) {
                  if($single_proj_log['project_log']['project_list_count'] > 0 && $single_proj_log['project_log']['project_details'] != 2) { ?>
                    <tr align="center" style="background-color: darkblue;color: #fff;">
                      <td colspan="9"><strong><?php echo $single_proj_log['project_log']['project_details']; ?></strong></td>
                    </tr>
                    <tr>
                      <th width="4%"><strong>Date</strong></th>
                      <th width="15%"><strong>Project Name</strong></th>
                      <th width="15%"><strong>Task</strong></th>
                      <th width="15%"><strong>Comment</strong></th>
                      <th width="10%"><strong>Hours</strong></th>
                      <th width="10%"><strong>Mg. Comment</strong></th>
                      <th width="10%"><strong>Mg. Status</strong></th>
                    </tr>
                    <?php
                    $total_hours = 0;
                    foreach ($single_proj_log['project_log']['project_list'] as $data) {
                      $total_hours += $data->hours;
                    ?>
                      <tr class="gradeA">
                        <td class="center"><?php echo $data->log_date; ?></td>
                        <td class="center"><?php echo $data->name; ?></td>
                        <td class="center"><?php echo $data->task_name; ?></td>
                        <td class="center"><?php echo $data->comment; ?></td>
                        <td class="center">
                          <div id="up_display_<?php echo $data->activity_id ?>"></div>
                          <?php if ($data->project_manager_status == "Rejected") { ?>
                            <input style="width:30%" type="number" id="project_hour_<?php echo $data->activity_id ?>" value="<?php echo $data->hours; ?>" max="18" min="1" />
                            <button style="display: inline !important;" onclick="SaveLogRecord(<?php echo $data->activity_id ?>,<?php echo $data->empl_id ?>,<?php echo $data->project_id ?>,'<?php echo $data->log_date; ?>');" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update" aria-describedby="tooltip547756">
                              <i class="fa fa-save" aria-hidden="true"></i>
                            </button>
                          <?php } else {
                            echo $data->hours;
                          } ?>
                        </td>
                        <td class="center"><?php echo $data->project_manager_comment; ?></td>
                        <td class="center"><?php echo $data->project_manager_status; ?></td>
                      </tr>
                    <?php } ?>
                    <tr>
                      <td colspan="4" align="right"><strong>Total Hours:</strong></td>
                      <td class="center"><strong><?php echo $total_hours; ?></strong></td>
                      <td colspan="2"></td>
                    </tr>
                  <?php } 
                } ?>
              <?php } ?>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function SaveLogRecord(record_id, employee_id, project_id, log_date) {
      $('#up_display_' + record_id).html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "inline");
      var hours = document.getElementById("project_hour_" + record_id).value;

      $.ajax({
        url: '<?php echo base_url('admin/projectlogs/update_hour_log'); ?>',
        type: "POST",
        data: {
          employee_id: employee_id,
          record_id: record_id,
          hours: hours,
          project_id: project_id,
          log_date: log_date
        },
        dataType: 'json',
        success: function(response) {
          if (response.status == false) {
            alert(response.error);
          }
          $('#up_display_' + record_id).html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "none");
        }
      });
    }

    function loadProject() {
      var customer_id = document.getElementById('customer_id').value;
      $("#loadproject").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "inline");
      $.ajax({
        url: '<?php echo base_url('admin/projectlogs/get_project_list'); ?>',
        type: "POST",
        data: {
          customer_id: customer_id
        },
        dataType: 'json',
        success: function(response) {
          $("#loadproject").html(response);
        }
      });
    }

    function loadTasks() {
      var project_id = document.getElementById('project_id').value;
      $("#loadtask").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "inline");
      $.ajax({
        url: '<?php echo base_url('admin/projectlogs/get_task_list'); ?>',
        type: "POST",
        data: {
          project_id: project_id
        },
        dataType: 'json',
        success: function(response) {
          $("#loadtask").html(response);
        }
      });
    }
  </script>
</div>
