<? 
if(isset($_POST['submit'])){ $getMsg = user_group_class::delete_all_user();}
?>
<link href="modules/user_group/css/style.css" rel="stylesheet" type="text/css"/>
<script src="modules/user_group/jscript/priv_loader.js" type="text/javascript"></script>
<script src="modules/user_group/jscript/roles_manager.js" type="text/javascript"></script>
<script src="modules/user_group/jscript/add_user.js" type="text/javascript"></script>
<script src="modules/user_group/jscript/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="modules/user_group/css/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<div class="title-bar">&nbsp;&nbsp;<img src="modules/user_group/images/users.png"/> <strong style="font-size:16px">User/Role Administration</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #F30"><? echo isset($_GET['msg']) ? $_GET['msg'] : ""; ?></span></div>
<div class="wrapper">
  <br />
  <div class="cont">
  <? include('modules/user_group/components/tab.php'); ?>
  </div>
</div>

