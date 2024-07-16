<!DOCTYPE html >
<html>
    <head>
        <title><?php echo $title ?> | Federal College of Education (Gusau)</title>
        <?php 
        
        //meta tags
        $meta = array(
            //array('name' => 'description', 'content' => 'Domain names, Trademark brand protection, Sunrise services, Web hosting.'),
            //array('name' => 'keywords', 'content' => 'Upperlinkinc, Upperlink, Trademark, Brand protection, Sunrise services, Protect, Brand, Sunrise, Trademark Claims, Trademark Certificate, Claims, Web hosting'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
        );
        echo meta($meta);
        
        //shortcut icon
        echo link_tag('assets/img/logoo.png', 'shortcut icon');
        
        
        //stylesheets
        echo link_tag('assets/css/fcet.css');
        if( !empty($css) ){
                foreach($css as $stylesheet) {
                        echo link_tag("assets/css/$stylesheet.css");
                }
        }
        
        
        //javascripts
        echo "<script src='" . base_url('assets/js/jquery-1.9.1.js') . "' type='text/javascript'></script>";
        if( !empty($js) ) {
                foreach($js as $javascript){
                        echo "<script src='" . base_url("assets/js/$javascript.js") . "' type='text/javascript'></script>";
                }
        }
        
        //extra javascripts and stylesheets
        if( !empty( $extras) ) {
                foreach($extras as $extra ) {
                        if( $extra['type'] == 'js' ) {
                                echo "<script src='" . base_url($extra['src']) . "' type='text/javascript'></script>";
                        }
                        elseif( $extra['type'] == 'css' ) {
                                echo link_tag($extra['href']);
                        }
                }
        }
        
        ?>
        
        <!-- FlexSlider
        <link rel="stylesheet" href="assets/flexslider/flexslider.css" type="text/css" media="screen" />
        <script defer src="assets/flexslider/jquery.flexslider.js"></script>
        <script type="text/javascript">
        $(window).load(function(){
                $('.flexslider').flexslider({
                        animation: "fade",
                        prevText: '',
                        nextText: '',
                        controlNav: false,
                        start: function(slider){
                                $('body').removeClass('loading');
                        }
                });
        });
        </script>-->

        <!-- Optional FlexSlider Additions 
        <script src="assets/flexslider/demo/js/jquery.easing.js"></script>
        <script src="assets/flexslider/demo/js/jquery.mousewheel.js"></script>
        <script defer src="assets/flexslider/demo/js/demo.js"></script>-->
    </head>
    
    <body>
        <div id="header">
                <div class="pagewrapper">
                        <div id='slogan'>...women in technology</div>
                        <div id="logo"><?php echo anchor(base_url(), img("assets/images/logo.png")) ?></div>
                </div>
        </div>
        <div id='nav-shadow'>
                <div id='nav'>
                        <div class='pagewrapper'>
                                <ul>
                                <?php

                                if(!empty($pages)) {
                                        foreach($pages as $page) {
                                                $id = $page->page_ref_id;
                                                $name = $page->page_ref_name;

                                                echo "<li>" . anchor("web/page/$id", strtoupper($name)) . "</li>";
                                        }
                                }

                                ?>
                                </ul>
                        </div>
                </div>
        </div>
        <div class='pagewrapper'>
                <div id='quicklinks'>
                        <h2>QUICK LINKS</h2>
                        <ul>
                                <li><a href=''>Administrative Mail</a></li>
                                <li><a href=''>School Organisation</a></li>
                                <li><a href=''>Administration</a></li>
                                <li><a href=''>Certificates</a></li>
                                <li><a href=''>Higher Diplomas</a></li>
                                <li><a href=''>Diplomas</a></li>
                                <li><a href=''>Smart Courses</a></li>
                                <li><a href=''>Alumni</a></li>
                        </ul>
                </div>
                <div id="slider" class='center'>
                        <?php

                        $attr = array('class'=>'bjqs');
                        $list = array( img('assets/images/slide1.jpg'), img('assets/images/slide2.jpg') );

                        echo ul($list, $attr);

                        ?>
                </div>
                <div id='portal-login-shadow'>
                        <div id='portal-login'>
                                <?php

                                echo form_open();
                                echo form_label('Portal Login', '', array('class'=>''));
                                echo nbs(5);
                                echo form_input('username', '', "placeholder='username' class='txtInput'");
                                echo nbs(5);
                                echo form_password('password', '', "placeholder='password' class='txtInput'");
                                echo nbs(5);
                                echo form_submit('login', 'GO', "class='btnSubmit'");

                                ?>
                                </form>
                        </div>
                </div>
                
        </div>
        
        <div id="content"><!--content starts here; ends in footer-->