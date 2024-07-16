<? 
if($_POST['button'] == "Delete All"){ $getMsg = content_man_class::delete_web_pages_selected();}
?>
  <link href="modules/content_manager/css/drag.css" rel="stylesheet" type="text/css"/>
   <link href="modules/content_manager/css/style.css" rel="stylesheet" type="text/css"/>
  <script language="javascript" type="text/javascript" src="modules/content_manager/jscript/ajax_page_loader.js"></script>
  <script language="javascript" type="text/javascript" src="modules/content_manager/jscript/check_form.js"></script>

  <script src="modules/content_manager/jscript/drag-ui.min.js"></script>
  <script src="modules/content_manager/jscript/drag.min.js"></script>
  <script>
  $(document).ready(function() {
    $("#resizable").resizable();
  });
  </script>

<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle" background="modules/content_manager/images/hd.png"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="50" align="left" valign="bottom"><img src="modules/content_manager/images/folder_process.png" width="32" height="32" /><strong style="font-size:16px"> Content Manager</strong></td>
        <td height="50" align="left" valign="bottom"><span class="errorMsg">
          <?= $_GET['msg']; ?>
          <?= $getMsg; ?>
        </span></td>
        <td height="50" align="right" valign="bottom"><div id="search" style="display:none">
              <input name="search_page" type="text" id="search_page" size="30" class="txtbox" />
              <input type="image" src="modules/content_manager/images/search.png" name="button" id="button" value="Search for web page" onclick="return check_search()"/>
            
          </div></td>
      </tr>
      <tr>
        <td width="40%" align="left" valign="middle">&nbsp;</td>
        <td width="26%" align="left" valign="middle">&nbsp;</td>
        <td width="34%" align="left" valign="middle">&nbsp;</td>
      </tr>
    </table>
    <br /></td>
  </tr>
</table>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td width="26%" align="left" valign="top"><br />
     <div id="resizable">
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
         <td height="71" align="left" valign="middle">
         <p><a href="?<?= PROJECTNAME; ?>=Control Panel&amp;INC=Content Manager&amp;CMD=Create Web Page">
         <img src="modules/content_manager/images/page_add.png" border="0" /> Create web page</a>
         </p>
         
         <p>
          <a href="#" onclick="javascript: if(document.getElementById('search').style.display == 'block'){ document.getElementById('search').style.display = 'none';} else { document.getElementById('search').style.display = 'block'; document.getElementById('search').focus(); }">
          
          <img src="modules/content_manager/images/search.png" border="0" /> Search</a>
         </p>
          
         <p>
         <img src="modules/content_manager/images/dir.gif" border="0" />
         <a href="?<?= PROJECTNAME; ?>=Control Panel&amp;INC=Content Manager&amp;CMD=Directory">Directory Structure</a>
          </p>
          </td>
       </tr>
     </table><p><p>
     <? include('modules/content_manager/components/treeview.php'); ?>
     </div></td>
     <td width="74%" align="center" valign="top"><br />
       <form id="form1" name="form1" method="post" action="" onsubmit="return verify_checkbox()">
         <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #F2F2F2">
           <tr>
             <td height="451" align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
               <tr>
                 <td width="33" height="24" align="center" valign="middle" bgcolor="#D9F2FF" >
                   <label>
                     <input type="checkbox" name="deleteWeb" id="deleteWeb" onclick="Check(document.form1.web)" />
                   </label>
                 </td>
                 <td width="33" align="left" valign="middle" bgcolor="#D9F2FF" ><strong>&nbsp;#</strong></td>
                 <td width="475" align="left" valign="middle" bgcolor="#D9F2FF"  ><strong>&nbsp;Page Name</strong>
                  </td>
                 <td width="188" align="left" valign="middle" bgcolor="#D9F2FF"  ><strong>&nbsp;Sub Pages</strong></td>
                 <td width="151" align="right" valign="middle" class="errorMsg">&nbsp;
                   <label>
                     <input type="submit" name="button" id="button" style="border:1px solid; height:30px" value="Delete All" />
                  </label></td>
                </tr>
               <?   content_man_class::get_all_webpages(); // method that displays all web page ?>
             </table></td>
           </tr>
         </table>
     </form></td>
   </tr>
 </table>