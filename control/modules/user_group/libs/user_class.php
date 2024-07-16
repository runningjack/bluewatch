<?
	class user_class{
		
     	public static function get_all_users() // get all users
	    {
			require('../../conf/settings.php');
			require('../../conf/connection.php');
			$project_name = PROJECTNAME;
			$rowsPerPage = 10; // how many rows to show per page
			$pageNum = 1; // by default we show first page
			if(isset($_GET['page'])){	$pageNum = $_GET['page']; } 	// if $_GET['page'] defined, use it as page number
				
			$offset = ($pageNum - 1) * $rowsPerPage; // counting the offset
			$j = 1;
			
			$query  = "SELECT * FROM  users ORDER BY users_role_id  ASC LIMIT $offset, $rowsPerPage"; // get records and display it
			$result = mysql_query($query) or die(mysql_error());
			
			echo "<TABLE border=0 width=100% align=center cellpadding=2 cellspacing=1>";
			echo '<tr>
            <td width="26" height="30" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;#</strong></td>
            <td width="250" height="30" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;Fullnames</strong></td>
            <td width="180" height="30" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;User Name</strong></td>
            <td width="200" height="30" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;Role / Group</strong></td>
            <td width="68" height="30" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;Status</strong></td>
            <td width="76" height="30" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;Logged</strong></td>
            <td width="10" height="30" align="left" valign="middle" class="errorMsg">&nbsp;</td>
            <td width="131" height="30" align="left" valign="middle" class="errorMsg"></td>
            </tr>';
			$c = 1;
			while ($myrow = mysql_fetch_array($result))
			{
				
				if($c % 2 == 0) {	$bgcolor="#FFFFFF";  }  else {  $bgcolor="#F9F9F9";  }
				$c++;
				echo "<TR>";
				
				echo "<TD width=20 height=30 align=left bgcolor=$bgcolor>&nbsp;";
				echo $j++;
							
				echo "<TD width=250 height=30 align=left  bgcolor=$bgcolor>&nbsp;";
				echo ucwords($myrow["fullnames"]);
				
				echo "<TD width=180 height=30 align=left  bgcolor=$bgcolor>&nbsp;";
				echo $myrow["username"];
				
				echo "<TD width=200 height=30 align=left  bgcolor=$bgcolor>&nbsp;";
				echo user_class::get_role_name($myrow["users_role_id"]);
				
				echo "<TD width=80 height=30 align=left  bgcolor=$bgcolor>&nbsp;";
				if($myrow["status"] == "Enabled")
				{
					
					?><a href="javascript:;" onclick="disableUser('modules/user_group/index.php?CMD=Disable Or Enable User&id=<?= $myrow["u_id"]; ?>')">
                    <img src="modules/user_group/images/enable_user.png" alt="User Activated" title="User Activated" width="16" height="16" border="0" />
                    </a>
					<?
				}
				else
				{
					?><a href="javascript:;" onclick="disableUser('modules/user_group/index.php?CMD=Disable Or Enable User&id=<?= $myrow["u_id"]; ?>')">
                    <img src="modules/user_group/images/disable_user.png" alt="User Deactivated" title="User Deactivated" width="16" height="16" border="0" />
                    </a>
					<?
				}
				
				
				echo "<TD width=50 height=30 align=left  bgcolor=$bgcolor>&nbsp;";
				if($myrow["logged"] == "Yes")
				{
					?><img src="modules/user_group/images/log_yes.png" alt="User Logged In"  title="User Logged In" width="16" height="16" border="0" /><?
				}
				else
				{
					?><img src="modules/user_group/images/log_no.png" alt="User Logged Out" title="User Logged Out" width="16" height="16" border="0" /><?
				}

				echo "<TD width=40 height=30 align=center bgcolor=$bgcolor>";
				?><a href=".?<?= PROJECTNAME; ?>=Control Panel&INC=User Group&UPD=Update&UID=<?= $myrow["username"]; ?>&id=<?= $myrow["u_id"]; ?>"><img src="modules/user_group/images/b_edit.png" alt="Edit Record" title="Edit Login Details" width="16" height="16" border="0" /></a><? 
				
					echo "<TD width=40 height=30 align=center bgcolor=$bgcolor>";
				?><a href="?<?= $project_name; ?>=Control Panel&INC=User Group&CMD=Delete User&id=<?= $myrow["u_id"]; ?>" onclick="return confirm('Are You Sure You Want To Delete This User?');"><img src="modules/user_group/images/b_drop.png" alt="Delete Record" title="Delete User" width="16" height="16" border="0" /></a><?
				
			}
			echo "</TABLE>";
			
			$query2   = "SELECT COUNT(u_id) AS numrows FROM  users"; // how many rows we have in database
			$result2  = mysql_query($query2) or die('Error, query failed');
			$row2     = mysql_fetch_array($result2);
			$numrows = $row2['numrows'];
			if($numrows != 0)
			{
			// how many pages we have when using paging?
			$maxPage = ceil($numrows/$rowsPerPage);
			
				if ($pageNum > 1)
				{
					$page = $pageNum - 1;
					//
					$prev = "<a href=\"javascript:;\" onclick=\"load_DataGrid_Next('modules/user_group/index.php?CMD=Show Users&page=$page')\"><img src='images/rewind.png' alt='Previous Page' width=16 height=16 border=0></a>";
					
					$first = "<a href=\"javascript:;\" onclick=\"load_DataGrid_Next('modules/user_group/index.php?CMD=Show Users&page=1')\"><img src='images/skip_backward.png' alt='First Page' width=16 height=16 border=0></a>";
				} 
				else
				{
					$prev  = "<img src='modules/user_group/images/rewind.png' alt='Previous Page'  title='Previous Page' width=16 height=16 border=0>";
					// we're on page one, don't enable 'previous' link
					$first = "<img src='modules/user_group/images/skip_backward.png' alt='First Page' title='First Page' width=16 height=16 border=0>";
					// nor 'first page' link
				}
			
				// print 'next' link only if we're not
				// on the last page
				if ($pageNum < $maxPage)
				{
					$page = $pageNum + 1;
					$next = "<a href=\"javascript:;\" onclick=\"load_DataGrid_Next('modules/user_group/index.php?CMD=Show Users&page=$page')\"><img src='modules/user_group/images/fast_forward.png' alt='Next Page' title='Next Page' width=16 height=16 border=0></a>";
					
					$last = "<a href=\"javascript:;\" onclick=\"load_DataGrid_Next('modules/user_group/index.php?CMD=Show Users&page=$maxPage')\"><img src='modules/user_group/images/skip_forward.png' alt='Last Page' title='Last Page' width=16 height=16 border=0></a>";
					
				} 
				else
				{
					$next = "<img src='modules/user_group/images/fast_forward.png' alt='Next Page' title='Next Page' width=16 height=16 border=0>";      // we're on the last page, don't enable 'next' link
					$last = "<img src='modules/user_group/images/skip_forward.png' alt='Last Page' title='Last Page' width=16 height=16 border=0>"; // nor 'last page' link
				
				}
			
			// print the page navigation link
	
echo <<<NavBar
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/user_group/images/m.png)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="22%" align="center" valign="middle">&nbsp;</td>
<td width="4%" align="center" valign="middle">		$first	</td>
<td width="4%" align="center" valign="middle">		$prev	</td>
<td width="4%" align="center" valign="middle">		$next	</td>
<td width="4%" align="center" valign="middle">		$last	</td>
<td width="36%" align="left" valign="middle">&nbsp;&nbsp;Page <font color='#FF6600'><strong>$pageNum</strong></font> of  <font color='#FF6600'><strong>$numrows</strong></font> Records &nbsp;</td>
</tr>
</table></td>
</tr>
</table>
NavBar;
	        }
			else
			{
echo <<<NavBar2
<p><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="middle">&nbsp;&nbsp;<img src="modules/user_group/images/warning.gif" /><font color="#FF6600"> No User Found!</font></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/user_group/images/m.jpg)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
</tr>
</table></td>
</tr>
</table><br/>
NavBar2;
			}
	
		}
		
		public static function get_all_roles() // get all roles
		{
			require('../../conf/connection.php');
			require('../../conf/settings.php');
			$project_name = PROJECTNAME;
			$rowsPerPage = 10; // how many rows to show per page
			$pageNum = 1; // by default we show first page
			if(isset($_GET['page'])){	$pageNum = $_GET['page']; } 	// if $_GET['page'] defined, use it as page number
					
			$offset = ($pageNum - 1) * $rowsPerPage; // counting the offset
			$j = 1;
			
			$query  = "SELECT * FROM  roles ORDER BY role_id  ASC LIMIT $offset, $rowsPerPage"; // get records and display it
			$result = mysql_query($query) or die(mysql_error());
			
			echo "<TABLE border=0 width=100% align=center cellpadding=2 cellspacing=1>";
			echo '<tr>
            <td width="26" height="30"  align="left" valign="middle" bgcolor="#D9F2FF"><strong>&nbsp;#</strong></td>
            <td width="250" height="30" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;Role Name</strong></td>
            <td width="180" height="30" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;Role Members</strong></td>
            </tr>';
			$c = 1;
			while ($myrow = mysql_fetch_array($result))
			{
				
				if($c % 2 == 0) {	$bgcolor="#FFFFFF";  }  else {  $bgcolor="#F9F9F9";  }
				$c++;
				echo "<TR>";
				
				echo "<TD width=20 height=30 align=left bgcolor=$bgcolor>&nbsp;";
				echo $j++;
							
				echo "<TD width=250 height=30  align=left  bgcolor=$bgcolor>&nbsp;";
				echo ucwords($myrow["role_type"]);
				
				echo "<TD width=180 height=30 align=left  bgcolor=$bgcolor>";
				user_class::users_in_role($myrow["role_id"]);

				if($myrow["status"] == "Enabled")
				{
						echo "<TD width=40 height=30  align=center bgcolor=$bgcolor>";
				?><div id="img_icon"><img src="modules/user_group/images/enable_role.png" alt="Enable Role" title="Enable Role" width="16" height="16" border="0" /></div><?
				}
				else
				{
						echo "<TD width=40 height=30  align=center bgcolor=$bgcolor>";
				?><div id="img_icon"><img src="modules/user_group/images/disable_role.png" alt="Disable Role" title="Disable Role" width="16" height="16" border="0" /></div><?
				}
				
				
			}
			echo "</TABLE>";
			
			$query2   = "SELECT COUNT(role_id) AS numrows FROM  roles"; // how many rows we have in database
			$result2  = mysql_query($query2) or die('Error, query failed');
			$row2     = mysql_fetch_array($result2);
			$numrows = $row2['numrows'];
			if($numrows != 0)
			{
		
			// how many pages we have when using paging?
			$maxPage = ceil($numrows/$rowsPerPage);
			
				if ($pageNum > 1)
				{
					$page = $pageNum - 1;
					//
					$prev = "<a href=\"javascript:;\" onclick=\"load_RoleDataGrid_Next('modules/user_group/index.php?CMD=Show Roles&page=$page')\"><img src='images/rewind.png' alt='Previous Page' width=16 height=16 border=0></a>";
					
					$first = "<a href=\"javascript:;\" onclick=\"load_RoleDataGrid_Next('modules/user_group/index.php?CMD=Show Roles&page=1')\"><img src='images/skip_backward.png' alt='First Page' width=16 height=16 border=0></a>";
				} 
				else
				{
					$prev  = "<img src='modules/user_group/images/rewind.png' alt='Previous Page'  title='Previous Page' width=16 height=16 border=0>";
					// we're on page one, don't enable 'previous' link
					$first = "<img src='modules/user_group/images/skip_backward.png' alt='First Page' title='First Page' width=16 height=16 border=0>";
					// nor 'first page' link
				}
			
				// print 'next' link only if we're not
				// on the last page
				if ($pageNum < $maxPage)
				{
					$page = $pageNum + 1;
					$next = "<a href=\"javascript:;\" onclick=\"load_RoleDataGrid_Next('modules/user_group/index.php?CMD=Show Roles&page=$page')\"><img src='modules/user_group/images/fast_forward.png' alt='Next Page' title='Next Page' width=16 height=16 border=0></a>";
					
					$last = "<a href=\"javascript:;\" onclick=\"load_RoleDataGrid_Next('modules/user_group/index.php?CMD=Show Roles&page=$maxPage')\"><img src='modules/user_group/images/skip_forward.png' alt='Last Page' title='Last Page' width=16 height=16 border=0></a>";
					
				} 
				else
				{
					$next = "<img src='modules/user_group/images/fast_forward.png' alt='Next Page' title='Next Page' width=16 height=16 border=0>";      // we're on the last page, don't enable 'next' link
					$last = "<img src='modules/user_group/images/skip_forward.png' alt='Last Page' title='Last Page' width=16 height=16 border=0>"; // nor 'last page' link
				
				}
			
			// print the page navigation link
	
echo <<<NavBar
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/user_group/images/m.png)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="22%" align="center" valign="middle">&nbsp;</td>
<td width="4%" align="center" valign="middle">		$first	</td>
<td width="4%" align="center" valign="middle">		$prev	</td>
<td width="4%" align="center" valign="middle">		$next	</td>
<td width="4%" align="center" valign="middle">		$last	</td>
<td width="36%" align="left" valign="middle">&nbsp;&nbsp;Page <font color='#FF6600'><strong>$pageNum</strong></font> of  <font color='#FF6600'><strong>$numrows</strong></font> Records &nbsp;</td>
</tr>
</table></td>
</tr>
</table>
NavBar;
	        }
			else
			{
echo <<<NavBar2
<p><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="middle">&nbsp;&nbsp;<img src="modules/user_group/images/warning.gif" /><font color="#FF6600"> No Role Found!</font></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/user_group/images/m.jpg)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
</tr>
</table></td>
</tr>
</table><br/>
NavBar2;
			}
	
		}
		
		public static function get_all_privileges() // get all privileges
		{
			require('../../conf/connection.php');
			require('../../conf/settings.php');
			$project_name = PROJECTNAME;
			$rowsPerPage = 10; // how many rows to show per page
			$pageNum = 1; // by default we show first page
			if(isset($_GET['page'])){	$pageNum = $_GET['page']; } 	// if $_GET['page'] defined, use it as page number
					
			$offset = ($pageNum - 1) * $rowsPerPage; // counting the offset
			$j = 1;
			
			$query  = "SELECT * FROM  privileges ORDER BY priv_id  ASC LIMIT $offset, $rowsPerPage"; // get records and display it
			$result = mysql_query($query) or die(mysql_error());
			
			echo "<TABLE border=0 width=100% align=center cellpadding=2 cellspacing=1>";
			echo '<tr>
            <td width="26" height="30"  align="left" valign="middle" bgcolor="#D9F2FF"><strong>&nbsp;#</strong></td>
            <td width="250" height="30" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;Privilege</strong></td>
            </tr>';
			$c = 1;
			while ($myrow = mysql_fetch_array($result))
			{
				
				if($c % 2 == 0) {	$bgcolor="#FFFFFF";  }  else {  $bgcolor="#F9F9F9";  }
				$c++;
				echo "<TR>";
				
				echo "<TD width=20 height=30 align=left bgcolor=$bgcolor>&nbsp;";
				echo $j++;
							
				echo "<TD width=250 height=30  align=left  bgcolor=$bgcolor>&nbsp;";
				echo $myrow["priv_type"];
				
			}
			echo "</TABLE>";
			
			$query2   = "SELECT COUNT(priv_id) AS numrows FROM   privileges"; // how many rows we have in database
			$result2  = mysql_query($query2) or die('Error, query failed');
			$row2     = mysql_fetch_array($result2);
			$numrows = $row2['numrows'];
			if($numrows != 0)
			{
			// how many pages we have when using paging?
			$maxPage = ceil($numrows/$rowsPerPage);
			
				if ($pageNum > 1)
				{
					$page = $pageNum - 1;
					//
					$prev = "<a href=\"javascript:;\" onclick=\"load_PrivDataGrid_Next('modules/user_group/index.php?CMD=Show Privileges&page=$page')\"><img src='images/rewind.png' alt='Previous Page' width=16 height=16 border=0></a>";
					
					$first = "<a href=\"javascript:;\" onclick=\"load_PrivDataGrid_Next('modules/user_group/index.php?CMD=Show Privileges&page=1')\"><img src='images/skip_backward.png' alt='First Page' width=16 height=16 border=0></a>";
				} 
				else
				{
					$prev  = "<img src='modules/user_group/images/rewind.png' alt='Previous Page'  title='Previous Page' width=16 height=16 border=0>";
					// we're on page one, don't enable 'previous' link
					$first = "<img src='modules/user_group/images/skip_backward.png' alt='First Page' title='First Page' width=16 height=16 border=0>";
					// nor 'first page' link
				}
			
				// print 'next' link only if we're not
				// on the last page
				if ($pageNum < $maxPage)
				{
					$page = $pageNum + 1;
					$next = "<a href=\"javascript:;\" onclick=\"load_PrivDataGrid_Next('modules/user_group/index.php?CMD=Show Privileges&page=$page')\"><img src='modules/user_group/images/fast_forward.png' alt='Next Page' title='Next Page' width=16 height=16 border=0></a>";
					
					$last = "<a href=\"javascript:;\" onclick=\"load_PrivDataGrid_Next('modules/user_group/index.php?CMD=Show Privileges&page=$maxPage')\"><img src='modules/user_group/images/skip_forward.png' alt='Last Page' title='Last Page' width=16 height=16 border=0></a>";
					
				} 
				else
				{
					$next = "<img src='modules/user_group/images/fast_forward.png' alt='Next Page' title='Next Page' width=16 height=16 border=0>";      // we're on the last page, don't enable 'next' link
					$last = "<img src='modules/user_group/images/skip_forward.png' alt='Last Page' title='Last Page' width=16 height=16 border=0>"; // nor 'last page' link
				
				}
			
			// print the page navigation link
	
echo <<<NavBar
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/user_group/images/m.png)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="22%" align="center" valign="middle">&nbsp;</td>
<td width="4%" align="center" valign="middle">		$first	</td>
<td width="4%" align="center" valign="middle">		$prev	</td>
<td width="4%" align="center" valign="middle">		$next	</td>
<td width="4%" align="center" valign="middle">		$last	</td>
<td width="36%" align="left" valign="middle">&nbsp;&nbsp;Page <font color='#FF6600'><strong>$pageNum</strong></font> of  <font color='#FF6600'><strong>$numrows</strong></font> Records &nbsp;</td>
</tr>
</table></td>
</tr>
</table>
NavBar;
	        }
			else
			{
echo <<<NavBar2
<p><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="middle">&nbsp;&nbsp;<img src="modules/user_group/images/warning.gif" /><font color="#FF6600"> No Privilege Found!</font></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/user_group/images/m.jpg)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
</tr>
</table></td>
</tr>
</table><br/>
NavBar2;
			}
	
		}
			
		private static function get_role_name($r_id) // return role name
		{
			$sql = mysql_query("SELECT role_type  FROM roles WHERE role_id='$r_id'") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			return $result->role_type;
			
		}
		
		public static function delete_user() // delete user
		{
			$project_name = PROJECTNAME;
			extract($_GET);
			if($id == "1")
			{ 
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=User Group&msg=You Cannot Delete User With Administrators Role!'</script>";
				die();
			}
			$sql = mysql_query("DELETE FROM users WHERE u_id='$id'") or die(mysql_error());
			if(!$sql)
			{
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=User Group&msg=User Not Deleted!'</script>";
			}
			else
			{
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=User Group&msg=User Deleted!'</script>";
			}
		}
		
		private static function users_in_role($r_id) // get all users on role
		{
			$sql = mysql_query("SELECT username FROM users WHERE users_role_id='$r_id'");
			$num = mysql_num_rows($sql);
			if($num != 0)
			{
				while($rows = mysql_fetch_array($sql))
				{
					echo $rows["username"] . ", ";
				}
			}
			else
			{
				echo "No User!";
			}
		}
		
		public static function get_roles_for_drop_down_menu() // get all role for drop down menu
		{
			$sql = mysql_query("SELECT * FROM roles") or die(mysql_error());	
			$num = mysql_num_rows($sql);
			if($num != 0)
			{
				while($rows = mysql_fetch_array($sql))
				{
					echo "<option value='".$rows["role_type"]."'>" .$rows["role_type"]. "</option>";
				}
			}
		}
		
		public static function get_priv_for_checkbox($val) // get all privilege and check the ones assign to this role
		{
			require('../../conf/connection.php');
			$sql = mysql_query("SELECT * FROM privileges  ORDER BY priv_id ASC") or die(mysql_error());	
			$num = mysql_num_rows($sql);
			
			$sql2 = mysql_query("SELECT role_id FROM roles
									   WHERE role_type='$val'") or die(mysql_error());
			$result2 = mysql_fetch_object($sql2);
			$role_id = $result2->role_id;
			
			if($num != 0)
			{
			
				while($rows = mysql_fetch_array($sql))
				{
					$priv_id = $rows["priv_id"];
					$sql3 = mysql_query("SELECT * FROM grant_role_privilege
										WHERE r_id = '$role_id'
										AND p_id = '$priv_id'");
			        $num3 = mysql_num_rows($sql3);
					 ?>
                        <input type="checkbox" name="priv[]" id="priv" <? if($num3 > 0){ echo "checked";} ?>
                        value="<?= $rows["priv_id"]; ?>">&nbsp;<?= $rows["priv_type"]; ?><br>
					 <?
				}
			}
		}
		
		public static function add_user() // add user
		{
			$project_name = PROJECTNAME;
			extract($_POST);
			$email = addslashes($email);
			$sql =mysql_query("SELECT * FROM users WHERE username='".htmlspecialchars($username)."'") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			if($result != 0)
			{
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=User Group&msg=Username already exist!'</script>";
			}
			$sql =mysql_query("SELECT * FROM users WHERE email='".addslashes($email)."'") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			if($result != 0)
			{
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=User Group&msg=Email Address already exist!'</script>";
			}
			else
			{
				$sqlrole = mysql_query("SELECT role_id FROM roles WHERE role_type ='".htmlspecialchars($roleT)."'") or die(mysql_error());
				$resultid = mysql_fetch_object($sqlrole);
				$sql = mysql_query("INSERT INTO users 
								   SET fullnames='".htmlspecialchars($fullnames)."', 
								   username='".htmlspecialchars($username)."', 
								   password='".md5($password)."', 
								   email='$email',
								   status='Disabled', 
								   users_role_id='".$resultid->role_id."', 
								   logged='No'");
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=User Group&msg=User Added!'</script>";
				
			}
			
		}
		
		public static function update_user() // update user
		{
			$project_name = PROJECTNAME;
			extract($_GET);
			extract($_POST);
			$u_id = htmlentities($user_name);
			$email = addslashes($email);
			if($urole == "Administrator" && $id  != "1")
			{ 
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=User Group&msg=This User Cannot Be Assigned Administrators Role!'</script>";
			die();
			}
			if($urole != "Administrator" && $id  == "1")
			{ 
				echo "<script>document.location.href='.?$project_name=Control Panel&INC=User Group&msg=This User Cannot Be Assigned Another Role!'</script>";
			die();
			}
			$sqlrole = mysql_query("SELECT role_id FROM roles WHERE role_type ='$urole'") or die(mysql_error());
			$resultid = mysql_fetch_object($sqlrole);
			if($c_pwd == "Yes")
			{
				
				$sql = mysql_query("UPDATE users 
								   SET fullnames='$fullname', 
								   username='$u_id', 
								   password='".md5($password)."',
								   email='$email', 
								   users_role_id='".$resultid->role_id."'
								   WHERE u_id='$id'") or die(mysql_error());
				if(!$sql){ $msg = "Update Failed!";	}else{ $msg = "Update Successful!";	}
			}
			else
			{
				$sql = mysql_query("UPDATE users 
								   SET fullnames='$fullname', 
								   username='$u_id',
								   email='$email', 
								   users_role_id='".$resultid->role_id."'
								   WHERE u_id='$id'") or die(mysql_error());
				
				
				if(!$sql){ $msg = "Update Failed!";	}else{ $msg = "Update Successful!";	}
			}
		  echo "<script>document.location.href='.?$project_name=Control Panel&INC=User Group&msg=$msg'</script>";
		}
		
		public static function grant_privileges() // match and grant privileges
		{
			extract($_POST);
			$privnum = count($_POST['priv']);
		    $sql = mysql_query("SELECT role_id FROM roles WHERE role_type ='$role' ORDER BY role_id ASC") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			$r_id = $result->role_id;
			 @mysql_query("DELETE FROM grant_role_privilege WHERE r_id='$r_id'") or die(mysql_error());
			   for($i=0; $i<=$privnum - 1; $i++)
			   {
				  
				  $p_id = $_POST['priv'][$i];
				   mysql_query("INSERT INTO grant_role_privilege SET r_id='$r_id', p_id='$p_id'") or die(mysql_error());		  
			   }
		 return "Privilege Updated!";
		}
		
		private static function get_priv_granted_id($privVal) // return privilege granted id from role_id
		{
			 $sqlg_priv = mysql_query("SELECT p_id FROM grant_role_privilege WHERE r_id ='$privVal'") or die(mysql_error());
			 $result_priv = mysql_num_rows($sqlg_priv);
			 if($result_priv != 0)
			 {
				$granted_priv = array();
				while($rows = mysql_fetch_array($sqlg_priv))
				{
					$granted_priv[] = $rows["p_id"];
				}
				
			 }
			 return $granted_priv;
		}
		
		public static function get_update_user($id) // get user info for update form
		{
			$sql = mysql_query("SELECT * FROM users WHERE u_id='$id'") or die(mysql_error());
			$result = mysql_fetch_object($sql);
			$r_id = user_class::get_role_name($result->users_role_id);
			$arrVal = array('rol'=>$r_id, 'fname'=>$result->fullnames, 'uid'=>$result->username, 'email'=>$result->email, 'psw'=>$result->password);
			return $arrVal;
		}
		
		public static function add_roles() // add role
		{
			require('../../conf/connection.php');
			extract($_GET); 
			$sql = mysql_query("SELECT * FROM roles WHERE role_type='$role'") or die(mysql_error());
			$num = mysql_num_rows($sql);
			if($num != 0)
			{
				echo 0; // Role Already Exist!
			}
			else
			{
				$sql2 = mysql_query("INSERT INTO roles SET role_type='$role', status='Enabled'") or die(mysql_error());
				if(!$sql2)
				{
					echo 1; // Cannot Add Role!
				}
				else
				{
					echo 2; // Role Added!
				}
			}
			
		}
		
		public static function disable_roles() // disable or enable role
		{
			require('../../conf/connection.php');
			extract($_GET); 
			$get_state = mysql_query("SELECT status FROM roles WHERE role_type='$role'");
			$set_state = mysql_fetch_object($get_state);
			if($set_state->status == "Disabled")
			{
				$state = "Enabled";
			}
			else
			{
				$state = "Disabled";
			}
			$sql = mysql_query("UPDATE roles SET status='$state' WHERE role_type='$role'");
			if(!$sql)
			{ 
				echo 0; // Failed! 
			}
			else
			{ 
				echo 1; //  Success!
			}
		}
		
		public static function disable_enable_user() // disable or enable user
		{
			require('../../conf/connection.php');
			extract($_GET); 
			$get_state = mysql_query("SELECT status FROM users WHERE u_id='$id'");
			$set_state = mysql_fetch_object($get_state);
			if($set_state->status == "Disabled")
			{
				$state = "Enabled";
			}
			else
			{
				$state = "Disabled";
			}
			$sql = mysql_query("UPDATE users SET status='$state' WHERE u_id='$id'");
			if(!$sql)
			{ 
				echo "Unable to update record!"; // Failed! 
			}
			else
			{ 
				echo $state; //  Success!
			}
		}
		
		
		
	}//end class
?>