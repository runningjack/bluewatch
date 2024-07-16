

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Department</h3>
                                                        
      <a href="<?php echo base_url("admin/department/add");?>">    
          <button class="btn btn-primary" type="button">Add New Department </button></a>
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
							 
            <?php } ?>
								<table class="table table-bordered" id="datatable2" >
									<thead>
										<tr>
											<th><b>S/N</b></th>
							<!--<th><b>Room Number</b></th>-->
											
                                                                                        <th><b>Department ID</b></th>
                                                                                        <th><b>Department Name</b></th>
                                                                                         <th><b>faculty</b></th>
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
<td class="center"><?php echo $data->department_id ?></td>
<td class="center"><?php echo $data->department_name ?></td>
<td class="center"><?php echo $data->faculty_name ?></td>

<td>
    
   <a 
      href="<?php echo base_url("admin/department/edit/".$data->department_id);?>" > <button class="btn btn-info" type="button">Edit department</button></a>
   
<a href="<?php echo base_url("admin/department/delete/".$data->department_id);?>"><button class="btn btn-danger" type="button">Delete department</button>
</td>											
												
<?php $counter++;}
?>
                                                         </tbody>
                                                         </table>
    <p><?php echo $links; ?></p>
    
    <?php } ?> 
 			</div>
       </div>									
			</div>
       </div>
    
        