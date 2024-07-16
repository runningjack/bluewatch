<?php /* ?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta name="hotelsystem" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Budget Management System">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">
	<?php echo link_tag('bootstrap/images/logo2.jpg', 'shortcut icon'); ?>

	<title>Budget Management System</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<?php echo link_tag('bootstrap/js/bootstrap/dist/css/bootstrap.css'); ?>

	<?php echo link_tag('bootstrap/fonts/font-awesome-4/css/font-awesome.min.css'); ?>

	<!-- Custom styles for this template -->
	<?php echo link_tag('bootstrap/css/style.css'); ?>

</head>

<body class="texture">

<div id="cl-wrapper" class="login-container">

	<div class="middle-login">
		<div class="block-flat">
			<div class="header">							
                            <h3 class="text-center"><img class="logo-img" style="height: 20px;" src="<?php echo base_url('bootstrap/images/logo2.jpg'); ?>" alt="logo"/>
                                Budget Application V1.0</h3>
			</div>
			<div>
                            
   <?php echo form_open('admin/accesscontrol/verifylogin'); ?>
					<div class="content">
						<h4 class="title">Admin Login Access</h4>
                                                <div style=" color: red; padding-left: 30px;">
                                                    <?php if (isset($check_database)) {
    echo $check_database;
}?>
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
		<div class="text-center out-links"><a href="#"><font color="white">&copy; <?php echo date(Y); ?> Bluechip Technology</font></a></div>
	</div> 
	
</div>

<?php echo "<script src='".base_url('bootstrap/js/jquery.js')."' type='text/javascript'></script>"; ?>
<?php echo "<script src='".base_url('bootstrap/js/behaviour/general.js')."' type='text/javascript'></script>"; ?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
 <?php echo "<script src='".base_url('bootstrap/js/behaviour/voice-commands.js')."' type='text/javascript'></script>"; ?>
  <?php echo "<script src='".base_url('bootstrap/js/bootstrap/dist/js/bootstrap.min.js')."' type='text/javascript'></script>"; ?>
<?php echo "<script src='".base_url('bootstrap/js/jquery.flot/jquery.flot.js')."' type='text/javascript'></script>"; ?>
<?php echo "<script src='".base_url('bootstrap/js/jquery.flot/jquery.flot.pie.js')."' type='text/javascript'></script>"; ?>
<?php echo "<script src='".base_url('bootstrap/js/jquery.flot/jquery.flot.resize.js')."' type='text/javascript'></script>"; ?>
<?php echo "<script src='".base_url('bootstrap/js/jquery.flot/jquery.flot.labels.js')."' type='text/javascript'></script>"; ?>
</body>
</html>
<?php */?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
    
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 	<?php echo link_tag('bootstrap/images/logo2.jpg', 'shortcut icon'); ?>
     <!-- Twitter -->
     <!-- <meta name="twitter:site" content="@GTBank">
     <meta name="twitter:creator" content="@BCT">
     <meta name="twitter:card" content="summary_large_image">
     <meta name="twitter:title" content="GTBank SIT">
     <meta name="twitter:description" content="Share Mananagement Application">
     <meta name="twitter:image" content="#">
  -->
     <!-- Facebook -->
     <meta property="og:url" content="#">
     <meta property="og:title" content="GTBank SIT">
     <meta property="og:description" content="Share Mananagement Application">
 
     <meta property="og:image" content="#">
     <meta property="og:image:secure_url" content="#">
     <meta property="og:image:type" content="image/png">
     <meta property="og:image:width" content="1200">
     <meta property="og:image:height" content="600">
 
     <!-- Meta -->
     <meta name="description" content="GTBank SIT">
     <meta name="author" content="Bluechip Technologies LLC /conclave/">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Budget Management System | Login</title>

    <!-- azia CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/newtemp/azia.css">
    <style type="text/css">
      .az-column-signup { 
    display: inline-grid !important;
  }
    </style>

  </head>
  <body class="az-body">

      <div class="az-signup-wrapper">
        <div class="az-column-signup-left" style="background:url(<?php echo base_url() ?>images/bg2.jpg); background-size: cover;">
          
        </div><!-- az-column-signup-left -->
        <div class="az-column-signup">
          <div class="az-signin-header">
              <img src="<?php echo base_url() ?>/images/bluechip-logo.png" alt="" class="float-right" width="80" srcset="">
          </div>
          <div class="az-signin-header">
              
              <h2 class="text-secondary" >Budget Management System</h2>
              <h4>Please sign in to continue</h4>
              <div style=" color: red; padding-left: 30px;">
                 <?php if (isset($_GET['error'])) {
                     echo $_GET['error'];
                              }?>
              </div>


      <div style=" color: red; padding-left: 30px;">
                 <?php if (isset($check_database)) {
                     echo $check_database;
                              }?>
      <?php echo validation_errors();  ?></div>
 
            <?php 
                      echo form_open('admin/accesscontrol/verifylogin');
              $redirect = $this->input->get('url');
            ?>
              <input type="hidden" name="url" value="<?=$redirect?>">
                <div class="form-group">
                  <label>Email </label>
                  <input type="text" class="form-control"  placeholder="Bluechip Email" id="username" name="username">
                </div><!-- form-group -->
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" placeholder="Bluechip Password" id="password" name="password">
                </div><!-- form-group -->
                
                	<input type="submit" class="btn btn-az-secondary btn-block"data-dismiss="modal" value="Login"/>
              </form> 

              <?php    ?>
            </div><!-- az-signin-header -->
            <div class="az-signin-footer">
             <!-- <p><a href="#">Forgot password?</a></p>
              <p>Don't have an account? <a href="#">Create an Account</a></p>-->
            </div><!-- az-signin-footer -->
             
     <!--        <a 
             href="https://myapps.microsoft.com/signin/a5401072-6f15-4bce-8c5e-602a4a93910f?tenantId=6a117883-fa0a-453d-8678-49b0376d643e">
            <button type="button" class="chakra-button css-192e5ps" style="width: 100%;"><span class="chakra-button__icon css-1wh2kri">
              <img class="chakra-image css-1f7z3x2" aria-hidden="true" focusable="false" src="<?php echo base_url() ?>assets//microsoft.078c9b21.svg"></span> Login with Microsoft </button>
            </a>
 -->
            <div class="az-signin-footer">
            
              <p> <a href="#">Support Email: support@bluechiptech.biz</a></p>
            </div><!-- az-signin-footer -->
        </div><!-- az-column-signup -->
      </div><!-- az-signup-wrapper -->
  
       </body>
  
</html>



