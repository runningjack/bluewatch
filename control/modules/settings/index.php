<?  setting_class::check_access_right("System Settings");
	require('libs/auth_privilege.php');
	switch(isset($_GET['CMD'])){
		
		default:
		include('inc/add_settings.php');
		break;
		
		
	}
?>

