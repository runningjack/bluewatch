<html>
    <head>
        <title>
        Order Break Down
        </title>
        <script type="text/javascript">
        </script>
        <style type="text/css">
            html
            {
                width:100%;
                height:100%;
                margin:0px;
                padding:0px;
            }
            body
            {
                padding:0px;
                margin:0px;
                font:13px "lucida grande",arial,sans-serif,helvetica;
                color:#222;
            }
            .page_wrapper
            {
                margin-left:2px;
                margin-right:2px;
                width:auto;
                height:auto;
                border:1px solid #f2f2f2;
            }
            .page_top
            {
                width:auto;
                position:relative;
                margin-left:1px;
                margin-right:1px;
                height:auto;
                background:black;
                color:white;
                padding:4px 4px;
                font-size:12px;
                font-family:"lucida grande",helvetica,arial;
                font-weight:bold;
            }
            select
            {
            font-size:11px;
            }
            .link_block
            {
                margin-left:5px;
                margin-right:5px;
                width:auto;
                height:22px;
                border:1px solid #f6f6f6;
                text-align:right;
                margin-bottom:1px;
            }
            .link_block ul
            {
                margin:0px;
                padding:4px 4px;
                list-style-type:none;
            }
            .link_block ul li
            {
                display:inline;
            }
            .link_block ul li a
            {
                width:auto;
                height:15px;
                padding:3px 4px;
                text-decoration:none;
                color:#666;
                font-weight:bold;
                font-size:11px;
            }
            .link_block ul li a:hover
            {
                color:#222;
                text-decoration:underline;
            }
            .sort_block
            {
                margin-left:5px;
                margin-right:5px;
                width:auto;
                height:23px;
                border-bottom:1px solid #f6f6f6;
            }
            .data_block_panel
            {
                margin-left:5px;
                margin-right:5px;
                width:auto;
                height:420px;
                overflow-y:auto;
                margin-bottom:2px;
                margin-top:5px;
                border:1px solid #f6f6f6;
            }
            .data_block_panel th
            {
                font-size:12px;
                color:white;
                padding:3px 1px;
            }
            .deactivate_block
            {
                display:none;

            }
            .sort_block label
            {
                font-weight:bold;
                font-size:12px;
            }
            .cmd-go
            {
                font-size:11px;

            }
            .indicator_block
            {
                width:auto;
                margin-left:15px;
                margin-right:15px;
                padding:5px 5px;
                height:auto;
                font-weight:bold;
                color:black;
                font-size:11px;
                font-family:tehoma,verdana;
                background-color:#ffebe8;
                border:1px solid #dd3c10;
            }
            .even
            {
                background-color:white;
                font-size:11px;
                font-family:"Lucida Grande",tehoma,verdana,arial;
            }
            .errorClass
           {
            background-color:lightgoldenrodyellow;
             border:1px solid red;
           }
            .button-control
            {
                text-align:right;
                padding:2px 20px;
                background:#ccc;
            }
            .odd
            {
                background-color:#f1f5f6;
                font-size:11px;
                font-family:"Lucida Grande",tehoma,verdana,arial;
            }
			.head
            {
                background-color:gray;
                font-size:11px;
                font-family:"Lucida Grande",tehoma,verdana,arial;
            }
			
			#headrow
         {
           background-color:gray;
             color:white;
            font-family:tehoma,verdana,arial;
            font-size:11px;
            height:18px;
            font-weight:bold;
              }
            .txt
            {
            width:50px;
            }
            .button-input
            {
            font:caption;
            }
            fieldset
            {
             padding:5px;
             margin-top:10px;
             border:1px solid #aaa;
            }
			textarea {
                       
		                 overflow: auto;
		                 margin:2px 0 0 2px;
						 resize:none;
						 width:100%;
                 }
            legend
            {
            font-size:12px;
            color:#222;
            font-weight:bold;
            }
			input.checkbox, input.radio{
	         display:inline;
	         margin:5px 10px 10px 10px;
	         padding:5px;
	         width:13px;
	         height:13px;
                 }
		  .warning
            {
                background-color:white;
				color:red;
                font-size:11px;
                font-family:"Lucida Grande",tehoma,verdana,arial;
            }
			.interview
            {
                background-color:white;
                font-size:11px;
                font-family:"Lucida Grande",tehoma,verdana,arial;
            }
        </style>
<?php 
/*$weightelement = array();             
               
   $weightelement[''] = '--Select Weight--';
 // $weightelement = array(1.1=>,1.2,1.3,1.4,1.5+0.1); 
   $x =1;
    for($i=1; $i<=21;$i++){
                    //echo $x.'<br>';
                    $weightelement[$i] = $x;
                   $x = $x+0.1;
                }  
*/

?>
        <?php echo "<script src='" . base_url('bootstrap/js/jquery.js') . "' type='text/javascript'></script>"; ?>
  
        <?php echo "<script src='" . base_url('bootstrap/js/record/order.js') . "' type='text/javascript'></script>"; ?>
    </head>
    <body>
     <div id="page_wrapper" class="page_wrapper">
        <div id="page_top" class="page_top" style="background-color: #60c060; color:#fff;" >
               Order Record Entry
            </div>
         <?  if(isset($message_error) ){?> <div id="indicator_block"
                     class="indicator_block deactivate_blocks">
                <?php echo $message_error;?>
            </div>
			<? exit;
			}?>
            <form id="physical" method="post" name = "physical" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          
              <fieldset>
             <legend style="background-color: #60c060; color:#fff;">Order Information</legend>
               <table width="99%" border="0">
               <tbody >
                 <tr class="even" valign="top">
                   
                   <td width="13%"><b>Order Code :</b></td>
                   <td width="15%"><?php echo $order_details['order_code'];?></td>
                   <td width="11%"><b>Order Date :</b></td><td width="15%"><?php echo $order_details['order_date'];?></td>
                   <td width="9%"><b>No of Items :</b></td>
                   <td width="23%"><?php echo $order_details['number_of_items'];?></td>
                 </tr>
                 <tr class="even" valign="top">
                 <td height="85"><b>Total Weight :</b></td>
                 <td><?php echo $order_details['total_weight'];?></td>
                 <td><b> Supplier Name :</b></td><td><?php echo $order_details['supplier_name'];?></td>
                 
                 </tr>
               </tbody>
               </table>
               </fieldset>
               <fieldset>
               <legend>REPORT ENTRY</legend>
               <div id= "result" class="box"  >
                   
                   
               <center> <div id= "flash" class="box"  >
                           </div>
                </center>
               <table width="100%">
               <tbody>
              <tr valign="top" id = 'headrow'  style="background-color: #60c060; color:#fff;">
                  <td height="2%" align="center">S/N</td>
                  <td width="20%" align="center">Date</td>
                  <td align="center">Weight</td>
                  <td align="center">Quantity</td>
                  <td width="23%" align="center">Total</td>
                 </tr>
                 <?php //var_dump($order_qty);
                 $sum = 0;
                 if($order_qty){
			       $i = 0;
				foreach ($order_qty as $o){ $i= $i + 1;?>
               <tr >
                 <td width="2%" align="left" valign="top"><?php  echo $i?></td>
                 <td width="20%" align="center"><? echo $o->inserted_date ;?></td>
                 <td width="5%"  align="center" valign="top"><?php echo $o->weight_id ;?></td>
                 <td width="5%" align="center" valign="top"><?php echo $o->quantity_id ;?></td>
                 <td width="4%" align="center" valign=""><?php  $total = $o->weight_id*$o->quantity_id;
                 $sum = $sum +$total;
                 echo $total ;?></td>
                 </tr>
              
              
              <?php }?>
              
               <tr >
                   <td><strong>Total</strong></td>
                   <td width="4%" align="right" colspan="4"><strong><?php 
                
                 echo $sum ;?></strong></td>
                 </tr>
              
              
                               <?php }else{?>
               <tr class="">
               
                 <td align="center" valign="top">No Record Found</td>
                 </tr>    
                  
             <?php }?>
               </tbody>
               </table>
               </div>
               </fieldset>
             <center> <div id= "flash" class="box"  >
                           </div>
                </center>
               <div id="indicator_block" class="indicator_block deactivate_block">Loading...</div>
              <fieldset>
               <legend>Report Preview</legend>
               <table width="100%" border="0" style='background-color:#f1f5f6;'>
               <tbody>
                 <tr class="even">
                     <td width="2%" height="28" rowspan="2">#</td>
                     
                     <td width="15%" align="center"><b>WEIGHT</b></td>
                     <td width="16%" align="center"><b>QUANTITY</b></td>
                     <td width="18%" rowspan="2">&nbsp;</td>
                 </tr>
                 <tr class="even">
                   <td align="center" valign="top">&nbsp;</td>
                   <td align="center" valign="top">&nbsp;</td>
                   <td align="center" valign="top">&nbsp;</td>
                   <td align="center" valign="top">&nbsp;</td>
                 </tr>
                 
                      <tr valign="top" class="odd">
                          <td height="45"></td>
                      <td align="left"> 
                           <?php //echo form_dropdown('weight', $weightelement,'','required="" class="form-control" id="weight"'); ?>
                  <select id="weight" name="weight">
                    <option value="">Select Weight</option>
                   <?php $x =1;
                   for($i=1; $i<=21;$i++){
                           $weightelement[$i] = $x;
                           $x = $x+0.1;?>
                           <option value="<?php echo $x ?>"><?php echo $x ?></option>
             <?php   } ?></select>
                    
                      </td>
                      <td align="center"> 
                          <input  size='8' name="quantity" type="number" id="quantity" class="dateinput" value="">
                        </td>
                      <td><div id='' class="">
                        
                            <input type='hidden' name="id" id='id' value="<?php echo $id;?>"/>
                <input style="background-color: #60c060;border-color: #54a754;width:210px; height: 40px; color:#fff;"
                               type="button" name='cmdupdate'  onclick = "insertorder()" id='cmdupdate' value="Update"/>
                          </div>
                          </td>
                      </tr>
                
               </tbody>
               </table>
               </fieldset>
              
            

            </form>
     </div>
     <?php echo "<script src='" . base_url('bootstrap/js/jquery.js') . "' type='text/javascript'></script>"; ?>
  
        <?php //include("order_js.php"); ?>
    </body>
   </html>
