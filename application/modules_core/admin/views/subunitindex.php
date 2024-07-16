

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Sub Unit</h3>
                                                        
      <a href="<?php echo base_url("admin/subunit/add");?>">    
          <button class="btn btn-primary" type="button">Add New Sub Unit </button></a>
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
                                                                                        <th><b>Unit Name</b></th>
							                                <th><b>Unit Code</b></th>
                                                                                         <th><b>Sub-Unit Code</b></th>
                                                                                        <th><b>Sub-unit Name</b></th>
                                                                                          <th><b>Cost(=N=)</b></th>
                                                                                         <th><b></b></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$counter = 1;
if(empty($results)){echo 'No Sub-Unit as been added';}else{
foreach($results as $data) { //var_dump($data);exit;?>
  <tr class="gradeA">
<td><?php 
echo $counter;
//var_dump($data); ?></td>
<td class="center"><?php echo $data->unit_name ?></td>
<td class="center"><?php echo $data->unit_code ?></td>
<td class="center"><?php echo $data->subunit_code ?></td>
<td class="center"><?php echo $data->subunit_name ?></td>
<td class="center"><?php echo $data->cost ?></td>


<td>
    
   <a 
      href="<?php echo base_url("admin/subunit/edit/".$data->subunit_id);?>" > <button class="btn btn-info" type="button">Edit Sub-Unit</button></a>
   
<a href="<?php echo base_url("admin/subunit/delete/".$data->subunit_id);?>"><button class="btn btn-danger" type="button">Delete Sub-Unit</button>
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
    
        