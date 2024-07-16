<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->


<!-- modernhotel/ by Bankork, Thu, 27 Feb 2014 16:17:33 GMT -->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>HMS V1.0</title>
    
   
   <?php  $meta = array(
            array('name' => 'description', 'content' => 'Upperlink Hotel Management System Version 1.0'),
            array('name' => 'keywords', 'content' => 'Kano,Hotel Reservation System'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
            array('name' => 'viewport', 'content' => 'width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;')
        );
          echo meta($meta);
          echo link_tag('bootstrap/images/logo.png', 'shortcut icon');
    
    echo link_tag('clientbootstrap/css/bootstrap.css');
        
?>

    <?php echo link_tag('clientbootstrap/css/style.css'); 
    echo link_tag('clientbootstrap/css/prettyPhoto.css');
    echo link_tag('clientbootstrap/css/font-awesome.min.css'); ?>
    <!--[if IE 7]>
   <?php echo link_tag('css/font-awesome-ie7.min.css'); ?>
    <![endif]-->
    
    
    

<?php
   echo "<script src='" . base_url('clientbootstrap/js/jquery.min.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/bootstrap.min.js') . "' type='text/javascript'></script>";
   echo "<script src='" . base_url('clientbootstrap/js/jquery.easing.1.3.js') . "' type='text/javascript'></script>";
   echo "<script src='" . base_url('clientbootstrap/js/jquery.quicksand.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/superfish.js') . "' type='text/javascript'></script>";
   echo "<script src='" . base_url('clientbootstrap/js/hoverIntent.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/jquery.flexslider.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/jflickrfeed.min.js') . "' type='text/javascript'></script>";
   echo "<script src='" . base_url('clientbootstrap/js/jquery.prettyPhoto.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/jquery.elastislide.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/jquery.tweet.js') . "' type='text/javascript'></script>";
   echo "<script src='" . base_url('clientbootstrap/js/smoothscroll.js') . "' type='text/javascript'></script>";
  echo "<script src='" . base_url('clientbootstrap/js/jquery.ui.totop.js') . "' type='text/javascript'></script>";
 echo "<script src='" . base_url('clientbootstrap/js/ajax-mail.js') . "' type='text/javascript'></script>";
  echo "<script src='" . base_url('clientbootstrap/js/main.js') . "' type='text/javascript'></script>";?>
  
   
    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<?php
$uri = explode('/', uri_string());
if(isset($uri[1])){
if( $uri[1] == 'page'||$uri[1] == 'pickroom'||$uri[1] == 'success' ) {
 echo link_tag('clientbootstrap/css/bs-preview.css');
 echo "<script src='" . base_url('clientbootstrap/js/bs-preview.js') . "' type='text/javascript'></script>";   
}

}?>
 
  <?php  
  
  ?>  
    
   <?php echo link_tag('clientbootstrap/css/sequencejs.css');?>
    <?php
    echo "<script src='" . base_url('clientbootstrap/js/sequence.jquery-min.js') . "' type='text/javascript'></script>";
    echo "<script src='" . base_url('clientbootstrap/js/sequencejs-options.js') . "' type='text/javascript'></script>";
    ?>
<?php  
    echo link_tag('datepick/jquery.datepick.css');

echo "<script src='" . base_url('datepick/jquery.datepick.js') . "' type='text/javascript'></script>";   ?>
    
<script type="text/javascript">
/*$(function() {
	$('#checkindate').datepick({ minDate: 0});
	$('#checkoutdate').datepick({ minDate: 0});
});
*/

$(function () {
    $("#endDate").datepick({ minDate: 0});
    $("#startDate").datepick({
        minDate: 0,
        onSelect: function (dateText, inst) {
             
            var date = $.datepick.parseDate($.datepick._defaults.dateFormat, dateText);
            $("#endDate").datepick("option", "minDate", date);
            // the following is optional
            $("#endDate").datepick("setDate", date);
        }
    });
});


</script>
</head>

<body>

<!--Start header-->
<header class="container container-logo">
   <div class="row-fluid">
       <div class="span8">
           <a href="index-2.html" class="logo"><img src="<?php echo  base_url('bootstrap/images/logo2');?>">Pilgrim V1.0 
               <span class="slogan">Ogun State Muslim Pilgrims Board</span></a>
       </div>
       <div class="span4">
           <ul class="top-social hidden-phone pull-right">
               <li><a rel="tooltip" data-placement="bottom" data-original-title="Facebook" href="#">
                   <i class="icon-facebook-sign"></i>
               </a></li>
               <li><a rel="tooltip" data-placement="bottom" data-original-title="Twitter" href="#">
                   <i class="icon-twitter-sign"></i>
               </a></li>
               <li><a rel="tooltip" data-placement="bottom" data-original-title="Linkedin" href="#">
                   <i class="icon-linkedin-sign"></i>
               </a></li>
               <li><a rel="tooltip" data-placement="bottom" data-original-title="Pinterest" href="#">
                   <i class="icon-pinterest-sign"></i>
               </a></li>
               <li><a rel="tooltip" data-placement="bottom" data-original-title="Google+" href="#">
                   <i class="icon-google-plus-sign"></i>
               </a></li>
           </ul>
           <div class="clearfix"></div>
           <p class="phone2call hidden-phone pull-right">Call Us +234 7030657010</p>
           
           <form action="https://www.google.com" target="_blank">
               <div class="input-append top-search pull-right">
               <input   id="appendedInputButton" type="text">
               <button class="btn" type="button">Go!</button>
           </div>
           </form>
       </div>
   </div>
</header>
<!-- start: Top Menu -->
<div class="menu-wrapper">
<div class="container navbar">
    <div class="navbar-inner">
        <div class="container main-menu">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                
                
                   <ul class="nav">
                                <?php
                                $current_page = 1;
                                $uri = explode('/', uri_string());
                                if(count($uri) > 1) {
                                        if( $uri[1] == 'page' ) {
                                                $current_page = $uri[2];
                                        }
                                }


                                if(!empty($nav_links)) {
                                        foreach($nav_links as $link) {
                                                $cat = $link->page_ref_category;
                                                if($cat == 'Parent') {
                                                        $id = $link->page_ref_id;
                                                        $c = $current_page == $id ? "current-page" : '';
                                                        $name = $link->page_ref_name;
                                                        $children = $link->children;
                                                        
                                                        switch ($id) {
                                                            case 1:
                                                            $icoon = '<i class="icon-home"></i>';
                                                             break;
                                                            case 2:
                                                               $icoon = '<i class="icon-list"></i>';
                                                                break;
                                                            case 3:
                                                               $icoon = '<i class="icon-bolt"></i>';
                                                                break;
                                                            case 4:
                                                               $icoon = '<i class="icon-picture"></i>';
                                                                break;
                                                            case 5:
                                                               $icoon = '<i class="icon-pencil"></i>';
                                                                break;
                                                            case 13:
                                                               $icoon = '<i class="icon-envelope"></i>';
                                                                break;

                                                            default:
                                                                $icoon ='';
                                                                break;
                                                        }
                                                        
                                                        
                                                        $ref = $id == 1 ? base_url() : base_url()."web/page/$id";
                                                        $attributes = array('class'=>"dropdown-toggle",
                                                            'data-toggle'=>"dropdown");
                                                        if( $children > 0 ) {
                                                            echo '<li class="dropdown">'
                                                            . '<a  data-toggle="dropdown" class="dropdown-toggle" href="'.$ref.'">'.$icoon.$name.'</a>';
                                                            // echo '<li class="dropdown">' . anchor($ref, $name,$attributes);
                                                        }else{
                                                             echo '<li > <a href="'.$ref.'">'.$icoon.$name.'</a>' ;
                                                        }
                                                        

                                                        if( $children > 0 ) {
                                                                echo '<ul class="dropdown-menu">';                                                                foreach($nav_links as $_link) {
                                                                        if( $_link->page_ref_index == $id ) {
                                                                                $_id = $_link->page_ref_id;
                                                                                $_name = $_link->page_ref_name;
                                                                                $_ref = "web/page/$_id";
                                                                                echo "<li>" . anchor($_ref, $_name) . "</li>";
                                                                        }
                                                                }
                                                                echo "</ul>";
                                                        }

                                                        echo  "</li>";
                                                }
                                                //echo "<li>" . anchor($ref, strtoupper($name)) . "</li>";
                                        }
                                }

                                ?>
                       <li ><a href="<?php echo base_url('booking/success');?>">Reservation Status</a></li>
                                </ul>
                
                
            </div>
        </div>
    </div>
</div>
</div>
<!-- stop: Top Menu -->








