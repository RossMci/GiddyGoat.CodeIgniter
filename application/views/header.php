<?php 

$this->load->helper('url'); 
$base = base_url() .  "/"; 
$img_base = base_url();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mini Things - Purveyors of Miniature Toys</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700" rel="stylesheet" type="text/css" />
<link href="<?php echo $base . "CI/assets/css/login/slide.css"?>" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo $base . "CI/assets/css/login/style.css"?>" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo $base . "CI/assets/css/default.css"?>" rel="stylesheet" type="text/css" media="all" />



<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="javascript" src="<?php echo $base . "CI/assets/js/jquery.validate.js"?>"></script>



<?php
include('loginForm.php'); 
?>




</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo"> 
			<h1><img src="<?php echo $img_base . "CI/assets/images/logo.jpg"?>" alt="" width="385" height="150" /></h1>
		</div>
	</div>

	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="<?php echo $base ?>">Home</a></li>
			<li><a href="#">Gallery</a></li>
			<li><a href="#">Special Offers::</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Find Us</a></li>
			<li class="last"><a href="#">Contact</a></li>
		</ul>
	</div>
	