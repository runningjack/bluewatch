<style type="text/css">
.title-bar{width:98%; background:url(modules/content_manager/images/hd.png); height:68px; margin-left:10px; padding-top:13px}
.wrapper{ position:relative; width:98%; margin-left:10px; }
.cont{ width:97%; border:2px solid #F2FAFE; padding:10px; min-height:250px; padding:0px}
.summary { line-height:19px; color:#333; text-align:justify }

</style>
<link href="modules/content_manager/css/style.css" rel="stylesheet" type="text/css"/>

<div class="title-bar">&nbsp;&nbsp;<img src="modules/content_manager/images/search_2.png"/> <strong style="font-size:16px">Search Result</strong></div>
<div class="wrapper">
<br />
<div class="cont"><?   content_man_class::search_for_webpages($_GET['val']);  ?></div>

</div>
<p>