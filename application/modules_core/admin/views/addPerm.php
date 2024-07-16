<?php

if ($_POST) {

    
    (new Role)->addPermition();
}

$modules = (new Role)->getModule();
?> 
    

<div class="col-sm-6 col-md-6">
        <div class="block-flat">
        		 <h2>Add Resource</h2>
                   <form action="" method ="POST"> <table class="form">
                        <tr>
                            <td class="label2">
                              
                                    Resources :
                            </td>
                            <td class="col2">
                                <input type="text" id="perm_name" name="perm_name" class="form-control" />
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Value :
                            </td>
                            <td class="col2">
                                <input type ="text"  name ="value" id="value" class="form-control" />
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Module :
                            </td>
                            <td class="col2">
                                <select name="module" id ="module" class="form-control">
                                 
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
                                <select name="visible" id ="visible" class="form-control">
                                 <option value ="0"> Not Visible</option>   
                                 <option value ="1"> Visible</option>   
                                </select>
                                
                            </td>
                        </tr>
                        <tr><td></td><td><input type="submit"  value="Add Permissions" class="btn btn-success" /></td></tr>
                      </table>
                       </form>
                         </div>
        </div>