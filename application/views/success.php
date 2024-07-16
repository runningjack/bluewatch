
<!-- start: Container -->

<div class="container">

    <!-- start: Page header / Breadcrumbs -->
    <section class="breadcrumbs">
        <div class="page-header">
         
        </div>
        <div class="breadcrumbs">
          <h3> Online Booking Status Check Page</h3>
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
      
     <?php $attributes = array( 'id' => 'form');
              echo form_open('booking/success',$attributes);?>
    <fieldset>
           <legend><i style="color: #003bb3;">Check Booking Status by Code</i></legend>
           <div class="input-append">
               <input class="span2" id="code" required="" type="text" name="code">
  <input type="submit" class="btn" name="check" value="Check!">
</div>
        
        </fieldset>
    <?php echo form_close(); ?>


<?php if($details){?>
    <table class="table table-striped">
                    <thead>
                    <tr>
                        
                        <th colspan="5"><center><h3>Booking Information</h3></center></th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    <tr >
                    
                        <td colspan="2"><strong>Full Name :</strong></td>
                        <td colspan="2"><?php echo $details['guest_firstname'].' '.$details['guest_lastname'] ?>
                      </td>
                    </tr>  
                    <tr >
                    <td><Strong>Code :</Strong></td>
                    <td><?php echo $details['booking_code']?></td>
                        <td colspan="3"><Strong>Status : </Strong><?php echo $details['status']?></td>
                        <td>
                        </td>
                    </tr>
                    
                    <tr >
                        
                        <td colspan="4"><center><h3> Room Details</h3></center></td>
                        
                    </tr>
                    <tr style="font-weight: bold;"><td>Room Number</td><td>Room Type</td>
                        <td>Description</td><td>Amount Per Night</td></tr>
                  <?php $counter =1;
                  foreach($room_info as $r){ //var_dump($r->roomtype);?> 
                    <tr><td><?php echo 'Room'.$counter?></td>
                        <td><?php echo $r->roomtype?></td><td><?php echo $r->description?></td><td><?php echo $r->default_amount?></td></tr>
                  
                  <?php  $counter++;}?>
                    
                    </tbody>
                </table>
<?php }else{?>
    <div> No record found </div>
    
    
<?}?>
   

            </section>
        

</div>
            </div>
        </section>
        </div>
    </div>
  
<!-- end: Container -->

<!-- start: Footer -->
<!-- end: Footer -->
</body>


</html>


