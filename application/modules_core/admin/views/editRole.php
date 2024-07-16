<?php

$role =  (new Role)->viewSingleRole($id);
if(isset($_POST['update'])){
    //var_dump($_POST);exit;
    (new Role)->editRole();
}
if($role){
?>

<div class="col-sm-10 col-md-10">
        <div class="block-flat">
        		 <h2>Edit Role</h2>
                   <form action="" method ="POST"> <table class="form">
                        <tr>
                            <td class="label2">
                              
                                    Role Name :
                            </td>
                            <td class="col2">
                                <input type="hidden" name ="id" value="<?echo $role['group_id']?>" />
                                <input type="text" id="role_name" name="role_name" value="<?echo $role['group_name'];?>" />
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Description :
                            </td>
                            <td class="col2">
                                
                                <textarea name ="role_des" cols="30" rows="5"><?php echo trim($role["group_description"]);?></textarea>
                             
                               
                            </td>
                        </tr>
                        <tr><td></td><td><input type="submit" name ="update" value="Update Role"/></td></tr>
                      </table>
                       </form>
                         </div>
        </div>
<?php }else{
    
    echo "<script type='text/javascript'>window.location.href = '".base_url('frontdesk/accessControlList/rolelist/')."'</script>";

}?>