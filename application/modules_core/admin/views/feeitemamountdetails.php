

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Fees Items Amount by Item</h3>
                                                        
     
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
											
							<!--<th><b>Room Number</b></th>-->
											
                                                                                       <th><b>S/N</b></th>
                                                                                        <th><b>Fee Items Name</b></th>
                                                                                        <th><b>Amount</b></th>
                                                                                        <th><b>Session</b></th>
                                                                                        <th><b>Programme</b></th>
                                                                                        <th><b>Faculty</b></th>
                                                                                        <th><b>Department</b></th>
                                                                                        <th><b>Dept Option</b></th>
                                                                                        <th><b>Level</b></th>
                                                                                        <th><b>Entry Mode</b></th>
                                                                                        <th><b>Nationality</b></th>
                                                                                        <th><b>State</b></th>
                                                                                         <th><b></b></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$counter = 1;
if(empty($results)){echo 'No Item as been added';}else{
foreach($results as $data) { //var_dump($data);exit;?>
  <tr class="gradeA">
<td><?php 
echo $counter;
//echo $data->amenity_id ?></td>

<td class="center"><?php echo $data->fee_name ?></td>
<td class="center"><?php echo $data->amount ?></td>
<td class="center"><?php if(!(isset($data->session_name))){echo 'General';}else{echo $data->session_name;} ?></td>
<td class="center"><?php if(!(isset($data->programme_name))){echo 'General';}else{echo $data->programme_name;} ?></td>
<td class="center"><?php if(!(isset($data->faculty_name))){echo 'General';}else{echo $data->faculty_name ;} ?></td>
<td class="center"><?php if(!(isset($data->department_name))){echo 'General';}else{echo $data->department_name ;} ?></td>
<td class="center"><?php if(!(isset($data->programme_option))){echo 'General';}else{echo $data->programme_option;} ?></td>
<td class="center"><?php if(!(isset($data->level_name))){echo 'General';}else{echo $data->level_name ;} ?></td>
<td class="center"><?php if(!(isset($data->entry_name))){echo 'General';}else{echo $data->entry_name ;} ?></td>
<td class="center"><?php if(!(isset($data->nationality))){echo 'General';}else{echo $data->nationality ;} ?></td>
<td class="center"><?php if(!(isset($data->state_name))){echo 'General';}else{echo $data->state_name ;} ?></td>

<td>
    
   <a 
      href="<?php echo base_url("admin/payment/editamount/".$data->fee_id);?>" > <button class="btn btn-info" type="button">Edit</button></a>
   
<a href="<?php echo base_url("admin/payment/deleteamount/".$data->fee_id);?>"><button class="btn btn-danger" type="button">Delete</button>
    </a>
    
 
</td>											
												
<?php $counter++;}
?>
                                                         </tbody>
                                                         </table>
    
    <?php } ?> 
 			</div>
       </div>									
			</div>
       </div>
    
        