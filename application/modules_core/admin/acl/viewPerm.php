<? 

$data = Role::viewPerm();

?>
<style>
table,td,tr {border: 1px solid #EEEEEE;padding: 2px 5px; }
</style>
<div class="col-sm-10 col-md-10">
        <div class="block-flat">
            
                    <form actio ="" method="POST">
        		 <h2>Permission Control</h2>
                         <table width="80%" style=" margin-top:20px;" >
                            
                            
                           <? $coun = 1;//var_dump($data["perm"]);exit;
                           foreach($data["perm"] as $r){?>
                             <thead style="background-color: #F9F9F9; font-size: 14px;" ><tr>
                                 <td></td>
                                     <td><?  echo '<strong>'.$r['module_name'].'</strong>';
                                 $sub = $r['menu']; ?></td>
                                 </tr></thead>
                          <? 
                          
                          foreach($sub as $m){
                             ?>
                             <tr class ="table2">
                             <td><? echo $coun; ?></td>
                           <td><? // echo ($m['perm_name']);
                             echo $m['perm_desc'];
                             ?></td> 
                      <td align="center">
                        <?echo $m['perm_name'];?> 
                       </td>
                    <td align="center">
                       <?
                       
                       if($m['visible']=='1'){echo 'Visible';}else{echo 'Invisible';}?>   
                       </td>
                             
                             <td>
                                 
                           
                             
                             <a href="<?php echo base_url('admin/accessControlList/deleteperm/'.$m['id']);?>">
                                   <img  title="Delete Role" src="<?php echo base_url('bootstrap/icons/group_delete.png'); ?>"/></a>
                               <a href="<?php echo base_url('admin/accessControlList/editperm/'.$m['id']);?>">
                                   <img src="<?php echo base_url('bootstrap/icons/group_edit.png'); ?>" title="Edit Role"/></a>
                               
                          
                             </td></tr>  
                               
                         <? $coun++;
                          }
                         
                         }?>  
                          <tr><td></td><td></td><td><input type="submit" class="btn btn-blue" name ="update" value="Update"/></td></tr>   
                         </table>
                        </form>  
                         </div>
   
    
    </div>
