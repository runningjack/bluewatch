<?
	if(!isset($_GET['CMD'])){
		setting_class::check_access_right("User Group");
		include('inc/dashboard.php');
		}
	else{
		switch($_GET['CMD']){
			
			
			case "Delete User":
			user_class::delete_user();
			break;		
			
			case "Edit User":
			include('inc/edit_user.php');
			break;
	
			case "Add Roles":
			require('libs/user_class.php'); // require the class because this is loaded via ajax
			user_class::add_roles();
			break;
			
			case "Show Privileges":
			require('libs/user_class.php'); // require the class because this is loaded via ajax
			user_class::get_all_privileges();
			break;
			
			case "Show Roles":
			require('libs/user_class.php'); // require the class because this is loaded via ajax
			user_class::get_all_roles();
			break;
			
			case "Show Users":
			require('libs/user_class.php'); // require the class because this is loaded via ajax
			user_class::get_all_users();
			break;
			
			
			
			case "Disable Roles":
			require('libs/user_class.php'); // require the class because this is loaded via ajax
			user_class::disable_roles();
			break;
			
			case "Add User":
			require('libs/user_class.php'); // require the class because this is loaded via ajax 
			user_class::add_user();
			break;
			
			case "Update User":
			require('libs/user_class.php'); // require the class because this is loaded via ajax 
			user_class::update_user();
			break;
			
			case "Disable Or Enable User":
			require('libs/user_class.php'); // require the class because this is loaded via ajax 
			user_class::disable_enable_user();
			break;
				
			case "Grant Privileges":
			require('libs/user_class.php'); // require the class because this is loaded via ajax
			user_class::grant_privileges($_GET);
			break;
			
			case "Get Privileges":
			require('libs/user_class.php'); // require the class because this is loaded via ajax
			user_class::get_priv_for_checkbox($_GET['val']);
			break;
	
			
		}
	}
?>

