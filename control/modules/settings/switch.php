<?
	require('libs/settings_class.php');
	switch($_GET['CMD'])
	{
		case "Apply Settings":
		settings_class::apply_settings();
		break;
	}
?>