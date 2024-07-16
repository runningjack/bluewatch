<?php


$percentageelement = array();
$percentageelement['0'] = '%';
for ($i = 1; $i <= 100; $i++) {
  $percentageelement[$i] = $i;
}


$departmentelement = array();
$departmentelement[''] = '--Select Dept.--';
foreach ($dept as $value) {
  $departmentelement[$value->id] = $value->title;
}

// var_dump($departmentelement);exit;



?>
<div class="row">
  <div class="col-md-12">
    <div class="block-flat">
      <div class="header">
        <h3>Transaction Processing</h3>


      </div>
      <div class="form-horizontal" parsley-validate novalidate>
        <div class="form-group">
          <?php // display sucess message
          //      var_dump($project_details);exit;
          if (!empty($sucess_message)) { ?>
            <div class="alert alert-success alert-white rounded">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="icon"><i class="fa fa-check"></i></div>
              <strong>Success!</strong> <?php echo $sucess_message; ?>!
              <br />
              <a href="<?php echo base_url("admin/transaction/printreciept/" . $trans_id); ?>">Print Receipt </a>
            </div>
          <?php } ?>

          <?php //display error message
          if (!empty($message_error)) { ?>
            <div class="alert alert-danger alert-white rounded">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div class="icon"><i class="fa fa-times-circle"></i></div>
              <strong>Error!</strong> <?php echo $message_error; ?>
            </div>

          <?php } ?>
          <div class=" alert alert-success alert-white rounded">

            <?php $attributes = array('id' => 'usersform');
            echo form_open('admin/projectbudget/saveprojectbudget', $attributes); ?>
            <table>
              <input type="hidden" name="budget_id" value="<?php echo $budget_id ?>">
              <tr>
                <td><strong>Name:</strong></td>
                <td> <?php echo $project_details['name']; ?></td>
              </tr>
              <!-- <tr><td><strong>Details:</strong></td><td> <?php echo $project_details['details']; ?></td></tr>
                          -->
              <tr>
                <td><strong>Start Date:</strong></td>
                <td>
                  <?php echo $project_details['start_date']; ?>
                </td>
              </tr>

              <tr>
                <td><strong>End Date:</strong></td>
                <td><?php echo $project_details['end_date']; ?></td>
              </tr>

              <tr>
                <td><strong>Budget:</strong></td>
                <td><?php echo number_format($project_details['budget_amount'], 2); ?></td>
              </tr>

              <tr>
                <td><strong>Allocated Amount:</strong></td>
                <td><span id="allocated_amount"></span></td>
              </tr>

              <input type="hidden" id="project_total_budget" name="project_total_budget" value="<?php echo $project_details['budget_amount']; ?>">

            </table>
            <div class="col-md-12">
              <hr>
            </div>

            <div class="row">
              <div class="col-md-12 form_sec_outer_task border ">
                <div class="row">
                  <div class="col-md-12 bg-light p-2 mb-3">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="row">
                          <div class="col-md-12">

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="col-md-12 p-0">
                  <div class="col-md-12 form_field_outer p-0">
                    <div class="row form_field_outer_row list-group-item">

                      <div id="error_display" style="display: none;" class="alert alert-warning" role="alert">
                        Total allocated amount is greater than project bugdet
                      </div>

                      <div id="error_display_1" style="display: none;" class="alert alert-warning" role="alert">
                        Budget head sum is greater than the allocated amount
                      </div>

                      <div class="form-group col-md-2">
                        <label> % </label>


                        <?php echo form_dropdown('percentage[]', $percentageelement, '', 'onclick="calculateBudget(this)" required="" class="form-control budget_percent" id="percentage_1"'); ?>
                      </div>

                      <div class="form-group col-md-4">
                        <label> Amount </label>
                        <input type="text" class="form-control budget_shared w_90 " name="department_budget[]" id="department_budget_1" placeholder="Budget % Amount">
                      </div>




                      <div class="form-group col-md-6">
                        <label> Department/Unit </label>
                        <?php echo form_dropdown('department[]', $departmentelement, '', 'required="" class="department form-control" id="department_1"'); ?>
                      </div>
                      <?php
                      foreach ($getRevenueHead as $head) { 
// onchange="validateHeaderSum(this);" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();"
                        ?>

                        <div class="form-group col-md-2"> 
                          <label> <?php echo $head->revenue_head ?> </label>
                          <?php echo form_dropdown('percentage_'.$head->revenue_head_id.'[]', $percentageelement, '', '        
                         
                          target_total_id="department_budget_1"
                          data-field_value_id="header_'.$head->revenue_head_id.'_1"
                          index = "1" 
                          element_index = 1
                          revenue_header_id = '.$head->revenue_head_id.' 




                          
                          onclick="calculateBudgetSubHeadSum(this)" required="" class="form-control budget_percent" id="percentage_'.$head->revenue_head_id.'"'); ?>
                 
                          <input type="number" step="any" class="form-control  w_90  budget_percentage_head_amount_1" name="<?php echo $head->revenue_head.'[]' ?>" id="header_<?php echo $head->revenue_head_id ?>_1" placeholder="<?php echo $head->revenue_head ?>"
                         
                          >
                        </div>

                      <?php }
                      ?>


                      <div class="form-group col-md-1 add_del_btn_outer">


                       <!-- <button  class="btn_round add_node_btn_frm_field" title="Copy or clone this row">
                          <i class="fa fa-plus"></i>
                        </button>-->
                         <button style="margin-top: 30px;" class="btn_round remove_node_btn_frm_field" disabled="">
                          <i class="fa fa-times"></i>
                        </button> 
                      </div>
                    </div>


                  </div>
                </div>
              </div>
              <div class="row ml-0 bg-light mt-3 border py-3">
                <div class="col-md-12">
                  <button class="btn btn-outline-lite py-0 add_new_frm_field_btn" type="button"><i class="fa fa-plus add_icon"></i> Add New field row</button>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8">
                  <button class="btn btn-danger form-control  " id="savebutton" type="submit"> Save Project Budget </button>
                </div>
              </div>
            </div>



            <?php echo form_close();

            ?>

          </div>

        </div>
      </div>
    </div>
  </div>

  <style type="text/css">
    .input_error {
      background-color: #fce4e4;
      border: 1px solid #cc0033;
      outline: none;
    }

    @font-face {
      font-weight: 400;
      font-style: normal;
      font-family: 'Circular-Loom';

      src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Book-cd7d2bcec649b1243839a15d5eb8f0a3.woff2') format('woff2');
    }

    @font-face {
      font-weight: 500;
      font-style: normal;
      font-family: 'Circular-Loom';

      src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Medium-d74eac43c78bd5852478998ce63dceb3.woff2') format('woff2');
    }

    @font-face {
      font-weight: 700;
      font-style: normal;
      font-family: 'Circular-Loom';

      src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Bold-83b8ceaf77f49c7cffa44107561909e4.woff2') format('woff2');
    }

    @font-face {
      font-weight: 900;
      font-style: normal;
      font-family: 'Circular-Loom';

      src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Black-bf067ecb8aa777ceb6df7d72226febca.woff2') format('woff2');
    }
  </style>
  <script type="text/javascript">
    $(document).ready(function() {
      $("body").on("click", ".add_new_frm_field_btn", function() {
      
        var index = $(".form_field_outer").find(".form_field_outer_row").length + 1+1;
               $(".form_field_outer").append(`
          <div class="row form_field_outer_row list-group-item">
          <div id="error_display_${index}" style="display: none;" class="alert alert-warning" role="alert">
                        Budget head sum is greater than the allocated amount
                      </div>
          <div class="form-group col-md-2">
                      <label> % </label>
                        <?php echo form_dropdown('percentage[]', $percentageelement, '', ' onclick="calculateBudget(this)" required="" class=" form-control budget_percent" id="percentage_${index}"'); ?>
                      </div>

                      <div class="form-group col-md-4">
                      <label> Amount </label>
                        <input type="text" class="form-control budget_shared w_90" name="department_budget[]" id="department_budget_${index}" placeholder="Amount">
                      </div>




                      <div class="form-group col-md-6">
                        <label> Department/Unit </label>
                        <?php echo form_dropdown('department[]', $departmentelement, '', 'required="" class="department form-control" id="department_${index}"'); ?> 
                      </div>

                      <?php
                      foreach ($getRevenueHead as $head) { 
//   onchange="validateHeaderSum(this);" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();"
                        ?>

                        <div class="form-group col-md-2">
                          <label> <?php echo $head->revenue_head ?> </label>
                         
                          <?php echo form_dropdown('percentage_'.$head->revenue_head_id.'[]', $percentageelement, '',
                            
                          
                          'onclick="calculateBudgetSubHeadSum(this)" required="" class="form-control budget_percent"
                          
                          target_total_id="department_budget_${index}"
                          data-field_value_id="header_'.$head->revenue_head_id.'_${index}"
                          index = ${index}
                          revenue_header_id = '.$head->revenue_head_id.'
                          
                             id="percentage_'.$head->revenue_head_id.'"'); ?>
                            <input type="number" step="any" class="form-control  w_90 budget_head_amount_${index}" name="<?php echo $head->revenue_head ?>[]" id="header_<?php echo $head->revenue_head_id ?>_${index}" placeholder="<?php echo $head->revenue_head ?>"
                       
                         
                          >
                        </div>

                      <?php }
                      ?>

                     <div class="form-group col-md-3 add_del_btn_outer">
                        <!--<button style="margin-top: 30px;" class="btn_round add_node_btn_frm_field" title="Copy or clone this row">
                          <i class="fa fa-plus"></i>
                        </button>-->
                        <button class="btn_round remove_node_btn_frm_field" disabled="">
                          <i class="fa fa-times"></i>
                        </button>
                      </div>
            </div>
        `);

        $(".form_field_outer").find(".remove_node_btn_frm_field:not(:first)").prop("disabled", false);
        $(".form_field_outer").find(".remove_node_btn_frm_field").first().prop("disabled", true);
      });
    });


    ///======Clone method
    $(document).ready(function() {
      $("body").on("click", ".add_node_btn_frm_field", function(e) {
        var index = $(e.target).closest(".form_field_outer").find(".form_field_outer_row").length + 1;
        var cloned_el = $(e.target).closest(".form_field_outer_row").clone(true);

        $(e.target).closest(".form_field_outer").last().append(cloned_el).find(".remove_node_btn_frm_field:not(:first)").prop("disabled", false);

        $(e.target).closest(".form_field_outer").find(".remove_node_btn_frm_field").first().prop("disabled", true);


        //change id
        $(e.target).closest(".form_field_outer").find(".form_field_outer_row").last().find("input[type='text']").attr("id", "department_budget_" + index);

        $(e.target).closest(".form_field_outer").find(".form_field_outer_row").last().find("select").attr("id", "no_type_" + index);

        console.log(cloned_el);
        //count++;
      });
    });


    $(document).ready(function() {
      //===== delete the form fieed row
      $("body").on("click", ".remove_node_btn_frm_field", function() {
        $(this).closest(".form_field_outer_row").remove();
        console.log("success");
      });
    });
  </script>

  </body>

  </html>