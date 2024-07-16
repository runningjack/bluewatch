<?php
$expHeaderelement = array();
$expHeaderelement[''] = '--Select Revenue Header.--';
foreach ($getRevenueHead as $value) { //var_dump($getRevenueHead);exit;
  $expHeaderelement[$value->revenue_head] = $value->revenue_head;
}

?>
<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Project Revenue Income(<?php print($project_details['name']) ?>)</h3> <br>
                            <button type="button" data-toggle="modal" data-target="#addtask" class="btn btn-primary" id="import">Add Income</button>
                                                        
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
											
                                                                                        <th width="20%"><b>Revenue Header</b></th>
                                                                                        <th><b>Amount</b></th>
                                                                                         <th><b>Date</b></th>
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
<td class="center"><?php echo $data->revenu_header ?></td>
<td class="center"><?php echo number_format($data->rev_amount,2); ?></td>
<td class="center"><?php echo $data->rev_date ?></td> 

<td>
     
<a href="<?php echo base_url("admin/projectbudget/deleteprojectrev/".$data->project_rev_id."/".$project_id);?>">
<button class="btn btn-danger" type="button">Delete</button>
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


	   <div id="addtask" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title">Add Revenue</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form enctype="multipart/form-data" method="POST" action="<?php echo base_url("admin/projectbudget/addrevenue") ?>">
          <table>
                        <tr>
                            <td class="label2">
                              
                                    Revenue Header :
                            </td>
                            <td class="col2">
							<?php echo form_dropdown('revenu_header', $expHeaderelement, '', ' required="" class="form-control budget_percent" id="revenue_deader"'); ?>
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Amount :
                            </td>
                            <td class="col2">
                            <input type="number" name="rev_amount"  min="0.00" max="10000000000.00" step="0.01"  class="form-control" id="rev_amount" />
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">                              
                                Date :
                            </td>
                            <td class="col2">
                               <input type="date" name="rev_date" id="rev_date" class="form-control" /> 
                            </td>
                        </tr>
                        <input type="hidden" id="project_id" name="project_id" value="<?php echo $project_id ?>">
                   
                        <tr><td></td><td><input type="submit"  value="Recognize Income" class="btn btn-success" /></td></tr>
                      </table>
          <!-- <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="saveUpload">Import</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div> -->
        </form>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
  </div>
    
        