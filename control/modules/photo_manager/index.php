<?
		setting_class::check_access_right("Photo Manager");
		if(empty($_GET['CMD'])){ include('inc/gallery.php'); }
		else{
                        switch($_GET['CMD']){

                            case"Upload Picture":
                            include('inc/create_album.php');
                            break;

                            case"View Sub Albums":
                            include('inc/view_sub_album.php');
                            break;

                            case "View Images In Sub Album":
                            include('inc/view_images_in_sub_album.php');
                            break;

                            case"View Album Images":
                            include('inc/view_album_images.php');
                            break;

                            /*case"View Image Details":
                            include('inc/view_album_details.php');
                            break;*/

                            case"View Image":
                            include('inc/view_image.php');
                            break;

                            case"Edit Image":
                            include('inc/edit_image.php');
                            break;

                            case"Delete Image":
                            gallery_class::delete_image();
                            break;


                            case"Delete Album":
                            gallery_class::delete_album();
                            break;

                            case"Delete Sub Album":
                            gallery_class::delete_sub_album();
                            break;
                    }
		}
?>

