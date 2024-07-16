

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Batch</h3>
                                                        
      <a href="<?php echo base_url("admin/batch/add");?>">    
          <button class="btn btn-primary" type="button">Add New Batch </button></a>
						</div>
						<div class="content">
							<div class="table-responsive">
                                                           <?php // display sucess message
                                                           if(!empty($sucess_message)){?>
                                                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $sucess_message;?>!
							 </div>
                                                           <?php }?>
                                                            
                                                            <?php //display error message
                                                            if(!empty($message_error)) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?}?>
								<table class="table table-bordered" id="datatable2" >
									<thead>
										<tr>
											<th><b>S/N</b></th>
							<!--<th><b>Room Number</b></th>-->
											
                                                                                        <th><b>Batch ID</b></th>
                                                                                        <th><b>Batch Name</b></th>
                                                                                         <th><b>Batch Start</b></th>
                                                                                          <th><b>Batch End</b></th>
                                                                                          <th><b>Status</b></th>
                                                                                         <th><b></b></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$counter = 1;
if(empty($results)){echo 'No faculty as been added';}else{
foreach($results as $data) { //var_dump($data);exit;?>
  <tr class="gradeA">
<td><?php 
echo $counter;
//echo $data->amenity_id ?></td>
<td class="center"><?php echo $data->batch_id ?></td>
<td class="center"><?php echo $data->batch_name ?></td>
<td class="center"><?php echo $data->start_date ?></td>
<td class="center"><?php echo $data->end_date ?></td>
<td class="center"><?php echo $data->batch_status ?></td>

<td>
    
   <a 
      href="<?php echo base_url("admin/batch/edit/".$data->batch_id);?>" > <button class="btn btn-info" type="button">Edit Batch</button></a>
   
<a href="<?php echo base_url("admin/batch/setascurrent/".$data->batch_id);?>"><button class="btn btn-danger" type="button">Set As Current</button>
</td>											
												
<? $counter++;}
?>
                                                         </tbody>
                                                         </table>
    <p><?php echo $links; ?></p>
    
    <?}?> 
 			</div>
       </div>									
			</div>
       </div>
    
        