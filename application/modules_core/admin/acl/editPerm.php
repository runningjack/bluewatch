<?
if($_POST){
 Role::editPermition($id);
    
}
$perm = Role::viewSinglePerm($id);

$modules = Role::getModule();
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
                                <input type="hidden" name ="id" value="<?echo $perm ['perm_id']?>">
                                <input type="text" id="perm_name" name="perm_name" value="<?echo $perm ["perm_desc"];?>" />
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Value :
                            </td>
                            <td class="col2">
                                <input type ="text"  size="100" name ="value" id="value"
                                       value ="<?echo $perm ["perm_name"];?>" />
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Module :
                            </td>
                            <td class="col2">
                                <select name="module" id ="module">
                                 
                                    <?foreach($modules as $m){?>
                                    <option value ="<?echo $m->module_id;?>"
                                           <? if($perm['module_id']==$m->module_id){
                                               echo 'selected';}?>
                                            ><?echo $m->module_name;?></option>  
                                    <?}?>
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
                                 <option value ="1" <?if($perm['visible']==0)echo 'selected';?>> Visible</option>   
                                </select>
                                
                            </td>
                        </tr>
                        <tr><td></td><td><input type="submit"  value="Update Permissions"/></td></tr>
                      </table>
                       </form>
                         </div>
        </div>
<?php }else{ echo 'Invalid Request';}?>