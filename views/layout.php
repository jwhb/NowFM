<?php
  $base_url = Flight::request()->base;
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $page_desc; ?>">
<meta name="author" content="<?php echo $page_author; ?>">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="<?php echo $base_url; ?>/style/skeleton.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>/style/app.css">

<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link rel="shortcut icon" href="<?php echo $base_url; ?>/img/favicon.ico">
<link rel="apple-touch-icon" href="<?php echo $base_url; ?>/img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72"
	href="<?php echo $base_url; ?>/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114"
	href="<?php echo $base_url; ?>/img/apple-touch-icon-114x114.png">

</head>
<body>
	<div class="container">
<?php echo $body; ?>

	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</body>
</html>