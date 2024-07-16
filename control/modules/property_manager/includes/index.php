<?php
$loc = "modules/property_manager/includes/";
// GET THE AUTOLOADER CLASS
require_once("modules/property_manager/classes/myclass.AutoLoader.php");

//CHECK IF USER HAS ACCESS TO PROPERTY MANAGER
setting_class::check_access_right("Property Manager");
?>

<div style="margin-left: 7px;" class="prop_backlayer">

	<div class="prop_header">
    	<img src="modules/property_manager/images/proplogo.png" style="margin-top: 5px; margin-left: 10px;"/> <strong style="font-size: 16px;">Property Manager</strong>
    </div>
    
    <div id="prop_content">
    
<!-- MENU STARTS HERE -->
<?php include($loc."propheader.php"); ?>       
<!-- MENU ENDS HERE -->
            
         <div id="mainarea">
        	<?php include($loc."welcome.php"); ?>
         </div>
            
          
    </div>
</div>