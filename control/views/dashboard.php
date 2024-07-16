<? 
$get = setting_class::get_settings();
$user = setting_class::get_users();
?>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
 <div id="TabbedPanels1" class="TabbedPanels">
        <ul class="TabbedPanelsTabGroup">
          <li class="TabbedPanelsTab" tabindex="0">Splash</li>
          <li class="TabbedPanelsTab" tabindex="0">System Status</li>
        </ul>
        <div class="TabbedPanelsContentGroup">
          <div class="TabbedPanelsContent">
          <span style="color:#CCC; font-size:9px">Instant satisfaction occurs when all you have to do is hit</span><br />
          <br />
          <img src="images/linkCMS-logo.png"/>
<h1 style="color:#666">Welcome to linkCMS v1.2          </h1>
<p>
        <span style="color: #666; line-height:18px">
        linkCMS makes site editing simple like working with a word-processor and you can learn how to do it in no time!<br /><br />
        You will have the ability to seamlessly format text, set hyperlinks, build tables, and insert images and documents with our content management system.
        </span><br /><br />
        <span style="color: #666">We intend to make you be in control of your content from the same interface faster and more convinently than ever before.</span><br />
        <br />
        <br />
        <span style="color: #999">Thank you for choosing linkCMS</span><br />
        </div>
          <div class="TabbedPanelsContent"><div style="min-height:340px">
          <strong>View basic information</strong><br /><br />
        <fieldset>
        <legend>Vendor's Info</legend>
     	<div style="line-height:20px">
        	<br /><strong>Developer: </strong>Upperlink Limited
            <br /><strong>Website: </strong><a href="http://www.upperlink.com.ng" target="_blank">www.upperlink.com.ng</a>
            <br /><strong>Date Released: </strong>01-07-2012
            <br /><strong>Current Version: </strong>1.2
            <br />
         </div>
        </fieldset>
        
        <p>
        <fieldset>
        <legend>Client Info</legend>
         <div style="line-height:20px">
     		<br /><strong>Client Name: </strong><?= $get['name']; ?>
          </div>
        </fieldset>
        
         <p>
        <fieldset>
        <legend>System Info</legend>
         <div style="line-height:20px">
     		<br /><strong>Server Name: </strong><? echo $_SERVER['SERVER_NAME']; ?>
            <br /><strong>Host Name: </strong><? echo gethostbyaddr($_SERVER['REMOTE_ADDR']); ?>
            <br /><strong>Browser: </strong><? echo $_SERVER['HTTP_USER_AGENT'] . "\n\n"; ?>
            <br /><strong>Total Number Of Users: </strong><?= $user['num']; ?>
            <br /><strong>Number of Users Logged in: </strong><?= $user['log']; ?>
          </div>
        </fieldset>
          
          
          </div></div>
        </div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
