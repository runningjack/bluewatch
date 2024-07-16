<script type="text/javascript">
    function validateForm()
{
    
   startDate = document.getElementById('startDate').value;    
   endDate = document.getElementById('endDate').value;

if (startDate==null || startDate=="")
  {
  alert("Please Select Check In Date");
  return false;
  }
  
  if (endDate==null || endDate=="")
  {
  alert("Please Select Check Out Date");
  return false;
  }
}
    </script>
<!-- start: Slider -->
<section id="slider" class="hidden-phone">

    <div id="sequence-theme">
        <div id="sequence">
            <img class="prev" src="<?php echo base_url('clientbootstrap/images/bt-prev.png');?>" alt="Previous Frame" />
            <img class="next" src="<?php echo base_url('clientbootstrap/images/bt-next.png');?>" alt="Next Frame" />
            <ul>
                <?php 
                if(isset($page_pic)){
                foreach($page_pic as $p){?>
                <li>

                    <h2 class="title"><span>Pro Business Template</span></h2>
                    <h3 class="subtitle"><span>aimed at success</span></h3>

                    <h5 class="subtitle1">Fully CSS3 Animated portfolio (10 styles)</h5>
                    <h5 class="subtitle2">Widgets (Latest Tweets / Flickr Images)</h5>
                    <h5 class="subtitle3">Iconic font - Font Awesome 3.0</h5>
                    <h5 class="subtitle4">AJAX/PHP contact form with validation</h5>

                    <img class="img4" src="<?php echo base_url('clientbootstrap/example/slider2.jpg');?>" alt="" />
                </li>
                <?}}else{?>
                 <li>

                    <h2 class="title"><span>Home Away from Home</span></h2>
                    <h3 class="subtitle"><span>Stay and leave the dream of your life</span></h3>

                    <h5 class="subtitle1">Fully CSS3 Animated portfolio (10 styles)</h5>
                    <h5 class="subtitle2">Widgets (Latest Tweets / Flickr Images)</h5>
                    <h5 class="subtitle3">Iconic font - Font Awesome 3.0</h5>
                    <h5 class="subtitle4">AJAX/PHP contact form with validation</h5>

                    <img class="img4" src="<?php echo base_url('clientbootstrap/example/slider2.jpg');?>" alt="" />
                </li>  
                    
               <? }?>
                
            </ul>
        </div>
        <div id="bookingform" class="container">
           
                <?php $attributes = array( 'id' => 'form','onsubmit' => 'return validateForm()');
              echo form_open('booking/pickroom',$attributes);?>
            <div class="row">
                <div class="span3">

                   
                        <fieldset>
                            <div id="legend" class="">
                                <legend class="">Check In Date</legend>
                            </div>
                            <div class="control-group">

                                <!-- Prepended checkbox -->
                                <label class="control-label">Pick check in date </label>
                                <div class="controls">
                           <input type="text" name="startDate" id="startDate">
                                </div>

                            </div>
                        </fieldset>
            


                </div>
                <div class="span3">

                 
                        <fieldset>
                            <div id="legend" class="">
                                <legend class="">Check Out Date</legend>
                            </div>
                            <div class="control-group">

                                <!-- Select Basic -->
                                <label class="control-label">Pick check out date</label>
                                <div class="controls">
                                    <input type="text" name="endDate" id="endDate">
                                </div>

                            </div>
                         </fieldset>

                

                </div>
                <div class="span3">

                    
                        <fieldset>
                            <div id="legend" class="">
                                <legend class="">Number of Room</legend>
                            </div>


                            <div class="control-group">
                                <label class="control-label">Select of Room</label>

                                <!-- Multiple Checkboxes -->
                                <div class="controls">
                                   <select name="roomno" class="input-xlarge">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>

                            </div>

                        </fieldset>
                 

                </div>
                <div class="span2">

                   
                        <fieldset>
                            <div id="legend" class="">
                                <legend class=""><br/></legend>
                            </div>
                            <div class="control-group">
                                

                                <!-- Button -->
                                <div class="controls">
                                    <br/>
                                    <input type="submit" class="btn btn-primary" name="book" value ="Book Now">
                                   
                                </div>
                            </div>

                        </fieldset>
                   
                </div>


            </div>
          <?php echo form_close(); ?>
        </div>
    </div>

</section>
<!-- end: Slider -->
