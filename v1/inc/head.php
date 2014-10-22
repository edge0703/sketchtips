<?php include("inc/functions.php"); ?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<?php if(isset($title)) { ?>
	<title><?php echo $title; ?> | sketchtips.info</title>
	<?php } else { ?>
	<title>Clever tips for your favourite design app | sketchtips.info</title>
	<?php } ?>
	<meta name="description" content="On sketch-tips you get a useful tip for the design app Sketch every day."/>
	<meta name="author" content="Christian Krammer"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<link rel="stylesheet" media="screen" href="css/style.css"/>
	<script src="js/modernizr.custom.00233.js"></script>
	<script type="text/javascript">if ('querySelector' in document && 'localStorage' in window && 'addEventListener' in window ) {document.write('<style type="text/css">body{opacity:0}</style>');}</script>
</head>