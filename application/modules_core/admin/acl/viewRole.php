<? $roles =  Role::viewRole();
  //var_dump($roles);
?>
<style>
table,td,tr {border: 1px solid #EEEEEE;padding: 2px 5px; }
</style>
<div class="col-sm-10 col-md-10">
        <div class="block-flat">
        		 <h2>Officer Roles</h2>
                         <table width="100%" style=" margin-top:20px;" >
                             <thead style="background-color: #F9F9F9; font-size: 14px;" ><tr>
                                 <td>S/N</td><td>Role</td><td>Description</td><td>Operation</td></tr></thead>
                           <? $coun = 1;
                           foreach($roles as $r){?>
                          <tr class ="table2">
                          <td><?echo $coun;?></td>    
                           <td><?echo $r->group_name;?></td>  
                           <td><?echo $r->group_description;?></td>
                           <td><a href="<?php echo base_url('admin/accessControlList/deleterole/'.$r->group_id);?>">
                                   <img  title="Delete Role" src="<?php echo base_url('bootstrap/icons/group_delete.png'); ?>"/></a>
                               <a href="<?php echo base_url('admin/accessControlList/editrole/'.$r->group_id);?>">
                                   <img src="<?php echo base_url('bootstrap/icons/group_edit.png'); ?>" title="Edit Role"/></a>
                               <a href="<?php echo base_url('admin/accessControlList/assignpriviledge/'.$r->group_id);?>">
                                   <img src="<?php echo base_url('bootstrap/icons/key_add.png'); ?>" title="Assign Priviledge"/></a>
                           </td>
                          </tr>     
                               
                         <?
                         $coun++;
                         
                         }?>  
                             
                         </table>
                         
                         </div>
      </div>
    
    </div>