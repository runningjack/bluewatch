

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Project Time Log</h3>
                                                          
						</div>
						<div class="content">
							<div class="table-responsive">
                                            <input type="hidden" id="projectID" value="<?php echo $project_id; ?>">

								<table class="table table-bordered" id="datatable2" >
									<thead>
											<th><strong>S/N</strong></th>
											<th><strong>Member Name</strong></th>
                                            <th><strong>Team</strong></th>
                                            <th><strong>Role</strong></th> 
                                            <th><strong>Hourly Rate</strong></th> 
                                            <th><strong>Hours Spent</strong></th> 
                                            <th>Cost</th>
                          
									</thead>
									<tbody>
<?php
$counter = 1;
$sum = 0;
if (empty($results)) {
    echo 'No team was found';
} else {

    foreach ($results as $data) {
      $sum += intval($data['rate_cost']);
        ?>
  <tr class="gradeA">
<td><?php echo $counter; ?><input type="hidden" value="<?php echo $data['member_id']; ?>"></td>
<td class="center"><?php echo $data['member_name']; ?></td>
<td class="center"><?php echo $data['team_name']; ?></td>
<td class="center"><?php if($data['team_lead'] == $data['member_id']){echo 'Team Lead';}else{echo 'Member';} ?></td>
<td class="center"><?php echo $data['employee_rate']; ?></td>
<td class="center"><?php echo $data['hours']; ?></td>
<td class="center" style="text-align: right;"><?php echo $data['rate_cost']; ?></td>                      
</tr>                   
<?php ++$counter;
  } ?>
  <tr style="font-weight: bolder;">
  <td>Total</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td style="text-align: right;"><?php echo $sum; ?></td>
  </tr>
   <?php
        } ?>

  
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
            <button class="btn btn-success" type="submit">Review</button>
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
