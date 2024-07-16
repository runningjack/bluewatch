<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Assigned Project Task</h3><br>
                            
						</div>
						<div class="content">
							<div class="table-responsive">
                                                          
								<table class="table table-bordered" id="datatable2" >
									<thead>
											<th><strong>S/N</strong></th>
											<th><strong>Project Name</strong></th>
                                            <th><strong>Task</strong></th>
                                            <th><strong>Task Details</strong></th> 


                                            <th><strong>Start Date</strong></th>

                                            <th><strong>End Date</strong></th>

                          
									</thead>
									<tbody>
<?php
$counter = 1;
if (empty($results)) {
    // echo 'No Project Task was found';
} else {
    foreach ($results as $data) {
        ?>
  <tr class="gradeA">
<td><?php echo $counter; ?></td>
<td class="center"><?php echo $data->name; ?></td>
<td class="center"><?php echo $data->task_name; ?></td>
<td class="center"><?php echo $data->task_description; ?></td>
<td class="center"><?php echo $data->start_date; ?></td>
<td class="center"><?php echo $data->end_date; ?></td>
                     
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