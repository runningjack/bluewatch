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
$group = $_SESSION["login_detal"]->group_id;
//var_dump($group);exit;


?>
<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Pending Transaction</h3>
                                                        
      
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
                                                                                        <th><b>Full Name</b></th>
							                                <th><b>Transaction Number</b></th>
                                                                                         <th><b>Transaction Date</b></th>
                                                                                         <th><b>Due Date</b></th>
                                                                                        <th><b>Total Amount</b></th>
                                                                                         
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

<td class="center"><?php echo $data->status ?></td>
<td class="center">
    <?php if($group==1||$group==15){?> 
    <a href="<?php echo base_url("admin/transaction/edittransaction/".$data->transaction_no);?>" >
        <button class="btn btn-info" type="button">Edit Transaction</button></a>

<a href="<?php echo base_url("admin/report/delete/".$data->transaction_no);?>"><button class="btn btn-danger" type="button">Delete Transaction</button>
    <?php }?>
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
    
        