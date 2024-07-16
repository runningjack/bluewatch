
<style>
table,td,tr {border: 1px solid #EEEEEE;padding: 2px 5px; }
table.controller .label{
  color: black !important;
}
</style>
<div class="col-sm-10 col-md-10">
        <div class="block-flat">
          <div class="row">
  <div class="col-md-10" >
      <div class="col-md-1"> <select class="form-control" name="filtercat" id="filtercat" style="width: 100px;" required>
    <option value="Monthly" <?php echo ($filter_option == 'Monthly') ? 'selected' : '' ; ?>>Monthly</option>
     <option value="Quarterly" <?php echo ($filter_option == 'Quarterly') ? 'selected' : '' ; ?>>Quarterly</option>
      <option value="Yearly" <?php echo ($filter_option == 'Yearly') ? 'selected' : '' ; ?>>Yearly</option>
    </select> 
</div>
  
  <div class="col-md-1">
    <select class="form-control" name="filteryear" id="filteryear" style="width: 100px;" required>
      <?php 
      $cur_year = date('Y');
      for ($i=($cur_year-2); $i < ($cur_year+3); $i++) { ?>
        <option value="<?php echo $i; ?>"  <?php echo ($curr_year == $i) ? 'selected' : '' ; ?>><?php echo $i; ?></option>
      <?php } ?>
    </select></div> <div class="col-md-3"> <button class="btn btn-success" id="filter">filter</button></div>
  </div>
   <div class="col-auto pull-right">
      
    <button class="btn btn-default" onclick="exportTableToExcel('tableBudget', 'budgetexpensereport_<?php echo $filter_option."_".$curr_year ?>')">Export</button>
  </div>
  </div>
   <div>
             <h2>Budget Table</h2>
                         <table id="tableBudget" class="controller" style="width:100%">
  <tr data-level="header" class="header"><td></td>
      <?php //var_dump($budgetExpense);exit;
 

     if (!empty($expenseReport)) {
      if($filter_option == 'Yearly'){ 
        $dbFilter = 'YEAR';
        $res_year = array();
       for ($i=($curr_year-2); $i < ($curr_year+3); $i++) { 
        $res_year[] = $i; ?>
          <td  style="text-align: center;"><?php echo $i; ?></td>
      <?php  } 
      $res_yearr = join(',', array_values($res_year)); 
       }elseif($filter_option == 'Quarterly'){ 
        $dbFilter = 'QUARTER'; ?>
      <td  style="text-align: center;">1st Quarter</td>
        <td  style="text-align: center;">2nd Quarter</td>
        <td  style="text-align: center;">3rd Quarter</td>
        <td  style="text-align: center;">4th Quarter</td>
     <?php  } else { 
     $dbFilter = 'MONTH'; ?>
        <td  style="text-align: center;">January</td>
        <td  style="text-align: center;">Febuary</td>
        <td  style="text-align: center;">March</td>
        <td  style="text-align: center;">April</td>
        <td  style="text-align: center;">May</td>
        <td  style="text-align: center;">June</td>
        <td  style="text-align: center;">July</td>
        <td  style="text-align: center;">August</td>
        <td  style="text-align: center;">September</td>
        <td  style="text-align: center;">October</td>
        <td  style="text-align: center;">November</td>
        <td  style="text-align: center;">December</td>
      <?php }  ?>
    </tr>
    <tr class="childless" data-child="1" data-level="1" id="level_1_an">
      <td>&nbsp;</td>
      <?php if($filter_option == 'Yearly'){ ?>
       <?php for ($i=0; $i < 5 ; $i++) { ?>
      <td class="data" style="text-align: right;">&nbsp;</td>
      <?php } ?>
      <?php }elseif($filter_option == 'Quarterly'){ ?>
      <?php for ($i=0; $i < 4 ; $i++) { ?>
      <td class="data" style="text-align: right;">&nbsp;</td>
      <?php } ?>
     <?php  } else {  ?>
       <?php for ($i=0; $i < 12 ; $i++) { ?>
      <td class="data" style="text-align: right;">&nbsp;</td>
      <?php } ?>
      <?php }  ?>
      
    </tr>
    <?php 
    $i = 1;
     foreach ($expenseReport as $m) {
     $j = 1;

     if ($dbFilter == 'Yearly') {
       $cat_amount = $this->reportmodel->getExpenseCatBudget($dbFilter, $res_yearr, $m["cat_id"]); 
     } else {
       $cat_amount = $this->reportmodel->getExpenseCatBudget($dbFilter, $curr_year, $m["cat_id"]); 
     }
     
     //var_dump($cat_amount);exit;?>
   

      <tr data-child="1" data-level="1" id="level_<?php echo $j; ?>_<?php echo $i; ?>" >
        <td style="font-size: 18px;"><?php echo $m["cat_name"]; ?></td>
         <?php if(!empty($cat_amount)){
          if($filter_option == 'Yearly'){ 
            $yearloop = explode(',', $res_yearr);
      for ($i=0; $i < 5 ; $i++) { 
            $amount = 0;
            foreach($cat_amount as $cat){
            if($yearloop[$i] == $cat->month){
              $amount = $cat->amount;
    }      
     } ?>
      <td class="data" style="font-size: 20px;text-align: right;"><?php echo $amount; ?></td>
      <?php }?>
          
      
        <?php  
       }elseif($filter_option == 'Quarterly'){
        for ($i=1; $i <= 4 ; $i++) { 
            $amount = 0;
            foreach($cat_amount as $cat){
            if($i == $cat->month){ 
              $amount = $cat->amount;?>
         <?php } }?>
           <td class="data" style="font-size: 20px;text-align: right;"><?php echo $amount; ?></td>
      
        <?php  }
        } else {
          for ($i=1; $i <= 12 ; $i++) { 
            $amount = 0;
            foreach($cat_amount as $cat){
            if($i == $cat->month){ 
              $amount = $cat->amount;?>
         <?php } }?>
           <td class="data" style="font-size: 20px;text-align: right;"><?php echo $amount; ?></td>
      
        <?php  }
         } 
          
          } ?>
        </tr>
         
        <?php  foreach ($m['menu'] as $l) {
           if ($dbFilter == 'Yearly') {
       $exp_amount = $this->reportmodel->getExpenseLineBudget($dbFilter, $res_yearr, $l['expID']);  
     } else {
       $exp_amount = $this->reportmodel->getExpenseLineBudget($dbFilter, $curr_year, $l['expID']);  
     }
       //var_dump($exp_amount);exit(); ?>
          <tr data-child="1" data-level="2" id="level_<?php echo $j+1; ?>_<?php echo $i; ?>" style="font-size: 15px;">
            <td style="font-size: 15px;"><?php echo $l['expenseName']; ?></td>
            <?php if(!empty($exp_amount)){
            if($filter_option == 'Yearly'){ 
            $yearloop = explode(',', $res_yearr);
      for ($i=0; $i < 5 ; $i++) { 
            $amount = 0;
            foreach($exp_amount as $cat){
            if($yearloop[$i] == $cat->month){
              $amount = $cat->amount;
    }      
     } ?>
      <td class="data" style="font-size: 15px;text-align: right;"><?php echo $amount; ?></td>
      <?php }?>
          
      
        <?php  
       }elseif($filter_option == 'Quarterly'){
          for ($i=1; $i <= 4 ; $i++) { 
            $amount = 0;
            foreach($exp_amount as $exp){
            if($i == $exp->month){ 
              $amount = $exp->amount;?>
         <?php } }?>
           <td class="data" style="font-size: 15px;text-align: right;"><?php echo $amount; ?></td>
      
        <?php  }
        } else {
            for ($i=1; $i <= 12 ; $i++) { 
            $amount = 0;
            foreach($exp_amount as $exp){
            if($i == $exp->month){ 
              $amount = $exp->amount;?>
         <?php } }?>
           <td class="data" style="font-size: 15px;text-align: right;"><?php echo $amount; ?></td>
      
        <?php  }
         } 
        
          } ?>
          </tr>
          <?php
            if (!empty($l["dpt"])) {
              $k = 1;
              foreach ($l["dpt"] as $dpt) {
                if ($dbFilter == 'Yearly') {
       $dept_amount = $this->reportmodel->getDepartmentBudget($dbFilter, $dpt->id, $res_yearr, $l['expID']);  
     } else {
       $dept_amount = $this->reportmodel->getDepartmentBudget($dbFilter, $dpt->id, $curr_year, $l['expID']);  
     }
               ?>
            
           <tr class="childless" data-level="3" id="level_<?php echo $k; ?>_<?php echo $j; ?>_<?php echo $i; ?>">
        <td><?php echo $dpt->title; ?></td>
        <?php if(!empty($dept_amount)){
          if($filter_option == 'Yearly'){ 
            $yearloop = explode(',', $res_yearr);
      for ($i=0; $i < 5 ; $i++) { 
            $amount = 0;
            foreach($dept_amount as $cat){
            if($yearloop[$i] == $cat->month){
              $amount = $cat->amount;
    }      
     } ?>
      <td class="data" style="text-align: right;"><?php echo $amount; ?></td>
      <?php }?>
          
      
        <?php  
       }elseif($filter_option == 'Quarterly'){
        for ($i=1; $i <= 4 ; $i++) { 
            $amount = 0;
            foreach($dept_amount as $dept){
            if($i == $dept->month){ 
              $amount = $dept->amount;?>
         <?php } }?>
           <td class="data" style="text-align: right;"><?php echo $amount; ?></td>
      
        <?php  }
        } else {
          for ($i=1; $i <= 12 ; $i++) { 
            $amount = 0;
            foreach($dept_amount as $dept){
            if($i == $dept->month){ 
              $amount = $dept->amount;?>
         <?php } }?>
           <td class="data" style="text-align: right;"><?php echo $amount; ?></td>
      
        <?php  }
         } 
         
          } ?>
      </tr>
   <?php 
   $k++;}
     }
   $j++;
    }
    $i++; } ?>
    <tr class="childless" data-child="1" data-level="1" id="level_1_a"><td>&nbsp;</td><td class="data"></td><td class="data"></td></tr>
    <tr class="childless" data-child="1" data-level="1" id="level_1_b">
    <td style="font-size: 20px;"><strong>Total</strong></td>
    <?php 
      if ($dbFilter == 'Yearly') {
       $total_amount = $this->reportmodel->getTotalBudget($dbFilter, $res_yearr);  
     } else {
       $total_amount = $this->reportmodel->getTotalBudget($dbFilter, $curr_year);  
     } //var_dump($total_amount);?> 
     <?php if(!empty($total_amount)){
     if($filter_option == 'Yearly'){ 
            $yearloop = explode(',', $res_yearr);
      for ($i=0; $i < 5 ; $i++) { 
            $amount = 0;
            foreach($total_amount as $cat){
            if($yearloop[$i] == $cat->month){
              $amount = $cat->amount;
    }      
     } ?>
      <td class="data" style="font-size: 20px;text-align: right;"><?php echo $amount; ?></td>
      <?php }?>
          
      
        <?php  
       }elseif($filter_option == 'Quarterly'){
        for ($i=1; $i <= 4 ; $i++) { 
            $amount = 0;
            foreach($total_amount as $total){
            if($i == $total->month){ 
              $amount = $total->amount;?>
         <?php } }?>
           <td class="data" style="font-size: 20px;text-align: right;"><?php echo $amount; ?></td>
      
        <?php  }
        } else {
          for ($i=1; $i <= 12 ; $i++) { 
            $amount = 0;
            foreach($total_amount as $total){
            if($i == $total->month){ 
              $amount = $total->amount;?>
         <?php } }?>
           <td class="data" style="font-size: 20px;text-align: right;"><?php echo $amount; ?></td>
      
        <?php  }
         } 
          
          } ?>
  </tr>
   <?php } ?>

</table>  

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

      $("#filter").on('click', function(){
        var cat = $('#filtercat').val();
        var year = $('#filteryear').val();
        window.location.href = '<?php echo base_url('admin/report/?')?>'+'filter='+cat+'-'+year;
      });


      });
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