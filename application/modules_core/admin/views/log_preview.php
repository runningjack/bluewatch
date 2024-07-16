 
<table style="padding: -15px; width: 96%; margin-left: 20px;" class="table">
                                     <thead class="thead-dark">
                                        <tr>
                                            <th>SN</th>
                                            <th>Date*</th>
                                            <th>Project Name</th>
                                            <th>Task</th>
                                            <th>Total No of Hours</th>
                                            <th>Comment</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $counter = 1;
                                        foreach($all_logs as $log){ ?>
                                        <tr>
                                            <td><?php 
                                            echo $counter;
                                            $counter++;
                                            ?></td>
                                            <td><?php echo $log->log_date ?></td>
                                            <td><?php echo $log->name ?></td>
                                            <td><?php echo $log->task_name ?></td>
                                            <td><?php echo $log->hours ?> Hours</td>
                                            <td><?php echo $log->comment ?> </td>
                                           <td>
                                            <button onclick="removeComent(<?php echo $log->activity_id ?>);" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" aria-describedby="tooltip547756">
                                                <i class="fa fa-trash-o"  aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <?php }?>

                                       
                                    </tbody>
                                </table>