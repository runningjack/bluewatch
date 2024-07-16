<style type="text/css">
	.ac{
		margin-top: 2%;
	}
	.ac-label {
  font-weight: 700;
  position: relative;
  padding: .5em 1em;
  margin-bottom: .5em;
  display: block;
  cursor: pointer;
  background-color: whiteSmoke;
  transition: background-color .15s ease-in-out;
}

.ac-input:checked + label, .ac-label:hover {
  background-color: #999;
}

.ac-label:after, .ac-input:checked + .ac-label:after {
  content: "+";
  position: absolute;
  display: block;
  right: 0;
  top: 0;
  width: 2em;
  height: 100%;
  line-height: 2.25em;
  text-align: center;
  background-color: #e5e5e5;
  transition: background-color .15s ease-in-out;
}

.ac-label:hover:after, .ac-input:checked + .ac-label:after {
  background-color: #b5b5b5;
}

.ac-input:checked + .ac-label:after {
  content: "-";
}

.ac-input {
  display: none;
}


.ac-text, .ac-sub-text {
  opacity: 0;
  height: 0;
  margin-bottom: .5em;
  transition: opacity .5s ease-in-out;
  overflow: hidden;
}

.ac-input:checked ~ .ac-text, .ac-sub .ac-input:checked ~ .ac-sub-text { 
  opacity: 1;
  height: auto;
}


.ac-sub .ac-label {
  background: none;
  font-weight: 600;
  padding: .5em 2em;
  margin-bottom: 0;
}

.ac-sub .ac-label:checked {
  background: none;
  border-bottom: 1px solid whitesmoke;
}

.ac-sub .ac-label:after, .ac-sub .ac-input:checked + .ac-label:after {
  left: 0;
  background: none;
}

.ac-sub .ac-input:checked + label, .ac-sub .ac-label:hover {
  background: none;
}

.ac-sub-text {
  padding: 0 1em 0 2em;
}

</style>
<div class="col-sm-10 col-md-10">
        <div class="block-flat">
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
<form action="<?php echo base_url('admin/budget/createbudget'); ?>" method="post">
	<div class="row">
  <div class="col-auto pull-right">
  		
  	<button type="reset" class="btn btn-default"> Reset Budget</button>&nbsp;&nbsp;<button type="button" data-toggle="modal" data-target="#uploadfile" class="btn btn-primary" id="import">Import Excel</button>&nbsp;&nbsp;<button type="submit" class="btn btn-success"> Create Budget</button>&nbsp;&nbsp;<select class="form-control" name="year" required><option disabled selected>Select Year</option>
  		<?php 
  		$maxYear = $this->settingsmodel->getmaxYear();
  		$cur_year = (!empty($maxYear->year)) ? (intval($maxYear->year)+1) : date('Y') ;
  		for ($i=$cur_year; $i <= $cur_year+5; $i++) { ?>
  			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
  		<?php } ?>
  	</select>
  </div>
  </div>
  <div class="ac">
    
  	 <?php
                $i = 1;//var_dump($budgetExpense );exit;
                foreach ($budgetExpense as $m) { ?>
                 <input class="ac-input" id="<?php echo $m["cat_name"]; ?>" type="checkbox" />
    <label class="ac-label" for="<?php echo $m["cat_name"]; ?>"><?php echo $m["cat_name"]; ?></label>
     <article class="ac-text">
                    <?php foreach ($m["menu"] as $l) {  //var_dump($l);die;?>
                    	<div class="ac-sub">
        <input class="ac-input" id="<?php echo $l['expenseName']; ?>" type="checkbox" />
        <label class="ac-label" for="<?php echo $l['expenseName']; ?>"><?php echo $l['expenseName']; ?></label>
        <article class="ac-sub-text">
        		
        	<?php if (!empty($l["dpt"])) { ?>
        		<table border="0">
        	<?php foreach ($l["dpt"] as $dpt) {  //var_dump($l);die;
        		$dept_amount = $this->settingsmodel->getDepartmentExpense($dpt->id, $l['expID']);?>
        			<tr><td width="30%"><label><?php echo $dpt->title; ?></label></td><td><input type="text" name="<?php echo $l['expID'].'-'. $dpt->id; ?>" value="<?php //if(!empty($dept_amount)){ echo $dept_amount->budgeted_amount;}else{ echo '0';} ?>"></td></tr>
        		
        		<?php } ?>
                </table>
                <?php } ?>
        </article>
      </div>
                    <?php } ?>
                </article>
           


        <?php $i++;

    } ?>

    <!--  -->
  </div>
  </form>
</div>
</div>

 <div id="uploadfile" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title">Upload File</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form enctype="multipart/form-data" method="POST" action="<?php echo base_url('admin/budget/uploadExcel') ?>">
          <div class="pd-30 pd-sm-40 wd-xl-100p">

            <div class="row row-xs align-items-center mg-b-20">
              <div class="col-md-12 mg-t-5 mg-md-t-0">
                 <div class="custom-file">
                  <select class="form-control" name="year" required><option disabled selected>Select Year</option>
      <?php 
  
      $cur_year = (!empty($maxYear->year)) ? (intval($maxYear->year)+1) : date('Y') ; 
        for ($i=$cur_year; $i <= $cur_year+5; $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
      <?php } ?>
     
    </select> <br/>
                <input type="file" class="form-control" id="fileURL" name="fileURL" accept=".csv">
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
  