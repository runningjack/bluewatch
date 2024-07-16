<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Project Task</h3><br>
                            <button type="button" data-toggle="modal" data-target="#addtask" class="btn btn-primary" id="import">Add Task</button>
                            <button type="button" data-toggle="modal" data-target="#uploadfile" class="btn btn-success" id="import">Import CSV</button>
                            <a href="<?php echo base_url().'admin/manageproject/download'; ?>" class="btn btn-default">Download Template</a>
                                                         
						</div>
						<div class="content">
							<div class="table-responsive">
                            <?php // display sucess message
                                                           if (!empty($this->session->flashdata('success'))) {
                                                               ?>
                                                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>!
							 </div>
                                                           <?php
                                                           }?>
                                                            
                                                            <?php //display error message
                                                      //  var_dump($log_details);
                                                            if (!empty($this->session->flashdata('error'))) {
                                                                ?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
							 </div>
							 
            <?php
                                                            }?>
                                                          
								<table class="table table-bordered" id="datatable2" >
									<thead>
											<th><strong>S/N</strong></th>
											<th><strong>Project Name</strong></th>
                                            <th><strong>Task</strong></th>
                                            <th><strong>Task Details</strong></th> 

                                            <th><strong>Assigned To</strong></th>

                                            <th><strong>Start Date</strong></th>

                                            <th><strong>End Date</strong></th>

                                            <th></th>
                          
									</thead>
									<tbody>
<?php
$counter = 1;
if (empty($results)) {
    echo 'No Project Task was found';
} else {
    foreach ($results as $data) {
        ?>
  <tr class="gradeA">
<td><?php echo $counter; ?></td>
<td class="center"><?php echo $data->name; ?></td>
<td class="center"><?php echo $data->task_name; ?></td>
<td class="center"><?php echo $data->task_description; ?></td>
<td class="center"><?php echo $data->first_name . " " . $data->last_name ; ?></td>
<td class="center"><?php echo $data->start_date; ?></td>
<td class="center"><?php echo $data->end_date; ?></td>
<td>
<?php 
//var_dump($_SESSION['login_detal']);exit;var_dump($_SESSION['login_detal']->employee_id);exit;
  $employee_id = $_SESSION['login_detal']->employee_id;
  $group_id = $_SESSION['login_detal']->group_id;
  if($group_id == 5 ){
?>
    <a href="<?php echo base_url('admin/manageproject/edittask/'.$data->task_id); ?>" > <button class="btn btn-primary" type="button">Edit</button></a>
    <button data-toggle="modal" data-target="#deletetask" onclick="addId(<?=$data->task_id?>)" class="btn btn-danger" type="button">Delete</button>

<?php 
    }
?>
    
</td>                      
</tr>                   
<?php ++$counter;
  } ?>
   <?php
        } ?>

  
                                                         </tbody>
                                                         </table>
    <p><?php echo $links; ?></p>
   
 			</div>
       </div>									
			</div>
       </div>



<div id="uploadfile" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title">Import Excel</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form enctype="multipart/form-data" method="POST" action="<?php echo base_url('admin/manageproject/uploadExcel') ?>">
          <div class="pd-30 pd-sm-40 wd-xl-100p">

            <div class="row row-xs align-items-center mg-b-20">
              <div class="col-md-12 mg-t-5 mg-md-t-0">
                <div class="custom-file">
                  <!-- accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" -->
                	<input type="file" class="form-control" id="fileURL" name="fileURL">
              	</div>
              </div><!-- col -->
            </div><!-- row -->
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="saveUpload">Import</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
</div>
<div id="deletetask" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title">Delete Project Task</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <input type="hidden" id="delete_id">
          <h4>Do you Really want to delete this task?</h4>
          </div>
          <div class="modal-footer">
            <a href="" id="delete_btn" class="btn btn-danger" id="saveUpload">Yes</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">N0</button>
          </div>
        
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
</div>

<div id="addtask" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title">Add Task</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form enctype="multipart/form-data" method="POST" action="<?php echo base_url("admin/manageproject/tasks") ?>">
          <table>
                        <tr>
                            <td class="label2">
                              
                                    Project :
                            </td>
                            <td class="col2">
                            <select name="project_id" id ="project_id" class="form-control" required>
                                <option>Select Project</option>
                                 <?php foreach($projects as $m){?>
                                 <option value ="<?php echo $m->id;?>"><?php echo $m->name;?></option>  
                                 <?php } ?>
                             </select>
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Task :
                            </td>
                            <td class="col2">
                            <select name="task_name" id ="task_name" class="form-control" required>
                                 <!-- <option>Select task</option> -->
                                 <!-- <?php foreach($modules as $m){?>
                                 <option value ="<?php echo $m->name;?>"
                                        <?php if($perm['module_id']==$m->module_id){
                                            echo 'selected';}?>
                                         ><?php echo $m->module_name;?></option>  
                                 <?php } ?> -->
                             </select>
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                Describe Task :
                            </td>
                            <td class="col2">
                                <textarea name="task_description" rows="5" id ="task_description" placeholder="Describe Task" class="form-control" required></textarea>
                                
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="label2">
                              
                                   Assign to :
                            </td>
                            <td class="col2">
                                <select name="assigned_to" id ="assigned_to" class="form-control" required>
                                 
                                 <?php foreach($modules as $m){?>
                                 <option value ="<?php echo $m->module_id;?>"
                                        <?php if($perm['module_id']==$m->module_id){
                                            echo 'selected';}?>
                                         ><?php echo $m->module_name;?></option>  
                                 <?php } ?>
                             </select>
                                
                            </td>
                        </tr>
                        <tr><td></td><td><input type="submit"  value="Add Task" class="btn btn-success" /></td></tr>
                      </table>
          <!-- <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="saveUpload">Import</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div> -->
        </form>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
  </div>
  <script type="text/javascript">
  function addId(id){
    var link = document.getElementById("delete_btn");
    link.href = "<?=base_url('admin/manageproject/deletetask/'.$data->task_id); ?>";
    console.log(link.href);
   }

	$(document).ready(function(){
    $.ajax({
                url: '<?php echo base_url('admin/ajax/projectteammember') .'/'; ?>' + $(this).val(),
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function (res) {
                    //console.log(res);
					var locations = document.getElementById("assigned_to");
                    $('#assigned_to')
                        .empty()
						.append('<option >--Select Members--</option>');
					

                    for (var i = 0; i < res.length; i++) {
                        var opt = document.createElement('option');
                        //console.log(res[i].Id);
                        opt.value = res[i].id;
                        opt.innerHTML = res[i].first_name + res[i].last_name  ;
						locations.appendChild(opt);
                    }

                },
                error: function (err) {
                    //alert('Error occured while fetch notification');
                    console.log(err)
                }
            });

            $.ajax({
                url: '<?php echo base_url('admin/ajax/projecttasks') .'/'; ?>' + $(this).val(),
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function (res) {
                    //console.log(res);
					var locations = document.getElementById("task_name");
                    $('#task_name')
                        .empty()
						.append('<option value="0" >--Select Task--</option>');
					

                    for (var i = 0; i < res.length; i++) {
                        var opt = document.createElement('option');
                        //console.log(res[i].Id);
                        opt.value = res[i].id;
                        opt.innerHTML = res[i].task_name;
						locations.appendChild(opt);
                    }

                },
                error: function (err) {
                    //alert('Error occured while fetch notification');
                    console.log(err)
                }
            });
		$("#project_id").change(function(){
			// alert($(this).val());
			$.ajax({
                url: '<?php echo base_url('admin/ajax/projectteammember') .'/'; ?>' + $(this).val(),
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function (res) {
                    //console.log(res);
					var locations = document.getElementById("assigned_to");
                    $('#assigned_to')
                        .empty()
						.append('<option value="0" >--All Members--</option>');
					

                    for (var i = 0; i < res.length; i++) {
                        var opt = document.createElement('option');
                        //console.log(res[i].Id);
                        opt.value = res[i].id;
                        opt.innerHTML = res[i].first_name + res[i].last_name  ;
						locations.appendChild(opt);
                    }

                },
                error: function (err) {
                    //alert('Error occured while fetch notification');
                    console.log(err)
                }
            });
            $.ajax({
                url: '<?php echo base_url('admin/ajax/projecttasks') .'/'; ?>' + $(this).val(),
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function (res) {
                    //console.log(res);
					var locations = document.getElementById("task_name");
                    $('#task_name')
                        .empty()
						.append('<option value="0" >--Select Task--</option>');
					

                    for (var i = 0; i < res.length; i++) {
                        var opt = document.createElement('option');
                        //console.log(res[i].Id);
                        opt.value = res[i].id;
                        opt.innerHTML = res[i].task_name;
						locations.appendChild(opt);
                    }

                },
                error: function (err) {
                    //alert('Error occured while fetch notification');
                    console.log(err)
                }
            });
		})
	});
	 
	</script>
  



