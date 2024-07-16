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

$user_department = $_SESSION["login_detal"]->dept_id; //$_SESSION['dept_id'];
$group_id = $_SESSION['group_id'];

?>
 
 
                                        <table class="table" border="1">

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
                                               

                                                if ($group_id != 4) {

                                                    //deal with supper user

                                                    foreach ($dept as $single_dept) { //var_dump($single_dept->title);exit; 
                                            ?>
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
                                                    <td><?php echo number_format($all_project_expense[$project->id], 2) ?></td>
                                                    <td><?php echo number_format($dpeartment_recieveble[$project->id], 2) ?></td>
                                                    <?php 
                                                    $column_count = 0;

                                                    foreach ($dept as $single_dept) {



                                                            $current_allocation_sum =  
                                                            (int)$current_allocation_sum + (int)$department_project_allocation[$project->id][$single_dept->id];
                                                            $current_recieveable_sum = 
                                                            (int)$current_recieveable_sum + (int)$department_project_recievieable[$project->id][$single_dept->id];
                                                            $current_direct_cost_sum = 
                                                            (int)$current_direct_cost_sum + (int)$department_project_direct_cost[$project->id][$single_dept->id];
                                                            $current_direct_personal_cost_sum = 
                                                            (int)$current_direct_personal_cost_sum + (int)$department_project_direct_personal_cost[$project->id][$single_dept->id];
                                                            $balance_sum = $balance_sum + (int)$balance;

                                                    ?>
                                                        <td><?php echo number_format($department_project_allocation[$project->id][$single_dept->id], 2); ?></td>
                            <td><?php
//var_dump($department_project_recievieable[61]);
                            $count = 0;
                             echo number_format((int)$department_project_recievieable[$project->id][$single_dept->id], 2);
                                 


                                                         ?></td>
                                                        <td><?php
                                                            // if ($project_hourly_logged[$project->id]['amount'] > 0) {
                                                            //     $temp_hr = $project_hourly_logged[$project->id]['amount'];
                                                            // } else {
                                                            //     $temp_hr = 1;
                                                            // }

                                                            // $depart_exp =
                                                            //     $project_department_hourly_log[$project->id][$single_dept->id] / $temp_hr * $all_project_expense[$project->id];
                                                            // echo number_format($depart_exp);


                                                            echo number_format((int)$department_project_direct_cost[$project->id][$single_dept->id],2); 

                                                            ?>


                                                        </td>
                                                        <td><?php
                                                       // var_dump($department_project_direct_personal_cost);exit;


                                                            print((int)$project_department_hourly_log[$project->id][$single_dept->id]) ?></td>
                                                        <td><?php echo number_format((int)$department_project_direct_personal_cost[$project->id][$single_dept->id], 2); ?></td>
                                                        <td><?php
                                                            $balance = (int)$department_project_recievieable[$project->id][$single_dept->id] -
                                                                ($department_project_direct_cost[$project->id][$single_dept->id] + (int)$department_project_direct_personal_cost[$project->id][$single_dept->id]);
                                                            $balance = 
                                                            (int)$department_project_recievieable[$project->id][$single_dept->id] -
                                                                ($depart_exp + (int)$department_project_direct_personal_cost[$project->id][$single_dept->id]);

             //$depart_exp
                                                            echo number_format($balance, 2);
                                                            ?></td>

                                                    <?php  } ?>


                                                    <td><?php echo number_format((int)$current_allocation_sum, 2); ?></td>
                                                    <td><?php echo number_format((int)$current_recieveable_sum, 2); ?></td>
                                                    <td> <?php echo number_format((int)$current_direct_cost_sum, 2); ?></td>
                                                    <td><?php echo number_format((int)$current_direct_personal_cost_sum, 2); ?></td>
                                                    <td><?php 

                                                            // print($department_project_recievieable[$project->id][$single_dept->id]);
                                                            // echo '||';
                                                            // print($depart_exp);
                                                            // echo '||';
                                                            // print($department_project_direct_personal_cost[$project->id][$single_dept->id]);

                                                    if($count==0)
                                                    {
                                                        $balance_sum = $balance_sum - $depart_exp;
                                                    }
                                                    $count = $count+1;
                                               
                                                     $balance_sum_new = $current_recieveable_sum - 
                                                     ($current_direct_cost_sum+$current_direct_personal_cost_sum);
                                                      

                                                    echo number_format((int)$balance_sum_new, 2);
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

