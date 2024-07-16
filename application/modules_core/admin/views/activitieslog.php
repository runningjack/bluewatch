<style type="text/css">
  table{
width: 50%;
border: 15px solid #25BAE4;
border-collapse:collapse;
margin: auto;
}
td{
width: 50px;
height: 50px;
text-align: center;
border: 1px solid #e2e0e0;
font-size: 18px;
font-weight: bold;
}
th{
height: 50px;
padding-bottom: 8px;
background:#25BAE4;
font-size: 20px;
}
.prev_sign a, .next_sign a{
color:white;
}
tr.week_name{
font-size: 16px;
font-weight:400;
color:red;
width: 10px;
background-color: #efe8e8;
}
.today{
background-color:#25BAE4;
color:white;
height: 27px;
padding-top: 13px;
padding-bottom: 7px;
}
.other-month{
  color: #f1c8c8 !important;
}
.active-week{
  background: #0a165e !important;
  color: #ffffff !important;
  cursor: pointer;
}

.week2{
  background: #95c4e0 !important;
  color: #ffffff !important;
  cursor: pointer;
}

.prev-active-week{
  background: #0a165e !important;
  color: #ffffff !important;
}
.no-click{
    cursor: not-allowed !important;
  }

</style>
<?php

/*$projelement = array();
               $projelement[''] = '--Select Project--';
                foreach ($user_proj_list as $value) {
                    $projelement[$value->id] = $value->name.'('.$value->team_name.')';
                }*/
              //  var_dump($projelement); exit;
?>

<script type="text/JavaScript"> 
    
    function randomNumber(limit){
	return Math.floor(Math.random()*limit);
        
}
    
$(function() {
$("#project_id").change(function(){	
         //$("#loadlga").html("<img src='images/zoho-busy.gif' alt='loading' />").css("display", "inline");
         var project_id = document.getElementById('project_id').value; 
         $("#loadtask").html("<img src='<?php echo base_url('bootstrap/images/zoho-busy.gif'); ?>' alt='loading' />").css("display", "inline");
 		
 		$("#project_task").load("<?php echo base_url('admin/ajax/projecttask'); ?>",{non: randomNumber(9), valu: project_id }, function(response, status, xhr){
           
           $("#loadtask").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		 //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";		         
		 
	});
});


  </script>

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Log Daily Activity</h3>                                      
     
						</div>
             <p>Click on a week to fill data</p> 
						<div class="content calendar">
              <?php
              $checkDate = $this->settingsmodel->checkDate(date('Y-m-d')); ?>
              <input type="hidden" id="checkDate" value="<?php echo $checkDate ?>">
               <?php echo $calendar; ?>


       </div>								
			</div>
       </div>
    

<div id="logModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Log Weekly Activities</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-lg-12">
          <div class="table-responsive">
            <form id="logActivities">
            <table class="table table-bordered" >
              
            </table>
            <button class="btn btn-success" id="saveBtn" type="submit">Save</button>
            </form>
          </div>
      </div>
    </div>
  </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="closem">Close</button>
      </div>
    </div>

  </div>
</div>

        <script type="text/javascript">

          $(document).ready(function(){
            var checkDate = $("#checkDate").val();
            
         //   if (checkDate == '0') {
            //  $(".today").parent().addClass("active-week");
           // }
            

            $('#logActivities').submit(function(e){
            e.preventDefault();
            if (confirm("Are you sure you want to save?")) {
               var fd = new FormData(this);
               console.log(fd);
            $.ajax({
                     url:'<?php echo base_url('admin/projectlogs/saveNewLogActivities'); ?>',
                     type:"POST",
                     data: fd,
                     contentType: false,
                    processData: false,
                    dataType: "json",
                      success: function(response){
                        console.log(response);
                        if (response) {
                          alert("Successfully saved");
                          $("#logModal .close").click();
                          location.reload();
                      }else{
                        alert("Error, Log not saved.");
                      }
                   }
                 });
            } 
           
          });
            
          });
           function setWData(element) {
            $("#logModal").modal();
            $('.table').html('');
              $.ajax({
                     url:'<?php echo base_url('admin/projectlogs/logNewActivities');?>',
                     type:"POST",
                     data: {week: $(element).data('first-date')},
                     dataType:'json',
                      success: function(response){

                       if (response === null) {
                        $('.table').html('<tr><td>No project found for this week</td></tr>');
                          $("#saveBtn").hide();
                       }else{
                         $('.table').html(response);
                          $("#saveBtn").show();
                      }
                   }
                 });
          }

          function nextMonth() {
            var curr_date = $(".prev_sign").next("th").text();
            $.ajax({
                     url:'<?php echo base_url('admin/projectlogs/newMonth');?>',
                     type:"POST",
                     data: {status:'next', curr_date: curr_date },
                     dataType:'json',
                      success: function(response){
                        console.log(response);
                        if (response === '') {
                          alert("Internal Server Error.");
                      }else{
                        $('.calendar').html(response);
                         $(".today").parent().addClass("active-week");
                      }
                   }
                 });
          }

          function prevMonth() {
            var curr_date = $(".prev_sign").next("th").text();
            $.ajax({
                     url:'<?php echo base_url('admin/projectlogs/newMonth');?>',
                     type:"POST",
                     data: {status:'prev',curr_date: curr_date },
                     dataType:'json',
                      success: function(response){
                        console.log(response);
                        if (response === '') {
                          alert("Internal Server Error.");
                      }else{
                        $('.calendar').html(response);
                         $(".today").parent().addClass("active-week");
            
                      }
                   }
                 });
          }

          function checkSumHour(obj) {
            if ($(obj).val() === '' || $(obj).val() < 0) {
              $(obj).val(0);
            }
             var className = $(obj).closest('tr').find("td:eq(0)").text();
             var total = 24;
             var hoursleft = $(obj).closest('tr').find(".hoursleft").text();
             var elements = document.getElementsByName(className+"[hour][]");
        var element_array = Array.prototype.slice.call(elements);
           var sum = 0;
          for(var i=0; i < element_array.length; i++){
              sum += parseInt(new Number(element_array[i].value), 10);
          }
          if (sum > total) {
            alert('Maximum hour is '+ total);
            $(obj).val(0);
          }else{
            $(obj).closest('tr').find(".totalhour").text(sum);
            $(obj).closest('tr').find(".hoursleft").text(total-sum);
          }
          }
        </script>