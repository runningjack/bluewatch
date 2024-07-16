<?php


$perm =  Role::viewSinglePerm($id);
//var_dump($perm);
if(isset($_POST['yes'])){
  Role::deletePerm($id);  
}
if(isset($_POST['no'])){
    
 echo "<script type='text/javascript'>window.location.href = '".base_url('admin/accessControlList/viewperm/')."'</script>";
 
}
if($perm){
?>
<div class="col-sm-10 col-md-10">
        <div class="block-flat">
               
                
                <div class="block">
            
<form action="" method="POST">
<div class="message error" >
                                <h5>Warning!</h5>
                                <p><input  type="hidden" value ="<?echo $perm['perm_id']?>" name ="id" type="id" />
                                    Do you Really Want to Delete <strong> <?echo ' '.$perm['perm_desc'];?></strong>.<br/>
                                    <button name="yes">Yes</button><button name="no">No</button>
                                </p>
                            </div>
    </form>
                    </div>
                </div>
    </div>
<?php }else{ echo 'Invalid Command';}?>