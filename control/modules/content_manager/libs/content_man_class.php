<? 	
	class content_man_class{
	    
        public static function get_all_webpages() // list all web pages create
        {
                $project_name = PROJECTNAME;
                $rowsPerPage = 10; // how many rows to show per page
                $pageNum = 1; // by default we show first page
                $inc = 0;
                if(isset($_GET['page']) >= 2)
                {
                $pageNum = $_GET['page'];
                $inc = ($_GET['page'] - 1) * $rowsPerPage;
                }  	
                // if $_GET['page'] defined, use it as page number

                $offset = ($pageNum - 1) * $rowsPerPage; // counting the offset
                $j = 1;

                if(!empty($_GET['TYP']))
                {
                        $query  = "SELECT * FROM  web_pages_content WHERE page_ref_index = '".$_GET['sub_id']."' ORDER BY page_ref_id ASC LIMIT $offset, $rowsPerPage";
                        $query2   = "SELECT COUNT(page_ref_id) AS numrows FROM  web_pages_content WHERE page_published = 'Yes' AND page_ref_index = '".$_GET['sub_id']."'"; // how many rows we have in database
                }
                else
                {
                        $query  = "SELECT * FROM  web_pages_content ORDER BY page_ref_id ASC LIMIT $offset, $rowsPerPage";
                        $query2   = "SELECT COUNT(page_ref_id) AS numrows FROM  web_pages_content WHERE page_published = 'Yes'"; // how many rows we have in database
                }

                 // get records and display it
                $result = mysql_query($query) or die('Error!');

                echo "<TABLE border=0 width=100% align=center cellpadding=2 cellspacing=1>";
                $c = 1;
                while ($myrow = mysql_fetch_array($result))
                {

                        if($c % 2 == 0) {	$bgcolor="#FFFFFF";  }  else {  $bgcolor="#F9F9F9";  }
                        $c++;
                        echo "<TR><TD width=29 height=40 align=left bgcolor=$bgcolor>&nbsp;";
                        echo '<input type="checkbox" name="web[]" id="web" value="'.$myrow["page_ref_id"].'" />';

                        echo "<TD width=29 height=40 align=left bgcolor=$bgcolor>&nbsp;";
                        echo $inc + $j++;

                        echo "<TD width=314 height=40 align=left  bgcolor=$bgcolor>&nbsp;";
                        echo ucwords($myrow["page_ref_name"]);

                        echo "<TD width=153 height=40 align=left bgcolor=$bgcolor>&nbsp;";
                        $get = content_man_class::get_no_of_children($myrow["page_ref_id"]); // Get the number of childred this page has

                        if($get['num'] == 0){ 	echo $get['num']; }
                        else {	echo '<strong><a href=".?'.$project_name.'=Control Panel&INC=Content Manager&TYP=Sub Pages&sub_id='.$myrow["page_ref_id"].'">' .$get['num']. '</a></strong>'; }


                        echo "<TD width=50 height=40 align=center bgcolor=$bgcolor>";
                        ?><a href="#" onclick="load_page('CMD=View Web Page&id=<?= $myrow["page_ref_id"];?>&cat=0')"><img src="modules/content_manager/images/b_browse.png" alt="View Content" width="16" height="16" border="0" /></a><?
                                echo "<TD width=35 height=40 align=center bgcolor=$bgcolor>";
                        ?><a href="?<?= $project_name; ?>=Control Panel&INC=Content Manager&CMD=Edit Web Page&id=<?= $myrow["page_ref_id"];?>"><img src="modules/content_manager/images/b_edit.png" alt="Edit Content" width="16" height="16" border="0" /></a><?

                        echo "<TD width=35 height=40 align=center bgcolor=$bgcolor>";
                        ?><a href="?<?= $project_name; ?>=Control Panel&INC=Content Manager&CMD=Delete Web Page&id=<?= $myrow["page_ref_id"]; ?>" onclick="return confirm('Deleting this page, automatically delete ALL sections under it, and all attached images. \n\n You Must First Delete Any Sub Pages If Present!, \n\n Are you sure you want to continue?');"><img src="modules/content_manager/images/b_drop.png" alt="Delete Record" width="16" height="16" border="0" /></a><?



                }
                echo "</TABLE>";


                $result2  = mysql_query($query2) or die(mysql_error());
                $row2     = mysql_fetch_array($result2);
                $numrows = $row2['numrows'];
                if($numrows != 0)
                {
                // how many pages we have when using paging?
                $maxPage = ceil($numrows/$rowsPerPage);

                        if ($pageNum > 1)
                        {
                                $page = $pageNum - 1;

                                $prev = "<a href=\"?$project_name=Control Panel&INC=Content Manager&page=$page\"><img src='images/rewind.png' alt='Previous Page' width=16 height=16 border=0></a>";

                                $first = "<a href=\"?$project_name=Control Panel&INC=Content Manager&page=1\"><img src='images/skip_backward.png' alt='First Page' width=16 height=16 border=0></a>";
                        } 
                        else
                        {
                                $prev  = "<img src='modules/content_manager/images/rewind.png' alt='Previous Page' width=16 height=16 border=0>";
                                // we're on page one, don't enable 'previous' link
                                $first = "<img src='modules/content_manager/images/skip_backward.png' alt='First Page' width=16 height=16 border=0>";
                                // nor 'first page' link
                        }

                        // print 'next' link only if we're not
                        // on the last page
                        if ($pageNum < $maxPage)
                        {
                                $page = $pageNum + 1;

                                $next = "<a href=\"?$project_name=Control Panel&INC=Content Manager&page=$page\"><img src='modules/content_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0></a>";

                                $last = "<a href=\"?$project_name=Control Panel&INC=Content Manager&page=$maxPage\"><img src='modules/content_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0></a>";

                        } 
                        else
                        {
                                $next = "<img src='modules/content_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0>";      // we're on the last page, don't enable 'next' link
                                $last = "<img src='modules/content_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0>"; // nor 'last page' link

                        }

                // print the page navigation link

echo <<<NavBar
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/content_manager/images/m.png)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="22%" align="center" valign="middle">&nbsp;</td>
<td width="4%" align="center" valign="middle">		$first	</td>
<td width="4%" align="center" valign="middle">		$prev	</td>
<td width="4%" align="center" valign="middle">		$next	</td>
<td width="4%" align="center" valign="middle">		$last	</td>
<td width="36%" align="left" valign="middle">&nbsp;&nbsp;Page <font color='#FF6600'><strong>$pageNum</strong></font> of  <font color='#FF6600'><strong>$numrows</strong></font> Records &nbsp;</td>
</tr>
</table></td>
</tr>
</table>
NavBar;
        }
                else
                {
echo <<<NavBar2
<p><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="middle">&nbsp;&nbsp;<img src="modules/content_manager/images/warning.gif" /><font color="#FF6600"> No Web Page Found!</font></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/content_manager/images/m.jpg)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
</tr>
</table></td>
</tr>
</table><br/>
NavBar2;
                }

        }
		
        public static function create_webpage() // create new web page
        {
                extract($_POST);
                $author = $_SESSION['validuser'];
                $c_date = date("F j, Y, g:i a");  
                $m_date = date("F j, Y, g:i a");  
                $pname = addslashes($page_name);
                $ptitle = addslashes($page_title);
                $pdesc = addslashes($desc);
                $parent_nam = trim($parent_name);
                $pub = $publish;
                $page_order = (int) $page_order;

                if($cat == "Parent")
                {
				$p_index = "0"; // 0 for all parent page index
				$val = content_man_class::insert_webpage($author, $c_date, $m_date, $pname, $ptitle, $pdesc, $pub, $cat, $p_index, $page_order);
                }
                elseif($cat == "Child") // get parent id
                {
				$p_index = content_man_class::get_parent_page_index($parent_nam); // get parent page index for child page
				content_man_class::page_has_child($p_index);
                                $val = content_man_class::insert_webpage($author, $c_date, $m_date, $pname, $ptitle, $pdesc, $pub, $cat, $p_index, $page_order);
                }
                else{
				$p_index = "null"; // null for all non page index
				$val = content_man_class::insert_webpage($author, $c_date, $m_date, $pname, $ptitle, $pdesc, $pub, $cat, $p_index, $page_order);
                }

                return $val;

            }
		
		// This method insert parent and Non category page only
        private static function insert_webpage($author, $c_date, $m_date, $pname, $ptitle, $pdesc, $pub, $cat, $p_index, $page_order)
        {
            $project_name = PROJECTNAME;
            if(!content_man_class::check_if_page_exist($pname)){
            $query = mysql_query("INSERT INTO web_pages_content 
                                    SET page_ref_name = '$pname',
                                    page_ref_title = '$ptitle',
                                    page_ref_desc = '$pdesc',
                                    page_ref_category = '$cat',
                                    page_ref_index = '$p_index',
                                    page_published = '$pub',
                                    date_created = '$c_date',
                                    date_modified = '$m_date',
                                    author = '$author',
                                    page_order = '$page_order'
                                    ") or die(mysql_error());


                    if(!$query)
                    {
                            $msg = "Cannot Create Web Page!"; 
                    }
                    else 
                    {
                            $msg = "Web Page Created!";
                    }

            }
            else
            {
                    $msg = "Web Page Already Exist!";
            }

           echo "<script>document.location.href='?$project_name=Control Panel&INC=Content Manager&CMD=Create Web Page&msg=$msg!'</script>";

        }

        private static function page_has_child($pid){
            mysql_query("UPDATE web_pages_content SET has_child = 'yes' WHERE page_ref_id = $pid");
        }

        private static function get_parent_page_index($page) // getting parent page index
        {

                $query = mysql_query("SELECT page_ref_id FROM web_pages_content WHERE page_ref_name='$page'") or die(mysql_error());
                $result = mysql_fetch_object($query);
                return $result->page_ref_id;

        }
		
	private static function check_if_page_exist($name) // check if page has already be created
    	{
            $query = mysql_query("SELECT * FROM web_pages_content WHERE page_ref_name='$name'") or die(mysql_error());
            $num = mysql_num_rows($query);
            if($num != 0){ return true; }
        }
		
        public static function get_all_parent_webpage() // get all pages that are parent
        {
                $query = mysql_query("SELECT * FROM web_pages_content WHERE page_ref_id != ".$_GET['id']." AND page_published = 'Yes' AND page_ref_category  != 'Non'") or die(mysql_error());
                $arr = array();
                while($rows = mysql_fetch_array($query))
                {
                        extract($rows);
                        $arr[] = array('pname'=>$page_ref_name, 'pid'=>$page_ref_id);
                }
                return $arr;			

        }

        public static function get_all_parent_webpage_creation() // get all pages that are parent
        {
                $query = mysql_query("SELECT * FROM web_pages_content WHERE page_published = 'Yes'  AND page_ref_category  != 'Non'") or die(mysql_error());
                $arr = array();
                while($rows = mysql_fetch_array($query))
                {
                        extract($rows);
                        $arr[] = array('pname'=>$page_ref_name, 'pid'=>$page_ref_id);
                }
                return $arr;			

        }

        private static function get_no_of_children($pid) // get the total number of children a particular page has
        {
                        $query = mysql_query("SELECT page_ref_id FROM web_pages_content WHERE page_ref_index = '$pid'") or die(mysql_error());
                        $num = mysql_num_rows($query);
                        $no_of_children = array('num'=>$num, 'pid'=>$pid);
                        return $no_of_children;
        }

        public static function delete_web_page() // delete web page
        {
                //require('conf/settings.php');
                $project_name = PROJECTNAME;

                extract($_GET);
                $query1 = mysql_query("SELECT page_ref_index, page_ref_name FROM web_pages_content WHERE page_ref_index='$id'") or die(mysql_error());
                $num = mysql_num_rows($query1);

                $query2 = mysql_query("SELECT page_ref_index, page_ref_name FROM web_pages_content WHERE page_ref_id='$id'") or die(mysql_error());
                $result = mysql_fetch_object($query2);
                $pname = trim($result->page_ref_name);
                if($num > 0) // IF PAGE HAS CHILD
                {

                        echo "<script>alert('You Must First Delete All Sub Pages!'); document.location.href='?$project_name=Control Panel&INC=Content Manager&msg=You Must Delete All Sub Pages First!'</script>";

                }
                else
                {		
						// DELETE PAGE FROM WEB_PAGES_CONTENTS TABLE 
                        mysql_query("DELETE FROM web_pages_content WHERE page_ref_id='$id'") or die(mysql_error()); 
						
						// DELETE SECTIONS UNDER THE PAGE *****MODIFIED BY IGINLA OMOTAYO *******
						mysql_query("DELETE FROM pages_content WHERE page_id='$id'") or die(mysql_error());
						
                        // DELETE IMAGES ATTACHED TO WEBPAGE IN PAGERESOURCES FOLDERS
						content_man_class::delete_images($id);
						
						// DELETE IMAGES UNDER ALL SECTIONS IN THE PAGE IN IMAGES TABLE *****MODIFIED BY IGINLA OMOTAYO *******
						mysql_query("DELETE FROM section_img WHERE page_id='$id'") or die(mysql_error());
						
                        $msg = "Web Pages Deleted!";
                }
                echo "<script>document.location.href='?$project_name=Control Panel&INC=Content Manager&msg=$msg'</script>";
        }

        public static function get_web_pages_for_treeview() // get all parent and child pages for treeview 
        {

                $treequery = mysql_query("SELECT * FROM web_pages_content WHERE page_ref_index='0'") or die(mysql_error());
                $treesql = mysql_num_rows($treequery);

                if($treesql != 0)
                {
                        while($treerows = mysql_fetch_array($treequery))
                        {
                                $treepid = $treerows["page_ref_id"];
                                $treenodequery = mysql_query("SELECT page_ref_id, page_ref_name FROM web_pages_content  WHERE page_ref_index = '$treepid'") or die(mysql_error());
                                $treelistsub = array();
                                while($treenoderows = mysql_fetch_array($treenodequery))
                                {
                                        extract($treenoderows);
                                        $treelistsub[] = array('r_name'=>$page_ref_name, 'r_id'=>$page_ref_id);
                                }	

                                extract($treerows);

                                $treelist[] = array('p_name'=>trim($page_ref_name), 'arr'=>$treelistsub);

                        }
                        return $treelist;
                }
                else
                {
                        echo '<img src="modules/content_manager/images/warning.gif" />&nbsp;No Web Page Found!';
                }


        }

        public static function get_uncategorised_pages_for_listview() // get all non categorised pages for listview 
        {
                $listquery = mysql_query("SELECT * FROM web_pages_content WHERE page_ref_category = 'Non'") or die(mysql_error());
                $listsql = mysql_num_rows($listquery);

                if($listsql != 0)
                {

                        while($listrows = mysql_fetch_array($listquery))
                        {
                                extract($listrows);
                                $listarr[] = array('uncatname'=>$page_ref_name, 'uncatid'=>$page_ref_id);
                        }
                        return $listarr;
                }
                else
                {
                        echo '<img src="modules/content_manager/images/warning.gif" />&nbsp;No Web Page Found!';
                }


        }

        public static function get_unpublished_pages_for_listview() // get all unpublished pages for listview 
        {
                $unlistquery = mysql_query("SELECT * FROM web_pages_content WHERE page_published = 'No'") or die(mysql_error());
                $unlistsql = mysql_num_rows($unlistquery);

                if($unlistsql != 0)
                {
                        while($unlistrows = mysql_fetch_array($unlistquery))
                        {
                                extract($unlistrows);
                                $unlistarr[] = array('prname'=>trim($page_ref_name), 'prid'=>trim($page_ref_id));
                        }
                        return $unlistarr;
                }
                else
                {
                        echo '<img src="modules/content_manager/images/warning.gif" />&nbsp;No Web Page Found!';
                }


        }

        public static function get_web_page_details($val) // view full web page details
        {
                $webdetailquery = mysql_query("SELECT * FROM web_pages_content WHERE page_ref_id = '$val'") or die(mysql_error());
                $webdetailsql = mysql_fetch_object($webdetailquery);
                $details = array('rf_id'=>$webdetailsql->page_ref_id, 'name'=>$webdetailsql->page_ref_name, 'title'=>$webdetailsql->page_ref_title, 'desc'=>$webdetailsql->page_ref_desc, 'category'=>$webdetailsql->page_ref_category, 'pub'=>$webdetailsql->page_published, 'dtc'=>$webdetailsql->date_created, 'dtm'=>$webdetailsql->date_modified, 'aut'=>$webdetailsql->author, 'idx'=>$webdetailsql->page_ref_index, 
				'pod'=>$webdetailsql->page_order);
                return $details;
        }

        public static function select_current_parent($val) // select parent name with val
        {
                        $query = mysql_query("SELECT page_ref_name FROM web_pages_content WHERE page_ref_id='$val'") or die(mysql_error());
                        $result = mysql_fetch_object($query);
                        echo '<option selected="selected" value="' .$result->page_ref_name. '"> '.$result->page_ref_name.'</option>';
        }
		
        public static function update_webpage() // get form fields and page index and pass them as a parameter to the update_webpage_tbl method for update
        {
                extract($_POST);
                if(!empty($parent_name)){ $parent_nam = trim($parent_name); } else {$parent_nam = ""; }

                $pname = addslashes($page_name);
                $ptitle = addslashes($page_title);
                $pdesc = addslashes($desc);
                $page_order = (int) $page_order;
                $pub = $publish;

                $dtm = date("F j, Y, g:i a"); 

                if($cat == "Parent")
                {
                        $p_index = "0"; // 0 for all parent page
                        $val = content_man_class::update_webpage_tbl($pid, $dtm, $pname, $ptitle, $parent_nam, $pdesc, $pub, $p_index, $page_order);
                }
                elseif($cat == "Child")
                {
                        $p_index = content_man_class::get_parent_page_index($parent_nam); // get parent page index
                    $val = content_man_class::update_webpage_tbl($pid, $dtm, $pname, $ptitle, $parent_nam, $pdesc, $pub, $p_index, $page_order);
                }
                else{
                        $p_index = "null"; // null for all neither parent nor child page
                        $val = content_man_class::update_webpage_tbl($pid, $dtm, $pname, $ptitle, $parent_nam, $pdesc, $pub, $p_index, $page_order);
                }

                 return "Web Pages Updated!";
        }
		
        public static function delete_web_pages_selected() // Web pages marked for  deletion
        {
           $numDel = count($_POST['web']);
           for($i=0; $i<=$numDel; $i++)
           {
                  $idDel = @$_POST['web'][$i];
                  $msg = content_man_class::check_selected_delete($idDel);
           }
           return $msg;
        }

        private static function check_selected_delete($idDel)// Scan before final deletion
        {
                $project_name = PROJECTNAME;
                $query1 = mysql_query("SELECT page_ref_index, page_ref_name FROM web_pages_content WHERE page_ref_index='$idDel'") or die(mysql_error());
                $num = mysql_num_rows($query1);

                $query2 = mysql_query("SELECT page_ref_index, page_ref_name FROM web_pages_content WHERE page_ref_id='$idDel'") or die(mysql_error());
                $result = mysql_fetch_array($query2);
                $pname = trim($result["page_ref_name"]);
                if($num > 0)
                {	
                        echo "<script>alert('You Must First Delete All Sub Pages First!'); document.location.href='?$project_name=Control Panel&INC=Content Manager&msg=You Must Delete All Sub Pages First!'</script>";		
                }
                else
                {	
                        // delete from web_pages_content table id 		
                        @mysql_query("DELETE FROM web_pages_content WHERE page_ref_id='$idDel'") or die(mysql_error()); 

                        // DELETE SECTIONS UNDER THE PAGE *****MODIFIED BY IGINLA OMOTAYO *******
                        @mysql_query("DELETE FROM pages_content WHERE page_id='$idDel'") or die(mysql_error());

                        // DELETE IMAGES FROM PAGERESOURCES FOLDERS
                        content_man_class::delete_images($idDel);

                        // DELETE IMAGES UNDER ALL SECTIONS IN EDITOR IMAGES TABLE *****MODIFIED BY IGINLA OMOTAYO *******
                        mysql_query("DELETE FROM section_img WHERE page_id='$id'") or die(mysql_error());
                        $msg = "Web Pages Deleted!";
                }

                return  $msg;

         }

        public static function delete_images($id)
        {
                 $img_query = "SELECT section_imglink FROM section_img WHERE page_id='$id'";
                 $result = mysql_query($img_query) or die(mysql_error());

                 while($imgrow = mysql_fetch_assoc($result))
                 {
                        unlink("../".$imgrow['section_imglink']);
                        unlink($imgrow['section_imglink']);
                 }
        }
		 
        public static function search_for_webpages($val) // Search for web pages
        {
                require('../../conf/settings.php');
            $project_name = PROJECTNAME;
                $rowsPerPage = 5; // how many rows to show per page
                $pageNum = 1; // by default we show first page
                if(isset($_GET['page'])){	$pageNum = $_GET['page']; } 	// if $_GET['page'] defined, use it as page number

                $offset = ($pageNum - 1) * $rowsPerPage; // counting the offset
                $j = 1;

                $query  = "SELECT * FROM web_pages_content
                                   WHERE page_ref_name LIKE '%$val%'
                                   OR page_ref_title  LIKE '%$val%'
                                   OR page_ref_desc LIKE '%$val%'  ORDER BY date_created ASC LIMIT $offset, $rowsPerPage"; // get records and display it
                $result = mysql_query($query) or die(mysql_error());
                while ($myrow = mysql_fetch_array($result))
                {
                         $pid = $myrow["page_ref_id"];
                         $pname = $myrow["page_ref_name"];
                         $desc = $myrow["page_ref_desc"];
                         $cat = $myrow["page_ref_category"];
                         $auth = $myrow["author"];
                         $dtc = $myrow["date_created"];
                         $dtm = $myrow["date_modified"];

                         $fetch_content = mysql_query("SELECT main_content FROM pages_content WHERE page_id = $pid");
                         $myrow['page_ref_content'] = mysql_result($fetch_content, 0);

                         $content = (stripslashes(strlen($myrow["page_ref_content"]) > 300)) ? stripslashes(substr($myrow["page_ref_content"], 0, 300)) . "..." : stripslashes($myrow["page_ref_content"]);

                        echo "<div style=\"border-bottom:1px dotted #CCC\"><table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                  <tr>
                                        <td width=\"4%\" height=\"82\" align=\"center\" valign=\"middle\"><img src=\"modules/content_manager/images/page.png\" width=\"32\" height=\"32\" /></td>
                                        <td width=\"80%\" align=\"left\" valign=\"middle\"><h3 style=\"margin-bottom:-5px\"><a href=\"#\" onclick=\"load_page('CMD=View Web Page&id=$pid')\">$pname</a></h3>
                                          <br /> 
                                        <strong>By:&nbsp;</strong>$auth</td>
                                        <td width=\"16%\" align=\"left\" valign=\"middle\">
                                          <a href=\"#\" onclick=\"load_page('CMD=View Web Page&id=$pid')\"><img src=\"modules/content_manager/images/b_browse.png\" width=\"16\" height=\"16\" border=\"0\" /> View Full</a><br />
                                          <a href=\"?$project_name=Control Panel&INC=Content Manager&CMD=Edit Web Page&id=$pid\"><img src=\"modules/content_manager/images/b_edit.png\" width=\"16\" height=\"16\" border=\"0\" /> Edit</a><br />
                                          <a href=\"?$project_name=Control Panel&INC=Content Manager&CMD=Delete Web Page&id=$pid\" onclick=\"return confirm('Deleting This Web Page Will Delete All Sub-Pages If Present!');\"><img src=\"modules/content_manager/images/b_drop.png\" width=\"16\" height=\"16\" border=\"0\" /> Delete</a></td>
                                  </tr>
                                  <tr>
                                        <td height=\"28\" colspan=\"3\" align=\"left\" valign=\"middle\">&nbsp;<strong>$desc</strong></td>
                                  </tr>
                                  <tr>
                                        <td height=\"62\" colspan=\"3\" align=\"left\" valign=\"top\"><div class=\"summary\">$content. </div></td>
                                  </tr>
                                  <tr>
                                        <td height=\"38\" colspan=\"3\" align=\"right\" valign=\"middle\"><strong>Category:&nbsp;</strong>&nbsp;$cat&nbsp;&nbsp;<strong>Date Created:&nbsp;</strong>&nbsp;$dtc  &nbsp;&nbsp;<strong> Date Last Modified:&nbsp; </strong>$dtm&nbsp; </td>
                                  </tr>
                                </table></div>";
                }

                $query2   = "SELECT COUNT(page_ref_id) AS numrows FROM  web_pages_content
                                   WHERE page_ref_name LIKE '%$val%'
                                   OR page_ref_title  LIKE '%$val%'
                                   OR page_ref_desc LIKE '%$val%'"; // how many rows we have in database
                $result2  = mysql_query($query2) or die(mysql_error());
                $row2     = mysql_fetch_array($result2);
                $numrows = $row2['numrows'];
                if($numrows != 0)
                {
                // how many pages we have when using paging?
                $maxPage = ceil($numrows/$rowsPerPage);

                        if ($pageNum > 1)
                        {
                                $page = $pageNum - 1;

                                $prev = "<a href=\"?$project_name=Control Panel&INC=Content Manager&page=$page\"><img src='images/rewind.png' alt='Previous Page' width=16 height=16 border=0></a>";

                                $first = "<a href=\"?$project_name=Control Panel&INC=Content Manager&page=1\"><img src='images/skip_backward.png' alt='First Page' width=16 height=16 border=0></a>";
                        } 
                        else
                        {
                                $prev  = "<img src='modules/content_manager/images/rewind.png' alt='Previous Page' width=16 height=16 border=0>";
                                // we're on page one, don't enable 'previous' link
                                $first = "<img src='modules/content_manager/images/skip_backward.png' alt='First Page' width=16 height=16 border=0>";
                                // nor 'first page' link
                        }

                        // print 'next' link only if we're not
                        // on the last page
                        if ($pageNum < $maxPage)
                        {
                                $page = $pageNum + 1;

                                $next = "<a href=\"?$project_name=Control Panel&INC=Content Manager&page=$page\"><img src='modules/content_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0></a>";

                                $last = "<a href=\"?$project_name=Control Panel&INC=Content Manager&page=$maxPage\"><img src='modules/content_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0></a>";

                        } 
                        else
                        {
                                $next = "<img src='modules/content_manager/images/fast_forward.png' alt='Next Page' width=16 height=16 border=0>";      // we're on the last page, don't enable 'next' link
                                $last = "<img src='modules/content_manager/images/skip_forward.png' alt='Last Page' width=16 height=16 border=0>"; // nor 'last page' link

                        }
			
			// print the page navigation link
	
echo <<<NavBar
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/content_manager/images/m.png)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="22%" align="center" valign="middle">&nbsp;</td>
<td width="4%" align="center" valign="middle">		$first	</td>
<td width="4%" align="center" valign="middle">		$prev	</td>
<td width="4%" align="center" valign="middle">		$next	</td>
<td width="4%" align="center" valign="middle">		$last	</td>
<td width="36%" align="left" valign="middle">&nbsp;&nbsp;Page <font color='#FF6600'><strong>$pageNum</strong></font> of  <font color='#FF6600'><strong>$numrows</strong></font> Records &nbsp;</td>
</tr>
</table></td>
</tr>
</table>
NavBar;
	        }
			else
			{
echo <<<NavBar2
<p><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="middle">&nbsp;&nbsp;<img src="modules/content_manager/images/warning.gif" /><font color="#FF6600"> No Web Page Found!</font></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(modules/content_manager/images/m.jpg)">
<tr>
<td height="26" align="center" valign="middle"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
</tr>
</table></td>
</tr>
</table>
NavBar2;
			}
	
		}
		 
		private static function update_webpage_tbl($pid, $dtm, $pname, $ptitle, $parent_nam, $pdesc, $pub, $p_index, $page_order) // update web page table
		{
			//require('conf/settings.php');
			$project_name = PROJECTNAME;
			$tbl = mysql_query("UPDATE web_pages_content 
									  SET page_ref_name = '$pname',
									  page_ref_title = '$ptitle',
									  page_ref_desc = '$pdesc',
									  page_ref_index = '$p_index',
									  page_published = '$pub',
									  date_modified = '$dtm',
									  page_order = '$page_order'
									  WHERE page_ref_id = '".$_GET['id']."'
									  ") or die(mysql_error());
				
				
				if(!$tbl)
				{
					$msg = "Web Page Has Not Been Updated!"; 
				}
			    else{
					$msg = "Web Page Has  Been Updated!"; 
				}
	  
			 $page = $_SESSION['page'];
			
		echo "<script>document.location.href='?$project_name=Control Panel&INC=Content Manager&CMD=Edit Web Page&id=$pid&msg=$msg!'</script>";
			
		}
		
	   public static function scan_img_tag($content) // scan for image tag comming from editor
	   {
		    $arrpath = array();
		    if(!empty($content))
			{
				$doc = new DOMDocument(); 
				$doc->loadHTML($content); 
				$xml = simplexml_import_dom($doc); 
				$images = $xml->xpath('//img'); 
				foreach ($images as $img) 
				{ 
				   $rep_path = str_replace('\"', '', $img['src']);
				   $arrpath[] = $rep_path;
				}
			}
		    return $arrpath;
		}
		
		public static function editor_images_in_table($page) // returns all editor images in table
		{
			 $sql = mysql_query("SELECT * FROM editor_img WHERE page='$page'") or die(mysql_error());
			 $arr_path = array();
			 while($rows = mysql_fetch_array($sql))
			 {
				 $arr_path[] = $rows["path"];
			 }
			 return	 $arr_path;	
		}
		
		public static function upload_cms_image() // check if directory exist
		{
			extract($_POST);
			$page = $_SESSION['page'];
			$admindir = '../../../../../pageresources/';
			$rootdir = '../../../../../../pageresources/';
			if(is_dir($admindir) && is_dir($rootdir))
			{
				$msg = content_man_class::loadImage($admindir, $rootdir, $page);
			}
			else
			{
				mkdir($admindir, 0777) or die('Cannot create dirctory!');
				chmod($rootdir, 0777);
				mkdir($rootdir, 0777) or die('Cannot create dirctory!');
				$msg = content_man_class::loadImage($admindir, $rootdir, $page);
			}
			return $msg;
		}
		
		private static function loadImage($admindir, $rootdir, $page) // Load image into directory
		{
			require_once('../../../../../conf/connection.php');
			$imagetype = $_FILES['fileField']['type'];
			$path_info = pathinfo($_FILES['fileField']['name']);
			$ext = $path_info['extension'];
			$file_name = $_POST['newname'] . "." . $ext;
			$max_filesize = 300000;
			$max_filesizeword = "300kb";
			
			if ($_FILES['fileField']['size'] > $max_filesize) {
				$msg = "That file type is too large, keep your image size at maximum of $max_filesizeword!";
			}
			include('resize.php');
			$newsize = ResizerImage::imageresizer($_FILES['fileField']['tmp_name'], $_POST['width'], $_POST['height'], $imagetype);	
			if($imagetype == "image/jpeg" || $imagetype == "image/pjpeg")
			{
					imagejpeg($newsize, $admindir."/".$file_name);
					imagejpeg($newsize, $rootdir."/".$file_name);
					$msg = "File Uploaded!"; 
			}
			
			elseif($imagetype == "image/jpg" || $imagetype == "image/pjpg")
			{
					imagejpeg($newsize, $admindir."/".$file_name);
					imagejpeg($newsize, $rootdir."/".$file_name);
					$msg = "File Uploaded!"; 
			}
			
			elseif($imagetype == "image/png")
			{
					imagepng($newsize, $admindir."/".$file_name);
					imagepng($newsize, $rootdir."/".$file_name);
					$msg = "File Uploaded!"; 
			}
			else
			{
				   $msg = "Image is not JPG or PNG!"; 
			}
			
			// Datatbase
			$page = $_SESSION['page'];
			$path = "pageresources/" . $file_name;
			mysql_query("INSERT INTO editor_img SET path='$path', page='$page'") or die(mysql_error());
			return $msg;
		}
		
		public static function create_session() // create current page session
		{
			session_start();
			$_SESSION['page'] = strtolower(str_replace(' ','_',$_GET['pagename']));
		}
		
	} // end class
					
					
?>