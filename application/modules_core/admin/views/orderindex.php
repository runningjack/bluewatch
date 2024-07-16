
 <script type="text/javascript">
     function popWindow(b)
{   var src=b.href;
    var win=null;
    var h=800;
    var w=800;
    var t=parseInt((screen.height-h)/2);
    var l=parseInt((screen.width-w)/2);
    
    var settings="status=1,scrollbars=1,width=800,height=800";
    if(src)
    {
      win=window.open (src,"Profile Details",settings);    
      win.moveTo(t,l);
    }
    return false;
     
}

    </script>
<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Order</h3>
                                                        
      <a href="<?php echo base_url("admin/inventory/neworder");?>">    
          <button class="btn btn-primary" type="button">Add New Order </button></a>
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
											
                                                                                        <th><b>Order Code</b></th>
                                                                                        <th><b>Order Date</b></th>
                                                                                        <th><b>Number of Items</b></th>
                                                                                        <th><b>Total Weight</b></th>
                                                                                        <th><b>Supplier Name</b></th>
                                                                                        <th><b>Created Date</b></th>
                                                                                         <th><b></b></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$counter = 1;
if(empty($results)){echo 'No Unit as been added';}else{
foreach($results as $data) { //var_dump($data);exit;?>
  <tr class="gradeA">
<td><?php 
echo $counter;
//echo $data->amenity_id ?></td>
<td class="center"><?php echo $data->order_code ?></td>
<td class="center"><?php echo $data->order_date ?></td>
<td class="center"><?php echo $data->number_of_items ?></td>
<td class="center"><?php echo $data->total_weight ?></td>
<td class="center"><?php echo $data->supplier_name ?></td>
<td class="center"><?php echo $data->created_date ?></td>

<td>
    
  
<a onClick="return popWindow(this);"  href="<?php echo base_url("admin/inventory/orderbreakdown/".$data->order_id);?>"><button class="btn btn-danger" type="button">Add Break Down</button>
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
    
        