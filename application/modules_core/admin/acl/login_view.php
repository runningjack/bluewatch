<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta name="hotelsystem" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="UMYU CBT">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>UMYU CBT</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<?php echo link_tag("bootstrap/js/bootstrap/dist/css/bootstrap.css"); ?>

	<?php echo link_tag("bootstrap/fonts/font-awesome-4/css/font-awesome.min.css"); ?>

	<!-- Custom styles for this template -->
	<?php echo link_tag("bootstrap/css/style.css"); ?>

</head>

<body class="texture">

<div id="cl-wrapper" class="login-container">

	<div class="middle-login">
		<div class="block-flat">
			<div class="header">							
                            <h3 class="text-center"><img class="logo-img" style="height: 20px;" src="<?php echo base_url('bootstrap/images/logo2.jpg');?>" alt="logo"/>
                                Computer Based Test V1.0</h3>
			</div>
			<div>
                            
   <?php echo form_open('admin/accesscontrol/verifylogin'); ?>
					<div class="content">
						<h4 class="title">Admin Login Access</h4>
                                                <div style=" color: red; padding-left: 30px;">
                                                    <?php if(isset($check_database)){ echo $check_database;}?>
                                                    <?php echo validation_errors(); ?></div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<input type="text" placeholder="username" id="username" name="username" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock"></i></span>
										<input type="password" placeholder="Password" id="password" name="password" class="form-control">
									</div>
								</div>
							</div>
							
					</div>
					<div class="foot">
					<input type="submit" class="btn btn-primary" data-dismiss="modal" value="Login"/>
						
					</div>
				</form>
			</div>
		</div>
		<div class="text-center out-links"><a href="#">&copy; 2015 UMYU Katsina</a></div>
	</div> 
	
</div>

<?php echo "<script src='" . base_url('bootstrap/js/jquery.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/behaviour/general.js') . "' type='text/javascript'></script>"; ?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
 <?php echo "<script src='" . base_url('bootstrap/js/behaviour/voice-commands.js') . "' type='text/javascript'></script>"; ?>
  <?php echo "<script src='" . base_url('bootstrap/js/bootstrap/dist/js/bootstrap.min.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.pie.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.resize.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.labels.js') . "' type='text/javascript'></script>"; ?>
</body>


</html>
