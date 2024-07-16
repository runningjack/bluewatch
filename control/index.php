<?	session_start();
	
	error_reporting(E_ALL ^ E_NOTICE);
	require('inc/require.php');
	require('conf/connection.php');
	
	if(empty($_GET[PROJECTNAME])){ include('views/login.php'); }
	else
	{
		switch($_GET[PROJECTNAME])
		{
			
			case"Control Panel":
			include('views/panel.php');
			break;
			
			case"Forget Password":
			include('views/forget_password.php');
			break;
			
			case"Reset_Password":
			email_class::reset_password();
			break;
				
			// Calling methods in linkCMS_auth_class
			case "Logout":
			login_class::logout_session();
			break;
		}
	}
?>