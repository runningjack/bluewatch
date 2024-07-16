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
              <!-- <button class="btn btn-default" onclick="exportTableToExcel('datatable2', '<?=$title; ?>' )">Excel File</button>                                          -->
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
                                    <td colspan="8"><strong>Project Details</strong></td>
                                    <td colspan="3"><strong>Project Manager Status</strong></td>
                                    <td colspan="3"><strong>Financial Controller Status</strong></td>
                                    <td colspan="3"><strong>Director Status</strong></td>
                                    <td></td>
                                    </tr>
										<tr>
											<th><strong>S/N</strong></th> 
                                            <th><strong>Logged Date</strong></th>
											<th><strong>Project Name</strong></th>
                      
                      <th><strong>Transaction ID</strong></th>
                                            <th><strong>Support Image</strong></th>
                                            <th><strong>Project Task</strong></th>                                            
                                            <th><strong>Amount</strong></th> 
                                             <th><strong>Description</strong></th> 

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
$exp_init = new Projectexpense();
  ?></td>
<td class="center"><?php echo $data->log_date; ?></td>
<td class="center"><?php echo $data->name; ?></td>
<td class="center"><?php echo $data->trans_id; ?></td>
<td class="center"><?php if($data->file_name != 'default.jpg') { ?> <a onclick="return popWindow(this);" href="<?php echo base_url('exp_files/'.$data->file_name) ?>">
<?php  $exp_init->photo($data->file_name); ?>
</a>
<?php } else{ ?>
<p>No File</p>
  <?php } ?>
</td>
<td class="center"><?php echo $data->task_name; ?></td>
<td class="center"><?php echo $data->amount; ?></td> 
 
 <td class="center"><?php echo $data->description; ?></td>

<td class="center"><?php echo $employeelist[$data->project_manager_id]; ?></td>
<td class="center"><strong><?php echo '<span style="color:'.$color[$data->project_manager_status].'">'.$statuselement[$data->project_manager_status].'</span>'; ?></strong></td>
<td class="center"><?php echo $data->project_manager_comment; ?></td>

<td class="center"><?php echo $employeelist[$data->account_controller_id]; ?></td>
<td class="center"><strong><?php echo '<span style="color:'.$color[$data->account_controller_status].'">'.$statuselement[$data->account_controller_status].'</span>'; ?></strong></td>
<td class="center"><?php echo $data->account_controller_comment; ?></td>


<td class="center"><?php echo $employeelist[$data->asssigned_director]; ?></td>
<td class="center"><strong><?php echo '<span style="color:'.$color[$data->director_status].'">'.$statuselement[$data->director_status].'</span>'; ?></strong></td>
<td class="center"><?php echo $data->director_comment; ?></td>




<td>
   <?php
  // var_dump($_SESSION['login_detal']->group_id == 5);exit;
   
   if ($data->project_manager_status != 1 && $_SESSION['login_detal']->group_id == 5 ) {
            ?>
   <a 
      href="<?php echo base_url('admin/projectexpense/projectmanagerupdate/'.$data->proj_exp_id); ?>" > <button class="btn btn-warning" type="button">Approve / Disappprove</button></a>
   
 

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


// function fnExcelReport()
// {
//     var tab_text="<table border='2px'><tr bgcolor='#87AFC6' width='70'>";
//     var textRange; var j=0;
//     tab = document.getElementById('datatable2'); // id of table

//     for(j = 0 ; j < tab.rows.length ; j++) 
//     {     
//         tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
//         //tab_text=tab_text+"</tr>";
//     }

//     tab_text=tab_text+"</table>";
//     tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
//     tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
//     tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

//     var ua = window.navigator.userAgent;
//     var msie = ua.indexOf("MSIE "); 

//     if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
//     {
//         txtArea1.document.open("txt/html","replace");
//         txtArea1.document.write(tab_text);
//         txtArea1.document.close();
//         txtArea1.focus(); 
//         sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
//     }  
//     else                 //other browser not tested on IE 11
//         sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

//     return (sa);
// }
</script>

