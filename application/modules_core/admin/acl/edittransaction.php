<?php

$unitselement = array();
               $unitselement[''] = '--Select Fee Type--';
                foreach ($units as $value) {
                    $unitselement[$value->unit_id] = $value->unit_name;
                }
                
                $quantity_element[''] = '--Select Quantity--';
                for($i=1; $i<=100;$i++){
                    $quantity_element[$i] = $i;
                }  
?>
<div class="row">
				<div class="col-md-10">
					<div class="block-flat">
						<div class="header">							
							<h3>Transaction Page</h3>
                                                        <h3 style=" color: blue;">Transaction ID :
                                                            <input type="hidden" name="tran_id" id="tran_id" value="<?php echo $tran_id ?>" />
                                                            <?php echo $tran_id ?></h3>
                                                        
     
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
							 
            <?}?><?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/transaction/editupdate/'.$tran_id,$attributes);?>
                   <input type="hidden" name="tran_id" id="tran_no" value="<?php echo $tran_id ?>" /> 
                  <div id='errordisplay'></div>
                     <div id='display'>
                     
                     </div>
<table>
                     <tr><td><strong>First Name:</strong></td><td><?php echo form_input($first_name); ?></td>
                         <td><strong>Middle Name:</strong></td><td><?php echo form_input($middle_name); ?></td>
                         <td><strong>Last Name:</strong></td><td><?php echo form_input($last_name); ?></td>
                        
                         </tr>
                         
                          <tr><td><strong>Passport Number:</strong></td><td><?php echo form_input($passport_no); ?></td>
                                      <td><strong>Gender:</strong></td><td>
                                          <select name="gender" id="gender" required=""  style="width: 100%;">
                                               <option value="">-Gender-</option>
                                              <option <?php if($main_trans['gender']=='Male') echo'selected';  ?> value="Male">Male</option>
                                              <option <?php if($main_trans['gender']=='Female') echo'selected';  ?> value="Female">Female</option>
                                  </select></td></tr>
                        <tr> 
                            <td><strong>Payment Type:</strong></td> <td><?php echo form_dropdown('payment_id', $unitselement,$main_trans["unit_id"],'required="" id="payment_id"  class="form-control"'); ?>
                        <td><strong>Amount:</strong></td> <td class="input-group">
                                                                         <span class="input-group-addon">=N=</span>
                                                                                <?php echo form_input($amount); ?>
                                                                        <span class="input-group-addon">.00</span></td>
                        
                         </tr>
                         
                         <tr> <td colspan="8"><input   style="float: right; margin-right: 200px;" class="btn btn-primary"  type='submit' name='submit' value='Complete Transaction'></td>
                     </tr>
                    
                     </table>								
<?php echo form_close(); ?>
                     
                     <div> 
                       <!--  <table >
                        <tr style="background-color: #F9F9F9; font-size: 15px;">
                            <td width='20%'><strong>Payment Type</strong></td><td><strong>Payment Amount</strong></td><td><strong>Quantity</strong></td><td></td></tr>   
                        
                        <tr style="background-color: #F9F9F9; font-size: 15px;">
                            <td><?php echo form_dropdown('unit_id', $unitselement,'','required="" id="unit_id" onchange="loadsubunit()" class="form-control"'); ?></td>
                            <td width='25%'><div id='loadsubunit'></div>
                                
                                <select name='subunit' id='subunit'class="form-control" > 
                                <option>--Please Select Unit--</option>
                                </select></td>
                            <td><?php echo form_dropdown('quantity', $quantity_element,'','required="" id="quantity" class="form-control"'); ?></td>
                            <td><button class='btn btn-primary' onclick="additem();" >Add Item</button></td>
                        </tr> 
                        
                         </table>-->
                     </div>
 			</div>
       </div>									
			</div>
       </div>
    
        
    
    