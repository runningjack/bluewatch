<h2 id="page-title"><?php echo $page_title ?></h2>
<div id="news-content">
        <?php

        if(empty($news)) {
                echo "No events";
        }
        else {
                if(is_array($news)) {
                        foreach($news as $a_news) {
                                $nid = $a_news->news_id;
                                $ntitle = $a_news->news_title;
                                $ncontent = $a_news->news_content;
                                
                                $len = 200;
                                $ncontent = strlen($ncontent) > $len ? substr($ncontent,0,$len) . " ... " . anchor("web/news/$nid", 'More') : $ncontent;

                                echo    "<div class='sxn'>
                                                <h3>" . anchor("web/news/$nid", $ntitle, "class='news-title'") . "</h3>
                                                <div class='sxn-content'>$ncontent</div>
                                        </div>";
                        }
                }
                else {
                        $nid = $news->news_id;
                        $ntitle = $news->news_title;
                        $ncontent = $news->news_content;
                        echo    "<div class='sxn'>
                                        <h3>$ntitle</h3>
                                        <div class='sxn-content'>$ncontent</div>
                                </div>";
                        echo anchor("web/news", "&laquo; All Events");
                }
                
        } 

        ?>
</div>