
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
							<h3>Approve Time Activities Log</h3>
                                                         
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
                                    <td colspan="6"><strong>Project Details</strong></td>
                                    <td colspan="3"><strong>Team Lead Status</strong></td>
                                    <td colspan="3"><strong>Project Manager Status</strong></td>
                                    <td></td>
                                    </tr>
										<tr>
											<th><strong>S/N</strong></th> 
                                            <th><strong>Staff</strong></th>
                                            <th><strong>Activity Date</strong></th>
											<th><strong>Project Name</strong></th>
                                            <th><strong>Task</strong></th>
                                            <th><strong>No of Hours</strong></th> 

                                            <th><strong>Name</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Comment</strong></th>

                                            <th><strong>Name</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Comment</strong></th>
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
    foreach ($results as $data) {
       // var_dump($data);exit;
        ?>
  <tr class="gradeA">
<td><?php
echo $counter;
        //echo $data->amenity_id?></td>
<td class="center"><?php echo $employeelist[$data->employee_id]; ?></td>
<td class="center"><?php echo $data->log_date; ?></td>
<td class="center"><?php echo $data->name; ?></td>
<td class="center"><?php echo $data->task_name; ?></td>
<td class="center"><?php echo $data->hours; ?></td> 

<td class="center"><?php echo $employeelist[$data->team_lead_id]; ?></td>
<td class="center"><strong>
<?php echo '<span style="color:'.$color[$data->team_lead_status].'">'.$statuselement[$data->team_lead_status].'</span>'; ?></strong></td>
<td class="center"><?php echo $data->team_lead_comment; ?></td>

<td class="center"><?php echo $employeelist[$data->project_manager_id]; ?></td>
<td class="center">
<strong>
<?php echo '<span style="color:'.$color[$data->project_manager_status].'">'.$statuselement[$data->project_manager_status].'</span>'; ?></strong>

 </td>
<td class="center"><?php echo $data->project_manager_comment; ?></td>



<td>
   <?php 
  // var_dump($_SESSION["login_detal"]->group_id);exit;
  //if ($_SESSION["login_detal"]->group_id == 6 && $data->project_manager_status != 1 && $data->team_lead_status != 1) {
   if ($_SESSION["login_detal"]->group_id == 6 && $data->project_manager_status != 1 && $data->team_lead_status != 1) {
            ?>
   <a 
      href="<?php echo base_url('admin/projectlogs/review/'.$data->activity_id); ?>" > <button class="btn btn-info" type="button">Review Activity</button></a>
   
 

   <?php
        } ?>
</td>											
												
<?php ++$counter;
    } ?>
                                                         </tbody>
                                                         </table>
    <p><?php echo $links; ?></p>
    
    <?php
}?> 
 			</div>
       </div>									
			</div>
       </div>
    
        