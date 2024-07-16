<?php

//CHECK IF USER HAS ACCESS TO MODULE ELSE REDIRECT USER TO CPANEL HOME
setting_class::check_access_right("Property Manager");

//load autoloader for property manager
require_once("modules/property_manager/classes/myclass.AutoLoader.php");

// DEFAULT INCLUDES FOLDER
$loc = "modules/property_manager/includes/";

?>





<!--MENU COMPONENTS -->
<link rel="stylesheet" type="text/css" href="modules/property_manager/css/style.css" />
<link rel="stylesheet" type="text/css" href="modules/property_manager/css/jqueryslidemenu.css" />
<script type="text/javascript" src="modules/property_manager/scripts/jqueryslidemenu.js"></script>

<!--[if lte IE 7]>
<style type="text/css">
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->

<script type="text/javascript" src="modules/property_manager/plugins/jquerycustom/js/jquery-1.7.1.min.js"></script>
<!-- END MENU COMPONENTS -->


<!-- NICE FORM PLUGIN COMPONENTS -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>-->
<script src="modules/property_manager/plugins/pixel/jquery.uniform.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
$(function(){
$("input, textarea, select, button").uniform();
});
</script>
    
<link rel="stylesheet" href="modules/property_manager/plugins/pixel/css/uniform.default.css" type="text/css" media="screen">
<!-- END PLUGIN -->


<div style="margin-left: 7px;" class="prop_backlayer">

	<div class="prop_header">
    	<img src="modules/property_manager/images/proplogo.png" style="margin-top: 5px; margin-left: 10px;"/> <strong style="font-size: 16px;">Property Manager</strong>
    </div>
    
    <div id="prop_content">
   
                
<!-- MENU STARTS HERE -->
<?php include($loc."propheader.php"); ?>       
<!-- MENU ENDS HERE -->
            
         <div id="prop_mainarea">
        	<?php 
			
			switch($_GET['CMD'])
				{

						case "Add_New_Cat":
						include('modules/property_manager/includes/prop_newcat.php');
						break;
						
						case "View_Exist_Cat":
						include('modules/property_manager/includes/prop_viewcat.php');
						break;
						
						case "Add_Lease_Type":
						include('modules/property_manager/includes/prop_addlease.php');
						break;
						
						case "View_Lease_Type":
						include('modules/property_manager/includes/prop_viewlease.php');
						break;
						
						case "Add_Prop_Type":
						include('modules/property_manager/includes/prop_addproptype.php');
						break;
						
						case "View_Prop_Type":
						include('modules/property_manager/includes/prop_viewproptype.php');
						break;
						
						case "Add_New_Prop":
						include('modules/property_manager/includes/prop_addnewprop.php');
						break;
						
						case "View_Exist_Prop":
						include('modules/property_manager/includes/prop_viewprop.php');
						break;
						
						case "Manage_Request":
						include('modules/property_manager/includes/prop_managereq.php');
						break;
							
						case "View_Client_Request":
						include('modules/property_manager/includes/prop_viewclientreq.php');
						break;
						
						case "View_Client_Exist":
						include('modules/property_manager/includes/prop_viewclients.php');
						break;
						
						case "Add_Prop_Contact":
						include('modules/property_manager/includes/prop_addcontact.php');
						break;
						
						case "View_Prop_Contact":
						include('modules/property_manager/includes/prop_viewcontact.php');
						break;
						
						case "Delete Web Page":
						content_man_class::delete_web_page();
						break;
						
						case "Edit_Cat":
						include("modules/property_manager/includes/prop_editcat.php");
						break;
						
						case "Del_Cat":
						include("modules/property_manager/includes/prop_delcat.php");
						break;
						
						case "Del_Contact":
						include("modules/property_manager/includes/prop_delcontact.php");
						break;
						
						case "Add_Prop_Image":
						include("modules/property_manager/includes/prop_addimage.php");
						break;
						
						case "Prev_Prop":
						include("modules/property_manager/includes/prop_preview.php");
						break;
						
						case "Del_Property":
						include("modules/property_manager/includes/prop_delproperty.php");
						break;
						
						case "Prop_Image_Mgr":
						include("modules/property_manager/includes/prop_imgmgr.php");
						break;
						
						case "Prop_Reply":
						include("modules/property_manager/includes/prop_replymsg.php");
						break;
						
						default:
						include('includes/welcome.php');
						break;

			}

		 ?>
         </div>
            
          
    </div>
</div>



<?php


	        
?>