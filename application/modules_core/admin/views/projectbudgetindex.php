

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Project Budget</h3>
                                                        
     
						</div>
						<div class="content">
							<div class="table-responsive">
                                                           <?php // display sucess message
                if(!empty($_GET['sucess_message'])){?>
                  <div class="alert alert-success alert-white rounded">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<div class="icon"><i class="fa fa-check"></i></div>
<strong>Success!</strong> <?php echo $_GET['sucess_message'];?>!
</div>
                <?php }else
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
											
                                                                                        <th width="20%"><b>Project Name</b></th>
                                                                                        <th><b>Project Code</b></th>
                                                                                         <th><b>Start Date</b></th>
                                                                                          <th><b>End Date</b></th>
                                                                                          <th><b>Budget</b></th>
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
<td class="center"><?php echo $data->name ?></td>
<td class="center"><?php echo $data->start_date ?></td>
<td class="center"><?php echo $data->end_date ?></td>
<td class="center"><?php echo $data->project_code ?></td>
<td class="center"><?php echo $data->budget_amount ?></td>

<td>
     
<a href="<?php echo base_url("admin/projectbudget/setbudget/".$data->id);?>">
<button class="btn btn-danger" type="button">Manage Budget</button>
</a>

<a href="<?php echo base_url("admin/projectbudget/viewbudget/".$data->id);?>">
<button class="btn btn-success" type="button">View Budget</button>
</a>

<a href="<?php echo base_url("admin/projectbudget/viewRevenueIncome/".$data->id);?>">
<button class="btn btn-warning" type="button">Revenue Income</button>
</a>
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
    
        