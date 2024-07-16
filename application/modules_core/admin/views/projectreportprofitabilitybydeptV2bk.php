<?php 

$percentageelement = array();
$percentageelement[''] = '%';
for ($i = 1; $i <= 100; $i++) {
    $percentageelement[$i] = $i;
}


$departmentelement = array();
//var_export($dept);exit;
$departmentelement[''] = '--Select Dept.--';
foreach ($dept as $value) {
    $departmentelement[$value->id] = $value->title;
}

 ///var_dump($_SESSION["login_detal"]->dept_id);exit;

 $user_department = $_SESSION["login_detal"]->dept_id;//$_SESSION['dept_id'];
 $group_id = $_SESSION['group_id'];

?>
<div class="row">
    <div class="col-md-12">
        <div class="block-flat">
            <div class="header">
                <h3>DEPARTMENTAL AND PROJECT PROFITABILITY [<a onclick="print();">Print</a>]

                    <a href="<?php echo base_url('admin/projectexpense/projectDepartmentProfitabilityV2Excel') ?>">
                        Export to excel
                    </a>
                </h3>


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

                        <?php
                        
                        $attributes = array('id' => 'usersform');
                        //if($group_id==4){ 
if(1){ 
                            ?>
                       <?php echo form_open('admin/projectexpense/projectDepartmentProfitabilityV2', $attributes); ?>
                        <table style="width: 5%;">
                            <input type="hidden" name="budget_id" value="<?php echo $budget_id ?>">

                            <tr>
                                <td><strong>Start Date:</strong></td>
                                <td><input type="date" name="start_date" class="form-control"></td>
                                
                               
                            </tr>

                            <tr>
                                <td><strong>End Date:</strong></td>
                                <td><input type="date" name="end_date" class="form-control"></td>
                            </tr>

                            <tr>
                                <td></td>
                            <td ><input type="submit" value="Filter" class="btn btn-success"></td>
                            </tr>
                        </table>
                        <?php echo form_close();
                        }
                        ?>
                        <!--    <table>
                            <input type="hidden" name="budget_id" value="<?php echo $budget_id ?>">
                          
                            <tr>
                                <td><strong>Budget:</strong></td>
                                <td><?php echo number_format($project_details['budget_amount'], 2); ?></td>
                            </tr>

                            <tr>
                                <td><strong>Allocated Amount:</strong></td>
                                <td><span id="allocated_amount"><?php echo number_format($total_allocated, 2); ?></span></td>
                            </tr>

                            <tr>
                                <td><strong>Total Expense :</strong></td>
                                <td><span id="allocated_amount"><?php echo number_format($project_expenses, 2); ?></span></td>
                            </tr>

                            <tr>
                                <td><strong>Total Recievable :</strong></td>
                                <td><span id="allocated_amount"><?php echo number_format($project_recognized_income, 2); ?></span></td>
                            </tr>

                            <input type="hidden" id="project_total_budget" name="project_total_budget" value="<?php echo $project_details['budget_amount']; ?>">

                        </table> -->
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
                                        <table class="table">

                                            <tr class="table-dark">
                                                <td></td>
                                                <td>Total Hours</td>
                                                <td>Total Expense</td>
                                                <td>Recievable</td>

                                                <?php
                                                $budget_ground_sum = 0;
                                                $expense_ground_sum = 0;
                                                $profit_ground_sum = 0;
                                                $personal_ground_sum = 0;
                                                if($group_id==4)
                                                {
                                                    //deal with HOD                                           
                                                    
                                                foreach ($dept as $single_dept) {  
                                                    // var_dump($user_department,$single_dept->id);
                                                    // echo '<br>';
                                                    ?>
                                                   
                                                   <?php if( $user_department==$single_dept->id){ ?>
                                                   <td colspan="6" class="text-center"><strong><?php echo $single_dept->title ?></strong></td>
                                                <?php  
                                                   }
                                            } ?>

                                                <td colspan="5" class="text-center"><strong>Totals</strong></td>
                                            </tr>


                                            <tr>
                                                <td></td>
                                                <td></td>

                                                <?php foreach ($dept as $single_dept) { 
                                                     if( $user_department==$single_dept->id){ ?>
                                                    
                                                    <td>Budget</td>
                                                    <td>Recievable</td>
                                                    <td>Direct Cost</td>
                                                    <td>Hourly Log</td>
                                                    <td>Personal Cost</td>
                                                    <td>Balance</td>

                                                <?php  } } ?>

                                                    <td>Budget</td>
                                                    <td>Recievable</td>
                                                    <td>Direct Cost</td>
                                                 
                                                    <td>Personal Cost</td>
                                                    <td>Balance</td>
                                            </tr>

                                            <?php
                                            foreach ($allProjects as $project) {
                                                 
                                                //expByProjectPersonel
                                                $current_allocation_sum = 0;
                                                $current_recieveable_sum = 0;
                                                $current_direct_cost_sum = 0;
                                                $current_direct_personal_cost_sum = 0;
                                                $balance_sum = 0
                                            ?>
                                                <tr>
                                                    <td><?php echo $project->name ?></td>
                                                    <td>1111</td>
                                                <?php foreach ($dept as $single_dept) { 
                                                    if( $user_department==$single_dept->id){ 
                                                    
                                                    $current_allocation_sum =  $current_allocation_sum + $department_project_allocation[$project->id][$single_dept->id];
                                                    $current_recieveable_sum = $current_recieveable_sum + $department_project_recievieable[$project->id][$single_dept->id];
                                                    $current_direct_cost_sum = $current_direct_cost_sum + $department_project_direct_cost[$project->id][$single_dept->id];
                                                    $current_direct_personal_cost_sum = $current_direct_personal_cost_sum + $department_project_direct_personal_cost[$project->id][$single_dept->id];
                                                    $balance_sum = $balance_sum + $balance;
                                                    
                                                    ?>
                                                    <td><?php echo number_format($department_project_allocation[$project->id][$single_dept->id],2); ?></td>
                                                    <td><?php echo number_format($department_project_recievieable[$project->id][$single_dept->id],2); ?></td>
                                                    <td><?php echo number_format($department_project_direct_cost[$project->id][$single_dept->id],2); ?></td>
                                                     <td><?php var_dump($project_department_hourly_log[$project->id]) ?></td>
                                                    <td><?php echo number_format($department_project_direct_personal_cost[$project->id][$single_dept->id],2); ?></td>
                                                   
                                                    <td><?php
                                                    $balance = $department_project_recievieable[$project->id][$single_dept->id] - 
                                                                              ($department_project_direct_cost[$project->id][$single_dept->id]+$department_project_direct_personal_cost[$project->id][$single_dept->id]);
                                                    echo number_format( $balance,2);
                                                    ?></td>

                                                <?php  } } ?>
                                             

                                                   <td><?php echo number_format($current_allocation_sum,2); ?></td>
                                                    <td><?php echo number_format($current_recieveable_sum,2); ?></td>
                                                    <td> <?php echo number_format($current_direct_cost_sum,2); ?></td>
                                                    <td><?php echo number_format($current_direct_personal_cost_sum,2); ?></td>
                                                    <td><?php echo number_format($balance_sum,2); ?></td>

                                                </tr>
                                            <?php }
                                                }

                                                if($group_id!=4){ 
 
                                                    //deal with supper user

                                                foreach ($dept as $single_dept) { //var_dump($single_dept->title);exit; ?>
                                                    <td colspan="6" class="text-center"><strong><?php echo $single_dept->title ?></strong></td>
                                                <?php  } ?>

                                                <td colspan="5" class="text-center"><strong>Totals</strong></td>
                                            </tr>


                                            <tr>
                                                <td></td>
                                                  <td></td>
                                                   <td></td>
                                                   <td></td>

                                                <?php foreach ($dept as $single_dept) { ?>
                                                    <td>Budget</td>
                                                    <td>Recievable</td>
                                                    <td>Direct Cost</td>
                                                      <td>Hourly Log</td>
                                                    <td>Personal Cost</td>
                                                    <td>Balance</td>

                                                <?php  } ?>

                                                    <td>Budget</td>
                                                    <td>Recievable</td>
                                                    <td>Direct Cost</td>
                                                    <td>Personal Cost</td>
                                                    <td>Balance</td>
                                            </tr>

                                            <?php
                                           // var_dump($recieveble);exit;
                                            foreach ($allProjects as $project) {
                                                 
                                                //expByProjectPersonel
                                                $current_allocation_sum = 0;
                                                $current_recieveable_sum = 0;
                                                $current_direct_cost_sum = 0;
                                                $current_direct_personal_cost_sum = 0;
                                                $balance_sum = 0;
                                                $balance = 0;
                                            ?>
                                                <tr>
                                                    <td><?php 
                                                 //   var_dump($project);exit;

                                                    echo $project->name ?>[<?php echo $project->client_name ?>]</td>
                                                   
                                                    <td><?php echo $project_hourly_logged[$project->id]['amount'] ?></td>
                                                    <td><?php echo number_format($all_project_expense[$project->id],2) ?></td>
                                                      <td><?php echo number_format($dpeartment_recieveble[$project->id],2) ?></td>
                                                <?php foreach ($dept as $single_dept) { 
                                                    
                                                    $current_allocation_sum =  $current_allocation_sum + $department_project_allocation[$project->id][$single_dept->id];
                                                    $current_recieveable_sum = $current_recieveable_sum + $department_project_recievieable[$project->id][$single_dept->id];
                                                    $current_direct_cost_sum = $current_direct_cost_sum + $department_project_direct_cost[$project->id][$single_dept->id];
                                                    $current_direct_personal_cost_sum = $current_direct_personal_cost_sum + $department_project_direct_personal_cost[$project->id][$single_dept->id];
                                                    $balance_sum = $balance_sum + $balance;
                                                    
                                                    ?>
                                                    <td><?php echo number_format($department_project_allocation[$project->id][$single_dept->id],2); ?></td>
                                                    <td><?php echo number_format($department_project_recievieable[$project->id][$single_dept->id],2); ?></td>
                                                    <td><?php 
                                                 if($project_hourly_logged[$project->id]['amount']>0)
                                                 {
                                                    $temp_hr = $project_hourly_logged[$project->id]['amount'];
                                                 }else
                                                 {
                                                    $temp_hr = 1;
                                                 }

                                                      $depart_exp = 
                  $project_department_hourly_log[$project->id][$single_dept->id]/$temp_hr*$all_project_expense[$project->id];
            echo number_format($depart_exp);


                                                    // echo number_format($department_project_direct_cost[$project->id][$single_dept->id],2); 

                                                    ?>
                                                        

                                                    </td>
            <td><?php 


            print($project_department_hourly_log[$project->id][$single_dept->id]) ?></td>
                                                    <td><?php echo number_format($department_project_direct_personal_cost[$project->id][$single_dept->id],2); ?></td>
                                                    <td><?php
                                                    $balance = $department_project_recievieable[$project->id][$single_dept->id] - 
                                                                              ($department_project_direct_cost[$project->id][$single_dept->id]+$department_project_direct_personal_cost[$project->id][$single_dept->id]);
                                                     $balance = $department_project_recievieable[$project->id][$single_dept->id] - 
                                                                              ($depart_exp+$department_project_direct_personal_cost[$project->id][$single_dept->id]);

                                                                              //$depart_exp
                                                    echo number_format( $balance,2);
                                                    ?></td>

                                                <?php  } ?>
                                             

                                                   <td><?php echo number_format($current_allocation_sum,2); ?></td>
                                                    <td><?php echo number_format($current_recieveable_sum,2); ?></td>
                                                    <td> <?php echo number_format($current_direct_cost_sum,2); ?></td>
                                                    <td><?php echo number_format($current_direct_personal_cost_sum,2); ?></td>
                                                    <td><?php echo number_format($balance_sum,2);
                                                    $current_allocation_sum = 0;
                                                    $current_recieveable_sum = 0;
                                                    $current_direct_cost_sum = 0;
                                                    $current_direct_personal_cost_sum = 0;
                                                    $balance_sum = 0;



                                                     ?></td>

                                                </tr>
                                            <?php }
                                                }
                                            ?>



                                                 
                  

                                        </table>


                                    </div>
                                </div>
                            </div>

                        </div>



                       

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

                var index = $(".form_field_outer").find(".form_field_outer_row").length + 1 + 1;
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
                        <input type="text" class="form-control budget_shared w_90" name="department_budget[]" id="department_budget_${index}" placeholder="Enter mobiel no.">
                      </div>




                      <div class="form-group col-md-6">
                        <label> Department/Unit </label>
                        <?php echo form_dropdown('department[]', $departmentelement, '', 'required="" class="department form-control" id="department_${index}"'); ?> 
                      </div>

                      <?php
                        foreach ($getRevenueHead as $head) { ?>

                        <div class="form-group col-md-2">
                          <label> <?php echo $head->revenue_head ?> </label>
                          <input type="number" step="any" class="form-control budget_shared w_90 budget_head_amount_${index}" name="<?php echo $head->revenue_head ?>[]" id="header_<?php echo $head->revenue_head_id ?>_${index}" placeholder="<?php echo $head->revenue_head ?>"
                          onchange="validateHeaderSum(this);" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();"
                         
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