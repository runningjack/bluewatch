<?php


$percentageelement = array();
$percentageelement[''] = '%';
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
                <h3>DEPARTMENTAL PROFITABILITY [<a onclick="print();">Print</a>]</h3>


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

                                                <?php 
                                                $budget_ground_sum = 0;
                                                $expense_ground_sum = 0;
                                                $profit_ground_sum = 0;

                                                
                                                foreach ($getRevenueHead as $rev_head) { ?>
                                                    <td colspan="3"  class="text-center"><strong><?php echo $rev_head->revenue_head ?></strong></td>
                                                <?php  } ?>

                                                <td colspan="3" class="text-center"><strong>Totals</strong></td>
                                            </tr>

                                            
                                            <tr>
                                                <td></td>

                                                <?php foreach ($getRevenueHead as $rev_head) { ?>
                                                    <td>Budget</td>
                                                    <td>Expense</td> 
                                                    <td>Balance</td>
                                                   
                                                <?php  } ?>

                                                <td>Budget</td>
                                                    <td>Expense</td> 
                                                    <td>Balance</td>
                                            </tr>

                                                <?php 
                                                foreach ($dept as $dept) {
                                                 //   var_dump($budget_head_by_dept[$dept->id]);exit;
                                                 
                                                 $budget_sum = 0;
                                                 $expense_sum = 0; 
                                                    ?>
                                                <tr>
                                                    <td><?php echo $dept->title ?></td>

                                                    <?php
                                                    foreach ($getRevenueHead as $head) {
                                                    ?>
                                                    <td>
                                                        <?php 
                                                         $sub_sum = 0.00;

                                                        foreach ($budget_head_by_dept[$dept->id] as $allhead) {
                                                           
                                                            if ($allhead->budget_head == $head->revenue_head) { ?>
                                                                 <?php 
                                                                 $budget_Amount = $allhead->budget_amount;
                                                                 $sub_sum = $sub_sum + $allhead->budget_amount; 
                                                                
                                                                 $budget_sum = $budget_sum+$allhead->budget_amount;
                                                                 ?>
                                                            <?php }else{?>
                                                            
                                                         <?php   }
                                                            ?>

                                                        <?php      }
                                                     echo number_format($sub_sum,2);
                                                     $revenue_head_sum_budget[$head->revenue_head][] = $sub_sum;
                                                      //  if(!$budget_Amount){ echo '0.00';}
                                                    //var_dump($revenue_head_sum_budget); 
                                                        ?>
                                                        </td>
                                                    <td><?php if($expByDeptRevenueHead[$dept->id][$head->revenue_head])
                                                    {
                                                        $expense_sum = $expense_sum + $expByDeptRevenueHead[$dept->id][$head->revenue_head];
                                                        $revenue_head_sum_expense[$head->revenue_head][] = $expByDeptRevenueHead[$dept->id][$head->revenue_head];
                                                        echo number_format($expByDeptRevenueHead[$dept->id][$head->revenue_head],2);
                                                    }else{
                                                        echo '0.00';
                                                    } ?></td>
                                                    <td>
                                                        <?php $revenue = $budget_Amount-$expByDeptRevenueHead[$dept->id][$head->revenue_head];
                                                              $revenue_head_sum_balance[$head->revenue_head][] = $revenue;
                                                              echo number_format($revenue,2);
                                                        ?>
                                                    </td>
                                                    

                                                    <?php } ?>

                                                    <td><?php  echo $budget_sum;?></td>
                                                    <td><?php  echo $expense_sum;?></td> 
                                                    <td><?php echo $budget_sum-$expense_sum;
                                                    
                                                    $budget_ground_sum =   $budget_ground_sum  +$budget_sum ;
                                                    $expense_ground_sum = $expense_ground_sum + $expense_sum;
                                                    $profit_ground_sum =  $profit_ground_sum + ($budget_sum-$expense_sum);
                                                    
                                                    ?></td>

                                                    </tr>
                                                <?php } ?>
                                           


                                                                
                                            <tr>
                                                <td></td>

                                                <?php foreach ($getRevenueHead as $rev_head) { ?>
                                                    <td> 
                             <?php print number_format(array_sum($revenue_head_sum_budget[$rev_head->revenue_head]),2); ?>
                                                </td>
                                                    <td>
                            <?php print number_format(array_sum($revenue_head_sum_expense[$rev_head->revenue_head]),2); ?>
                                                    </td> 
                                                    <td>
                            <?php print number_format(array_sum($revenue_head_sum_balance[$rev_head->revenue_head]),2); ?>
                                                    </td>
                                                   
                                                <?php  } ?>

                                                <td><?php echo number_format($budget_ground_sum,2); ?></td>
                                                    <td><?php echo number_format($expense_ground_sum,2); ?></td> 
                                                    <td><?php echo number_format($profit_ground_sum,2); ?></td>


                                                              </tr>

                                        </table>
 

                                    </div>
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