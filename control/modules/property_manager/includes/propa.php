<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="../scripts/myjquery.js"></script>

<script type="text/javascript">
$(function() {
		$( "#cancelb" ).click(
		function(){
			$("#prop_darklayer").css("visibility","hidden");
			$("#prop_contentlayer").css("visibility","hidden");
		 });
		
		$("#alert1").click(function(){

		var defid = $(".tuna a").attr("id");
		var tousecontent = $("#box-"+defid).html();
			$("#mydisplay").html(tousecontent);
			$("#prop_darklayer").css("visibility","visible");
			$("#prop_contentlayer").css("visibility","visible");
		   });
		});

</script>
</head>

<body>
<div id="prop_darklayer"></div>

<div id="prop_contentlayer">
    
    <div id="prop_ban">
    <input type="button" name="cancel" id="cancelb" class="cancelButton" onclick="">
        <div id="prop_ban2"></div>
    </div>


        <div style="padding-left:20px;">
          <h2 class="title">Contact Details</h2>
              <div id="mydisplay"></div>
        </div>
    
</div>
 
 <div class="tuna">
 <a href="javascript:;" id="alert1">alert ni jare</a>
 <div id="box-alert1">content <h1>goesss</h1> here</div>
 </div>
</body>
</html>