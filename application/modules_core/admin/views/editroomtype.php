<?php 
$nocount=array();              
for($i=0;$i<=100;$i++){
                        $nocount[$i] = $i;             
                }
                
  $att ='class="form-control"';
?>


<div class="col-sm-6 col-md-6">
        <div class="block-flat">
           
          <div class="header">							
            <h3>Edit Room Type</h3>
          </div>
             <?php if(isset($message_error)) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?}
             extract($roomtype_details);
            ?>
          <div class="content">
              <?php echo form_open("frontdesk/roomtype/editroomtype/$id");?>
             <div class="form-horizontal"  parsley-validate novalidate>
              <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Room Type:</label>
              <div class="col-sm-7">
               <?php echo form_input($form_roomtype); ?>  
              </div>
              </div>
                 <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Room Description:</label>
              <div class="col-sm-7">
               <?php echo form_input($form_description); ?>  
              </div>
              </div>
              
             
                   <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Default Amount(<i>Number without comma</i>):</label>
              <div class="col-sm-7">
                  <div class="input-group">
                  <span class="input-group-addon">#</span>
               <?php echo form_input($form_default_amount); ?>
                  <span class="input-group-addon">.00</span>
                  </div>
              </div>
              </div>
                 
                  <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Tax in Percentage:</label>
              <div class="col-sm-7">
                   <div class="input-group">
               <?php echo form_dropdown('tax_percentage', $nocount,$tax_percentage,$att); ?> 
                   <span class="input-group-addon">%</span>
                  </div>
              </div>
              </div>
                 
                  <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Service Charge:</label>
              <div class="col-sm-7">
                   <div class="input-group">
               <?php echo form_dropdown('service_charge_percentage', $nocount,$service_charge_percentage,$att); ?> 
                  <span class="input-group-addon">%</span>
                  </div>
              </div>
            </div>
                 
                  <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
               <input type="submit" name="Update" class="btn btn-primary" value="Update Room Type"/>
              </div>
              </div>
                 </div>
              <?php echo form_close(); ?>
          </div>
        </div>				
      </div>
    
    