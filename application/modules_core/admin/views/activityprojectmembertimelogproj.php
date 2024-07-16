

<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Project Time Log</h3>
                                                         
						</div>
						<div class="content">
							<div class="table-responsive">
                                            <input type="hidden" id="projectID" value="<?php echo $project_id; ?>">

								<table class="table table-bordered" id="datatable2" >
									<thead>
											<th><strong>S/N</strong></th>
											<th><strong>Member Name</strong></th>
                                            <th><strong>Team</strong></th>
                                            <th><strong>Role</strong></th> 

                                            <th></th>
                          
									</thead>
									<tbody>
<?php
$counter = 1;
if (empty($results)) {
    echo 'No team was found';
} else {
    foreach ($results as $data) {
        ?>
  <tr class="gradeA">
<td><?php echo $counter; ?><input type="hidden" value="<?php echo $data['member_id']; ?>"></td>
<td class="center"><?php echo $data['member_name']; ?></td>
<td class="center"><?php echo $data['name']; ?></td>
<td class="center"><?php echo $data['role_name'] ?></td>
<td><button class="btn btn-info" type="button" data-toggle="modal" data-target="#logModal">Approve Log</button></td>                      
</tr>                   
<?php ++$counter;
  } ?>
   <?php
        } ?>

  
                                                         </tbody>
                                                         </table>
   
   
 			</div>
       </div>									
			</div>
       </div>

       <div id="logModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Review Weekly Activities</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-lg-12">
          <div class="table-responsive">
            <form id="logActivities">
              <input type="hidden" name="dateRange">
              <input type="hidden" name="userId">
              <input type="hidden" name="projectID" id="projectID" value="<?php echo $projectID; ?>">
            <table class="table table-bordered" >
              
            </table>
            <button class="btn btn-success" type="submit">Update Approval</button>
            <button class="btn btn-info stateButton" type="button" data-state="prev">Previous Week</button>
            <button class="btn btn-warning stateButton" type="button" data-state="next">Next Week</button>
            </form>
          </div>
      </div>
    </div>
  </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  <script type="text/javascript">

          $(document).ready(function(){
            $('#logModal').on('show.bs.modal', function(e) {
              var member_id = $(e.relatedTarget).closest('tr').find("td:eq(0) input").val();
              var date_range = '';
              var projectID = $('#projectID').val();
               
        
              $.ajax({
                     url:'<?php echo base_url('admin/projectlogs/projmanagerreviewlogActivities');?>',
                     type:"POST",
                     data: {
                      member_id: member_id,
                      date_range: date_range,
                      projectID:projectID
                      },
                     dataType:'json',
                      success: function(response){
                       // console.log(response);
                        $('#logModal .table').html(response.content);
                         $("#logModal input[name=userId]").val(response.user_id);
                         $("#logModal input[name=dateRange]").val(response.dateRange);
                   }
                 });
             });

            $('.stateButton').on('click', function(e) {



             try {

              var member_id = $("#logModal input[name=userId]").val();
              var date_range = $("#logModal input[name=dateRange]").val();
              var approved_hour_id = $("input[name='approved_hour_id[]']")
                                       .map(function(){return $(this).val();}).get();               
              var approved_task_id = $("input[name='approved_task_id[]']")
                                      .map(function(){return $(this).val();}).get();


              var state = $(this).data('state');
              var projectID = $('#projectID').val() ;

              
             } catch (error) {
              
             }
             
            
        
              $.ajax({
                     url:'<?php echo base_url('admin/projectlogs/projmanagerreviewlogActivities');?>',
                     type:"POST",
                     data: {
                        member_id: member_id,
                        date_range: date_range,
                        state: state,
                        projectID : projectID,
                        approved_hour_id:approved_hour_id,
                        approved_task_id:approved_task_id
                      },
                     dataType:'json',
                      success: function(response){
                       // console.log(response);
                        $('#logModal .table').html(response.content);
                         $("#logModal input[name=userId]").val(response.user_id);
                         $("#logModal input[name=dateRange]").val(response.dateRange);
                   }
                 });
             });


            $('#logActivities').submit(function(e){
            e.preventDefault();
            var _this = $(this);
            
            if (confirm("Are you sure you want to save?")) {
               var fd = new FormData(this);
             //  alert("vvvv2222");
            $.ajax({
                     url:'<?php echo base_url('admin/projectlogs/saveReviewLogActivities'); ?>',
                     type:"POST",
                     data: fd,
                     contentType: false,
                    processData: false,
                    dataType: "json",
                      success: function(response){
                        console.log(response);
                        if (response) {
                          alert("Successfully saved");
                          _this.find(':submit').attr('disabled', false);
                          $("#logModal .close").click();
                      }else{
                        alert("Error, Review not saved.");
                      }
                   }
                 });
            } 
           
          });
         });

           function SumHour(obj) {
            if ($(obj).val() < 0) {
              $(obj).val(0);
            }
            var number = 0;
             var total = 8*7;
             var elements = document.getElementsByName("projManagerhour[]");
        var element_array = Array.prototype.slice.call(elements);
           var sum = 0;
          for(var i=0; i < element_array.length; i++){
             number = element_array[i].value;
            if (number === '') {
               number = $(element_array[i]).closest('td').find("p").text();
            }
              sum += parseInt(new Number(number), 10);
          }

        var elements1 = document.getElementsByName("otherprojManagerhour[]");
        var element_array1 = Array.prototype.slice.call(elements1);
          for(var i=0; i < element_array1.length; i++){
              sum += parseInt(new Number(element_array1[i].value), 10);
          }

       /*     if ($(obj).val() === '') {
              var objvalue = $(obj).closest('td').find("p").text();
              sum += parseInt(new Number(objvalue), 10);
            }
*/
          if (sum > total) {
            alert('Maximum hour is '+ total);
            $(obj).val(0);
          }else{
            $(obj).closest('tr').find(".projtotalhour").text(sum);
            $(obj).closest('tr').find(".projhoursleft").text(total-sum);
          }
          }
</script>
    
        