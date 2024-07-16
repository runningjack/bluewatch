<?php
$statuselement = array();
    foreach ($task_status as $value) {//// var_dump($value);exit;
        $statuselement[$value->status_id]= $value->status;
    }
//var_dump($statuselement);exit;

?>

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
            <h3><?=$title; ?> </h3> <br>
              <iframe id="txtArea1" style="display:none"></iframe>
              <button class="btn btn-primary" id="btnExport" onclick="fnExcelReport()">Export to Excel</button>
                                                        
 
						</div>
						<div class="content">
							<div class="table-responsive">
                      <?php // display sucess message
                                                           if ($this->session->flashdata('sucess_message')) {
                                                               ?>
                                                             <div class="alert alert-success alert-white rounded">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div class="icon"><i class="fa fa-check"></i></div>
                <strong>Success!</strong> <?php echo $this->session->flashdata('sucess_message'); ?>!
               </div>
                                                           <?php
                                                           }?>
                                                           <?php // display sucess message
                                                           if (!empty($sucess_message)) {
                                                               ?>
                                                             <div class="alert alert-success alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-check"></i></div>
								<strong>Success!</strong> <?php echo $sucess_message; ?>!
							 </div>
                                                           <?php
                                                           }?>
                                                            
                                                            <?php //display error message
                                                            if (!empty($message_error)) {
                                                                ?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?php
                                                            }

                                                         //var_dump($results); exit;

                                                            ?>
								<table class="table table-bordered" id="datatable2" >
									<thead>
                                    <tr align="center" style="background-color: darkblue;color: #fff;">
                                    <td colspan="7"><strong>Expense Details</strong></td>
                                    <td colspan="3"><strong>HOD Status</strong></td>
                                    <td colspan="3"><strong>Financial Controller Status</strong></td>
                                    <td colspan="3"><strong>Director Status</strong></td>
                                    <td></td>
                                    </tr>
										<tr>
											<th><strong>S/N</strong></th> 
                                            <th><strong>Logged Date</strong></th>
                                            <th><strong>Transaction ID</strong></th> 
                                            <th><strong>Support Image</strong></th>
                                            <th><strong>Expense Cat.</strong></th>
                                            <th><strong>Expense Line</strong></th>
                                            <th><strong>Amount</strong></th> 

                                            <th><strong>Name</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Comment</strong></th>

                                            <th><strong>Name</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Comment</strong></th>

                                            <th><strong>Name</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Comment</strong></th>

 
                                            <th></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$color = array(1 => 'green', 2 => 'red', 3 => 'yello', 4 => 'blue');
$counter = 1;
if (empty($results)) {
    echo 'No Room Type was set';
} else {
    foreach ($results as $data) { //var_dump($data);exit;
        ?>
  <tr class="gradeA">
<td><?php
echo $counter;
$exp_init = new bauexpense();
  ?></td>
<td class="center"><?php echo $data->log_date; ?></td> 
<td class="center"><?php echo $data->trans_id; ?></td> 
<td class="center"><?php if($data->file_name != 'default.jpg') { ?> <a onclick="return popWindow(this);" href="<?php echo base_url('exp_files/'.$data->file_name) ?>">
<?php  $exp_init->photo($data->file_name); ?>
</a>
<?php } else{ ?>
<p>No File</p>
  <?php } ?>
</td>
<td class="center"><?php echo $data->expense_category_name; ?></td> 
<td class="center"><?php echo $data->expense_line_name; ?></td>
<td class="center"><?php echo number_format($data->amount,2); ?></td> 
 

<td class="center"><?php echo $employeelist[$data->hod_id]; ?></td>
<td class="center"><strong><?php echo '<span style="color:'.$color[$data->hod_status].'">'.$statuselement[$data->hod_status].'</span>'; ?></strong></td>
<td class="center"><?php echo $data->hod_comment; ?></td>

<td class="center"><?php echo $employeelist[$data->account_controller_id]; ?></td>
<td class="center"><strong><?php echo '<span style="color:'.$color[$data->account_controller_status].'">'.$statuselement[$data->account_controller_status].'</span>'; ?></strong></td>
<td class="center"><?php echo $data->account_controller_comment; ?></td>


<td class="center"><?php echo $employeelist[$data->asssigned_director]; ?></td>
<td class="center"><strong><?php echo '<span style="color:'.$color[$data->director_status].'">'.$statuselement[$data->director_status].'</span>'; ?></strong></td>
<td class="center"><?php echo $data->director_comment; ?></td>




<td>
   <?php
  // var_dump($_SESSION['login_detal']->group_id == 5);exit;
   
   if ($data->hod_status != 1 && $_SESSION['login_detal']->group_id == 4 ) {
            ?>
   <a 
      href="<?php echo base_url('admin/bauexpense/hodmanagerupdate/'.$data->bau_exp_id); ?>" > <button class="btn btn-warning" type="button">Approve / Disappprove</button></a>
   
 

   <?php
        } ?>
</td>											
												
<?php ++$counter;
    } ?>
                                                         </tbody>
                                                         </table>
    <p><?php echo $links; ?></p>
    
    <?php
}?> 
 			</div>
       </div>									
			</div>
       </div>
    
  
<script type="text/javascript">
function popWindow(b)
{   var src=b.href;
    var win=null;
    var h=550;
    var w=850;
    var t=parseInt((screen.height-h)/2);
    var l=parseInt((screen.width-w)/2);
    
    var settings="status=1,scrollbars=1,width=850,height=550";
	if(src)
	{
	  win=window.open (src,"STUDENT INFORMATION",settings);	
	  win.moveTo(t,l);
	}
	return false;
	 
}
</script>