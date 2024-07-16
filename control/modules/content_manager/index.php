<?  setting_class::check_access_right("Content Manager");
	switch($_GET['CMD']){
		
		default:
		include('inc/all_webpages.php');
		break;
		
		case "Create Web Page":
		include('inc/create_webpage.php');
		break;
		
		case "Directory":
		include('inc/directory.php');
		break;
		
		case "Add_Content":
		include('inc/addcontent.php');
		break;
		
		case "Edit_Section":
		include('inc/editcontent.php');
		break;
		
		case "View Web Page":
		include('inc/view_webpage.php');
		break;
		
		case "Edit Web Page":
		include('inc/edit_webpage.php');
		break;
		
		case "Delete Web Page":
		content_man_class::delete_web_page();
		break;
		
	}
?>

