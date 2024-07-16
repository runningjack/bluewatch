
<div class="col-sm-8 col-md-8">
        <div class="block-flat"><br>
        <h2>Edit Task </h2>
<form enctype="multipart/form-data" method="POST" action="<?php echo base_url("admin/manageproject/edittask")."/".$task['task_id'] ?>">
<input type="hidden" name="assign_to_value" id="assign_to_value" value="<?=$task['assigned_to']?>">
<input type="hidden" name="task_name_value" id="task_name_value" value="<?=$task['task_name']?>">
          <table>
                        <tr>
                            <td class="label2">
                              
                                    Project :
                            </td>
                            <td class="col2">
                            <select name="project_id" id ="project_id" class="form-control" required>
                                <option>Select Project</option>
                                 <?php foreach($projects as $m){?>
                                 <option value ="<?php echo $m->id;?>"
                                    <?php if($task['project_id']==$m->id){
                                                echo 'selected';}?>
                                 ><?php echo $m->name;?></option>  
                                 <?php } ?>
                             </select>
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                    Task :
                            </td>
                            <td class="col2">
                            <select name="task_name" id ="task_name" class="form-control" required>
                                 <option>Select task</option>
                                 <!-- <?php foreach($modules as $m){?>
                                 <option value ="<?php echo $m->name;?>"
                                        <?php if($perm['module_id']==$m->module_id){
                                            echo 'selected';}?>
                                         ><?php echo $m->module_name;?></option>  
                                 <?php } ?> -->
                             </select>
                            </td>
                        </tr>
                         <tr>
                            <td class="label2">
                              
                                Describe Task :
                            </td>
                            <td class="col2">
                                <textarea name="task_description" rows="5" id ="task_description"  placeholder="Describe Task" class="form-control"><?=$task['task_description']?></textarea>
                                
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="label2">
                              
                                   Assign to :
                            </td>
                            <td class="col2">
                                <select name="assigned_to" id ="assigned_to" class="form-control" required>
                                 
                                 <?php foreach($modules as $m){?>
                                 <option value ="<?php echo $m->module_id;?>"
                                        <?php if($perm['module_id']==$m->module_id){
                                            echo 'selected';}?>
                                         ><?php echo $m->module_name;?></option>  
                                 <?php } ?>
                             </select>
                                
                            </td>
                        </tr>
                        <tr><td></td><td><input type="submit"  value="Update Task" class="btn btn-success" /></td></tr>
                      </table>
        </form>
        </div>
</div>




<script type="text/javascript">
	$(document).ready(function(){
        $.ajax({
                url: '<?php echo base_url('admin/ajax/projectteammember') .'/'; ?>' + $("#project_id").val(),
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function (res) {
                    //console.log(res);
                    var assign_to = document.getElementById("assigned_to");
                    var assign_to_value = document.getElementById("assign_to_value");
                    $('#assigned_to')
                        .empty();
					

                    for (var i = 0; i < res.length; i++) {
                        var opt = document.createElement('option');
                        //console.log(res[i].Id);
                        opt.value = res[i].id;
                        //console.log(res[i])
                        opt.innerHTML = res[i].first_name + res[i].last_name;
                        
                        assign_to.appendChild(opt);
                        if(res[i].id == assign_to_value.value){
                            console.log(res[i].id, assign_to_value.value)
                            assign_to.selectedIndex = i ;
                        }
                    }
                    //assign_to.value = assign_to_value;

                },
                error: function (err) {
                    //alert('Error occured while fetch notification');
                    console.log(err)
                }
            });
            $.ajax({
                url: '<?php echo base_url('admin/ajax/projecttasks') .'/'; ?>' + $("#project_id").val(),
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function (res) {
                    //console.log(res);
                    var task_name = document.getElementById("task_name");
                    var task_name_value = document.getElementById("task_name_value");
                    $('#task_name')
                        .empty();
					

                    for (var i = 0; i < res.length; i++) {
                        var opt = document.createElement('option');
                        //console.log(res[i].Id);
                        opt.value = res[i].id;
                        opt.innerHTML = res[i].task_name;
                        //console.log(res[i].task_name,task_name_value.value)
                        
                        task_name.appendChild(opt);
                        if(res[i].id == task_name_value.value){
                            task_name.selectedIndex = i;
                        }
                    }

                },
                error: function (err) {
                    //alert('Error occured while fetch notification');
                    console.log(err)
                }
            });
		// $("#project_id").change(function(){
		// 	// alert($(this).val());
			
		// })
	})
	
	</script>