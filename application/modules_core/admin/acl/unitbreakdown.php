 <script type="text/javascript">
     function popWindow(b)
{   var src=b.href;
    var win=null;
    var h=450;
    var w=600;
    var t=parseInt((screen.height-h)/2);
    var l=parseInt((screen.width-w)/2);
    
    var settings="status=1,scrollbars=0,width=700,height=550";
    if(src)
    {
      win=window.open (src,"Transaction Details",settings);    
      win.moveTo(t,l);
    }
    return false;
     
}

    </script>

<?php

$unitselement = array();
               $unitselement[''] = '--Select Payment--';
                foreach ($units as $value) {
                    $unitselement[$value->unit_id] = $value->unit_name;
                }
?>
<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Transaction Breakdown by Payment Type</h3>
                                                        
      
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
							 
                                            <?}?><?php $attributes = array( 'id' => 'usersform');
                                              echo form_open('admin/report/unitbreakdown',$attributes);?>
                                                            <table class="table table-bordered" id="" width="50%" >
                                                                    <tr><td><strong>Payment Type:</strong></td><td > <?php echo form_dropdown('unit_id', $unitselement,'','required="" class="form-control"'); ?></td>
                                                                        <td> <input type="submit" name="search" required="" value="Search" class="btn btn-primary"></td></tr>
                                                                   </table>
                                                           <?php echo form_close(); ?> 
								<table class="table table-bordered" id="datatable2" >
									<thead>
										<tr>
											<th><b>S/N</b></th>
                                                                                        <th><b>First Name</b></th>
                                                                                        <th><b>Middle Name</b></th>
                                                                                        <th><b>Last Name</b></th>
                                                                                        <th><b>Gender</b></th>
                                                                                        <th><b>Passport Number</b></th>
                                                                                         <th><b>Payment Type</b></th>
							                                <th><b>Transaction Number</b></th>
                                                                                       
                                                                                          <th><b>Total Amount</b></th>
                                                                                         <th><b>Date</b></th>
                                                                                          <th><b>Status</b></th>
                                                                                        
										</tr>
									</thead>
									<tbody>
<?php
$counter = 1;//var_dump($results);exit;
if(empty($results)){echo 'No transaction as been added';}else{
foreach($results as $data) { ?>
  <tr class="gradeA">
<td><?php 
echo $counter;
//var_dump($data); ?></td>
<td class="center"><?php echo $data->first_name ?></td>
<td class="center"><?php echo $data->last_name ?></td>
<td class="center"><?php echo $data->middle_name ?></td>
<td class="center"><?php echo $data->gender ?></td>
<td class="center"><?php echo $data->passport_number ?></td>
<td class="center"><?php echo $data->unit_name ?></td>
<td class="center"><?php echo $data->trans_no ?></td>
<td class="center"><?php echo number_format($data->trans_amount,2) ?></td>
<td class="center"><?php echo $data->trans_date; ?></td>
<td class="center"><?php 
$trans_detail = transactionmodel::fetch_tran_status($data->trans_no);
if(isset($trans_detail['status']))echo $trans_detail['status']; ?></td>


										
												
<? $counter++;}
?>
                                                         </tbody>
                                                         </table>
    <p><?php echo $links; ?></p>
    
    <?}?> 
 			</div>
       </div>									
			</div>
       </div>
    
        