
    
<div class="col-sm-7 col-md-6">
        <div class="block-flat">
           
          <div class="header">							
            <h3>Add Role</h3>
          </div>
             <div style=" color: red; padding-left: 30px;">
                                                    <?php if(isset($check_database)){ echo $check_database;}?>
                                                    <?php echo validation_errors(); ?></div>
             <?php if(isset($message_error)) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?php } ?>
          <div class="content">
        		 
                   <form action="" method ="POST"> <table class="form">
                        <tr>
                            <td class="label2">
                              
                                    Role Name :
                            </td>
                            <td class="col2">
                                <input type="text" id="role_name" name="role_name" />
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Description :
                            </td>
                            <td class="col2">
                                <textarea class="tinymce" name ="role_des" ></textarea>
                            </td>
                        </tr>
                        <tr><td></td><td><input type="submit" value="Add Role"></td></tr>
                      </table>
                       </form>
                        </div>
        </div>				
      </div>
    