<?
    // This file contains a call to all system classes used
	// If you need to cal any class any where in this system just include the path there
	
	require('conf/settings.php');
	include('libs/setting_class.php');
	require('libs/login_class.php');
	require('libs/email_class.php');
	
	// Content manager class
	require('modules/content_manager/libs/content_man_class.php');
       
        // Photo Gallery class
	require('modules/photo_manager/libs/gallery_class.php');


	// News Cast class
	require('modules/news_cast/libs/news_class.php');


	// User Group class
	require('modules/user_group/libs/user_class.php');
	
	// System settings class
	require('modules/settings/libs/settings_class.php');
	
	
	
?>