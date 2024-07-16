       
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
                 <?php
                 if($order_qty){
			       $i = 0;
				foreach ($order_qty as $o){ $i= $i + 1;?>
               <tr >
                 <td width="2%" align="left" valign="top"><?php  echo $i?></td>
                 <td width="20%" align="center"><?php echo $o->inserted_date ;?></td>
                 <td width="5%"  align="center" valign="top"><?php echo $o->weight_id ;?></td>
                 <td width="5%" align="center" valign="top"><?php echo $o->quantity_id ;?></td>
                 <td width="4%" align="center" valign=""><?php  echo ($o->weight_id*$o->quantity_id) ;?></td>
                 </tr>
              
              
              <?php }}else{?>
               <tr class="">
               
                 <td align="center" valign="top">No Record Found</td>
                 </tr>    
                  
             <?php }?>
               </tbody>
               </table>