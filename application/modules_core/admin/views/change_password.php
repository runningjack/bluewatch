<div class="col-sm-4 col-md-6">
        <div class="block-flat">
           
          <div class="header">							
            <h3>Change Password</h3>
          </div>
             <?php if(isset($_GET['sucess'])) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="sucess" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Success!</strong> <?php echo $_GET['sucess']; ?>
							 </div>
							 
            <?php } ?>
            
             <?php if(isset($_GET['message'])) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $_GET['message']; ?>
							 </div>
							 
            <?php } ?>
            <?php 
             
               
//var_dump($modulesarray);

                
                ?>
          <div class="content">
              <?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/users/changepassword',$attributes);?>
             <div class="form-horizontal"  parsley-validate novalidate>
                 <div class="form-group">
                     <fieldset> <legend></legend>
                          <table style="border: 0;">
                
                        
                        <td><label >
                                <strong>Old Password :</strong></label></td><td><?php echo form_input($form_old); ?> </td>
                                
                    </tr>
                    <tr>
                       <td><label >
                                <strong>New Password :</strong></label></td><td><?php echo form_input($form_password); ?></td> 
                                </tr><tr> 
                        <td><label >
                                <strong>Confirm Password :</strong></label></td><td colspan=""><?php echo form_input($form_confirmpassword); ?></td>
                    </tr>
                    
                  
                
                    <tr>
                       
                        <td><label >
                                </label></td><td colspan="4"><input type='submit' name='submit' value='Update'></td>
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
    
  