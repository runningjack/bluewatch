<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle" background="modules/content_manager/images/hd.png"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="50" align="left" valign="bottom"><img src="modules/content_manager/images/page_add.png" width="32" height="32" /> <strong style="font-size:16px">Directory Structure</strong></td>
        <td height="50" align="left" valign="bottom"></td>
        </tr>
      <tr>
        <td width="51%" align="left" valign="middle">&nbsp;</td>
        <td align="left" valign="middle"></td>
        </tr>
    </table>
      <br /></td>
  </tr>
</table>

<div>

<?php 
include("modules/content_manager/classes/myclass.AutoLoader.php");

// CREATE OBJECT OF CLASS CONNECTION
		$configData = new ConfigData;
		$conn = $configData -> connectDB();
		
?>
<div id="treecontrol">
		<a title="Collapse the entire tree below" href="#"> Collapse All</a> | 
		<a title="Expand the entire tree below" href="#"> Expand All</a> | 
		<a title="Toggle the tree below, opening closed branches, closing open branches" href="#">Toggle All</a>
	</div>
  <?php
echo "<ul id='red' class='treeview-red'>";
	
// SELECT ALL 
$recursion = new Recursion();
$recursion -> setConn($conn);
$recursion -> setSelectObj(new SelectQuery());
$arr_result = $recursion -> getChildren(0);
$recursion -> clearArr();

foreach($arr_result as $k => $v)
	{
		
		$no_of_children = $recursion -> testChild($k);
		echo "<li><a href='?".PROJECTNAME."=Control Panel&INC=Content Manager&CMD=View Web Page&id=$k&cat=0&d=0'>$v</a>";
		
		if($no_of_children != 0)
		{	
			echo "<ul>";
			displayResult($k,$recursion);
			echo "</ul>";
		}else{
			echo "</li>";
			}
	}
	
function displayResult($key,$recursion)
{
	$arr_result = $recursion -> getChildren($key);
	$recursion -> clearArr();
	

	foreach($arr_result as $a => $b)
	{
		
		$childno = $recursion -> testChild($a);
		$recursion -> clearArr();
		
		echo "<li><a href='?".PROJECTNAME."=Control Panel&INC=Content Manager&CMD=View Web Page&id=$a&cat=0&d=0'>$b</a>";
		
		if($childno != 0)
		{	
			echo "<ul>";
			displayResult($a,$recursion);
			echo "</ul>";
		}else{
			echo "</li>";
			}
	}
	
}
	
echo "</ul>";

?>
</div>