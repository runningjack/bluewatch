<?php

//var_dump($taskStatus);exit;
$statuselement = array();
              $statuselement[''] = '--Status Element --';
               foreach ($taskStatus as $value) {//// var_dump($value);exit;
                    $statuselement[$value->status_id]= $value->status;
                }
              
 
//var_dump($statuselement);exit;

 
//var_dump($statuselement);exit;
?>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3><?php echo $result['first_name'].' '.$result['last_name'].' '.$result['middle_name'] ?> Activity Log</h3>
                                                        
     
						</div>
						<div class="form-horizontal"  parsley-validate novalidate>
                 <div class="form-group">
                                                           <?php // display sucess message
                                                           if(!empty($sucess_message)){?>
                                                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $sucess_message;?>!
                                                                <br/>
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
                 <div class="alert alert-success alert-white rounded">
                     
                    <?php 
                    
                    
              $attributes = array( 'id' => 'usersform');
              echo form_open('admin/projectlogs/reviewproject/'.$id,$attributes);
              
             // var_dump($taskStatus);exit;
              ?>
              <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                    <table class='table'>
                        
                         <tr><td width="20%"><strong>Activities Date:</strong></td><td> 
                         <?php 
                         $newDate = date("d-M-Y", strtotime($result['log_date']));
                         echo $newDate; ?></td></tr>

                        <tr><td><strong>Project Name:</strong></td><td> 
                         <?php echo $result['name']  ?></td></tr>
                         <tr><td><strong>Task Name:</strong></td><td> 
                         <?php echo $result['task_name']  ?></td></tr>
                         <tr><td><strong>Number of Hour(s):</strong></td><td> 
                         <?php echo $result['hours']  ?></td></tr>

                        <tr>
                          <td><label >
                                <strong>Status :</strong></label></td><td>
                                    <?php echo form_dropdown('status', $statuselement,'', ' id= "status" required="" class="form-control"'); ?> </td>
                         </tr>

                          <tr>
                          <td><label >
                                <strong>Comment :</strong></label></td>
                                <td>
                                <textarea col="3" row="3" class="form-control" name="comment" id="comment"></textarea>

                                  </td>                
                      
                         <tr>
                            <td colspan="2">
                                 <input type="submit" required="" style=" float: right;" class="btn btn-success" name="reject" id="Add" value="Update Activity"/></td> 
                            </tr>
                     </table>
                        
                        
                  <?php  echo form_close();
       
?>

	         </div>     
                     
 			</div>
       </div>									
			</div>
       </div>
    
        