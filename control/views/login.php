<? 
$project_name = PROJECTNAME;
if(isset($_POST['submit'])){ login_class::verify_login_access(); }?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= PROJECTNAME; ?> | Admin Session</title>
<link rel="shortcut icon"  href="images/icon.png" type="image/x-icon" />
<link href="css/style.css" type="text/css" rel="stylesheet" />
<script language="javascript" src="jscript/script.js" type="text/javascript"></script>
<?php //require("meta-tag.php"); ?>
</head>
<body>
<div class="login-top-bar"></div>
<div class="login-container">
	<div class="login-desc"><img src="images/contentmd.png" width="16" height="16" /><strong> Content Manager</strong><br />
	  <span style="color:#333; font-size:10px">Manage your webpage content faster and more convinently</span><br />
	<br />
	<strong><img src="images/photomd.png" width="16" height="16" /> Photo Manager</strong><br />
	<span style="color:#333; font-size:10px">Your photo manager just got better</span>
	<br />
	<br />
	<strong><img src="images/user_accept.png" width="16" height="16" /> Authorize Users</strong><br />
	<span style="color:#333; font-size:10px">Control who manges and access your content  by assigning roles and privileges</span>
</div>
	<div class="login-form">
    <form id="form" method="post" action="" onsubmit="return validate_login();">
      <div class="error"></div>
    <img src="images/login.png" width="24" height="24" /><strong>&nbsp;Sign in with your account</strong><br /><br />
    Username &nbsp;<input type="text" id="uid" name="uid" class="input" /><br /><br />
    Password &nbsp;&nbsp;<input type="password" id="pwd" name="pwd" class="input" /><br /><br />
    <a href="?<?= $project_name ?>=Forget Password">Forget Password</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" name="submit" id="submit" value="Sign In" class="btn" />
  	</form>
    <div id="error" class="errorMsg">
    <? 
		if(isset($_GET['msg']) == "False"){
			 echo "Invalid Access!";
		}
		elseif(isset($_GET['msg']) == "Logout"){
			echo "You Have Successfully Logged Out!";
		}
		elseif(isset($_GET['msg']) == "Disabled"){
			echo "You Have Not Been Activated!";
		}
		else{
			
			$ms = isset($_GET['msg']) ? $_GET['msg']: "";
			echo $ms;
		}
	?>
    </div>
    <span class="errorMsg">    </span>
    </div>
	<div class="support">For technical support: <a href="mailto:info@upperlink.com.ng">info@upperlink.com.ng</a></div>
</div>
</body>
</html>