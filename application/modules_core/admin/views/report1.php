<style>
table,td,tr {border: 1px solid #EEEEEE;padding: 2px 5px; }
table.controller .label{
  color: black !important;
}

.expense_line{
    cursor:pointer;
}
</style>
<div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="row">
  <div class="col-md-10">
   <form class="form-inline" method="POST" action="<?php echo base_url('admin/report')?>">
    <div class="form-group">
    <label class="sr-only" for="expCat">Expense Category:</label>
   <select class="form-control" name="expCat" id="expCat" required>
    <option disabled selected>Select Category</option>
      <?php
      foreach($cat_select as $key => $value){?>
        <option value="<?php echo $key; ?>" <?php echo ($exp_cat == $key) ? 'selected' : '' ; ?>><?php echo $value; ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group">
    <label class="sr-only" for="filtercat">Category:</label>
    <select class="form-control" name="filtercat" id="filtercat" style="width: 100px;" required>

    <option value="MONTH" <?php echo ($filter_option == 'MONTH') ? 'selected' : '' ; ?>>Monthly</option>
     <option value="QUARTER" <?php echo ($filter_option == 'QUARTER') ? 'selected' : '' ; ?>>Quarterly</option>
      <option value="YEAR" <?php echo ($filter_option == 'YEAR') ? 'selected' : '' ; ?>>Yearly</option>
    </select> 
  </div>
  <div class="form-group">
    <label class="sr-only" for="filteryear">Year:</label>
   <select class="form-control" name="filteryear" id="filteryear" style="width: 100px;" required>
    <option disabled selected>Select Year</option>
      <?php 
      $cur_year = $_SESSION['finacial_year']->year;
      for ($i=($cur_year-2); $i < ($cur_year+3); $i++) { ?>
        <option value="<?php echo $i; ?>"  <?php echo ($curr_year == $i) ? 'selected' : '' ; ?>><?php echo $i; ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group">
  <button class="btn btn-success" id="filter" type="submit">filter</button>
</div>
</form>

  </div>
   <div class="col-auto pull-right">
      
    <button class="btn btn-default" onclick="exportTableToExcel('tableBudget', 'budgetexpensereport_<?php echo $filter_option."_".$curr_year ?>')">Export</button>
  </div>
  </div>
   <div>
             <h2>Budget-Expense Table</h2>
                         <table id="tableBudget" style="width:100%">
                          <tr data-level="header" class="header"><td></td>
                            <td>&nbsp;</td>

      <?php //var_dump($budgetExpense);exit;

     if (!empty($exp_amount)) {
      $colspan = '';
      if($filter_option == 'YEAR'){ 
        $dbFilter = 'YEAR'; ?>
      <td  style="text-align: center;" colspan="3"><?php echo $curr_year; ?></td>
      <?php   
       }elseif($filter_option == 'QUARTER'){ 
        $colspan = 17;
        $dbFilter = 'QUARTER'; ?>
      <td  style="text-align: center;" colspan="3">1st Quarter</td>
        <td  style="text-align: center;" colspan="3">2nd Quarter</td>
        <td  style="text-align: center;" colspan="3">3rd Quarter</td>
        <td  style="text-align: center;" colspan="3">4th Quarter</td>
        <td  style="text-align: center;" colspan="3">Total</td>
     <?php  } else {
     $colspan = 14; 
     $dbFilter = 'MONTH';

     for ($i=2; $i >= 0; $i--) { 
      $year = intval($_SESSION['finacial_year']->year);
        $month = date('F');
        $date = date_parse($month);
        $month = intval($date['month']);
        $month = date('F', mktime(0, 0, 0, $month - $i, 1, $year));
        
      ?>
        <td  style="text-align: center;" colspan="3"><?php echo $month; ?></td>
      <?php } ?>

        <td  style="text-align: center;" colspan="3">Year to Date</td>
      <?php } ?>
    </tr>
    <tr class="childless" data-child="1" data-level="1" id="level_1_an">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <?php if($filter_option == 'YEAR'){ ?>
      <td class="data" style="text-align: center;" >Budget</td>
      <td class="data" style="text-align: center;" >Spent</td>
      <td class="data" style="text-align: center;" >Balance</td>
      <?php }elseif($filter_option == 'QUARTER'){ ?>
      <?php for ($i=0; $i < 5 ; $i++) { ?>
      <td class="data" style="text-align: center;" >Budget</td>
      <td class="data" style="text-align: center;" >Spent</td>
      <td class="data" style="text-align: center;" >Balance</td>
      <?php } ?>
     <?php  } else {  ?>
       <?php for ($i=0; $i < 4 ; $i++) { ?>
      <td class="data" style="text-align: center;" >Budget</td>
      <td class="data" style="text-align: center;" >Spent</td>
      <td class="data" style="text-align: center;" >Balance</td>
      <?php } ?>
      <?php }  ?>
      
    </tr>

    <?php 
    $count = 1;
    $totalBudget = 0;
    $totalActual = 0;
   // var_dump($exp_amount);exit;
     foreach ($exp_amount as $m) {
     $j = 1; ?>
   
      <tr class="expense_line collapsed" data-id="<?php echo $m['expense_line_id']; ?>" style="background-color:#f8f8f8;">
        <td><?php echo $count; ?></td>
        <td style="font-size: 18px;"><?php echo $m['expense_line_name']; ?></td>
         <?php
        
          if($filter_option == 'YEAR'){
           $amount = 0.00;
          $budget = 0.00;
          $sumAmount = 0;
            $bal = 0;
            if (!empty($m['budget'])) {
          $budget = floatval($m['budget']);
        }
          if ($m['actual']) {
            foreach ($m['actual'] as $value) {
              if ($value->amount) {
                $amount = floatval($value->amount);
                $sumAmount += round(floatval($value->amount),2);
              } 
               ?>
         <?php
          $bal = $budget - round($amount,2); } ?>
  <td class="data" style="text-align: right;background-color: aliceblue;"><?php echo number_format($budget, 2, '.', ','); ?></td>
  <td class="data" style="text-align: right;background-color: antiquewhite;"><?php echo number_format($amount, 2, '.', ','); ?></td>
           <td class="data" style="text-align: right;background-color: beige;"><?php echo number_format($bal, 2, '.', ','); ?></td>
        <?php }else{
         $amount = 0.00;
              $bal = $budget - round($amount,2); ?>
    <td class="data" style="text-align: right;background-color: aliceblue;"><?php echo number_format($budget, 2, '.', ','); ?></td>
    <td class="data" style="text-align: right;background-color: antiquewhite;"><?php echo number_format($amount, 2, '.', ','); ?></td>
      <td class="data" style="text-align: right;background-color: beige;"><?php echo number_format($bal, 2, '.', ','); ?></td>
        <?php } ?>
          
      
        <?php  
       }elseif($filter_option == 'QUARTER'){
        $budget = 0;
        $qbudget = 0;
        $sumAmount = 0;
        if (!empty($m['budget'])) {
          $budget = floatval($m['budget']);
          $qbudget = round($budget/4,2);
        }
        for ($i=1; $i <= 4 ; $i++) { 
             $amount = 0.00;
            $bal = 0;
          if ($m['actual']) {
            foreach ($m['actual'] as $value) {
          
            if($i == $value->month){ 
              if ($value->amount) {
                $amount = floatval($value->amount);
                $sumAmount += round(floatval($value->amount),2);
              } 
               ?>
         <?php }
          $bal = $qbudget - round($amount,2); } ?>
  <td class="data" style="text-align: right;background-color: aliceblue;"><?php echo number_format($qbudget, 2, '.', ','); ?></td>
  <td class="data" style="text-align: right;background-color: antiquewhite;"><?php echo number_format($amount, 2, '.', ','); ?></td>
           <td class="data" style="text-align: right;background-color: beige;"><?php echo number_format($bal, 2, '.', ','); ?></td>
        <?php }else{
         $amount = 0.00;
              $bal = $qbudget - round($amount,2); ?>
    <td class="data" style="text-align: right;background-color: aliceblue;"><?php echo number_format($qbudget, 2, '.', ','); ?></td>
    <td class="data" style="text-align: right;background-color: antiquewhite;"><?php echo number_format($amount, 2, '.', ','); ?></td>
      <td class="data" style="text-align: right;background-color: beige;"><?php echo number_format($bal, 2, '.', ','); ?></td>
      
        <?php } } ?>
        <td class="data" style="text-align: right;background-color: aliceblue;"><?php echo number_format($budget, 2, '.', ','); ?></td>
<td class="data" style="text-align: right;background-color: antiquewhite;"><?php echo number_format($sumAmount, 2, '.', ','); ?></td>
  <td class="data" style="text-align: right;background-color: beige;"><?php $sumbal = $budget - $sumAmount;echo number_format($sumbal, 2, '.', ','); ?></td>
       <?php } else {
        $month = intval(date('m'));
        $budget = 0;
        $mbudget = 0;
        $sumAmount = 0;
        if (!empty($m['budget'])) {
          $budget = floatval($m['budget']);
          $mbudget = round($budget/12,2);
        }
          for ($i=($month-2); $i <= $month ; $i++) {
            $amount = 0.00;
            $bal = 0;
          if ($m['actual']) {
            foreach ($m['actual'] as $value) {
          
            if($i == $value->month){ 
              if ($value->amount) {
                $amount = floatval($value->amount);
                $sumAmount += round(floatval($value->amount),2);
              } 
               ?>
         <?php }
          $bal = $mbudget - round($amount,2); } ?>
  <td class="data" style="text-align: right;background-color: aliceblue;"><?php echo number_format($mbudget, 2, '.', ','); ?></td>
  <td class="data" style="text-align: right;background-color: antiquewhite;"><?php echo number_format($amount, 2, '.', ','); ?></td>
           <td class="data" style="text-align: right;background-color: beige;"><?php echo number_format($bal, 2, '.', ','); ?></td>
        <?php }else{
         $amount = 0.00;
              $bal = $mbudget - round($amount,2); ?>
    <td class="data" style="text-align: right;background-color: aliceblue;"><?php echo number_format($mbudget, 2, '.', ','); ?></td>
    <td class="data" style="text-align: right;background-color: antiquewhite;"><?php echo number_format($amount, 2, '.', ','); ?></td>
      <td class="data" style="text-align: right;background-color: beige;"><?php echo number_format($bal, 2, '.', ','); ?></td>


        <?php } }  ?>
  <td class="data" style="text-align: right;background-color: aliceblue;"><?php echo number_format($budget, 2, '.', ','); ?></td>
<td class="data" style="text-align: right;background-color: antiquewhite;"><?php echo number_format($sumAmount, 2, '.', ','); ?></td>
  <td class="data" style="text-align: right;background-color: beige;"><?php $sumbal = $budget - $sumAmount;echo number_format($sumbal, 2, '.', ','); ?></td>
      <?php }
          
     ?>

        </tr>
      <?php $totalBudget += $budget;
            $totalActual += $sumAmount;
            $totalBal = $totalBudget - $totalActual; $count++; } ?>
            <tr class="expense_line"><td colspan="<?php echo (!empty($colspan)) ? $colspan : '5' ; ?>">&nbsp;</td></tr>
            <tr>
            <td style="font-size: 18px;" colspan="<?php echo (!empty($colspan)) ? $colspan-3 : '2' ; ?>">Total</td>
 <td class="data" style="text-align: right;background-color: aliceblue;"><?php echo number_format($totalBudget, 2, '.', ','); ?></td>
    <td class="data" style="text-align: right;background-color: antiquewhite;"><?php echo number_format($totalActual, 2, '.', ','); ?></td>
      <td class="data" style="text-align: right;background-color: beige;"><?php echo number_format($totalBal, 2, '.', ','); ?></td>
    </tr>
           <?php }?>
                         </table>
                       </div>
                     </div>
                   </div>
 <script type="text/javascript">
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
      $(document).ready(function(){
     $('.expense_line').click(function(){
      var expense_line_id = $(this).attr('data-id');
    if($(this).hasClass("collapsed")){
      
      var filter = $('#filtercat').val();
      var year = $('#filteryear').val();
      var $set = $(this);
      $.ajax({
               url:'<?php echo base_url('admin/report/deptReport');?>',
               type:"POST",
               data: {
                      expense_line_id: expense_line_id,
                      filter: filter,
                      year: year
                    },
               dataType:'json',
                success: function(response){
                  console.log(response);
                  $set.closest( "tr" ).after(response.content);
                  if (response.status) {
                    $set.nextUntil('tr.expense_line')
                    .find('td')
                    .parent()
                    .find('td > div')
                    .slideDown("fast", function(){
                        $set.replaceWith($set.contents());
                    });
                    $set.removeClass("collapsed");
                  }
                
             }
           });
        
    } else {
        $(this).nextUntil('tr.expense_line')
        .find('td')
        .wrapInner('<div style="display: none;" />')
        .parent()
        .find('td > div')
        .slideUp("fast");
        $(this).addClass("collapsed");
        $('.'+expense_line_id).remove();
    }
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