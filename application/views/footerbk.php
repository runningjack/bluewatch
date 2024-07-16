</div><!--content ends here-->
<div class='clear'></div>

</div>
<div class='clear'></div>

</div><!--maincontent ends here; starts in header-->

<div id='subnav'>
        <div class='contentwrapper'>
                <div id='events'>
                        <h3>EVENTS</h3>
                        <div id='events-box'>
                                <div id='events-date'>
                                        <p id='events-month'><?php echo strftime("%b")?></p>
                                        <p id='events-day'><?php echo strftime("%d")?></p>
                                </div>

                                <div style='border-left:1px solid; float: left; padding-left: 5px'>
                                    <div id='events-list'>
                                         <?php

                                         if(empty($ticker_news)) {
                                                 echo "No events";
                                         }
                                         else {
                                                 $len = 70;
                                                 echo "<ul>";
                                                 foreach($ticker_news as $news_item) {
                                                        $n_id = $news_item->news_id;
                                                         $n_content = $news_item->news_content;
                                                         if(strlen($n_content) > $len){
                                                                 $n_content = substr($n_content, 0, $len) ." ...";
                                                         }

                                                         echo    "<li>
                                                                         <div class='news_item'>" .
                                                                                 anchor("web/news/$n_id", $n_content) .
                                                                         "</div>
                                                                 </li>";
                                                 }
                                                 echo "</ul>";
                                         }
                                         ?>
                                    </div>
                                    <p id='all-events' class='clear'><?php echo anchor('web/news', 'All Events') ?></p>
                                </div>
                        </div>
                </div>
                <div class='fbox' id='aboutus'>
                        <h3>ABOUT US</h3>
                        <ul>
                                <?php
                                $list = array(
                                            anchor('web/page/5', 'Vision and Mission'),
                                            anchor('web/page/6', 'Mandatory Disclosure'),
                                            anchor('web/page/7', 'Message From VC'),
                                            anchor('web/page/8', 'Founder'),
                                            anchor('web/page/9', 'Administration')
                                        );
                                echo ul($list);
                                ?>
                        </ul>
                </div>
                <div class='fbox' id='academics'>
                        <h3>ACADEMICS</h3>
                        <ul>
                                <?php
                                $list = array(
                                            anchor('', 'Faculty of Engineering'),
                                            anchor('', 'School of Law'),
                                            anchor('', 'Commerce and Management'),
                                            anchor('', 'Sciences'),
                                            anchor('', 'Humanities and Social Sciences')
                                        );
                                echo ul($list);
                                ?>
                        </ul>
                </div>
                <div class='fbox' id='admission'>
                        <h3>ADMISSION</h3>
                        <ul>
                                <?php
                                $list = array(
                                            anchor('', 'Apply Online'),
                                            anchor('', 'Admission 2012'),
                                            anchor('', 'Application Status')
                                        );
                                echo ul($list);
                                ?>
                        </ul>
                </div>
        </div>
        <div class='clear'></div>
</div>
<div id='footer'>
        <div class='contentwrapper'>
                <div id='socials'>
                        <span class='follow'>Follow us on</span>
                        <span class='links'><?php echo anchor("j", img('assets/images/fb.png')) . nbs(2) . anchor("j", img('assets/images/twitter.png')) ?></span></div>
                <p id='copyright'>Copyright 2013 - Federal College of Education</p>
        </div>
</div>

<!--</div><!--container-->

</body>
</html>