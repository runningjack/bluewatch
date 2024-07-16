<?php
$unitselement = array();
               $unitselement[''] = '--Select Product--';
                foreach ($units as $value) {
                    $unitselement[$value->unit_id] = $value->unit_name;
                }
?>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>New Order Page</h3>
                                                        
     
						</div>
						<div class="form-horizontal"  parsley-validate novalidate>
                 <div class="form-group">
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
							 
            <?php } ?><?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/inventory/neworder',$attributes);?>
								<table style="border: 0;" >
                                                                     <tr style="background-color: #F9F9F9; font-size: 15px;">
                                                                       <td><strong>Product Type</strong></td>
                                                                         <td><?php echo form_dropdown('unit_id', $unitselement,'','required="" id="unit_id" onchange="loadsubunit()" class="form-control"'); ?></td>
                            </tr>
                                                                   
                                                                    <tr><td><strong>Order Date:</strong></td><td>
                                                                        <div >
                  <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
                      <input class="form-control" size="16" type="text" value=""  name="orderDate" id="orderDate" readonly="">
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>					
                </div>
                                                                       </td></tr>
                                                                    <tr><td><strong>Total Number of Items:</strong></td><td><?php echo form_input($totalNumberOfBird); ?></td></tr>
                                                                    <tr><td><strong>Total Weight:</strong></td><td><?php echo form_input($totalWeight); ?></td></tr>
                                                                    <tr><td><strong>Supplier Name:</strong></td><td><?php echo form_input($supplierName); ?></td></tr>
                                                                    <tr><td></td><td><input  class="btn btn-primary"  type="submit" value="Add New Order" name="Submit" /></td></tr> 
                                                                       
                                                                            
                                                                            
                                                                            </table>
<?php echo form_close(); ?>
 			</div>
       </div>									
			</div>
       </div>
    
        