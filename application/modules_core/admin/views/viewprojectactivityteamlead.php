

<div class="row">
        <div class="col-md-12">
          <div class="block-flat">
            <div class="header">              
              <h3>Project Time Log</h3>
                                                         
            </div>
            <div class="content">
              <div class="table-responsive">
                                                          
                <table class="table table-bordered" id="datatable2" >
                  <thead>
                      <th><strong>S/N</strong></th>
                      <th><strong>Project Name</strong></th>
                                            <th><strong>Client</strong></th>
                                            <th><strong>Details</strong></th> 

                                            <th><strong>Status</strong></th>
                                            <th><strong>Begin</strong></th>
                                            <th><strong>End</strong></th> 

                                            <th></th>
                          
                  </thead>
                  <tbody>
<?php
$counter = 1;
if (empty($results)) {
    echo 'No Project was found';
} else {
    foreach ($results as $data) {
        ?>
  <tr class="gradeA">
<td><?php echo $counter; ?></td>
<td class="center"><?php echo $data->name; ?></td>
<td class="center"><?php echo $data->client_name; ?></td>
<td class="center"><?php echo $data->details; ?></td>
<td class="center"><?php echo $data->status; ?></td>
<td class="center"><?php echo $data->start_date; ?></td>
<td class="center"><?php echo $data->end_date; ?></td>
<td><a href="<?php echo base_url('admin/projectlogs/teamleadreviewprojecttimelog/'.$data->id); ?>" > <button class="btn btn-info" type="button">View Project log</button></a></td>                      
</tr>                   
<?php ++$counter;
  } ?>
   <?php
        } ?>

  
                                                         </tbody>
                                                         </table>
   
      </div>
       </div>                 
      </div>
       </div>
    
        