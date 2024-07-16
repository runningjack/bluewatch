<?php
$statuselement = array();
foreach ($task_status as $value) { //// var_dump($value);exit;
    $statuselement[$value->status_id] = $value->status;
}

$projectelement = array();
//var_dump($project_list);exit;
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

//var_dump($projectelement);exit;

?>

<style>
    .form-control {
    margin: 4px;
    }
    .aligh_right
    {
        float: right;
    }
    </style>
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

                <div class="content">

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


                    <div class="row">
                        <div class="col-md-10">
                        <div id="error" class="alert alert-danger rounded" style="display:none">
 
                        </div>
                            <div class="table-responsive" id="display">
                </hr>
                               
<table style="padding: -15px; width: 96%; margin-left: 20px;" class="table">
                                     <thead class="thead-dark">
                                        <tr>
                                            <th>SN</th>
                                            <th>Date*</th>
                                            <th>Project Name</th>
                                            <th>Task</th>
                                            <th>Total No of Hours</th>
                                            <th>Comment</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $counter = 1;
                                        foreach($all_logs as $log){ ?>
                                        <tr>
                                            <td><?php 
                                            echo $counter;
                                            $counter++;
                                            ?></td>
                                            <td><?php echo $log->log_date ?></td>
                                            <td><?php echo $log->name ?></td>
                                            <td><?php echo $log->task_name ?></td>
                                            <td><?php echo $log->hours ?> Hours</td>
                                            <td><?php echo $log->comment ?> </td>
                                            <td>

                                            <button onclick="removeComent(<?php echo $log->activity_id ?>);" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" aria-describedby="tooltip547756">
                                                <i class="fa fa-trash-o"  aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <?php }?>

                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">


                        <div class="col-md-10">

<div id="submiting"></div>







                            <form name="timelog" onsubmit="return logActivityAjax(event);">
                                <div class="col-md-12" style="padding:0px ;">


                                    <div class="col-md-12">
                                        <?php $date = date('Y-m-d', time());
                                        $start_date = date('Y-m-d', strtotime('-30 day', strtotime($date)));

                                        ?>
                                        <input name="date"  id="date" type="date" class="form-control" placeholder="Select Date for Entry" min="<?php echo $start_date ?>" max="<?php echo $date; ?>">
                                    </div>

                                    <div class="col-md-8">
                                        <?php echo form_dropdown('customer_id', $customerElement, '', '  class="form-control " id="customer_id" onchange="loadProject();"'); ?>
                                    </div>



                                    <div class="col-md-4">
                                        <span id="loadproject"></span>
                                        <?php echo form_dropdown('project_id', $projectelement, '', 'required="" class="form-control" id="project_id" onchange="loadTasks();"'); ?>
                                    </div>

                                    <div class="col-md-6">
                                        <span id="loadtask"></span>
                                        <select class="form-control" name="task_done" required id="task_done">
                                             <option value="340">Idle Time</option>
                                            <option value="">Select Project to load Task</option>
                                           
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input name="time" id="time" type="number" max="16" min="1" class="form-control" placeholder="Enter Time in Hour(s)">
                                    </div>


                                    <div class="col-md-12">
                                        <textarea id="comment" name="comment" class="form-control" col="5"></textarea>

                                    </div>


                                    <div class="col-md-12" style="margin-left: auto; margin-right: 0;">
                                    <a href="<?php echo base_url("admin/projectlogs/continueTimelog"); ?>" name="continue" class="btn btn-danger btn-sm rounded-0 aligh_right" value="Continue" style="width:100px">
                                    Continue   </a>
                                    <input name="submit" id="updatelogbtn" type="submit" class="btn btn-success  btn-sm aligh_right" value="Add" style="width:100px">

                                    <input name="cancel" type="button" class="btn btn-warning btn-sm aligh_right" value="Cancel" >

                                     
                                       
                                    </div>
                               

                                </div>
                            </form>

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
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

            return true;
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


        function removeComent(comment_id)
        {

            $("#submiting").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "inline");
            

$.ajax({
    url: '<?php echo base_url('admin/projectlogs/removecomment'); ?>',
    type: "POST",
    data: {
        comment_id: comment_id
    },
    dataType: 'json',
    success: function(response) {
        $("#submiting").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "none");
        $("#display").html(response.display);
        $(":submit").removeAttr("disabled");

         console.log(response);
       
    }
});
        }
        function logActivityAjax(event) {
            event.preventDefault();
            $("#submiting").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "inline");
            $("#error").css("display", "none");
     
            
            var member_id = "<?php echo $_SESSION['login_detal']->id; ?>";
          //  !isset($date) || !isset($project_id) || !isset($time) || !isset($project_id) 

          var project_id = document.getElementById('project_id').value;
          var date = document.getElementById('date').value;
          var time = document.getElementById('time').value; 
          var comment = $("#comment").val();  
          var task_done = document.getElementById('task_done').value; 

                $.ajax({
                    url: '<?php echo base_url('admin/projectlogs/logSingleTaskAjax'); ?>',
                    type: "POST",
                    data: {
                        project_id: project_id,
                        date: date,
                        time: time,
                        comment:comment,
                        task_done:task_done
                    },
                    dataType: 'json',
                    success: function(response) {

                        if(response.error!="")
                        {

                        $("#submiting").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "none");
                        $("#error").html(response.error).css("display", "inline");;
                        $(":submit").removeAttr("disabled");
                        }
                        else
                       {
                         $("#submiting").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif"); ?>' alt='loading' />").css("display", "none");
                        $("#display").html(response.display);
                        $(":submit").removeAttr("disabled");
                    }

                         console.log(response);
                       
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