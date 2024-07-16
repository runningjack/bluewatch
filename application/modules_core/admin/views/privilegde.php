<?php 
$rolr_obj = new Role();

$data = $rolr_obj->rolePriviledge($id);


if(isset($_POST) && count($_POST)>0){
  // echo "urray";
  //   var_dump($_POST); exit;
    $rolr_obj->updateRolePermition();
}
 //var_dump($data['role']['role_name']);exit;
?>
<style>
table,td,tr {border: 1px solid #EEEEEE;padding: 2px 5px; }
</style>
<div class="col-sm-10 col-md-10">
        <div class="block-flat">
            
            <?php if((isset($data['role']['group_name']))){?>
                    <form actio ="" method="POST">
        		 <h2><?php echo 'Role : '.$data['role']['group_name'];
                           $role_id = $data['role']['group_id'];?></h2>
                         <table width="80%" style=" margin-top:20px;" >
                             <input type="hidden" name ="role_id" value ="<?php echo $role_id; ?>"/>
                        <thead style="background-color: #6FACDD;color: white;" ><tr>
                               <td width="1%">#</td>  <td><strong>Module</strong></td><td><strong>Decision</strong></td>
                                 </tr></thead>      
                           <?php $coun = 1;
                           foreach($data['perm'] as $r){?>
                             <thead style="background-color: #F9F9F9; font-size: 14px;" ><tr>
                                 <td></td>
                                     <td><?php  echo '<strong>'.$r['module_name'].'</strong>';
                                 $sub = $r['menu'];//var_dump($sub);exit; ?></td>
                                 </tr></thead>
                          <?php foreach($sub as $m){
                             ?>
                             <tr class ="table2">
                             <td><?php echo $coun; ?></td>
                           <td><?php // echo ($m['perm_name']);
                             echo $m['perm_desc'];
                             $acces = $rolr_obj->haveAccess($role_id,$m['perm_name']);
                             //var_dump($acces);//exit;
                           
                           
                             ?></td>  
                           
                               
            <td align="center"><label><input type="radio" name="group_role[<?php echo $m['perm_name']?>]" 
                                             value="0" />No</label>
            <label><input type="radio" name="group_role[<?php echo $m['perm_name']?>]" value="1"  
                         <?php if($acces){echo 'checked="checked"';}?>/>Yes</label>
        </td>   </tr>  
                               
                         <?php $coun++;
                          }
                         
                         }?>  
                          <tr><td></td><td></td><td><input type="submit" class="btn btn-blue" name ="update" value="Update"/></td></tr>   
                         </table>
            </form>  <?php }else{ echo'Invalid Role';} ?>
                         </div>
   
    
    </div>
