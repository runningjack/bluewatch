<? 
if($_POST['submit']){ $getMsg = news_class::delete_news_selected();}
?>
  <link href="modules/news_cast/css/drag.css" rel="stylesheet" type="text/css"/>
   <link href="modules/news_cast/css/style.css" rel="stylesheet" type="text/css"/>
  <script language="javascript" type="text/javascript" src="modules/news_cast/jscript/ajax_page_loader.js"></script>
  <script language="javascript" type="text/javascript" src="modules/news_cast/jscript/check_form.js"></script>

  <script src="modules/news_cast/jscript/drag-ui.min.js"></script>
  <script src="modules/news_cast/jscript/drag.min.js"></script>
  <script>
  $(document).ready(function() {
    $("#resizable").resizable();
  });
  </script>
<style type="text/css">
<!--
.txtWhite {
	color: #FFF;
}
-->
</style>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle" background="modules/news_cast/images/hd.png"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="50" align="left" valign="bottom"><img src="modules/news_cast/images/news.png" width="32" height="32" /><strong style="font-size:16px"> News Cast</strong></td>
        <td height="50" align="left" valign="bottom">&nbsp;</td>
        <td height="50" align="left" valign="bottom">
          <div id="search" style="display:none">
              <input name="search_page" type="text" id="search_page" size="30" class="txtbox" />
              <input type="image" src="modules/news_cast/images/search.png" name="button" id="button" value="Search for web page" onclick="return check_search()"/>
            
          </div>
          <span class="errorMsg"><?= $_GET['msg']; ?><?= $getMsg; ?></span>
          <div id="error" class="errorMsg"></div></td>
      </tr>
      <tr>
        <td width="26%" align="left" valign="middle">&nbsp;</td>
        <td width="33%" align="left" valign="middle">&nbsp;</td>
        <td width="41%" align="left" valign="middle">&nbsp;</td>
      </tr>
    </table>
    <br /></td>
  </tr>
</table>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td width="26%" height="479" align="left" valign="top"><br />
     <div id="resizable">
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
         <td height="71" align="left" valign="middle"><p><a href="?<?= PROJECTNAME; ?>=Control Panel&INC=News Cast&CMD=Create News"><img src="modules/news_cast/images/add_news.png" border="0" /> Create news</a></p>
           </td>
       </tr>
     </table><p><p>
     <? include('modules/news_cast/components/treeview.php'); ?>
     </div></td>
     <td width="74%" align="center" valign="top"><br />
       <form id="form1" name="form1" method="post" action="" onsubmit="return verify_checkbox()">
         <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #F2F2F2">
           <tr>
             <td height="454" align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
               <tr>
                 <td width="33" height="40" align="center" valign="middle" bgcolor="#D9F2FF" >
                   <label>
                     <input type="checkbox" name="deleteWeb" id="deleteWeb" onclick="Check(document.form1.web)" />
                   </label>
                 </td>
                 <td width="33" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;#</strong></td>
                 <td width="459" align="left" valign="middle" bgcolor="#D9F2FF"  ><strong>&nbsp;News</strong>
                  </td>
                 <td width="204" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;Sub News</strong></td>
                 <td width="151" align="left" valign="middle" class="errorMsg">&nbsp; <a href="#" onclick="return confirm('Are You Sure You Want To Delete Selected Pages?');">
                   <input type="image" src="modules/news_cast/images/delete_all.jpg" name="submit" id="submit" value="Submit" />
                 </a></td>
                </tr>
               <?   news_class::get_all_news(); // method that displays all news ?>
             </table></td>
           </tr>
         </table>
     </form></td>
   </tr>
 </table>