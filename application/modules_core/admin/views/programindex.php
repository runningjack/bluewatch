

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Programme</h3>
                                                        
      <a href="<?php echo base_url("admin/programme/addprogramme");?>">    
          <button class="btn btn-primary" type="button">Add New Programme </button></a>
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
											
                                                                                        <th><b>Programme ID</b></th>
                                                                                        <th><b>Programme Name</b></th>
                                                                                         <th><b></b></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$counter = 1;
if(empty($results)){echo 'No Programme as been added';}else{
foreach($results as $data) { //var_dump($data);exit;?>
  <tr class="gradeA">
<td><?php 
echo $counter;
//echo $data->amenity_id ?></td>
<td class="center"><?php echo $data->programme_id ?></td>
<td class="center"><?php echo $data->programme_name ?></td>

<td>
    
   <a 
      href="<?php echo base_url("admin/programme/edit/".$data->programme_id);?>" > <button class="btn btn-info" type="button">Edit Programme</button></a>
   
<a href="<?php echo base_url("admin/programme/delete/".$data->programme_id);?>"><button class="btn btn-danger" type="button">Delete Programme</button>
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
    
        