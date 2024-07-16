<?php
if($_POST){
 (new Role)->editPermition($id);
    
}
$perm = (new Role)->viewSinglePerm($id);

$modules = (new Role)->getModule();
//var_dump($perm);

if($perm){
?> 
    
<div class="col-sm-10 col-md-10">
        <div class="block-flat">
        		 <h2>Edit Resource</h2>
                   <form action="" method ="POST"> 
                       <table class="form">
                        <tr>
                            <td class="label2">
                              
                                    Resources :
                            </td>
                            <td class="col2">
                                <input type="hidden" name ="id" value="<?php echo $perm ['perm_id']?>">
                                <input type="text" id="perm_name" name="perm_name" value="<?php echo $perm ["perm_desc"];?>" />
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Value :
                            </td>
                            <td class="col2">
                                <input type ="text"  size="100" name ="value" id="value"
                                       value ="<?php echo $perm ["perm_name"];?>" />
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Module :
                            </td>
                            <td class="col2">
                                <select name="module" id ="module">
                                 
                                    <?php foreach($modules as $m){?>
                                    <option value ="<?php echo $m->module_id;?>"
                                           <?php if($perm['module_id']==$m->module_id){
                                               echo 'selected';}?>
                                            ><?php echo $m->module_name;?></option>  
                                    <?php } ?>
                                </select>
                                
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="label2">
                              
                                   Status :
                            </td>
                            <td class="col2">
                                <select name="visible" id ="visible">
                                 <option value ="0" > Not Visible</option>   
                                 <option value ="1" <?php if($perm['visible']==0)echo 'selected';?>> Visible</option>   
                                </select>
                                
                            </td>
                        </tr>
                        <tr><td></td><td><input type="submit"  value="Update Permissions"/></td></tr>
                      </table>
                       </form>
                         </div>
        </div> 


<?php }else{ echo 'Invalid Request';}?>