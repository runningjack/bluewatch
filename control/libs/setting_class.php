<?
	class setting_class{
		
		public static function get_settings() // system settings
		{
			$query = mysql_query("SELECT * FROM settings") or die(mysql_error());
			$sql = mysql_fetch_object($query);
			$num = mysql_num_rows($query);
			if($num != 0)
			{
				$arr = array('id'=>$sql->id, 'name'=>$sql->company_name, 'footer'=>$sql->footer, 'img'=>$sql->imgpath);
				return $arr;
			}
			else
			{
				echo "System settings undefined!";
			}
		}
		
		public static function get_users() // get num of users
		{
			$sql = mysql_query("SELECT * FROM users") or die(mysql_error());
			$num = mysql_num_rows($sql);
			
			$sql = mysql_query("SELECT * FROM users WHERE logged = 'Yes'") or die(mysql_error());
			$log = mysql_num_rows($sql);
			
			$users = array('num'=>$num, 'log'=>$log);
			
			return $users;
			
		}
		
		public static function left_menu_link() // get menu links by priviledge grated to user
		{
			$query = mysql_query("SELECT * FROM grant_role_privilege JOIN privileges 
								 ON privileges.priv_id = grant_role_privilege.p_id
								 AND grant_role_privilege.r_id = '".base64_decode($_SESSION['role'])."'
								 ORDER BY privileges.priv_id") or die(mysql_error());
			
			while($rows = mysql_fetch_array($query)){
				echo '<li>'.$rows["module_link"].'</li>';
			}
		}
		
		public static function check_access_right($module) // check access right 
		{
			$project_name = PROJECTNAME;
			$p_id = setting_class::module_priviledge($module);
			$query = mysql_query("SELECT * FROM grant_role_privilege
								 WHERE r_id = '".base64_decode($_SESSION['role'])."'
								 AND p_id = '$p_id'") or die(mysql_error());
			$num = mysql_num_rows($query);
			if($num < 1)
			{
				echo "<script>alert('Access Denied!');document.location.href='.?$project_name=Control Panel'</script>";
			}
		}
				
		public static function module_priviledge($module) // get module priviledge id
		{
			$query = mysql_query("SELECT priv_id FROM privileges WHERE priv_type = '$module'") or die(mysql_error());
			$res = mysql_fetch_object($query);
			return $res->priv_id;
		}
		
	}
?>