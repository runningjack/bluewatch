<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="<?php echo Generalmodel::$developer; ?>">
	
       <?php echo link_tag('bootstrap/images/logo2.jpg', 'shortcut icon'); ?>

	<title>Budget Management System</title>
	<?php echo "<script src='".base_url('bootstrap/js/jquery.js')."' type='text/javascript'></script>"; ?>
	<!-- Bootstrap core CSS -->
       <?php echo link_tag('bootstrap/js/bootstrap/dist/css/bootstrap.css'); ?>
	
	

	<?php echo link_tag('bootstrap/fonts/font-awesome-4/css/font-awesome.min.css'); ?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script <?php echo link_tag('bootstrap/assets/js/html5shiv.js'); ?>
	  <script <?php echo link_tag('bootstrap/js/respond.min.js'); ?>
	<![endif]-->
      
<?php echo link_tag('bootstrap/js/jquery.gritter/css/jquery.gritter.css'); ?>
<?php echo link_tag('bootstrap/js/jquery.nanoscroller/nanoscroller.css'); ?>
<?php echo link_tag('bootstrap/js/jquery.easypiechart/jquery.easy-pie-chart.css'); ?>
<?php echo link_tag('bootstrap/js/bootstrap.switch/bootstrap-switch.css'); ?>
<?php echo link_tag('bootstrap/js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css'); ?>
<?php echo link_tag('bootstrap/js/jquery.select2/select2.css'); ?>
<?php echo link_tag('bootstrap/js/bootstrap.slider/css/slider.css'); ?>
<?php echo link_tag('bootstrap/js/intro.js/introjs.css'); ?>
<?php echo link_tag('bootstrap/js/jquery.vectormaps/jquery-jvectormap-1.2.2.css'); ?>
<?php echo link_tag('bootstrap/js/jquery.magnific-popup/dist/magnific-popup.css'); ?>
<?php echo link_tag('bootstrap/js/jquery.niftymodals/css/component.css'); ?>
<?php echo link_tag('bootstrap/js/bootstrap.summernote/dist/summernote.css'); ?>
<?php echo link_tag('bootstrap/js/jquery.datatables/bootstrap-adapter/css/datatables.css'); ?>	
<?php echo link_tag('bootstrap/js/jquery.niftymodals/css/component.css'); ?>	
<?php echo link_tag('bootstrap/css/style.css'); ?>
<?php echo link_tag('bootstrap/css/custome.css'); ?>	
<style type="text/css">
  li{
    list-style-type:none;
    }
    input{
    /*  height: 40px;*/
    }
</style>
        
</head>

<body>
<?php
$this->load->model('menu');
 $this->load->model('Role');

$group = $_SESSION['login_detal']->group_id;
$menu = (new Menu)->fetchEnabledModule($group); //var_dump($menu);//exit;

$uri = explode('/', uri_string());

if (isset($uri[0])) {
    $perm_name = $uri[0].'/index';
}
if (isset($uri[1])) {
    $perm_name = $uri[0].'/'.$uri[1].'/index';
}
if (isset($uri[2])) {
    $perm_name = $uri[0].'/'.$uri[1].'/'.$uri[2];
}
if (isset($uri[3])) {
    $perm_name = $uri[0].'/'.$uri[1].'/'.$uri[2].'/'.$uri[3];
}

$access = (new Role)->haveAccess($group, $perm_name);
//var_dump($access);//exit;

if ($_SESSION['user'].md5('salt0123') != $_SESSION['usersalt']) {
    echo "<script type='text/javascript'>alert('invalid access'); "
    ."window.location.href = '".base_url('admin/')."'</script>";

    exit;
}
?>
  <!-- Fixed navbar -->
  <div id="head-nav" style="padding-left:0px;" class="navbar navbar-default navbar-fixed-top ">
    <div class="container-fluid" style="padding-left:0px;">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="fa fa-gear"></span>
        </button>
        <a class="navbar-brand" style="width: 195px;" href="#"><span>Budget App V1.0</span></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Bluechip Technology Limited</a></li>
                
      </ul>
          
    
         
    <ul class="nav navbar-nav navbar-right user-nav">
      <li class="dropdown profile_menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            
            Welcome <?php echo $_SESSION['user']; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">         
          <li><a href="<?php echo base_url('admin/accesscontrol/logout'); ?>">Sign Out</a></li>
        </ul>
      </li>
    </ul>			
          
          
          

      </div><!--/.nav-collapse -->
    </div>
  </div>
	
<div id="cl-wrapper">
		<div class="cl-sidebar">
			<div class="cl-toggle"><i class="fa fa-bars"></i></div>
			<div class="cl-navblock">
        <div class="menu-space">
          <div class="content">
            <div class="side-user">
              <div class="avatar"><img src="<?php echo base_url('bootstrap/images/avatar1_50.jpg'); ?>" alt="Avatar" /></div>
              <div class="info">
                <a href="#"><?php echo $_SESSION['user']; ?> </a>
                <img src="<?php echo base_url('bootstrap/images/state_online.png'); ?>" alt="Status" /> <span>Online</span>
              </div>
            </div>
            <ul class="cl-vnavigation">
              <li><a href="<?php echo base_url('admin/index'); ?>"><i class="fa fa-home"></i><span>Dashboard</span></a>
               
              </li>
              
              <?php
               $i = 1;
              foreach ($menu as $m) {
                  ?>
                    
                        
                        <li><a class="menuitem">
                                <?php (new Menu)->menuIcon($i); ?><span>
                                <?php echo  $m['module_name']; ?></span></a>
                            <ul class="sub-menu">
                                <?foreach ($m['menu'] as $l) {  //var_dump($l);die;?>
               <li><a href="
               <?php echo base_url($l['perm_name']); ?>"><?echo $l['per_desc']; ?></a> </li>
                                <?php
                  } ?>
                            </ul>
                        </li>
                        
                    
                    <?php ++$i;
              }?>
              
            </ul>
          </div>
        </div>
        
			</div>
		</div>
	
	<div class="container-fluid" id="pcont">


ALTER TABLE `bua_exp_log` CHANGE COLUMN `amount` `amount` DECIMAL(17,2) NULL DEFAULT NULL AFTER `log_date`;
ALTER TABLE `admin_exp_log` CHANGE COLUMN `amount` `amount` DECIMAL(17,2) NULL DEFAULT NULL AFTER `log_date`;
ALTER TABLE `project_exp_log` CHANGE COLUMN `amount` `amount` DECIMAL(17,2) NULL DEFAULT NULL AFTER `log_date`;
ALTER TABLE `department_exp_budget` CHANGE COLUMN `budgeted_amount` `budgeted_amount` DECIMAL(17,2) NOT NULL;


