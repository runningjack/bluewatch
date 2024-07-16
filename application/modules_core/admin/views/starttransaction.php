<script type="text/JavaScript"> 
    
    function randomNumber(limit){
	return Math.floor(Math.random()*limit);
        
}

function loadsubunit(){
      var unit_id = document.getElementById('unit_id').value;
      $("#loadsubunit").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
     $("#subunit").load("<?php echo base_url('admin/ajax/load_subunit'); ?>",{non: randomNumber(9), valu: unit_id }, function(response, status, xhr){
           
           $("#loadsubunit").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		
    //alert(unit_id); 
    
}

function additem(){
      var unit_id = document.getElementById('unit_id').value;
      var price = document.getElementById('price').value;
      var weight = document.getElementById('weight').value;
      var quantity = document.getElementById('quantity').value;
      var tran_id = document.getElementById('tran_id').value;
     
      if(isNaN(price))
		{
			msg="The price is not a valid number";
                      //  $("#"+price).addClass("errorClass");
                        alert(msg);
			return false;
		}
      if(quantity==''||weight==''||unit_id==''||price==''){
          alert('One of the required field is empty');
          return false; 
      }
      
      $("#loadsubunit").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
     $("#display").load("<?php echo base_url('admin/ajax/additems'); ?>",{non: randomNumber(9), unit_id: unit_id, price: price, weight: weight, quantity: quantity, tran_id: tran_id }, function(response, status, xhr){
          
           document.forms['physical'].unit_id.value = "";
           document.forms['physical'].weight.value = "";
           document.forms['physical'].quantity.value = "";
           document.forms['physical'].price.value = "";
           $("#loadsubunit").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		
    //alert(unit_id); 
    
}
 function deletetran(id){
var tran_id = document.getElementById('tran_id').value;
      
      if(tran_id==''){
          alert('Invalid Transaction ID');
          return false; 
      }
      
      $("#loadsubunit").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
     $("#display").load("<?php echo base_url('admin/ajax/deletitems'); ?>",{non: randomNumber(9), id: id,tran_id: tran_id }, function(response, status, xhr){
           
           $("#loadsubunit").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		
 
 }  
     </script>
<?php

$unitselement = array();
               $unitselement[''] = '--Select Product--';
                foreach ($units as $value) {
                    $unitselement[$value->unit_id] = $value->unit_name;
                }
                
                $quantity_element[''] = '--Select Quantity--';
                for($i=1; $i<=100;$i++){
                    $quantity_element[$i] = $i;
                }  
?>
     <style>
         .errorClass
           {
            background-color:lightgoldenrodyellow;
             border:1px solid red;
           }
     </style>
<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Invoice Page</h3>
                                                        <h3 style=" color: blue;">Transaction ID :
                                                            <input type="hidden" name="tran_id" id="tran_id" value="<?php echo $tran_id ?>" />
                                                            <?php echo $tran_id ?></h3>
                                                        
     
						</div>
						<div class="form-horizontal"  parsley-validate novalidate>
                 <div class="form-group">
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
              echo form_open('admin/transaction/addtransaction',$attributes);?>
                   <input type="hidden" name="tran_id" id="tran_no" value="<?php echo $tran_id ?>" /> 
                  <div id='errordisplay'></div>
                     <div id='display'>
                     
                     </div>
<table>
                     <tr><td><strong>Customer Full Name:</strong></td><td><?php echo form_input($customer_name); ?></td>
                         <td><strong>Mobile Number:</strong></td><td><?php echo form_input($customer_mobile); ?></td>
                         <td><strong>Address:</strong></td><td><?php echo form_input($customer_address); ?></td>
                     </tr>
                         <tr> <td colspan="8"><input   style="float: right;" class="btn btn-primary"  type='submit' name='submit' value='Complete Transaction'></td>
                     </tr>
                    
                     </table>								
<?php echo form_close(); ?>
                     
                     <div> 
                         <form id="physical" method="post" name = "physical" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                         <table >
                        <tr style="background-color: #F9F9F9; font-size: 15px;">
                            <td width='20%'><strong>Product</strong></td><td><strong>Weight</strong></td>
                            <td><strong>Quantity</strong></td><td><strong>Price</strong></td><td></td></tr>   
                        
                        <tr style="background-color: #F9F9F9; font-size: 15px;">
                            <td><?php echo form_dropdown('unit_id', $unitselement,'','required="" id="unit_id" onchange="loadsubunit()" class="form-control"'); ?></td>
                            <td><select id="weight" name="weight" class="form-control"  >
                    <option value="">Select Weight</option>
                   <?php $x =1;
                   for($i=1; $i<=21;$i++){
                           $weightelement[$i] = $x;
                           $x = $x+0.1;?>
                           <option value="<?php echo $x ?>"><?php echo $x ?></option>
             <?php   } ?></select></td>
                            <td><?php echo form_dropdown('amount', $quantity_element,'','required="" id="quantity" class="form-control"'); ?></td>
                            <td><div class="input-group">
                    <span class="input-group-addon">N</span>
                   <?php echo form_input($price); ?>
                    <span class="input-group-addon">.00</span>
                  </div>
                                </td>
                                <td><button class='btn btn-primary' type="button" onclick="additem();" >Add Item</button></td>
                        </tr> 
                        
                         </table>
                             </form>
                     </div>
 			</div>
       </div>									
			</div>
       </div>
    
        