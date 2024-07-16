<?php 


$data = Role::rolePriviledge($id);
if(isset($_POST['update'])){
  //  var_dump($_POST);
    Role::updateRolePermition();
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
                               <td width="1%">#</td>  <td><strong>Module</strong></td><td><strong>Decision</strong></td
                                 </tr></thead>      
                           <? $coun = 1;
                           foreach($data['perm'] as $r){?>
                             <thead style="background-color: #F9F9F9; font-size: 14px;" ><tr>
                                 <td></td>
                                     <td><?  echo '<strong>'.$r['module_name'].'</strong>';
                                 $sub = $r['menu'];//var_dump($sub);exit; ?></td>
                                 </tr></thead>
                          <? foreach($sub as $m){
                             ?>
                             <tr class ="table2">
                             <td><? echo $coun; ?></td>
                           <td><? // echo ($m['perm_name']);
                             echo $m['perm_desc'];
                             $acces = Role::haveAccess($role_id,$m['perm_name']);
                             //var_dump($acces);//exit;
                           
                           
                             ?></td>  
                           
                               
            <td align="center"><label><input type="radio" name="group_role[<?echo $m['perm_name']?>]" 
                                             value="0" />No</label>
            <label><input type="radio" name="group_role[<?echo $m['perm_name']?>]" value="1"  
                         <?if($acces){echo 'checked="checked"';}?>/>Yes</label>
        </td>   </tr>  
                               
                         <? $coun++;
                          }
                         
                         }?>  
                          <tr><td></td><td></td><td><input type="submit" class="btn btn-blue" name ="update" value="Update"/></td></tr>   
                         </table>
            </form>  <?php }else{ echo'Invalid Role';} ?>
                         </div>
   
    
    </div>
