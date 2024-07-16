
<script type="text/javascript">
$(function() {
		   
		$("#cancelb").click(
		function(){
			$("#prop_darklayer").css("visibility","hidden");
			$("#prop_contentlayer").css("visibility","hidden");
		 });
		
		$("a > img").bind('mouseenter', function(){
		
		var defid = $(this).attr("id");
		
		var e = $("#"+defid).attr("name");
		var l = "modules/property_manager/images/property/" + e
		var d = $("#mainimg").attr("src",l);
		

	        //var imgname = $("#pix-"+defid).attr("src");
			/*$("#mydisplay").html("<img src=\'" + l + "\' />");
			$("#prop_darklayer").css("visibility","visible");
			$("#prop_contentlayer").css("visibility","visible");*/
		});
});
</script>
<?php
$pid = $_GET['PID'];

// CREATE OBJECT OF CLASS CONNECTION
$configData = new ConfigData;
$conn = $configData -> connectDB();
		
// BUILD QUERY
$selectQuery = new SelectQuery();

$result = $selectQuery -> from("prop_property")
						 ->select("*")
						 ->where("property_id='{$pid}'")
						 ->buildQuery()
						 ->getResult($conn);
						 
while ($row = $result->fetch_assoc())
	 {
		$title =	$row['property_title'];
			$description = $row['property_description'];
			$address = $row['property_address'];
			$city = $row['property_city'];
			$state = $row['property_state'];
			$country = $row['property_country'];
			
			
			// BUILD QUERY
		$selectQuery2 = new SelectQuery();
		$selectQuery3 = new SelectQuery();
		
		$result2 = $selectQuery2 -> from("prop_contact")
								 ->select("*")
								 ->where("propcontact_id='{$row[property_contactid]}'")
								 ->buildQuery()
								 ->getResult($conn);
								 
			while ($row2 = $result2->fetch_assoc())
	 		{
			 $c_name = $row2['propcontact_name']; 
			 $c_addy = $row2['propcontact_address'];
			 $c_email = $row2['propcontact_email'];
			 $c_phone1 = $row2['propcontact_phone1'];
			 $c_phone2 = $row2['propcontact_phone2'];
			}
$catname = $selectQuery3 -> returnValue("propcat_name","prop_categories","propcat_id",$row['property_maincat'],$conn);
$leasetype = $selectQuery3 -> returnValue("propcat_name","prop_categories","propcat_id",$row['property_leasetype'],$conn);
$proptype = $selectQuery3 -> returnValue("propcat_name","prop_categories","propcat_id",$row['property_proptype'],$conn);


			$bedno = $row['property_bedno'];
			$pricewords = $row['property_priceword'];
			$pricefig = $row['property_pricefigure'];
			if( $row['property_negotiable'] == "yes"){$negotiate = "negotiable";}else{$negotiate = "non-negotiable";}
			$dateadded = date("F j, Y, g:i a",$row['property_dateadded']);
			$addedby = $row['property_addedby'];
			$enable = $row['property_status'];
			$imgdefault = $row['property_imgdefault'];
			
	 }

?>

<div>
<h2>PROPERTY PREVIEW</h2>


<div style="">
  <img src="<?php echo "modules/property_manager/images/property/".$imgdefault; ?>" style="margin-right: 10px;border: 2px solid #ffcc99;" id='mainimg' /><br /><br />
  
  <?php
  $selectQuery5 = new SelectQuery();
		
		$result5 = $selectQuery5 -> from("prop_imagemgr")
								 ->select("*")
								 ->where("imagemgr_propid='{$pid}'")
								 ->buildQuery()
								 ->getResult($conn);
								 
		while ($row5 = $result5->fetch_assoc())
	 		{
			 $thumb = $row5['imagemgr_link'];
			 $id = $row5['imagemgr_id'];
			 
			echo "<a href='javascript:;'><img src='modules/property_manager/images/property/thumbs/{$thumb}' id='pix-{$id}' name='$thumb' /></a> ";
			}
  
echo "<div style='clear: both'></div><div><br /><span style='font-size: 14px; font-weight: bold;'>$title</span><br /> ";
echo "<span style='font-style: italic; color: red'>$catname >> $leasetype >> $proptype </span><br />posted by $addedby on <i>$dateadded</i><br /><br />"; 
echo $description."<br /><br />";
echo "Located at ".$address.", $city<br />";
echo "$state, $country<br /><br />";
echo $bedno." available bedroom(s)<br /><br />";
echo "<b style='color: red'>Price: <img src='modules/property_manager/images/naira.png' /> $pricewords </b>(<i>$negotiate</i>)</div>";
echo "<div style='clear: both'></div>";
echo "<br /><span style='font-weight: bold'>For more information, contact:</span> <br />";
echo "$c_name<br />$c_addy<br />$c_email<br />$c_phone1, $c_phone2";
?>
</div>



<div id="prop_darklayer"></div>

<div id="prop_contentlayer">
      
       
    <div id="prop_ban" style="float: right">
        <span style="font-size: 16px; font-weight: bold; margin-top: 10px">View Image</span><img src="modules/property_manager/images/close.png" name="cancel" id="cancelb" style="width:36px; height:31px; float:right; margin:5px; border:0px;" onmouseover="changeBg()" onmouseout="returnbg()"/><div style="clear:both"></div>
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


<div style="padding:20px;"><div id="mydisplay"></div>
</div>
        
   <div align="center" style="background-image: url(modules/property_manager/images/glossyback.png)">Copyright &copy; 2012</div>  
</div>