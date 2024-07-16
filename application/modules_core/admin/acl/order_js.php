<script type="text/javascript">
function insertorder()
{ 
   
   weight = document.getElementById('weight').value; 
   quantity = document.getElementById('quantity').value;
   id = document.getElementById('id').value;
   
 
   var myData = "weight=" + weight;
   myData+=  "&quantity=" + quantity+ "&id=" + id;//alert(myData);
				
					
      if( weight ==''){
		  alert('Select the weight');
	  return false;}
	 if(quantity==''){
	  alert('Please Select  the quantity');
	  return false;} 
	 
	  if( id == ''){
		  alert('Invalid recorde ID');
	  return false;}
	 
	  
	  
	  $("#flash").show();
	  
$("#flash").fadeIn(400).html('<img src="<?php echo base_url("images/websedit-ag-bar.gif");?>" align="absmiddle"> <span class="loading">Saving Please wait...</span>');
	
$.ajax({
            type: "POST",
            url: "<?php echo base_url("admin/ajax/addorderitems"); ?>",
            data: myData,
            success: function(data) {
				
			//document.getElementById('physical').reset()
                //alert("AJAX call successful and this data was returned: " + data);
				$("#flash").hide();
                 document.getElementById("result").innerHTML = data;
                 document.forms['physical'].weight.value = "";
                 document.forms['physical'].quantity.value = "";
				

				 
            },
            error: function() {
                  alert("AJAX call an epic failure");
                  document.getElementById("questiondislay").innerHTML=""; 
            }
        });
}

</script>