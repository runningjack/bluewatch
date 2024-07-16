   <script src="modules/content_manager/jscript/treeview/jquery-latest.js"></script>
  <link rel="stylesheet" href="modules/content_manager/jscript/treeview/jquery.treeview.css" type="text/css" media="screen" />
  <script type="text/javascript" src="modules/content_manager/jscript/treeview/jquery.treeview.js"></script>
  <style type="text/css">
  #browser {
    font-family: Verdana, helvetica, arial, sans-serif;
    font-size: 68.75%;
  }
  </style>
  <script>
  $(document).ready(function(){
    $("#browser").treeview();
 $("#add").click(function() {
 	var branches = $("<li><span class='folder'>New Sublist</span><ul>" + 
 		"<li><span class='file'>Item1</span></li>" + 
 		"<li><span class='file'>Item2</span></li>" +
 		"</ul></li>").appendTo("#browser");
 	$("#browser").treeview({
 		add: branches
 	});
 });
  });
  </script>
   <p>
   <hr style=" border:1px dotted #F4F4F4" />
   <p>
   
   <span style="font-size:10px; color:#CCC">Main News</span><p>
   
 <ul id="browser" class="filetree">
    <?
	require('conf/settings.php');
	$project_name = PROJECTNAME;
	$get_main_news = news_class::get_news_for_treeview();
	$count = count($get_main_news);
	for($i=0; $i<=$count-1; $i++)
	{
		?>
        	<li class="closed"><span class="folder"><?= $get_main_news[$i]['n_name']; ?></span>
 		       <ul>
 			       
				   <? 
				   		foreach($get_main_news[$i]['arr'] as $val)
						{
							if(count($val['n_name']) >= 1)
							{
								?><li><span class="file"><a href="?<?= $project_name; ?>=Control Panel&INC=News Cast&CMD=View News&id=<?= $val['n_id'];?>&cat=<?= $val['indx'];?>"><?= $val['n_name']; ?></a></span></li><?
							}
							else
							{
								?><span>No Node</span><?
							}
						}
		
				   ?>
 		       </ul>
 	        </li>
        <?
	}
	?>
 	 	
   </ul>
   <p>
   <hr style=" border:1px dotted #F4F4F4" />
   <p>
   
   <span style="font-size:10px; color:#CCC">Unpublished News</span>
   <div id="nonCategorisedPages">
  <ul>
   <?
    $get_unpublished_pages = news_class::get_unpublished_news_for_listview();
	$cnt = count($get_unpublished_pages);
	for($i=0; $i<=$cnt-1; $i++)
	{
		?><li><img src="modules/news_cast/images/file.gif" align="left" />&nbsp;<a href="?<?= $project_name; ?>=Control Panel&INC=News Cast&CMD=View News&id=<?= $get_unpublished_pages[$i]['news_id'];?>&cat=<?= $get_unpublished_pages[$i]['ind'];?>"><?= $get_unpublished_pages[$i]['news_name']; ?></a></li><?
	}
   ?>
   </ul>
   
   </div>
   
   
   
   		
   