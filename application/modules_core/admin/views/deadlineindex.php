

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Registeration Deadline</h3>
   
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
											
                                                                                        <th><b>Programme</b></th>
                                                                                        <th><b>Returning Student Reg. Deadline</b></th>
                                                                                         <th><b>New Student Reg. Deadline</b></th>
                                                                                         <th><b>New Current Session</b></th>
                                                                                         <th><b>Returning Current Session</b></th>
                                                                                         <th><b>Current Semester New</b></th>
                                                                                         <th><b>Current Semester Returning</b></th>
                                                                                         <th><b>Registration is Done By</b></th>
                                                                                         <th><b></b></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$counter = 1;
if(empty($results)){echo 'No Registration Deadline has been set';}else{
foreach($results as $data) { //var_dump($data);exit;?>
  <tr class="gradeA">
<td><?php 
echo $counter;
//echo $data->amenity_id ?></td>
<td class="center"><?php if(isset($data["data"]['returning_registration_end']))echo $data["gen_details"]->programme_name; ?></td>
<td class="center"><?php if(isset($data["data"]['returning_registration_end']))echo $data["data"]['returning_registration_end']; ?></td>
<td class="center"><?php if(isset($data["data"]['returning_registration_end']))echo $data["data"]['new_registration_end'] ;?></td>
<td class="center"><?php if(isset($data["data"]['returning_registration_end']))echo $data["data"]['current_session_new'] ?></td>
<td class="center"><?php if(isset($data["data"]['returning_registration_end']))echo $data["data"]['current_session_returning'] ?></td>
<td class="center"><?php if(isset($data["data"]['returning_registration_end']))echo $data["data"]['current_semester_new'] ?></td>
<td class="center"><?php if(isset($data["data"]['returning_registration_end']))echo $data["data"]['current_semester_returning'] ?></td>
<td class="center"><?php if(isset($data["data"]['returning_registration_end']))echo $data["data"]['register_by'] ?></td>

<td>
    
   <a 
      href="<?php echo base_url("admin/deadline/edit/".$data["gen_details"]->programme_id);?>" > <button class="btn btn-info" type="button">Edit</button></a>
   
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
    
        