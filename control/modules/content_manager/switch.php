<?	
    require('libs/content_man_class.php');
	require('../../conf/connection.php');
	switch($_GET['CMD'])
	{

		case"View Web Page":
		include('inc/view_webpage.php');
		break;
		
		case"Search For Web Page":
		include('inc/search_webpage.php');
		break;
		
		case"Upload Image":
		content_man_class::upload_cms_image();
		break;
		
		case"Create Session":
		content_man_class::create_session();
		break;
	}
?>