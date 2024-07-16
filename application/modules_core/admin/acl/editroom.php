<script type="text/javascript">
   function beddisplay(x){
       
       if(x==1){
							 document.getElementById('bendcntOne').style.display = 'block';
							 document.getElementById('bendcntTwo').style.display = 'none';
							 document.getElementById('bendcntThree').style.display = 'none';
							 document.getElementById('bendcntFour').style.display = 'none';
							}else if(x==2){
							 document.getElementById('bendcntOne').style.display = 'block';
							 document.getElementById('bendcntTwo').style.display = 'block';
							 document.getElementById('bendcntThree').style.display = 'none';
							 document.getElementById('bendcntFour').style.display = 'none';
							}else if(x==3){
							 document.getElementById('bendcntOne').style.display = 'block';
							 document.getElementById('bendcntTwo').style.display = 'block';
							 document.getElementById('bendcntThree').style.display = 'block';
							 document.getElementById('bendcntFour').style.display = 'none';
							}else{
							 document.getElementById('bendcntOne').style.display = 'block';
							 document.getElementById('bendcntTwo').style.display = 'block';
							 document.getElementById('bendcntThree').style.display = 'block';
							 document.getElementById('bendcntFour').style.display = 'block';
							}
   } 

  /**
	   * Delete the selected amenity from the RoomAmenity select list
	   * and add the value back into the RoomAmenityList pulldown.
	   */
	  function removeRoomAmenitySelected() {
		var elSel = document.getElementById('RoomAmenity');
		var i;
		for (i = elSel.length - 1; i>=0; i--) {
		  if (elSel.options[i].selected) {
			appendAmenityItemList(elSel.options[i].value, elSel.options[i].text);
			elSel.remove(i);
		  }
		}
	  }
	  /** 
	   * When submitting the form, only the selected items are passed as POST variables
	   * back to the from. In order to retrieve what was added to the RoomAmenity select
	   * list, all items must be selected at the "onSubmit" call.
	   */
	  function selectallAmenities() {
		var elSel = document.getElementById('RoomAmenity');
		var i;
    //		alert("Selecting all amenities");
		for (i = elSel.length - 1; i>=0; i--) {
		  elSel.options[i].selected = true;
		}
	  }
	  /** 
	   * Remove the item from the amenity list RoomAmenityList pulldown.
	   * finds the selected item and deletes it from the list
	   */
	  function removeAmenityItem() {
		var elSel = document.getElementById('RoomAmenityList');
		var i;
		for (i = elSel.length - 1; i>=0; i--) {
		  if (elSel.options[i].selected) {
			elSel.remove(i);
		  }
		}
//		elSel.options.length--;
	  }
	  /**
	   * Add the item back into the amenity list RoomAmenityList pulldown.
	   * @param val [in] The value for the option
	   * @param txt [in] The description text from the option
	   */
	  function appendAmenityItemList(val, txt) {
		var elSel = document.getElementById('RoomAmenityList');
		var num = elSel.length + 1;
		var elOptNew = document.createElement('option');
		elOptNew.text = txt;
		elOptNew.value = val;
		if(val) {
		  try {
			elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
		  }
		  catch(ex) {
			elSel.add(elOptNew); // IE only
		  }
		}
	  }
	  /** 
	   * Javascript to add the amenity into the want list
	   * Gets the RoomAmenityList pull down, finds the selected item.
	   * add the item to the RoomAmenity select list and deletes
	   * it from the RoomAmenityList.
	   */
	  function appendAmenity() {
		var AmSel = document.getElementById('RoomAmenityList');
		var i;
		var val;
		var txt;
		for (i = AmSel.length - 1; i>=0; i--) {
		  if (AmSel.options[i].selected) {
			val = AmSel.options[i].value;
			txt = AmSel.options[i].text;
		  }
		}
		var elSel = document.getElementById('RoomAmenity');
		var num = elSel.length + 1;
		var elOptNew = document.createElement('option');
		if(val) {
		  elOptNew.text = txt;
		  elOptNew.value = val;
		  try {
			elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
		  }
		  catch(ex) {
			elSel.add(elOptNew); // IE only
		  }
		  removeAmenityItem();
		}
	  }
//-->	 


	</script>



<div class="col-sm-6 col-md-12">
        <div class="block-flat">
           
          <div class="header">							
            <h3>Add New Room</h3>
          </div>
             <?php if(isset($message_error)) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?}?>
            <?php 
               $roomtypeitem = array();
               $roomtypeitem[''] = '--Select Room Type--';
                foreach ($roomtype as $value) {
                    $roomtypeitem[$value->roomtypeid] = $value->roomtype;
                }
                //var_dump($roomtype);exit;
                $bedtypeitem = array();
                foreach ($beds as $value) {
                    $bedtypeitem[$value->bed_id] = $value->bed_name;
                }
                
                  $roomAmenItem = array();
                foreach ($amenities as $value) {
                    $roomAmenItem[$value->amenity_id] = $value->Description;
                }
                $roomtypejs = 'id="roomtype" onChange="some_function();" class="form-control"';
                
                $noofroomjs = 'id="noofroom" style="width:65px;" onChange="some_function();" class="form-control"';
                
                $noofbedjs = 'id="noofbed" style="width:65px;" onChange="beddisplay(this.value);" class="form-control"';
                
                $bed1 = 'id="bed1" style="width:120px;" class="form-control"';
                $bed2 = 'id="bed2" style="width:120px;" class="form-control"';
                $bed3 = 'id="bed3" style="width:120px;"  class="form-control"';
                $bed4 = 'id="bed4" style="width:120px;"  class="form-control"';
                
                $roomAmenitiesAtt =' id="RoomAmenityList" size="1" class="form-control"';



                $nocount=array();
                
                        for($i=1;$i<5;$i++){
                        $nocount[$i] = $i;             
                }
                
                ?>
          <div class="content">
              <?php $attributes = array( 'id' => 'roomform');
              echo form_open('frontdesk/roommanager/editroom/'.$id,$attributes);?>
             <div class="form-horizontal"  parsley-validate novalidate>
                  <div class="form-group">
                     <label class="col-sm-4 control-label"><strong> File Upload</strong></label>
                <div class="col-sm-7">
      
                    <button data-modal="form-green" class="btn btn-primary btn-flat md-trigger">Upload/Change Room Picture</button>
                    </div>                 
             </div>                 
    <div class="form-group">
                     <label class="col-sm-4 control-label"><strong>Room Image :</strong></label>
                <div class="col-sm-7"><div id="files">
                    <?php if(isset($info['image'])){?>
                        '<img style="height:250px;width:100%;" src="<?php echo base_url('files/'.$info['image']); ?>" align="absmiddle"><?php }?></div>
                    <input type="hidden" name="image" id="image" value="<? echo $info['image']?>" />    
                    </div>
                     </div>
    
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label"><strong>Room Type:</strong></label>
              <div class="col-sm-7"><?php echo form_dropdown('roomtype', $roomtypeitem,$info['roomtypeid'],$roomtypejs); ?>  
              </div>
              </div>
                 <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label"><strong>Room Name:</strong></label>
              <div class="col-sm-7"> <?php echo form_input($form_roomname); ?>   
              </div>
              </div>
                    <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label"><strong>Number of Room:</strong></label>
              <div class="col-sm-7">
                  <?php echo form_dropdown('noofroom', $nocount, $info['noofrooms'],$noofroomjs); ?>
              </div>
              </div>
                 
                 <div class="form-group">
              
                 
                     <label for="inputEmail3" class="col-sm-4 control-label"><strong>Number of Bed:</strong></label>
             <div class="col-sm-7">
                  <?php echo form_dropdown('noofbed', $nocount, '',$noofbedjs); ?>
             </div>
                     <table style=" width:45%; float: right; margin-right:20%; ">            
                      
                      <tr id="bendcntOne" style="display:block"> <td> Bed One Type :</td> <td>  <?php echo form_dropdown('bedtype1', $bedtypeitem,$info['bedtype1'],$bed1); ?></td></tr>
                    <tr id="bendcntTwo" style="display:none"> <td> Bed Two Type :</td> <td>  <?php echo form_dropdown('bedtype2', $bedtypeitem,$info['bedtype2'],$bed2); ?></td></tr>
                     <tr id="bendcntThree" style="display:none"><td> Bed Three Type :</td> <td>  <?php echo form_dropdown('bedtype3', $bedtypeitem,$info['bedtype3'],$bed3); ?></td></tr>
                     <tr id="bendcntFour" style="display:none"><td> Bed Four Type :</td> <td>  <?php echo form_dropdown('bedtype4', $bedtypeitem,$info['bedtype4'],$bed4); ?></td>
                     </tr>
              
                 </table>
               </div>
                    <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label"><strong>Room Occupancy:</strong></label>
              <div class="col-sm-7">
                 <?php echo form_input($form_occupancy); ?>   
              </div>
              </div>
                  <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label"><strong>Room Amenities:</strong></label>
              <div class="col-sm-7">
                <table>
						  <tbody><tr>
							<td style=" width: 40%;">
                     <?php 
                     $roomAmen = 'size="4"  style=" width: 100%;" id="RoomAmenity" multiple="multiple" ';
                     $amen_value =  array();
                    if(($amen)) {foreach ($amen as $a) {
                    $amen_value[$a->amenity_id] = $a->Description;
                    }
                    
                    }
                     echo form_multiselect('RoomAmenity[]', $amen_value, '',$roomAmen); ?>
                    
													
							  
							</td>
							<td>
	 <?php echo form_dropdown('RoomAmenityList', $roomAmenItem, '',$roomAmenitiesAtt); ?>  <br>
							  <input type="button" name="AddAmenity" id="AddAmenity" class="plainButton" value="Add" onclick="appendAmenity();"><br>
							  <input type="button" name="RemoveAmenity" id="RemoveAmenity" class="plainButton" value="Delete" onclick="removeRoomAmenitySelected();">
							</td>
						  </tr>	
						</tbody></table>
              </div>
              </div>
                 
                 <div class="form-group">
                     <label class="col-sm-4 control-label"><strong>Status :</strong></label>
                <div class="col-sm-7">
                  <label class="radio-inline"> <input type="radio" class="icheck" name="status" value="Vacant" 
                      <?php if($info['status']=='Vacant')  { echo 'checked=""'; }?> > Vacant</label> 
                  <label class="radio-inline"> <input type="radio" class="icheck" name="status" value="Reserved"
                              <?php if($info['status']=='Reserved')  { echo 'checked=""'; }?>> Reserved</label> 
                  <label class="radio-inline"> <input type="radio" class="icheck" name="status" value="Occupied"
                              <?php if($info['status']=='Occupied')  { echo 'checked=""'; }?>> Occupied</label> 
                  <label class="radio-inline"> <input type="radio" class="icheck" name="status" value="Unavailable"
                              <?php if($info['status']=='Unavailable')  { echo 'checked="checked"'; }?>>  Unavailable</label> 
                </div>
              </div>
              
                 
              
              <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" name="add" class="btn btn-primary" onclick="selectallAmenities()" value="Update Room"/>
              </div>
              </div>
            </div>
              <?php echo form_close(); ?>
          </div>
        </div>				
      </div>
    
   <div class="md-modal md-dark custom-width md-effect-9" id="form-green">
                    <div class="md-content">
                  <form method="post" action="" id="upload_file">    <div class="modal-header">
                        <h3>Upload Room Picture</h3>
                        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body form">
                        <div class="form-group">
                          <label>Select File to Upload</label>
                          <input type="file" name="userfile" id="userfile" size="20" />          </div>
                       
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-flat md-close" data-dismiss="modal" onclick="upload();">Send to Server</button>
                      </div>
                    </div>
                  </form>
                </div>