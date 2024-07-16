<div id="TabbedPanels1" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
      <li class="TabbedPanelsTab" tabindex="0">Users</li>
      <li class="TabbedPanelsTab" tabindex="1">Roles</li>
      <li class="TabbedPanelsTab" tabindex="2">Add Users</li>
      <li class="TabbedPanelsTab" tabindex="3">Privileges</li>
      <li class="TabbedPanelsTab" tabindex="4">Grant Privilege</li>
      <?
	  	// UPDATE TAB	
		extract($_GET);
		if(isset($UPD) == "Update")
		{
			?><li class="TabbedPanelsTab" tabindex="4">Update [<?= '<span style="color:#F30">'.$UID.'</span>'; ?>]&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="closeTAB('.?<?= PROJECTNAME; ?>=Control Panel&INC=User Group')">[x]</a></li> <?
		}
	  ?>
    </ul>
    <div class="TabbedPanelsContentGroup">
      <div class="TabbedPanelsContent">
      <? include('modules/user_group/inc/users.php'); ?>
      </div>
      <div class="TabbedPanelsContent">
       <? include('modules/user_group/inc/roles.php'); ?>
      </div>
      <div class="TabbedPanelsContent">
	  <? include('modules/user_group/inc/add_users.php'); ?>
      </div>
      <div class="TabbedPanelsContent">
      <? include('modules/user_group/inc/privileges.php'); ?>
      </div>
      <div class="TabbedPanelsContent">
	  <? include('modules/user_group/inc/grant_priv.php'); ?>
      </div>
		
      <?
	  	// UPDATE CONTENT
		extract($_GET);
		if(isset($UPD) == "Update")
		{ 
			?>
        	<div class="TabbedPanelsContent">
			<? include('modules/user_group/inc/update_user.php'); ?>
            </div>
        	<?
		}
		
	  
	  ?>
    </div>
  </div>
  <script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>