

<div>
<h2>VIEW LEASING CATEGORIES</h2>

<?php

//IF PAGE IS FROM ADD CATEGORY AND WAS SUCCESSFUL
if( (isset($_GET['STA'])))
{
	switch($_GET['STA'])
	{
	 	case "confirm":
		$returnstring = "Leasing Category Successfully Created";
		break;
		
		case "update":
		$returnstring = "Leasing Category Successfully Updated";
		break;
		
		case "delete":
		$returnstring = "Leasing Category Successfully Deleted";
		break;
	}
echo "<div class='prop_success'><img src='modules/property_manager/images/yes.gif' /> $returnstring </div><br />";
}

		// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
		// BUILD QUERY
		$selectQuery = new SelectQuery();
		
		$result = $selectQuery -> from("prop_categories")
								 ->select("propcat_id","propcat_name")
								 ->where("propcat_belongs = 'prop_leasetype'")
								 ->buildQuery()
								 ->getResult($conn);
		if($result == false)
		{
			echo "<div class='prop_error'><img src='modules/property_manager/images/error.png' /> ERROR RETRIEVING LEASING CATEGORIES </div>";
		}
					 
?>


<table width="503" class="prop_tables">
<tr class="prop_trow">
<th width="82">ID</th>
<th width="311">Category Name</th>
<th width="43">Edit</th>
<th width="47">Delete</th>
</tr>

<?php
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
		echo "<td class='prop_cols'>".$row['propcat_name']."</td>";
		echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Edit_Cat&ACT=Edit&PID=$row[propcat_id]&CAS=1'><img src='modules/property_manager/images/edit.png' /></a></td>";
		echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Del_Cat&ACT=Delete&PID=$row[propcat_id]&CAS=1'><img src='modules/property_manager/images/no.gif' /></a></td></tr>";
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


</div>