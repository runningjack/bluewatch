<!DOCTYPE html >
<html>
    <head>
        <title><?php echo $title ?> | Federal College of Education (Technical) Gusau</title>
        <?php

        //meta tags
        $meta = array(
            array('name' => 'description', 'content' => 'A higher institution in the Northern region of Nigeria with a difference'),
            array('name' => 'keywords', 'content' => 'FCET, Federal College of Education (Technical), Gusau, Technical, College of Education, Nigerian Institutions, Higher Institutions in Nigeria, Technical Institution'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
        );
        echo meta($meta);

        //shortcut icon
        echo link_tag('assets/images/icon.png', 'shortcut icon');


        //stylesheets
        echo link_tag('assets/css/fcet.css');

        if( !empty($css) ){
                foreach($css as $stylesheet) {
                        echo link_tag("assets/css/$stylesheet.css");
                }
        }


        //javascripts
        echo "<script src='" . base_url('assets/js/jquery-1.9.1.js') . "' type='text/javascript'></script>";
        echo "<script src='" . base_url('assets/js/fcet.js') . "' type='text/javascript'></script>";
        if( !empty($js) ) {
                foreach($js as $javascript){
                        echo "<script src='" . base_url("assets/js/$javascript.js") . "' type='text/javascript'></script>";
                }
        }


        //newsticker
        echo "<script type='text/javascript' src='" . base_url('assets/js/jquery.vticker.js') . "'></script>";

        //bjqs
        echo "<script type='text/javascript' src='" . base_url('assets/bjqs/bjqs-1.3.min.js') . "'></script>";
        echo link_tag("assets/bjqs/bjqs.css");
        echo link_tag("assets/bjqs/demo.css");


        //extra assets
        
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
        <!--news ticker-->

    </head>

    <body>
    <!--<div id="<?php echo $wrap ?>"><!--container; ends in footer-->
        <div id="header">
                <div class="contentwrapper">
                        <div id='slogan'>...women in technology</div>
                        <div id="logo"><?php echo anchor(base_url(), img("assets/images/logo.png")) ?></div>
                </div>
        </div>
        <div id='nav-shadow'>
                <div id='nav'>
                        <div class='contentwrapper'>
                                <ul>
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
                                                        $ref = $id == 1 ? base_url() : "web/page/$id";

                                                        echo "<li class='upp $c'>" . anchor($ref, $name);

                                                        if( $children > 0 ) {
                                                                echo "<ul>";
                                                                foreach($nav_links as $_link) {
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
                                </ul>
                        </div>
                </div>
        </div>
        <div class='contentwrapper'>
        <?php if(in_array('quicklinks', $show)) { ?>
                <div id='quicklinks'>
                        <h2>QUICK LINKS</h2>
                        <ul>
                                <?php
                                $list = array(
                                            anchor('', 'Administrative Mail'),
                                            anchor('', 'School Organisation'),
                                            anchor('', 'Administration'),
                                            anchor('', 'Certificates'),
                                            anchor('', 'Higher Diplomas'),
                                            anchor('', 'Diplomas'),
                                            anchor('', 'Smart Courses'),
                                            anchor('', 'Alumni')
                                        );
                                echo ul($list);
                                ?>
                        </ul>
                </div>
        <?php } ?>
        <?php if(in_array('slide', $show)) { ?>
                <div id="slider" class='center'>
                        <?php

                        $attr = array('class'=>'bjqs');
                        $list = array(
                                    img('assets/images/img1.jpg'),
                                    img('assets/images/img5.jpg'),
                                    img('assets/images/img7.jpg'),
                                    img('assets/images/img2.jpg'),
                                    img('assets/images/img4.jpg'),
                                    img('assets/images/img8.jpg')
                                );

                        echo ul($list, $attr);

                        ?>
                </div>
        <?php } else { echo "<div id='noslide'>" . img(array('src'=>"assets/images/$page_pic")) . "</div>"; } ?>

                <div id='portal-login-shadow'>
                        <div id='portal-login'>
                                <?php

                              //  echo form_open('portal/login');
								 echo form_open('portal/login.php');
                                echo form_label('Portal Login', '', array('class'=>''));
                                echo nbs(5);
                                echo form_input('username', '', "placeholder='username' class='txtInput'");
                                echo nbs(5);
                                echo form_password('password', '', "placeholder='password' class='txtInput'");
                                echo nbs(5);
                                echo form_submit('login', 'Login', "class='btnSubmit'");

                                ?>
                                </form>
                        </div>
                </div>

        </div>

        <div id="maincontent"><!--maincontent starts here; ends in footer-->
                <div class='contentwrapper'>
                        <div id='sidebar'>
                                <h3>New Applicant <?php echo nbs(2) . img("assets/images/arrow-new-applicant.png") . nbs(3) . anchor("&nbsp;", "Click Here") ?> </h3>
                                <div id='ad'>
                                        <?php
                                        echo img(array('src'=>'assets/images/advert.png', 'id'=>'advert-h'));
                                        $attr = array('class'=>'bjqs');
                                        $list = array( anchor(base_url(), img('assets/images/ad1.jpg'), "title='Advert1'"), anchor(base_url(), img('assets/images/ad2.jpg'), "title='Advert2'") );
                                        echo ul($list, $attr);
                                        ?>
                                </div>
                        </div>

                        <div id='content'><!--content starts here; ends in footer-->