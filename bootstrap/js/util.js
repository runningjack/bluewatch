  function loadRooms(){
      
       roomtype = document.getElementById('roomtype').value; 
       var myData = "roomtype=" + roomtype;
     //alert(roomtype);
       
        $.ajax({
            type: "POST",
            url             :'http://localhost/kano/frontdesk/ajax/loadAvailableRoom/',
            data            : myData,
            success : function (data)
            {
               // alert("AJAX call successful and this data was returned: " + data);
                document.getElementById("course_display").innerHTML = data;
               // alert(data.msg);
               
              //  $("#course_display").append(data);

            }
        });
        return false;
    }
    function loadRoomProperty(){
      
       room = document.getElementById('room').value; 
       discount = document.getElementById('discount').value; 
     //  alert(room);
       if(room==""){
          alert('No room was selected');
          return false; 
       }
       var myData = "room=" + room;
       
        myData+=  "&discount=" + discount ;
        
       removeRoomItem();
       
        $.ajax({
            type: "POST",
            url             :'http://localhost/kano/frontdesk/ajax/loadRoomProperty/',
            data            : myData,
            success : function (data)
            {
               // alert("AJAX call successful and this data was returned: " + data);
             //   document.getElementById("room_property").innerHTML = data;
               // alert(data.msg);
               
              $("#room_property").append(data);

            }
        });
        return false;
    }
	
	  /** 
	   * Remove the item from the amenity list RoomAmenityList pulldown.
	   * finds the selected item and deletes it from the list
	   */
	  function removeRoomItem() {
	  //alert('am here');
		var elSel = document.getElementById('room');
		var i;
		for (i = elSel.length - 1; i>=0; i--) {
		  if (elSel.options[i].selected) {
			elSel.remove(i);
		  }
		}
//		elSel.options.length--;
	  }
          
          
function validateFirst(){
    
var checker = document.getElementById('check_out');
if(checker==null){
    alert('Please Select a Room');  
    
      return false;
    
}else{
document.getElementById("checkinForm").submit();

}
  
}

function update_total(amount,qty,total) {
   
amount = document.getElementById('amount').value;  
qty = document.getElementById('qty').value;  
   
	
		var net_total = qty * amount;
		document.forms['others'].total.value = "";
                document.forms['others'].total.value = net_total;
		
	  }