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
   
   <span style="font-size:10px; color:#CCC">Main Pages</span><p>
   
 <ul id="browser" class="filetree">
    <?
	$get_main_pages = content_man_class::get_web_pages_for_treeview();
	$count = count($get_main_pages);
	for($i=0; $i<=$count-1; $i++)
	{
		?>
        
        	<li class="closed"><span class="folder"><?= $get_main_pages[$i]['p_name']; ?></span>
 		       <ul>
 			       
				   <? 
				   		foreach($get_main_pages[$i]['arr'] as $val)
						{
							if(count($val['r_name']) >= 1)
							{
								?><li><span class="file"><a href="#"  onclick="load_page('CMD=View Web Page&id=<?= $val['r_id'];?>&cat=0')"><?= $val['r_name']; ?></a></span></li><?
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
   
   <span style="font-size:10px; color:#CCC">Non Categorised Pages</span>
   <div id="nonCategorisedPages"><ul>
   <?
    $get_uncategorised_pages = content_man_class::get_uncategorised_pages_for_listview();
	$cnt = count($get_uncategorised_pages);
	for($i=0; $i<=$cnt-1; $i++)
	{
		?><li><img src="modules/content_manager/images/file.gif" />&nbsp;<a href="#" onclick="load_page('CMD=View Web Page&id=<?= $get_uncategorised_pages[$i]['uncatid'];?>')"><?= $get_uncategorised_pages[$i]['uncatname']; ?></a></li><?
	}
   ?>
   </ul>
   </div>
    <p>
   <hr style=" border:1px dotted #F4F4F4" />
   <p>
   
   <span style="font-size:10px; color:#CCC">Unpublished Pages</span>
   <div id="nonCategorisedPages">
  <ul>
   <?
    $get_unpublished_pages = content_man_class::get_unpublished_pages_for_listview();
	$cnt = count($get_unpublished_pages);
	for($i=0; $i<=$cnt-1; $i++)
	{
		?><li><img src="modules/content_manager/images/file.gif" />&nbsp;<a href="#" onclick="load_page('CMD=View Web Page&id=<?= $get_unpublished_pages[$i]['prid'];?>')"><?= $get_unpublished_pages[$i]['prname']; ?></a></li><?
	}
   ?>
   </ul> 
   </div>
   
   
   
   		
   