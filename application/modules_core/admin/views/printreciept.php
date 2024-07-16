<head>
    <title>HMS V1.0</title>
    
   
   <?php  $meta = array(
            array('name' => 'description', 'content' => 'Upperlink Hotel Management System Version 1.0'),
            array('name' => 'keywords', 'content' => 'Kano,Hotel Reservation System'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
            array('name' => 'viewport', 'content' => 'width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;')
        );
          echo meta($meta);
          echo link_tag('bootstrap/images/logo.png', 'shortcut icon');
    
    echo link_tag('clientbootstrap/css/bootstrap.css');
        
?>

    <?php echo link_tag('clientbootstrap/css/style.css'); 
    echo link_tag('clientbootstrap/css/prettyPhoto.css');
    echo link_tag('clientbootstrap/css/font-awesome.min.css'); ?>
    <!--[if IE 7]>
   <?php echo link_tag('css/font-awesome-ie7.min.css'); ?>
    <![endif]-->
    
    
    

<?php
   echo "<script src='" . base_url('clientbootstrap/js/jquery.min.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/bootstrap.min.js') . "' type='text/javascript'></script>";
   echo "<script src='" . base_url('clientbootstrap/js/jquery.easing.1.3.js') . "' type='text/javascript'></script>";
   echo "<script src='" . base_url('clientbootstrap/js/jquery.quicksand.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/superfish.js') . "' type='text/javascript'></script>";
   echo "<script src='" . base_url('clientbootstrap/js/hoverIntent.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/jquery.flexslider.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/jflickrfeed.min.js') . "' type='text/javascript'></script>";
   echo "<script src='" . base_url('clientbootstrap/js/jquery.prettyPhoto.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/jquery.elastislide.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/jquery.tweet.js') . "' type='text/javascript'></script>";
   echo "<script src='" . base_url('clientbootstrap/js/smoothscroll.js') . "' type='text/javascript'></script>";
  echo "<script src='" . base_url('clientbootstrap/js/jquery.ui.totop.js') . "' type='text/javascript'></script>";
 echo "<script src='" . base_url('clientbootstrap/js/ajax-mail.js') . "' type='text/javascript'></script>";
  echo "<script src='" . base_url('clientbootstrap/js/main.js') . "' type='text/javascript'></script>";?>
  
   
<script >
printWindow();

if (document.layers)
  document.captureEvents(Event.MOUSEDOWN);

document.oncontextmenu = nocontextmenu;
document.onmousedown = norightclick;
document.onmouseup = norightclick;
</script>
<?php
if(isset($trans_details)){ 
  //  var_dump($main_trans);
                         $attributes = array( 'id' => 'usersform');
                        echo form_open('admin/transaction/commit',$attributes);?>
                     <input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>"/>
                     <input type="hidden" name="amount" value="<?php echo $trans_details["trans_total_amount"]-$previous_amount; ?>"/>
                <center>   <table>
                       <tr>
                           <td width="126"><img style="width: 100px;height: 100px;" src="<?php echo  base_url('bootstrap/images/logo2.jpg');?>" ></td>
                           <td width="476" align="center"><h3> Ogun State Muslim Pilgrims Board</h3>
                             <h4> Ogun State Nigeria <br>
                           PMB 3456 Alakara.</h4></td></tr>  
                      <tr><td colspan="3">
                     <center>  <table width="497">
                         
                         
                         <tr><td colspan="3">Transaction Details</td></tr>
                         <tr><td width="269">Passport Number</td><td width="216"><?php  echo $main_trans["passport_number"]?></td></tr>
                         <tr><td width="269">Gender</td><td><?php  echo $main_trans["gender"]?></td></tr>
                         <tr><td width="269">Passport Number</td><td><?php  echo $trans_details["name"]?></td></tr>
                         <tr><td>Transaction Number</td><td><?php  echo $trans_details["transaction_no"]?></td></tr>
                         <tr><td>Previous Payment</td><td>  <?php  echo number_format($previous_amount,2);?></td></tr>
                         <tr><td>Bank Status</td><td><?php  echo $trans_details["status"]?></td></tr>
                         <tr><td>Supervisor Status</td><td><?php  echo $trans_details["supervisor_status"]?></td></tr>
                             </table> </center> 
                        </td></tr>
                      </table>
                        </center> 
                  <?php  echo form_close();
                  
                    }
?>

	         </div>     -