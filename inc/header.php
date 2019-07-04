<?php
    include 'lib/Session.php';
		Session::init();
	if (isset($_GET['action']) && $_GET['action'] == "logout") {
		Session::destroy();
	}
    include('lib/Database.php');
	include('helpers/Format.php');
	include 'plugins/currencySymbol.php';
	
	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});

	$db     = new Database();
	$fm     = new Format();
	$cat    = new Category();
	$pd     = new Product();
	$cmr    = new Customer();
	$search = new Search();

?>

<?php
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache"); 
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
	header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bootstrap E-commerce Templates</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->

		<!-- Favicon -->
		<link rel="shortcut icon" href="ico/favicon.png" />

		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>
		<link href="themes/css/mystyle.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>		
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
					<form method="POST" class="search_form">
						<input type="text" class="input-block-level search-query" Placeholder="eg. T-sirt">
					</form>
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">				
							<li><a href="myproducts.php">My Account</a></li>
							<?php
								if(!Session::get("user_login")){
							?>
								<li><a href="auth.php">Login</a></li>
							<?php }else { ?>
								<li><a href="?action=logout">Logout</a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">				
					<a href="index.php" class="logo pull-left"><img src="themes/images/logo.png" class="site_logo" alt=""></a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="products.php">All Products</a></li>
						</ul>
					</nav>
				</div>
			</section>