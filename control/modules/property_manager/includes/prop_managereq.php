<?php
//IF PAGE IS FROM ADD CATEGORY AND WAS SUCCESSFUL
if( (isset($_GET['STA'])))
{
	switch($_GET['STA'])
	{
	 	case "confirm":
		$returnstring = "Reply Successfully Sent";
		break;
		
		case "update":
		$returnstring = "Request Successfully Sent";
		break;
		
		case "delete":
		$returnstring = " Request Successfully Deleted";
		break;
	}
echo "<div class='prop_success'><img src='modules/property_manager/images/yes.gif' /> $returnstring </div><br />";
}



if(isset($_POST['confirm']))
{
$act = $_GET['ACT'];
$cas = $_GET['CAS'];
$pid = $_GET['PID'];

        // CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
		    // DELETE QUERY REQUEST
		
			$deleteQuery = new DeleteQuery();
			$result = $deleteQuery ->from("prop_request")
									 ->where("request_id='{$pid}'")
									 ->buildQuery()
									 ->execute($conn);
				if($result)
				{					 				
				header("Location: .?BQ=Control Panel&INC=Property&CMD=Manage_Request&ACT=Delete&PID=$pid&CAS=1");
				}

}


if( (isset($_GET['ACT'])) && ($_GET['ACT'] == "Delete") && ($_GET['CAS'] == 0) )
{
$act = $_GET['ACT'];
$cas = $_GET['CAS'];
$pid = $_GET['PID'];

if($cas == 0)
{
echo <<<EOT
<div>
<h2>DELETE REQUEST</h2>

<div style="background: url(modules/property_manager/images/clear2.png) repeat; ">
<h3 style="color: red"><img src="modules/property_manager/images/error.png" /> IMPORTANT INFORMATION</h3>
Are you sure you want to delete this property request? If you wish to continue, click the continue button or cancel to go back.<br /><br />

<form method="post" action="">
<input type="submit" name="cancel" value="CANCEL" />
<input type="submit" name="confirm" value="CONFIRM" />
</form>
</div>
</div>
EOT;
}
}


if($_GET['CAS']==1)
{
echo "<div class='prop_success'><img src='modules/property_manager/images/yes.gif' /> Request Successfully Deleted </div><br />";
}

?>


<script type="text/javascript">
$(function() {
		$( "#cancelb" ).click(
		function(){
			$("#prop_darklayer").css("visibility","hidden");
			$("#prop_contentlayer").css("visibility","hidden");
		 });
		
		$(".prop_tables a").bind('click', function(){

		var defid = $(this).attr("id");
		var tousecontent = $("#box-"+defid).html();
			$("#mydisplay").html(tousecontent);
			$("#prop_darklayer").css("visibility","visible");
			$("#prop_contentlayer").css("visibility","visible");
		   });
		});

</script>
<div id="prop_darklayer"></div>

<div id="prop_contentlayer">
      
       
    <div id="prop_ban" style="float: right">
        <span style="font-size: 16px; font-weight: bold; margin-top: 10px"></span><img src="modules/property_manager/images/close.png" name="cancel" id="cancelb" style="width:36px; height:31px; float:right; margin:5px; border:0px;" onmouseover="changeBg()" onmouseout="returnbg()"/><div style="clear:both"></div>

<script type="text/javascript">
function changeBg()
{
	document.getElementById('cancelb').src = "modules/property_manager/images/close_hover.png";
}

function returnbg()
{
	document.getElementById('cancelb').src = "modules/property_manager/images/close.png";
}
</script>
    </div>


        <div style="padding:20px;">
       
              <div id="mydisplay"></div>
        </div>
        
   <div align="center" style="background-image: url(modules/property_manager/images/glossyback.png)">Copyright &copy; 2012</div>  
</div>



<?php

		// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
		
		// START PAGINATION
		if(isset($_GET['nxt']))
			{
				$pgno = (int) $_GET['nxt'];	
			}else
			{
				$pgno = 0;
			}
			
		
		// PAGINATION QUERY::GET TOTAL ROWS IN DB
			$totselectQuery = new SelectQuery();
			$totresult = $totselectQuery -> from("prop_request")
									 ->select("*")
									 ->buildQuery()
									 ->getResult($conn);
			// TOTAL ROWS
			$rows_per_page = 10;
			$total_rows = $totselectQuery -> getAffectedRows();
			$no_of_pages = ceil($total_rows / $rows_per_page);
			$first_page = 0;
			$start = $pgno * $rows_per_page;

		
		
		
			// MAIN BUILD QUERY
			$selectQuery = new SelectQuery();
			$result = $selectQuery -> from("prop_request")
									 ->select("*")
									 ->orderBy("request_id","DESC")
									 ->limit("$start,$rows_per_page")
									 ->buildQuery()
									 ->getResult($conn);
								 
								 
			$start_index = ($total_rows==0 ? 0 : $start + 1);
			$stop_index = $start_index + $rows_per_page - 1;
			
			if($pgno > 0)
			{
				$start_index = $start + 1;
				$stop_index = $start_index + $rows_per_page - 1;
				$stop_index = ($stop_index > $total_rows ? $total_rows : $stop_index);
			}else
			{	
				$start_index = ($total_rows==0 ? 0 : $start + 1);
				$stop_index = ($total_rows==0 ? 0 : $start_index + $rows_per_page - 1);
				$stop_index = ($stop_index > $total_rows ? $total_rows : $stop_index);
			}		
			
			$rtnstring = "Showing $start_index - $stop_index out of $total_rows Requests";



		if($result == false)
		{
			echo "<div class='prop_error'><img src='modules/property_manager/images/error.png' /> ERROR RETRIEVING REQUESTS </div>";
		}


echo "<div class='prop_success'><img src='modules/property_manager/images/yes.gif' /> $rtnstring </div><br />";
?>


<div>
<h2>MANAGE REQUEST</h2>
<table width="859" class="prop_tables">
<tr class="prop_trow">
<th width="34">ID</th>
<th width="294">Name</th>
<th width="94">View Details</th>
<th width="95">Status</th>
<th width="135">Enquiry</th>
<th width="100">Reply</th>
<th width="75">Delete</th>
</tr>




<?php
if($total_rows==0){echo "<tr><td colspan='7'>No Request Available</td></tr>";}

if($result != false)
{	
	 $counter = 1;
	 while ($row = $result->fetch_assoc())
	 {
		echo "<tr ";
		
		if( ($counter%2) == 0 )
		{
		echo "class='prop_even'";
		}
		
		echo "><td class='prop_cols'>$counter</td>";
		echo "<td class='prop_cols'>".$row['request_fname']." ".$row['request_lname']."</td>";
		echo "<td class='prop_cols'><a href='javascript:;' id='alert{$counter}'>details</a>
			<div id='box-alert{$counter}' style='display: none'>
			From: {$row['request_fname']} {$row['request_lname']} &lt;{$row['request_email']}&gt;  <br />
			Phone: $row[request_phone] <br /> <br />
			Message: <br /><br />$row[request_message]
			</div>
		</td>";
		
		echo "<td class='prop_cols'>";
			if($row['request_status'] == 0){echo "Reply Sent"; }else{echo "Awaiting Reply";}
			
		echo "</a></td>";

			echo "<td class='prop_cols'>";
			if($row['request_propid'] == 0){echo "General"; }else{echo "<a href='.?linkCMS=Control Panel&INC=Property&CMD=Prev_Prop&PID=$row[request_propid]&CAS=0'>Go to Property</a>";}
			
		echo "</a></td>";
				
		echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Prop_Reply&ACT=Edit&PID=$row[request_id]&CAS=0'><img src='modules/property_manager/images/edit.png' /></a></td>";
		
		echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Manage_Request&ACT=Delete&PID=$row[request_id]&CAS=0'><img src='modules/property_manager/images/no.gif' /></a></td></tr>";
		$counter++;
	 }
	 		
			//CLEAN UP OBJECTS
			$configData -> destroy();
			$configData = null;
			unset($configData);
			
			$selectQuery = null;
			unset($selectQuery);
}
?>

</table>

<?php
// ECHO PAGINATION
			echo "<div align='center'><br />";
			//.?linkCMS=Control Panel&INC=Property&CMD=View_Exist_Prop&nxt=$first_page
			
			// FOR FIRST BUTTON
			if($pgno == 0)
			{
				echo "<a href='javascript:;'> <img src='modules/property_manager/images/skip_backward.png' style='border: 0px'/> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}else
			{
				echo "<a href='.?BQ=Control Panel&INC=Property&CMD=Manage_Request&nxt=$first_page'> <img src='modules/property_manager/images/skip_backward.png' style='border: 0px'/> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			
			// FOR PREVIOUS BUTTON
			if($pgno > 0)
			{
				$previous_index = $pgno - 1;
				echo "<a href='.?BQ=Control Panel&INC=Property&CMD=Manage_Request&nxt=$previous_index'> <img src='images/rewind.png' style='border: 0px'/> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}else
			{
				echo "<a href='javascript:;'> <img src='modules/property_manager/images/rewind.png' style='border: 0px'/> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			
			// FOR NEXT BUTTON
			if($no_of_pages > ($pgno + 1) )
			{
				$next_index = $pgno + 1;
				echo "<a href='.?BQ=Control Panel&INC=Property&CMD=Manage_Request&nxt=$next_index'><img src='modules/property_manager/images/forward.png' style='border: 0px'/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}else
			{
				echo "<a href='javascript:;'><img src='modules/property_manager/images/forward.png' style='border: 0px'/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			
			
			// FOR LAST BUTTON
			if($no_of_pages != ($pgno + 1) )
			{	
				$last_page = $no_of_pages - 1;
				echo "<a href='.?BQ=Control Panel&INC=Property&CMD=Manage_Request&nxt=$last_page'> <img src='modules/property_manager/images/skip_forward.png' style='border: 0px'/> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}else
			{
				echo "<a href='javascript:;'> <img src='modules/property_manager/images/skip_forward.png' style='border: 0px'/> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				
			}

			
			echo "</div>";

?>

</div>



