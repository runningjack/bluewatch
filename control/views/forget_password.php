<? 
$rnd = rand(1000,99999);
if(isset($_POST['submit']) == "Request Now"){ email_class::request_password(); }?>
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
	
  <form id="form" method="post" action="" onsubmit="return validate_forget();">
      <strong><br />
      Reset your password</strong> | <a href=".">Home</a><br />
      <br />
    If you have forgotten your username or password, you can request to have   your username <br />
    emailed to you and to reset your password. When you fill   in your registered email address,<br />
you will be sent instructions on how   to reset your password.<br />
    <br />
    Email &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
<input name="email" type="text" class="input" id="email" size="50" />
    <br />
    
  	<!--Verification--> 
  
<label>
<?php
	//Generate token to be used to identify this instance of CAPTCHA
	$token = rand (10000, 1000000);
	echo "<input type=\"hidden\" name=\"x\" value=\"$token\" />";
?><img src="<?php echo "libs/ic.php?zq=$token"; ?>" />
<input type="text" name="veri" id="veri" class="input" />
 </label>
    <input type="submit" name="submit" id="submit" value="Request Now" class="btn" />
  </form>
  <div id="errMsg" class="errorMsg"><? if(isset($_GET['msg'])){echo $_GET['msg'] ;} ?></div>
	<div class="support">For technical support: <a href="mailto:info@upperlink.com.ng">info@upperlink.com.ng</a></div>
</div>
</body>
</html>