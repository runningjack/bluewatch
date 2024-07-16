<table width="100%">
    <tr>
        
        <td colspan="8"><strong>WORK ORDER</strong></td>
    </tr>
    <tr>
        <?php $randnum = rand(1111111111,9999999999);?>
        <td colspan="8"><strong>W.O. # :</strong> <?php echo $randnum; ?></td>   
    </tr>
    <tr>
        <td colspan="8"><strong>W.O. Date :</strong><?php echo  date('m/d/Y h:i:s a', time());; ?></td>
       
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr> 
        <td colspan="8"> <strong>Requested By:</strong> <?php echo $project_manager_fullname;  ?></td>
        
    </tr>
    <tr> 
        <td colspan="8" ><strong>Customer ID: <?php echo $current_department;?></strong></td>
         
    </tr>
    
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
         <td colspan="4"><strong>JOB</strong></td>
        
         <td colspan="4"><strong>BILL TO</strong></td>
       
    </tr>
    <tr>
        <td colspan="3"><?php echo $project_name; ?></td>
  
        <td colspan="5"><?php echo $current_department; ?></td>
       
    </tr>

    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
	</table>
	
	<table class="styled-table" style="margin-top:10px" width="100%">
    <tr>
        <td>QTY</td>
        <td>RESOURCE NAME</td>
        <td>Role</td>
        <td></td>        
        <td>HOURLY RATE</td>
        
    </tr>

    <?php 
    $counter = 1;
    foreach($resource as $res){?>
    <tr>
        <td><?php echo $counter; ?></td>
        <td><?php echo $res->first_name.' '.$res->middle_name.' '.$res->last_name ?></td>
        <td><?php echo $res->resource_role_name ?></td>
        <td></td>
        <td><?php echo $res->employee_rate ?></td>
      
      
    </tr>
    <?php }?>
    <!-- <tr>
        <td>5</td>
        <td>Hourly Labor for ABC (5 hours)</td>
        <td></td>
        <td></td>
      
        
        <td> 250.00 </td>
    </tr> -->
   
  
   
</table>

<style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}


.styled-table th,
.styled-table td {
    padding: 12px 15px;
}


.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

</style>