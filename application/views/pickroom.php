<?php 
               $roomtypeitem = array();
               
                foreach ($roomtype as $value) {
                    $roomtypeitem[$value->roomtypeid] = $value->roomtype.'(#'.$value->default_amount.')';
                }
                
                $roomtypejs = 'id="roomtype" onChange="some_function();" class="form-control"';
                
                
                $countryelement = array();
               $countryelement[''] = '--Select Country--';
                foreach ($country as $value) {
                    $countryelement[$value->countryid] = $value->country;
                }
                ?>
<!-- start: Container -->
 <?php $attributes = array( 'id' => 'form');
              echo form_open('booking/bookroom',$attributes);?>
<div class="container">

    <!-- start: Page header / Breadcrumbs -->
    <section class="breadcrumbs">
        <div class="page-header">
         
        </div>
        <div class="breadcrumbs">
          <h3> Online Booking System</h3>
        </div>
    </section>
    <!-- end: Page header / Breadcrumbs -->

    <div class="row">

        <!-- start: Page section -->
        <section id="page-sidebar" class="span12">


        <!-- Docs nav
        ================================================== -->
        <div class="row">
        <div class="span3 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
                <li><a href="#global"><i class="icon-chevron-right"></i> Tourist Board</a></li>
                <li><a href="#gridSystem"><i class="icon-chevron-right"></i>History of Kano</a></li>
                <li><a href="#fluidGridSystem"><i class="icon-chevron-right"></i>Recreation Centers</a></li>
                <li><a href="#layouts"><i class="icon-chevron-right"></i> Layouts</a></li>
                <li><a href="#responsive"><i class="icon-chevron-right"></i> Responsive design</a></li>
            </ul>
        </div>
        <div class="span9">

<section>
<br/>
    <table class="table table-striped">
                    <thead>
                    <tr>
                        
                        <th colspan="2"><center><h3>Booking Information</h3></center></th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    <tr >
                    
                        <td>Checkin Date :</td>
                        <td><?php echo $checkin ?>
                        <input type="hidden" name="checkindate" value="<?php echo $checkin ?>"></td>
                    </tr>
                    <tr >
                        
                        <td>Check out Date :</td>
                        <td><?php echo $checkout; ?>
                        <input type="hidden" name="checkoutdate" value="<?php echo $checkout ?>">
                        </td>
                    </tr>
                    <tr >
                        
                        <td>Number of Room :</td>
                        <td><?php echo $noguest; ?>
                        <input type="hidden" name="roomno" value="<?php echo $noguest ?>">
                        </td>
                    </tr>
                    
                    </tbody>
                </table>

   <table class="table table-striped">
                    <thead>
                    <tr>
                        
                        <th colspan="2"><center><h3>Room Details</h3></center></th>
                       
                    </tr>
                    
                    </thead>
                    <tbody>
                        <tr><td><strong>Room Number</strong></td><td><strong>Room Type</strong></td></tr>
                        <?php // echo count($noguest);exit;
                        $noguest = (int)$noguest;
                        for($i=1;$i<=$noguest;$i++){?>
                         <tr><td>Room <?php echo $i;?></td><td>
                             <?php echo form_dropdown('roomtype[]', $roomtypeitem, '',$roomtypejs); ?> </td></tr>
                             <?php }
                             ?>
                    </tbody>
                    
                    </table>

<table class="table table-striped">
                    <thead>
                    <tr>
                        
                        <th colspan="2"><center><h3>Quest Information</h3></center></th>
                       
                    </tr>
                    
                    </thead>
                    <tbody>
                        <tr><td>
                               <strong>First Name *: </strong><input type="text" class="input-large"  required="" id="firstname" name="firstname" ></td><td>
                               <strong> Last Name *:</strong> <input type="text" class="input-large"  required="" id="othername" name="othername" ></td></tr>
                        <tr><td><strong>Nationality *:</strong></td><td colspan="5">
                        <?php echo form_dropdown('nationality', $countryelement, '','required="" class="form-control"'); ?></td></tr>
                       
                       <tr><td><strong>City *:</strong></td><td>
                                <input type="text" class="input-large" required="" id="city" name="city" ></td>
                           </tr>
                           
                           <tr><td><strong>Address *:</strong></td><td>
                                <textarea rows="3" name="address" required="" required=""id="address"></textarea></td>
                           </tr>
                           
                            <tr><td><strong>Email *:</strong></td><td>
                                <input type="email" class="input-large" required="" id="email" name="email" ></td>
                           </tr>
                        <tr><td><strong>Mobile Number *:</strong></td><td>
                                <input type="text" class="input-large" required="" id="mobile" name="mobile" ></td>
                           </tr>
                           <tr><td><strong>Estimated check-in Time *:</strong></td><td>
                                <input type="text" class="input-large" required="" id="time" name="time" ></td>
                           </tr>
                           
                           <tr><td><strong>Instruction :</strong></td><td>
                                <textarea rows="3" name="instruction" required="" id="instruction"></textarea></td>
                           </tr>
                            <tr>
                                <td></td><td><input type="checkbox" required="" value="1" id="terms" name="terms">
                                <a style="cursor: pointer" onclick="window.open('<?php echo base_url("booking/terms/")?>', 'cbbooking_terms', 'resizable=yes, width=400, height=400, scrollbars=yes')">
                                    I agree with the terms and conditions</a>
                                </td>
                           </tr>
                           
                           <tr><td></td><td>
                              <input type="submit" name="submit" class="btn btn-primary" value="Continue">  <button type="button" class="btn">Cancel</button></td>
                           </tr>
                           
  
                    </tbody>
                    
                    </table>



            </section>
        

</div>
            </div>
        </section>
        </div>
    </div>
  <?php echo form_close(); ?>
<!-- end: Container -->

<!-- start: Footer -->
<!-- end: Footer -->
</body>


</html>


