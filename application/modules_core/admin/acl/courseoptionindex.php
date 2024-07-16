

<div class="row">
				<div class="col-md-13">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Course of Study</h3>
                                                        
      <a href="<?php echo base_url("admin/courseoption/add");?>">    
          <button class="btn btn-primary" type="button">Add New Course of Study </button></a>
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
											
                                                                                        <th><b>ID</b></th>
                                                                                         <th><b>Course of Study</b></th>
                                                                                        <th><b>Department Name</b></th>
                                                                                         <th><b>faculty</b></th>
                                                                                         <th><b></b></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$counter = 1;
if(empty($results)){echo 'No Course of Studey as been added';}else{
foreach($results as $data) { //var_dump($data);exit;?>
  <tr class="gradeA">
<td><?php 
echo $counter;
//echo $data->amenity_id ?></td>
<td class="center"><?php echo $data->courseoption_id ?></td>
<td class="center"><?php echo $data->programme_option ?></td>
<td class="center"><?php echo $data->department_name ?></td>
<td class="center"><?php echo $data->faculty_name ?></td>

<td>
    
   <a 
      href="<?php echo base_url("admin/courseoption/edit/".$data->courseoption_id);?>" > <button class="btn btn-info" type="button">Edit Course Option</button></a>
   
<a href="<?php echo base_url("admin/courseoption/delete/".$data->courseoption_id);?>"><button class="btn btn-danger" type="button">Delete Course Option</button>
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
    
        