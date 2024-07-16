<?php


$role =  (new Role)->viewSingleRole($id);//var_dump($role);
if(isset($_POST['yes'])){
  (new Role)->deleteRole();  
}
if(isset($_POST['no'])){
 echo "<script type='text/javascript'>window.location.href = '".base_url('admin/accessControlList/rolelist/')."'</script>";
}
if($role){
?>
<div class="col-sm-10 col-md-10">
        <div class="block-flat">
               
                
                <div class="block">
            
<form action="" method="POST">
<div class="message error" >
                                <h5>Warning!</h5>
                                <p><input  type="hidden" value ="<?echo $role['group_id']?>" name ="id" type="id" />
                                    Do you Really Want to Delete <?echo ' '.$role['group_name'];?>.<br/>
                                    <button name="yes">Yes</button><button name="no">No</button>
                                </p>
                            </div>
    </form>
                    </div>
                </div>
    </div>
        <?php }else{
    
    echo "<script type='text/javascript'>window.location.href = '".base_url('admin/accessControlList/rolelist/')."'</script>";

}?>