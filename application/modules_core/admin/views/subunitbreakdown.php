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

$subunitselement = array();
               $subunitselement[''] = '--Select Units--';
                foreach ($subunits as $value) {
                    $subunitselement[$value->subunit_id] = $value->subunit_name;
                }
?>
<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Transaction Breakdown by Sub-Unit</h3>
                                                        
      
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
							 
                                            <?php } ?><?php $attributes = array( 'id' => 'usersform');
                                              echo form_open('admin/report/subunitbreakdown',$attributes);?>
                                                            <table class="table table-bordered" id="" width="50%" >
                                                                    <tr><td><strong>Unit Name:</strong></td><td > <?php echo form_dropdown('subunit_id', $subunitselement,'','required="" class="form-control"'); ?></td>
                                                                        <td> <input type="submit" name="search" required="" value="Search" class="btn btn-primary"></td></tr>
                                                                   </table>
                                                           <?php echo form_close(); ?> 
								<table class="table table-bordered" id="datatable2" >
									<thead>
										<tr>
											<th><b>S/N</b></th>
                                                                                        <th><b>Patient Name</b></th>
							                                <th><b>Transaction Number</b></th>
                                                                                        <th><b>Hospital Number</b></th>
                                                                                        <th><b>Unit</b></th>
                                                                                        <th><b>Items</b></th>
                                                                                         <th><b>Quantity</b></th>
                                                                                        <th><b>Amount per Item</b></th>
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
<td class="center"><?php echo $data->full_name ?></td>
<td class="center"><?php echo $data->trans_no ?></td>
<td class="center"><?php echo $data->hospital_no ?></td>
<td class="center"><?php echo $data->unit_name ?></td>
<td class="center"><?php echo $data->subunit_name ?></td>
<td class="center"><?php echo $data->quantity ?></td>
<td class="center"><?php echo number_format($data->amount_per_item,2) ?></td>
<td class="center"><?php echo number_format($data->total_trans_amount,2) ?></td>
<td class="center"><?php echo $data->trans_date; ?></td>
<td class="center"><?php 
$trans_detail = transactionmodel::fetch_tran_status($data->trans_no);
echo $trans_detail['status']; ?></td>


										
												
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
    
        