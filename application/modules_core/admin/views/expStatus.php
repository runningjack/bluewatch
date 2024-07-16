<?php
//var_dump($log_details);exit;
extract($log_details);
?>

<div class="row">
				<div class="col-md-8">
					<div class="block-flat">
						<div class="header">							
							<h3>Expense Log Status</h3>
      
     
						</div>
						<div class="content">
							<div class="table-responsive">
       
								<table class="table table-bordered" >


<tr><td><strong>Transaction ID:</strong></td>
<td> <?php echo $trans_id; ?></td></tr>
 <?php if($stat != 'prj'){?>
<tr><td><strong>Expense Category:</strong></td>
<td> <?php echo $expense_category_name; ?></td></tr>
 
<tr><td><strong>Expense Line : <span id="loadtask"></span>
</strong></td><td> 
<?php echo $expense_line_name; ?>
</td>
</tr> 
 <?php } ?>
<tr><td><strong>Date :</strong></td><td> <?php echo $log_date;  ?> </td></tr>
 


<tr>
<td>
<strong>Amount :</strong>
</td>
<td>
<?php echo number_format($amount,2); ?> 
</td>
</tr>



<tr>
<td>
<strong>File/Receipt/Evidence :</strong>
</td>
<td>

  <?php if($log_details['file_name'] != 'default.jpg') { ?><a onclick="return popWindow(this);" href="<?php echo base_url('exp_files/'.$log_details['file_name']) ?>">
<?php 
$exp_init = $this->generalmodel->photo($log_details['file_name'];
 ?>
</a>
<?php } else{ ?>
<p>No File</p>
  <?php } ?>
 

 
</td>
</tr>
 
 <?php if($stat == 'bau'){?>

 <tr>
 <td>
  <label><strong>HOD Status :</strong></label></td>
 <td>
    <?php   $proj_mana_details = $this->settingsmodel->getEmployeeDetails($log_details['hod_id']); 
            echo $proj_mana_details['first_name'].' '.$proj_mana_details['last_name'].' ('.$taskStatus_arr[$log_details['hod_status']] .') <br/><br/>'.$log_details['hod_comment']; ?>
 </td>
</tr>
<tr>
 <td>
  <label >
       <strong>Finacial Controller Status :</strong></label>
 </td>
 <td><?php   $proj_mana_details = $this->settingsmodel->getEmployeeDetails($log_details['account_controller_id']); 
            echo $proj_mana_details['first_name'].' '.$proj_mana_details['last_name'].' ('.$taskStatus_arr[$log_details['account_controller_status']] .') <br/><br/>'.$log_details['account_controller_comment']; ?>
 </td>
</tr>
<tr>
 <td><label> <strong>Director's Status :</strong></label></td>
 <td><?php   $proj_mana_details = $this->settingsmodel->getEmployeeDetails($log_details['assigned_director']); 
            echo $proj_mana_details['first_name'].' '.$proj_mana_details['last_name'].' ('.$taskStatus_arr[$log_details['director_status']] .') <br/><br/>'.$log_details['director_comment']; ?>
 </td>
</tr>
<?php } ?>

 <?php if($stat == 'adm'){?>

 
<tr>
 <td><label> <strong>Director's Status :</strong></label></td>
 <td><?php   $proj_mana_details = $this->settingsmodel->getEmployeeDetails($log_details['asssigned_director']); 
            echo $proj_mana_details['first_name'].' '.$proj_mana_details['last_name'].' ('.$taskStatus_arr[$log_details['director_status']] .') <br/><br/>'.$log_details['director_comment']; ?>
 </td>
</tr>
<?php } ?>

 <?php if($stat == 'prj'){?>

 <tr>
 <td>
  <label><strong>Project Manager Status :</strong></label></td>
 <td>
    <?php   $proj_mana_details = $this->settingsmodel->getEmployeeDetails($log_details['project_manager_id']); 
            echo $proj_mana_details['first_name'].' '.$proj_mana_details['last_name'].' ('.$taskStatus_arr[$log_details['project_manager_status']] .') <br/><br/>'.$log_details['project_manager_comment']; ?>
 </td>
</tr>
<tr>
 <td>
  <label >
       <strong>Finacial Controller Status :</strong></label>
 </td>
 <td><?php   $proj_mana_details = $this->settingsmodel->getEmployeeDetails($log_details['account_controller_id']); 
            echo $proj_mana_details['first_name'].' '.$proj_mana_details['last_name'].' ('.$taskStatus_arr[$log_details['account_controller_status']] .') <br/><br/>'.$log_details['account_controller_comment']; ?>
 </td>
</tr>
<tr>
 <td><label> <strong>Director's Status :</strong></label></td>
 <td><?php   $proj_mana_details = $this->settingsmodel->getEmployeeDetails($log_details['asssigned_director']); 
            echo $proj_mana_details['first_name'].' '.$proj_mana_details['last_name'].' ('.$taskStatus_arr[$log_details['director_status']] .') <br/><br/>'.$log_details['director_comment']; ?>
 </td>
</tr>
<?php } ?>
        </table>

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
    
        