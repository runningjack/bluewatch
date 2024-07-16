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

<h2>VIEW EXISITING CONTACTS</h2>

<?php

//IF PAGE IS FROM ADD CATEGORY AND WAS SUCCESSFUL
if( (isset($_GET['STA'])))
{
	switch($_GET['STA'])
	{
	 	case "confirm":
		$returnstring = " Contact Successfully Created";
		break;
		
		case "update":
		$returnstring = " Contact Successfully Updated";
		break;
		
		case "delete":
		$returnstring = " Contact Successfully Deleted";
		break;
	}
echo "<div class='prop_success'><img src='modules/property_manager/images/yes.gif' /> $returnstring </div><br />";
}

		// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
		// BUILD QUERY
		$selectQuery = new SelectQuery();
		
		$result = $selectQuery -> from("prop_contact")
								 ->select("*")
								 ->buildQuery()
								 ->getResult($conn);
		$c_numrow = $selectQuery -> getAffectedRows();
		if($result == false)
		{
			echo "<div class='prop_error'><img src='modules/property_manager/images/error.png' /> ERROR RETRIEVING CONTACTS </div>";
		}
					 
?>

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
<table width="597" class="prop_tables">
<tr class="prop_trow">
<th width="29">ID</th>
<th width="289">Name</th>
<th width="141">View details</th>
<th width="58">Edit</th>
<th width="77">Delete</th>
</tr>

<?php
if($c_numrow == 0)
{
echo "<tr><td colspan='5'>No Available Contacts</td></tr>";
}
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
		echo "<td class='prop_cols'>".$row['propcontact_name']."</td>";
		echo "<td class='prop_cols'><a href='javascript:;' id='alert{$counter}'>details</a>
			<div id='box-alert{$counter}' style='display: none'>
			$row[propcontact_name] <br /><br />
			$row[propcontact_address] <br /> <br />
			$row[propcontact_email] <br /> <br />
			$row[propcontact_phone1] <br />
			$row[propcontact_phone2]
			</div>
		</td>";
		echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Add_Prop_Contact&ACT=Edit&PID=$row[propcontact_id]&CAS=0'><img src='modules/property_manager/images/edit.png' /></a></td>";
		echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Del_Contact&ACT=Delete&PID=$row[propcontact_id]&CAS=0'><img src='modules/property_manager/images/no.gif' /></a></td></tr>";
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