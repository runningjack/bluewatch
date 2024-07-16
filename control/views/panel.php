<? 
login_class::auth_login_access();
$set = setting_class::get_settings();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $set['name']; ?></title>
<link rel="shortcut icon"  href="images/icon.png" type="image/x-icon" />
<link href="css/style.css" type="text/css" rel="stylesheet" />

<link rel="stylesheet" href="modules/content_manager/classes/jquery.treeview.css" />
<script type="text/javascript" src="modules/content_manager/classes/jquery-1.7.1.min.js"></script>
<script src="modules/content_manager/classes/jquery.cookie.js" type="text/javascript"></script>
<script src="modules/content_manager/classes/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript" src="modules/content_manager/classes/demo.js"></script>
</head>
<body>
<? include('inc/top-bar.php'); ?>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="disablerLoading" class="noshow"><img src="images/loading.gif" align="left" />&nbsp;Loading...</div></td>
  </tr>
</table>
<div class="container">
	
    <? include('inc/banner.php'); ?>
   
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" align="left" valign="top">
         <div class="welcome-bar">&nbsp;&nbsp;&nbsp;&nbsp;Welcome to [ <strong><?= $_SESSION['validuser']; ?></strong> ]&nbsp; [ <a href=".?<?= PROJECTNAME; ?>=Logout">Sign Out</a> ]<span class="time"><?= $log_time; ?></span></div>
    </td>
      </tr>
      <tr>
        <td width="18%" align="left" valign="top"><div class="left-side-menu"><? include('inc/side-bar.php'); ?></div></td>
        <td width="82%" align="left" valign="top"><div id="showcontent" class="controlboard">
          <?
		  if(!isset($_GET['INC'])){ include('dashboard.php'); }
		  else{
				switch($_GET['INC'])
				{
								
					// Content Manager Module
					case"Content Manager":
					include('modules/content_manager/index.php');
					break;
					
					// Photo Manager Module
					case"Photo Manager":
					include('modules/photo_manager/index.php');
					break;
							
					// News Cast
					case"News Cast":
					include('modules/news_cast/index.php');
					break;
					
					// User Group
					case"User Group":
					include('modules/user_group/index.php');
					break;
					
					// Settings
					case"Settings":
					include('modules/settings/index.php');
					break;
					
					// Plugins here
				
				}
		  }
	?>
        </div></td>
      </tr>
    </table>
</div>
<br />
<? include ('inc/footer.php'); ?>
  <div id="dockBottom" class="dockbtm">&nbsp;</div>
</body>
</html>