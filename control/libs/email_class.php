<?
	class email_class{
		
		public static function request_password() // Request password
		{
			$project_name = PROJECTNAME;
			$cms = CMSFOLDER;
			$_POST["x"] = isset($_POST["x"]) ? $_POST["x"] : "hdgmf6hf587gtmsv87hdf54jr0gmf6gtmsv87gtm4jr0gmf6hdf54jr0gmf6sv87gtmsv87gtm";
			$token = md5($_POST["x"]);
			$captchaValue = isset($_SESSION[session_id() . "captcha_confirmimage_$token"]) ? $_SESSION[session_id() . "captcha_confirmimage_$token"] : "474yrh4sdgsdgs45aewtr4w56trsgsaffir73yeijkaf";
			if($captchaValue != $_POST['veri'])
			{
				echo "<script>document.location.href='.?$project_name=Forget Password&msg=Verification Code Wrong!'</script>";
				die();
			}
			
			$query = mysql_query("SELECT * FROM users WHERE email = '".addslashes($_POST['email'])."'") or die(mysql_error());
			$num = mysql_num_rows($query);
			if($num < 1)
			{
				echo "<script>document.location.href='.?$project_name=Forget Password&msg=Wrong Email Address!'</script>";
				die();
			}
			else 
			{
			  $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";	
			  
			  $code = substr(str_shuffle($alphanum), 0, 20);
			  mysql_query("UPDATE users SET request_code = '$code' WHERE email = '".addslashes($_POST['email'])."'") or die(mysql_error());
			  $res = mysql_fetch_object($query);
			  
			  $subject = "Your request to reset your password  for " . $_SERVER['HTTP_HOST'];
			  $msg = '<table width="500" border="0" align="left" cellpadding="10" cellspacing="0" style="border:1px solid #EFEFEF">
				  <tr>
				    <td align="left" valign="top" bgcolor="#F9F9F9">Dear '.$res->fullnames.',<br>
                      <br>
You have requested to reset your password on <a target="_blank" href="http://'.$_SERVER['HTTP_HOST'].'">'.$_SERVER['HTTP_HOST'].'</a> because you have forgotten
					  your password. If you did not request this, please ignore it.<br>
                      <br>
To reset your password, please click on this link to confirm : <a href="http://'.$_SERVER['HTTP_HOST']. "/". $cms .'?'.$project_name.'=Reset Password&pwdcode='.$code.'" target="_blank">'.$_SERVER['HTTP_HOST']. "/". $cms . "/" .'?'.$project_name.'=Reset Password&pwdcode='.$code.'</a> then your password will be reset and sent to your email.<br>
<br>
<strong>Your username is:</strong> '.$res->username.'<br>
<br>
All the best,<br>
Site Administrator.<br>
'.$_SERVER['HTTP_HOST'].'</td>
  </tr>
				  </table>';
				
				
			  email_class::send_mail($res->email, $subject, $msg);
			  echo "<script>document.location.href='.?$project_name=Forget Password&msg=Request sent! Please check your email for verification'</script>";
			}
		}
		
		public static function send_mail($to, $subject, $msg) // send mail
		{
			$project_name = PROJECTNAME;
			$from = EMAIL;
            		// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: ' . $from . "\r\n";

			
			//echo $to . "<br>" . $subject . "<br>" . $msg . "<br>" . $headers;
			//die();
			@mail($to, $subject, $msg, $headers);
			return;
		}
		
		public static function reset_password() // reset password now
		{
			$query = mysql_query("SELECT * FROM users WHERE request_code = '".$_GET['pwdcode']."'") or die(mysql_error());
			$num = mysql_num_rows($query);

			if($num > 0)
			{
			  $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";	
			  
			  $pwd = substr(str_shuffle($alphanum), 0, 8);
			  mysql_query("UPDATE users SET password = '".md5($pwd)."' WHERE request_code = '".$_GET['pwdcode']."'") or die(mysql_error());
			  $res = mysql_fetch_object($query);
			  
			  $subject = "Your new password for " . $_SERVER['HTTP_HOST'];
			  $msg = '<table width="500" border="0" align="left" cellpadding="10" cellspacing="0" style="border:1px solid #EFEFEF">
				  <tr>
					<td>Dear '.$res->fullnames.',<br>
					  <br>
					  As you requested, your password has now been reset. Your new details are as follows:
					  <br>
					  <strong>Your username is: </strong>'.$res->username.'<br>
					  <strong>Your password is: </strong>'.$pwd.'<br>
					  <br>
					  All the best,<br>
                      Site Administrator.<br>
					'.$_SERVER['HTTP_HOST'].'</td>
				  </tr>
				</table>';
			  email_class::send_mail($res->email, $subject, $msg);
			  
			}
			echo '<script>document.location.href=".?msg=Get Your Login Access From Yor Email!"</script>';
		}
	}
?>