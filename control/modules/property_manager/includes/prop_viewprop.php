<div>
<h2>VIEW EXISITING PROPERTIES</h2>

</div>

<?php

//IF PAGE IS FROM ADD PROPERTY AND WAS SUCCESSFUL
if( (isset($_GET['STA'])))
{
	switch($_GET['STA'])
	{
	 	case "confirm":
		$returnstring = " Property Successfully Added";
		break;
		
		case "imgconfirm":
		$returnstring = "Property Images Successfully Uploaded, You can preview property";
		break;
		
		case "update":
		$returnstring = " Property Successfully Updated";
		break;
		
		case "delete":
		$returnstring = " Property Successfully Deleted";
		break;
	}
echo "<div class='prop_success'><img src='modules/property_manager/images/yes.gif' /> $returnstring </div><br />";
}

	// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
		// CREATE PAGINATION
		
		
			if(isset($_GET['nxt']))
			{
				$pgno = (int) $_GET['nxt'];	
			}else
			{
				$pgno = 0;
			}
			
			$totselectQuery = new SelectQuery();
		
		    $totresult = $totselectQuery -> from("prop_property")
								 ->select("property_title","property_id")
								 ->buildQuery()
								 ->getResult($conn);
			
			// TOTAL ROWS
		$rows_per_page = 4;
		$total_rows = $totselectQuery -> getAffectedRows();
		$no_of_pages = ceil($total_rows / $rows_per_page);
		$first_page = 0;
		$start = $pgno * $rows_per_page;
		
		
		// BUILD QUERY
		$selectQuery = new SelectQuery();
		
		$result = $selectQuery -> from("prop_property")
								 ->select("property_title","property_id")
								 ->orderBy("property_id","DESC")
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
			
			$rtnstring = "Showing $start_index - $stop_index out of $total_rows Properties";

		
		
?>
<?php
echo "<div class='prop_success'><img src='modules/property_manager/images/yes.gif' /> $rtnstring </div><br />";
?>
<table width="708" class="prop_tables">
<tr class="prop_trow">
<th width="45">ID</th>
<th width="388">Property Title</th>
<th width="53">Preview</th>
<th width="49">Add </th>
<th width="65">Manage </th>
<th width="35">Edit</th>
<th width="41">Delete</th>
</tr>
<?php
if($no_return == 0)
		{
			echo "<tr><td colspan='7'> NO PROPERTY AVAILABLE </div>";
		}
?>

<?php
if($result != false)
{	
	 $counter = $start_index;
	 while ($row = $result->fetch_assoc())
	 {
		echo "<tr ";
		
		if( ($counter%2) == 0 )
		{
		echo "class='prop_even'";
		}
		
		echo "><td class='prop_cols'>$counter</td>";
		echo "<td class='prop_cols'>".$row['property_title']."</td>";
		echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Prev_Prop&PID=$row[property_id]&CAS=0'><img src='modules/property_manager/images/prev.png' /></a></td>";
		echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Add_Prop_Image&PID=$row[property_id]&CAS=0'><img src='modules/property_manager/images/addimg.png' alt='Add Images' /></a></td>";
		echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Prop_Image_Mgr&PID=$row[property_id]&CAS=0'><img src='modules/property_manager/images/preview.png' alt='manage images' /></a></td>";
		echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Add_New_Prop&ACT=Edit&PID=$row[property_id]&CAS=0'><img src='modules/property_manager/images/edit.png' /></a></td>";
		echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Del_Property&ACT=Delete&PID=$row[property_id]&CAS=0'><img src='modules/property_manager/images/no.gif' /></a></td></tr>";
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
				echo "<a href='.?BQ=Control Panel&INC=Property&CMD=View_Exist_Prop&nxt=$first_page'> <img src='modules/property_manager/images/skip_backward.png' style='border: 0px'/> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			
			// FOR PREVIOUS BUTTON
			if($pgno > 0)
			{
				$previous_index = $pgno - 1;
				echo "<a href='.?BQ=Control Panel&INC=Property&CMD=View_Exist_Prop&nxt=$previous_index'> <img src='images/rewind.png' style='border: 0px'/> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}else
			{
				echo "<a href='javascript:;'> <img src='modules/property_manager/images/rewind.png' style='border: 0px'/> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			
			// FOR NEXT BUTTON
			if($no_of_pages > ($pgno + 1) )
			{
				$next_index = $pgno + 1;
				echo "<a href='.?BQ=Control Panel&INC=Property&CMD=View_Exist_Prop&nxt=$next_index'><img src='modules/property_manager/images/forward.png' style='border: 0px'/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}else
			{
				echo "<a href='javascript:;'><img src='modules/property_manager/images/forward.png' style='border: 0px'/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			
			
			// FOR LAST BUTTON
			if($no_of_pages != ($pgno + 1) )
			{	
				$last_page = $no_of_pages - 1;
				echo "<a href='.?BQ=Control Panel&INC=Property&CMD=View_Exist_Prop&nxt=$last_page'> <img src='modules/property_manager/images/skip_forward.png' style='border: 0px'/> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}else
			{
				echo "<a href='javascript:;'> <img src='modules/property_manager/images/skip_forward.png' style='border: 0px'/> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				
			}

			
			echo "</div>";

?>
</div>