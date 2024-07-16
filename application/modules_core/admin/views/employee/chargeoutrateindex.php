
<div class="row">
    <div class="col-md-12">
        <div class="block-flat">
            <div class="header">							
                <h3>Employee Charge Out Rate</h3>
                <form action="<?php echo base_url('admin/manageemployee/uploadchargeoutrate'); ?>" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>CSV File</td>
                            <td> <input class="form-control" type="file" name="csv" value="" /></td>
                            <td><input class="btn btn-success" type="submit" name="Upload" value="Save" /></td>
                        </tr>
                    </table>
                </form>                                     
            </div>
            <div class="content">
                <div class="table-responsive">
                    <?php // display success message
                    if (!empty($success_message)) {
                        ?>
                        <div class="alert alert-success alert-white rounded">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <div class="icon"><i class="fa fa-check"></i></div>
                            <strong>Success!</strong> <?php echo $success_message; ?>!
                        </div>
                    <?php
                    } ?>
                    <?php // display error message
                    if (!empty($error_message)) {
                        ?>
                        <div class="alert alert-danger alert-white rounded">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <div class="icon"><i class="fa fa-times-circle"></i></div>
                            <strong>Error!</strong> <?php echo $error_message; ?>
                        </div>
                    <?php
                    } ?>



<div class="col-md-8">
					<div class="block-flat">
						
						<div class="content">
							
                                <?php $attributes = array('id' => 'usersform');
              echo form_open('admin/manageemployee/uploadchargeoutrate', $attributes); ?>
                            
                            </div>
                            </div>
                            </div>



                    <?php if (!empty($charge_out_rates)) { ?>
                        <table class="table table-bordered" id="datatable2">
                            <thead>
                                <tr>
                                    <th><strong>S/N</strong></th>  
                                    <th><strong>Full Name</strong></th>
                                    <th><strong>Gender</strong></th>
                                    <th><strong>Employee No</strong></th> 
                                    <th><strong>Rate Per Hour</strong></th>
                                    <th></th>                                                                                       
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $color = array(1 => 'green', 2 => 'red', 3 => 'yellow', 4 => 'blue');
                                $counter = 1;
                                foreach ($charge_out_rates as $data) {
                                    ?>
                                    <tr class="gradeA">
                                        <td><?php echo $counter; ?></td>
                                        <td class="center"><?php echo $data->first_name . ' ' . $data->last_name . ' ' . $data->middle_name; ?></td>
                                        <td class="center"><?php echo $data->gender; ?></td>
                                        <td class="center"><?php echo $data->emp_id; ?></td> 
                                        <td class="center"><?php echo number_format($data->charge_out_rate, 2); ?></td>
                                        <td><a href="<?php echo base_url("admin/manageemployee/chargeoutrate?id=" . $data->emp_id) ?>"><button class="btn btn-success">Update Rate</button></a></td>
                                    </tr>
                                    <?php ++$counter;
                                } ?>
                            </tbody>
                        </table>
                        <p><?php echo $links; ?></p>
                    <?php } else { ?>
                        <p>No employee charge out rates found.</p>
                    <?php } ?> 
                </div>
            </div>									
        </div>
    </div>
</div>
