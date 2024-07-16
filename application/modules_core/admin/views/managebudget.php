
<style>
table,td,tr {border: 1px solid #EEEEEE;padding: 2px 5px; }
table.controller .label{
  color: black !important;
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
          <div class="col-auto">
     <a href="<?php echo base_url('admin/budget/createbudget'); ?>" class="btn btn-primary btn float-right">Add New</a>
     <button class="btn btn-default" onclick="exportTableToExcel('tableBudget', 'budgetreport')">Excel File</button></div>
   <div>
        		 <h2>Budget Table</h2>
                         <table id="tableBudget" class="controller" style="width:100%">
  <tr data-level="header" class="header"><td></td>
    <?php //var_dump($budgetExpense);exit;
    $current_year = date("Y");
     if (!empty($budgetExpense)) {
      $res_list = array();
      $year = $this->settingsmodel->getExpenseYear();
      if (!empty($year)) {
        
     
       foreach ($year as $row) { 
         $res_list[] = $row->year;?>
        <td style="text-align: right;">
          <?php 
            echo $row->year; 

            if($row->year > $current_year){
              ?>
                <a href="#" data-toggle="modal" onclick="addYear(<?= $row->year ?>)" data-target="#myModal"> <i class="fa fa-times"  style="color:black"></i></a>
              <?php 
            }
            
            ?>
        </td>
    <?php }
    $res_year = join(',', array_values($res_list)); ?>
    </tr>
    <?php 
    $i = 1;
     foreach ($budgetExpense as $m) {
     $j = 1;
     $cat_amount = $this->settingsmodel->getExpenseCatBudget($res_year, $m["cat_id"]); ?>
   

      <tr data-child="1" data-level="1" id="level_<?php echo $j; ?>_<?php echo $i; ?>" >
        <td style="font-size: 20px;"><?php echo $m["cat_name"]; ?></td>
         <?php if(!empty($cat_amount)){
          foreach ($res_list as $budget_year) {
            $amount = 0.00;
            foreach ($cat_amount as $cat) {
              if ($budget_year == $cat->year) {
             $amount = sprintf("%.2f", floatval($cat->budgeted_amount));
            
            }
            
          } ?>

           <td class="data" style="font-size: 20px;text-align: right;"><?php echo $amount; ?></td>
         <?php }
          }else { 
           for ($non=0; $non < count($res_list) ; $non++) { ?>
            <td class="data" style="font-size: 20px;text-align: right;">0.00</td>
          <?php }
        } ?>
        </tr>
         
        <?php  foreach ($m['menu'] as $l) {
        $exp_amount = $this->settingsmodel->getExpenseLineBudget($res_year, $l['expID']); ?>
          <tr data-child="1" data-level="2" id="level_<?php echo $j+1; ?>_<?php echo $i; ?>" style="font-size: 15px;">
            <td style="font-size: 15px;"><?php echo $l['expenseName']; ?></td>
            <?php if(!empty($exp_amount)){
          foreach ($res_list as $budget_year) {
            $amount = 0.00;
            foreach ($exp_amount as $exp) {
              if ($budget_year == $exp->year) {
             $amount = sprintf("%.2f", floatval($exp->budgeted_amount));
            
            }
            
          } ?>
           <td class="data" style="font-size: 15px;text-align: right;" ><?php echo $amount; ?></td>
         <?php }
          }else { 
           for ($non=0; $non < count($res_list) ; $non++) { ?>
            <td class="data" style="font-size: 15px;text-align: right;">0.00</td>
          <?php }
        } ?>
          </tr>
          <?php
            if (!empty($l["dpt"])) {
              $k = 1;
              foreach ($l["dpt"] as $dpt) {
              $dept_amount = $this->settingsmodel->getDepartmentBudget($dpt->id, $res_year, $l['expID']); ?>
            
           <tr class="childless" data-level="3" id="level_<?php echo $k; ?>_<?php echo $j; ?>_<?php echo $i; ?>">
        <td><?php echo $dpt->title; ?> </td>
        <?php 
        if(!empty($dept_amount)){
          foreach ($res_list as $budget_year) {
            $amount = 0.00;
            foreach ($dept_amount as $dept) {
              if ($budget_year == $dept->year) {
             $amount = sprintf("%.2f", floatval($dept->budgeted_amount));
             $dpt_exp_id =$dept->dpt_exp_budget_id;
            
            }
            
          } ?>
           <td class="data" style="text-align: right;"><?php 
           echo $amount;

           if($budget_year >= $current_year){
            ?> 
            <a href="<?php echo base_url("admin/budget/editDepartmentBudget/". $dpt_exp_id) ; ?>"> <i class="fa fa-pencil"></i></a></td>
         <?php }
            }
          }
          else { 
           for ($non=0; $non < count($res_list) ; $non++) { ?>
            <td class="data" style="text-align: right;">0.00</td>
          <?php }
        } ?>
      </tr>
   <?php 
   $k++;}
     }
   $j++;
    }
    $i++; }  ?>
    <tr class="childless" data-child="1" data-level="1" id="level_1_a"><td>&nbsp;</td><td class="data"></td><td class="data"></td></tr>
    <tr class="childless" data-child="1" data-level="1" id="level_1_b">
    <td style="font-size: 20px;"><strong>Total</strong></td>
    <?php $total_amount = $this->settingsmodel->getTotalBudget($res_year); ?> 
     <?php if(!empty($total_amount)){
          foreach ($res_list as $budget_year) {
            $amount = 0.00;
            foreach ($total_amount as $totl) {
              if ($budget_year == $totl->year) {
             $amount = sprintf("%.2f", floatval($totl->budgeted_amount));
            
            }
            
          } ?>
           <td class="data" style="font-size: 20px;text-align: right;"><strong><?php echo $amount; ?></strong></td>
         <?php }
          }else { 
           for ($non=0; $non < count($res_list) ; $non++) { ?>
            <td class="data" style="font-size: 20px;text-align: right;">0.00</td>
          <?php }
        } ?>
  </tr>
   <?php } } ?>

</table>  

                         </div>
      </div>
    
    </div>

    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">DELETE BUDGET</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to delete this budget?</p>
        <input type="hidden" id="budget_year" >
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-danger" id="delete_btn" >Delete</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    <script type="text/javascript">
      $(document).ready(function(){
      $('#tableBudget').tabelize({
          /*onRowClick : function(){
            alert('test');
          }*/
          onRowClick : self.rowClicker,
  fullRowClickable : true

        });


      });


      // function add href to a tag in the delete modal
      function addYear(year){
        var a = document.getElementById('delete_btn'); //or grab it by tagname etc
        a.href = "<?=base_url("admin/budget/deleteBudgetByYear/")?>" +"/" + year;
      }


      function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
    </script>