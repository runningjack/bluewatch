<?
	setting_class::check_access_right("News Cast");
	switch($_GET['CMD']){
		
		default:
		include('inc/dashboard.php');
		break;
		
		case"Create News":
		include('inc/create_news.php');
		break;
		
		case"Create News Session":
		require('libs/news_class.php');
		news_class::create_session();
		break;
		
		case "View News":
		include('inc/view_news.php');
		break;
		
		case "Edit News":
		include('inc/edit_news.php');
		break;
		
		case "Delete News":
		news_class::delete_news();
		break;
		
	}
?>