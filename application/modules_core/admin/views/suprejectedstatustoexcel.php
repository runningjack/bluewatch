
								<table <?php if(!isset($boarder)){?>
                                                                    border='1' <?php }?> >
                                                                    <thead>
										<tr>
                                                                                    <th colspan="8"><b>Supervisor Rejected Transaction</b></th>
                                                                                                                                                                          
										</tr>
									</thead>
									<thead>
										<tr>
											<th><b>S/N</b></th>
                                                                                        <th><b>Full Name</b></th>
							                                <th><b>Transaction Number</b></th>
                                                                                         <th><b>Transaction Date</b></th>
                                                                                         <th><b>Due Date</b></th>
                                                                                        <th><b>Total Amount</b></th>
                                                                                        <th><b>Batch</b></th>
                                                                                         
                                                                                         <th><b>Status</b></th>
                                                                                         <th><b></b></th>
                                                                                        
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
<td class="center"><?php echo $data->name ?></td>
<td class="center"> <a onClick="return popWindow(this);" href="<?php echo base_url("admin/report/transactiondetails/".$data->transaction_no);?>"><?php echo $data->transaction_no ?></a></td>
<td class="center"><?php echo $data->trans_date?></td>
<td class="center"><?php echo $data->payment_duedate?></td>
<td class="center"><?php echo number_format($data->trans_total_amount,2); ?></td>
<td class="center"><?php echo $data->batch_name?></td>
<td class="center"><?php echo $data->status ?></td>
<td class="center"> 


</td>


										
												
<?php $counter++;}
?>
                                                         </tbody>
                                                         </table>
    <p><?php echo $links; ?></p>
    
    <?php } ?> 