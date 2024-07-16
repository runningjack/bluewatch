<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Department Budget Update</h3>
                                                        
     
						</div>
						<div class="content">
							<div class="table-responsive">
                                                           <?php // display sucess message
                                                           if (!empty($sucess_message)) {
                                                               ?>
                                                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $sucess_message; ?>!
							 </div>
                                                           <?php
                                                           }?>
                                                            
                                                            <?php //display error message
                                                      //  var_dump($log_details);
                                                            if (!empty($message_error)) {
                                                                ?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?php
                                                            }?><?php $attributes = array('id' => 'usersform');
              echo form_open('admin/budget/editdepartmentbudget/'.$id, $attributes); ?>
								<table class="table table-bordered" >

<tr>
    <td><strong>Budget Year:</strong></td>
    <td><?php echo $deptbudget->year;?></td>
</tr> 
<tr>
    <td><strong>Department:</strong></td>
    <td><?php echo $deptbudget->title;?></td>
</tr>

<tr>
    <td><strong>Expense Line:</strong></td>
    <td><?php echo $deptbudget->expense_line_name;?></td>
</tr>
 
 


<tr>
<td>
<strong>Budgeted Amount</strong>
</td>
<td>
<input type="number" name="budgeted_amount" id="budgeted_amount" class="form-control" value="<?php echo $deptbudget->budgeted_amount; ?>"/>
</td>
</tr>


<tr><td></td><td><input type='submit' name='submit' value='Update' class="btn btn-primary"></td></tr> 
   
        
        
        </table>

 			</div>
       </div>								<?php echo form_close(); ?>	
			</div>
       </div>