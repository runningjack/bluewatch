<?
	class login_class{
		
		public static function verify_login_access()
		{
			extract($_POST);
			$project_name = PROJECTNAME;
			$username = htmlspecialchars($uid);
			$password = htmlspecialchars($pwd);
			$query = mysql_query("SELECT * FROM users WHERE username = '$username' AND password = '".md5($password)."'") or die(mysql_error());
			$sql = mysql_fetch_object($query);
			$num = mysql_num_rows($query);
			
			if($num != 0){ 
				
				if($sql->status != "Disabled")
				{
					$_SESSION['library_session'] = md5("enter");
					$_SESSION['validuser'] = $sql->username;
					$_SESSION['role'] = base64_encode($sql->users_role_id);
					mysql_query("UPDATE users SET logged='Yes' WHERE username='".$_SESSION['validuser']."'") or die(mysql_error());
					
					echo "<script>document.location.href='.?$project_name=Control Panel'</script>";
				}
				else
				{
					header('location: .?msg=Disabled');
				}
				
			}else{
				
				header('location: .?msg=False');
			}
			
		}
		
		public static function auth_login_access()
		{
			if($_SESSION['library_session'] != md5("enter")){ header('location: .?msg=False'); }		
		}
		
		public static function check_login_session()
		{
			if($_SESSION['library_session'] == md5("enter")){ return true; }		
		}
		
		public static function logout_session()
		{
			mysql_query("UPDATE users SET logged='No' WHERE username='".$_SESSION['validuser']."'");
			session_destroy();
			header('location: .?msg=Logout');
			
		}
		
	}
?>