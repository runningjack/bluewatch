<style>
    .even{
        border: 0px solid #ddd;
        background: #f8f8f8;
    }    
    
</style>
<script>
    print();
    </script>
<?php //var_dump($trans_deatails); ?>
    <center>
<table width ="80%" style=" alignment-adjust:  central;">
    <tr>
                           <td width=""><img style="width: 100px;height: 100px;" src="<?php echo  base_url('bootstrap/images/logo2.jpg');?>" ></td>
                           <td width="30" align="center" colspan="4"><h3>Webcoder Frozen Foods</h3>
                             <h4> Ogun State Nigeria <br>
                           PMB 3456 Alakara.</h4></td></tr>  
    
    <tr class="even"><td><strong>Customer Fullname :</strong></td><td><?php echo $trans_status["name"] ?></td>
        <td><strong>Transaction Number :</strong></td><td><?php echo $trans_status["transaction_no"] ?></td></tr>
     <tr class="even"><td><strong>Mobile Number :</strong></td><td><?php echo $trans_status["customer_mobile"] ?></td>
        <td><strong>Address :</strong></td><td><?php echo $trans_status["customer_address"] ?></td></tr>
    <tr><td><strong>Transaction Date :</strong></td><td><?php echo $trans_status["trans_date"] ?></td>
        <td><strong>Amount :</strong></td><td><?php echo number_format( $trans_status["trans_total_amount"],2); ?></td></tr>
    <tr> <td><strong>Amount in Word :</strong></td><td colspan="2" ><?php 
        $transaction_obj = new transactionmodel();
        echo ucfirst(strtolower(trim($transaction_obj->convert_number_to_words($trans_status["trans_total_amount"])))); ?></td></tr>
   
         <tr class="even"><td><strong>Amount Paid :</strong></td><td colspan="4">
        <?php if(isset($previous_amount["amount"]))
            {echo number_format($previous_amount["amount"],2);}  else {
    echo "Not yet paid";
}?></td>
        </tr>
  
</table>
<table  width ="80%"  style=" alignment-adjust:  central;">
    <tr class="even"><td colspan="6"><strong>Payment Breakdown</strong></td>
        </tr>
        <tr><td><strong>Transaction Number</strong></td>
            <td><strong>Items Name</strong></td>
            <td><strong>Weight Unit</strong></td>
            <td><strong>Quantity</strong></td>
            <td><strong>Total Weight</strong></td>
            <td><strong>Price</strong></td>
           </tr>
        <?php //var_dump($trans_deatails);
        if($trans_deatails){ foreach($trans_deatails as $t){?>
    <tr><td><strong><?php echo $t->trans_no; ?></strong></td>
        <td><strong><?php echo $t->unit_name; ?></strong></td>
        <td><strong><?php echo $t->weight; ?></strong></td>
        <td><strong><?php echo $t->quantity; ?></strong></td>
        <td><strong><?php echo $t->total_weight; ?></strong></td>
        <td><strong><?php echo $t->total_trans_amount; ?></strong></td>
           </tr>
        <?php }
        }?>
    
    <tr><td colspan="3">
            <br><br><i>***PAYMENT SHOULD BE MADE AT THE CASHIER DESK</i></td></tr>
</table>
</center>