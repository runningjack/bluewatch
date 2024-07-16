


<div class="col-sm-6 col-md-6">
        <div class="block-flat">
           
          <div class="header">							
            <h3>Delete Guest</h3>
          </div>
             <?php if(isset($message_error)) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?php } ?>
          <div class="content">
              <div class="alert alert-danger alert-white rounded">
		
		<div class="icon"><i class="fa fa-times-circle"></i></div>
		<strong>Warning!</strong>   Do you really want to Delete <Strong>
                    <?php //print_r(($guest_details));
extract($guest_details); echo $Description.' '.$lastname.' '.$middlename ;?></strong>
               
                                		</div>
      <form action="<?php echo base_url("frontdesk/guests/deleteguest/".$id);?>" method="post">
             <div class="form-horizontal"  parsley-validate novalidate>
             
<div>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="submit" name="del" value="Yes" />
<input type="submit" name="del" value="No" />
</div>
             </div>
          </form>

            </div>
          
          </div>
        </div>				
      </div>
    
    