<script type="text/javascript">
$(function() {
		   
		$("#cancelb").click(
		function(){
			$("#prop_darklayer").css("visibility","hidden");
			$("#prop_gudcontent").css("visibility","hidden");
		 });
		
		$("a").bind('click', function(){
		
		var defid = $(this).attr("id");
		
		var e = $("#"+defid).attr("name");
		var l = "modules/property_manager/images/property/" + e;
		
			$("#mydisplay").html("<img src=\'" + l + "\' />");
			
			var hei = $("#mydisplay > img").outerHeight();
			var wid = $("#mydisplay > img").outerWidth();
			
			$("#mydisplay").height(hei);
			$("#mydisplay").width(wid);
			
		
			$("#prop_gudcontent").height(hei+40);
			$("#prop_gudcontent").width(wid);
			
			$("#prop_darklayer").css("visibility","visible");
			$("#prop_gudcontent").css("visibility","visible");
		});
});
</script>

<?php
if(isset($_POST['confirm']))
{
$act = $_GET['ACT'];
$cas = $_GET['CAS'];
$pid = $_GET['PID'];
$pixid = $_GET['PIXID'];
$name = $_GET['name'];

        // CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
		    // DELETE CONTACT
		
			$deleteQuery = new DeleteQuery();
			$result = $deleteQuery ->from("prop_imagemgr")
									 ->where("imagemgr_id='{$pixid}'")
									 ->buildQuery()
									 ->execute($conn);
				if($result)
				{					 
				$imgdir =  "modules/property_manager/images/property/$name"; 
				$thumbdir =  "modules/property_manager/images/property/thumbs/$name"; 
				unlink($imgdir);
				unlink($thumbdir);
				
				header("Location: .?BQ=Control Panel&INC=Property&CMD=Prop_Image_Mgr&ACT=Delete&PID=$pid&CAS=1");
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
<h2>DELETE IMAGE</h2>

<div style="background: url(modules/property_manager/images/clear2.png) repeat; ">
<h3 style="color: red"><img src="modules/property_manager/images/error.png" /> IMPORTANT INFORMATION</h3>
Are you sure you want to delete this image? If you wish to continue, click the continue button or cancel to go back.<br /><br />

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
echo "<div class='prop_success'><img src='modules/property_manager/images/yes.gif' /> Image Successfully Deleted </div><br />";
}
?>
<div>
<h2>PROPERTY IMAGES MANAGER</h2>

<table width="175" class="prop_tables">
<tr class="prop_trow">
<th width="42">ID</th>
<th width="63">Image </th>
<th width="54">Delete</th>
</tr>

 <?php
$pid = $_GET['PID'];

// CREATE OBJECT OF CLASS CONNECTION
$configData = new ConfigData;
$conn = $configData -> connectDB();
		
// BUILD QUERY
$selectQuery = new SelectQuery();
$result = $selectQuery -> from("prop_imagemgr")
								 ->select("*")
								 ->where("imagemgr_propid='{$pid}'")
								 ->buildQuery()
								 ->getResult($conn);
				$counter = 1;				 
			while ($row = $result->fetch_assoc())
			{
			$thumb = $row['imagemgr_link'];
			$id = $row['imagemgr_id'];
			
			echo "<tr ";
					
					if( ($counter%2) == 0 )
					{
					echo "class='prop_even'";
					}
					
					echo "><td class='prop_cols'>$counter</td>";

			echo "<td class='prop_cols'><a href='javascript:;' id='pix-{$id}' name='$thumb'>Preview</a></td>";
			echo "<td class='prop_cols'><a href='.?BQ=Control Panel&INC=Property&CMD=Prop_Image_Mgr&ACT=Delete&PID=$pid&PIXID=$id&CAS=0&name=$thumb'><img src='modules/property_manager/images/no.gif' /></a></td></tr>";
			$counter++;
			}
			
			?>
</table>
</div>





<div id="prop_darklayer"></div>

<div id="prop_gudcontent">
      
       
    <div id="prop_ban" align="">
        <img src="modules/property_manager/images/close.png" name="cancel" id="cancelb" style="width:36px; top: -30px; height:31px; float:right; margin:5px; border:0px;" onmouseover="changeBg()" onmouseout="returnbg()"/>
        
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


<div id="mydisplay"></div>

   </div>