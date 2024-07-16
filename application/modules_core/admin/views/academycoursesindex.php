

<div class="row">
				<div class="col-md-13">
					<div class="block-flat">
						<div class="header">							
							<h3>Manage Courses</h3>

                                                        
      <a href="<?php echo base_url("admin/academycourses/add");?>">    
          <button class="btn btn-primary" type="button">Add New Courses </button></a>
          
           <form action="<?php echo base_url("admin/academycourses/index");?>" method="POST">
            <table><tr><td><strong>Advance Search:</strong></td><td><input type="text" name="search" id="search" /></td>
                    <td><input type="submit" name="submit"  width="200px" value="Search" class="btn btn-primary" /></td></tr></table>
     
     </form>
						</div>
                                            
						<div class="content">
							<div class="table-responsive">
                                                           <?php // display sucess message
                                                           if(!empty($sucess_message)){?>
                                                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $sucess_message;?>!
							 </div>
                                                           <?php }?>
                                                            
                                                            <?php //display error message
                                                            if(!empty($message_error)) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?php } ?>
								<table class="table table-bordered" id="datatable2" >
									<thead>
										<tr>
											<th><b>S/N</b></th>
							<!--<th><b>Room Number</b></th>-->
											
                                                                                        <th><b>ID</b></th>
                                                                                         <th><b>Course Code</b></th>
                                                                                          <th><b>Course Title</b></th>
                                                                                        <th><b>Department</b></th>
                                                                                         <th><b>Unit</b></th>
                                                                                        
                                                                                         <th><b>Level </b></th>
                                                                                         <th><b>Semester</b></th>
                                                                                        
                                                                                         <th><b></b></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$counter = 1;
if(empty($results)){echo 'No Course of Studey as been added';}else{
foreach($results as $data) { //var_dump($data);exit;?>
  <tr class="gradeA">
<td><?php 
echo $counter;
//echo $data->amenity_id ?></td>
<td class="center"><?php echo $data->course_id ?></td>
<td class="center"><?php echo $data->course_code ?></td>
<td class="center"><?php echo $data->course_title ?></td>
<td class="center"><?php echo $data->department_name ?></td>
<td class="center"><?php echo $data->course_unit ?></td>

<td class="center"><?php echo $data->level_name ?></td>
<td class="center"><?php echo $data->semester ?></td>

<td>
    
   <a 
      href="<?php echo base_url("admin/academycourses/edit/".$data->course_id);?>" > <button class="btn btn-info" type="button">Edit</button></a>
   
<a href="<?php echo base_url("admin/academycourses/delete/".$data->course_id);?>"><button class="btn btn-danger" type="button">Delete</button>
</td>											
												
<?php $counter++;}
?>
                                                         </tbody>
                                                         </table>
    <p><?php echo $links; ?></p>
    
    <?php } ?> 
 			</div>
       </div>									
			</div>
       </div>
    
        