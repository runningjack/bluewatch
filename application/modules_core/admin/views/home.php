<div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3><?php echo $extra;?></h3>
                                                        
     
						</div>

						<?php // display sucess message
                if($this->session->flashdata('success')){?>
                    <div class="alert alert-success alert-white rounded">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<div class="icon"><i class="fa fa-check"></i></div>
						<strong>Success!</strong> <?php echo $this->session->flashdata('success');?>!
					</div>
                <?php }?>
                                                            
                <?php //display error message
                	if($this->session->flashdata('error')) {?>
					<div class="alert alert-danger alert-white rounded">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<div class="icon"><i class="fa fa-times-circle"></i></div>
						<strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
					</div>
               
           		<?php } ?>
<?php
//var_dump($output);exit;
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
 
	<div style='height:20px;'></div>  
    <div style="padding: 10px">
		<?php echo $output; ?>
    </div>
    <?php //var_dump($js_files);exit; 
	$i = 0;
	foreach($js_files as $file): ?>
    <?php if($i != 0){ ?>    <script src="<?php echo $file; ?>"></script><?php }?>
    <?php 
	$i++;
	endforeach; ?>

	<script type="text/javascript">
	// $(document).ready(function(){
	// 	$("#field-project_id").change(function(){
	// 		alert($(this).val());
	// 		$.ajax({
    //             url: '<?php echo base_url('admin/ajax/projectteammember') .'/'; ?>' + $(this).val(),
    //             type: 'GET',
    //             dataType: 'json',
    //             cache: false,
    //             success: function (res) {
    //                 //console.log(res);
	// 				var locations = document.getElementById("field-assigned_to");
    //                 $('#field-assigned_to')
    //                     .empty()
	// 					.append('<option value="0" >--All Members--</option>');
					

    //                 for (var i = 0; i < res.length; i++) {
    //                     var opt = document.createElement('option');
    //                     //console.log(res[i].Id);
    //                     opt.value = res[i].id;
    //                     opt.innerHTML = res[i].first_name + res[i].last_name  ;
	// 					locations.appendChild(opt);
    //                 }

    //             },
    //             error: function (err) {
    //                 //alert('Error occured while fetch notification');
    //                 console.log(err)
    //             }
    //         });
	// 	})
	// })
	
	</script>
<div id="uploadtask" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title">Import Project Timeline CSV</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form enctype="multipart/form-data" method="POST" action="<?php echo base_url('admin/manageproject/uploadTimelineExcel') ?>">
          <div class="pd-30 pd-sm-40 wd-xl-100p">

            <div class="row row-xs align-items-center mg-b-20">
              <div class="col-md-12 mg-t-5 mg-md-t-0">
                <div class="custom-file">
                	<input type="file" class="form-control" id="fileURL" name="fileURL" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
              	</div>
              </div><!-- col -->
            </div><!-- row -->
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="saveUpload">Import</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
  </div>
  

  

</div>
</div>
</div>
