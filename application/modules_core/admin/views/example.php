<?php 
foreach ($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php echo link_tag('bootstrap/js/bootstrap/dist/css/bootstrap.css'); ?>
<?php echo link_tag("bootstrap/fonts/font-awesome-4/css/font-awesome.min.css"); ?>

	<div style='height:20px;'></div>  
    <div style="padding: 0px">
		<?php echo $output; ?>
    </div>
    <?php foreach ($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
 
