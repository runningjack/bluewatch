
<?php /*?>
<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Transaction Processing</h3>
                                                        
     
						</div>
<?php
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
 
	<div style='height:20px;'></div>  
    <div style="padding: 10px">
		<?php echo $output; ?>
    </div>
    <?php //var_dump($js_files);exit; 
	$i = 0;/*
	foreach($js_files as $file): ?>
    <?php if($i != 0){ ?>    <script src="<?php echo $file; ?>"></script><?php }?>
    <?php 
	$i++;
	endforeach; ?>

</div>

</div>

</div>
 <?php */?>
 
 
 <?php $roles =  (new Role)->viewRole();
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
                           <?php $coun = 1;
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
                               
                         <?php $coun++;
                         
                         }?>  
                             
                         </table>
                         
                         </div>
      </div>
    
    </div>
 