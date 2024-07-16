<?
if($_POST){
 Role::addPermition();
    
}

$modules = Role::getModule();
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
                                <input type="text" id="perm_name" name="perm_name" />
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Value :
                            </td>
                            <td class="col2">
                                <input type ="text"  name ="value" id="value" />
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Module :
                            </td>
                            <td class="col2">
                                <select name="module" id ="module">
                                 
                                    <?foreach($modules as $m){?>
                                    <option value ="<?echo $m->module_id;?>"><?echo $m->module_name;?></option>  
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
                                 <option value ="0"> Not Visible</option>   
                                 <option value ="1"> Visible</option>   
                                </select>
                                
                            </td>
                        </tr>
                        <tr><td></td><td><input type="submit"  value="Add Permissions"/></td></tr>
                      </table>
                       </form>
                         </div>
        </div>