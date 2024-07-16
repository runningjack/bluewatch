
     
     <?php

$monthelement = array( 
                        'January'=>'January',
                        'Febuary'=>'Febuary',
                        'March' => 'March',
                        'April' => 'April',
                        'May' => 'May',
                        'June' => 'June',
                        'July' => 'July',
                        'August' => 'August',
                        'September' => 'September',
                        'October' => 'October',
                        'November' => 'November',
                        'December' => 'December' );

?>


<div class="col-sm-4 col-md-6">
        <div class="block-flat">
   <?php // display sucess message
                                                           if(!empty($sucess_message)){?>
                                                             <div class="alert alert-success alert-white rounded">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div class="icon"><i class="fa fa-check"></i></div>
                <strong>Success!</strong> <?php echo $sucess_message;?>!
               </div>
                                                           <?php }?>
             <?php if(isset($message_error)) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?php } ?>
        
          <div class="content">
              <?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/settings/finyear',$attributes);?>
             <div class="form-horizontal"  parsley-validate novalidate>
                 <div class="form-group">
                     <fieldset> <legend> Finacial Year Settings </legend>
                          <table style="border: 0;">

						  <tr>
                        <td><label >
                                <strong>Finacial Year :</strong></label></td><td>
                                  <select class="form-control" name="finyear" id="finyear" style="width: 100px;" required>
    <option disabled selected>Select Year</option>
      <?php 
      $cur_year = intval($_SESSION['finacial_year']->year);
      for ($i=($cur_year-2); $i < ($cur_year+3); $i++) { ?>
        <option value="<?php echo $i; ?>"  <?php echo ($cur_year == $i) ? 'selected' : '' ; ?>><?php echo $i; ?></option>
      <?php } ?>
    </select></td>
                         </tr>
                         <tr>
                        <td><label >
                                <strong>Start Month :</strong></label></td><td>
                                  <?php echo form_dropdown('start_month', $monthelement,$_SESSION['finacial_year']->start_month, ' required=""  class="form-control"'); ?> </td>
  
                                </td>
                         </tr>
                   
                       
                    <tr>
                       
                        <td><label >
                                </label></td><td colspan="4"><input type='submit' name='submit' value='Save Settings' class="btn btn-success"></td>
                    </tr>
                                     
                    </table>
                     </fieldset>
                   <?php echo form_close(); ?>
                  </div>     
                    
            </div>
              <?php echo form_close(); ?>
          </div>
        </div>				
      </div>
    
  