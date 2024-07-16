<div class="row">
    <div class="col-md-12">
        <div class="block-flat">
            <div class="header">
                <h3>Project Expense Report</h3>
            </div>
            <div class="content">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable2">
                        <thead>
                            <tr>
                                <th><strong>S/N</strong></th>
                                <th><strong>Project Name</strong></th>
                                <th><strong>Client</strong></th>
                                <th><strong>Budgeted Amount</strong></th>
                                <th><strong>Amount Spent</strong></th>
                                <th><strong>Balance</strong></th>
                                <th><strong></strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $total_budgeted_amount = 0;
                            $total_amount_spent = 0;
                            $total_balance = 0;

                            if (empty($results)) {
                                echo 'No Project was found';
                            } else {
                                foreach ($results as $data) {
                                    $proj = $this->projectexpensemodel->getAmount($data->id);
                                    $budgeted_amount = floatval($data->budget_amount);
                                    $amount_spent = $proj['amount'] ? floatval($proj['amount']) : 0.00;
                                    $balance = $budgeted_amount - $amount_spent;

                                    // Summing up totals
                                    $total_budgeted_amount += $budgeted_amount;
                                    $total_amount_spent += $amount_spent;
                                    $total_balance += $balance;
                                    ?>
                                    <tr class="gradeA">
                                        <td><?php echo $counter; ?></td>
                                        <td class="center"><?php echo $data->name; ?></td>
                                        <td class="center"><?php echo $data->client_name; ?></td>
                                        <td class="center"><?php echo number_format($budgeted_amount, 2, '.', ','); ?></td>
                                        <td class="center"><?php echo number_format($amount_spent, 2, '.', ','); ?></td>
                                        <td class="center"><?php echo number_format($balance, 2, '.', ','); ?></td>
                                        <td>
                                            <a href="<?php echo base_url("admin/projectexpense/viewbudgetreport/" . $data->id); ?>">
                                                <button class="btn btn-success" type="button">View Budget</button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $counter++;
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Total</th>
                                <th><?php echo number_format($total_budgeted_amount, 2, '.', ','); ?></th>
                                <th><?php echo number_format($total_amount_spent, 2, '.', ','); ?></th>
                                <th><?php echo number_format($total_balance, 2, '.', ','); ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                    <p><?php echo $links; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
