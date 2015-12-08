<!doctype html>

<head>
	<title>Mullins Chain Drive</title>
  
  <link href="<?php echo $baseUrl; ?>/favicon.png" rel="shortcut icon">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=IE8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="og:description" content="Skinny trees if you please. Hand made in Richmond, California">

	<meta property="og:title" content="Mullins Chain Drive">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo $baseUrl; ?>">
  <meta property="og:image" content=""> <!-- need to add image !!!!! -->
  <meta property="og:site_name" content="Mullins Chain Drive">

	<script src="https://use.typekit.net/nsc3eew.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>

	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/assets/style/style.css" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
<div class="logo"><img src="<?php echo $baseUrl; ?>/assets/images/logo.png"></div>

<?php

$directory = 'dist/assets/images/bgs/';
$files = glob($directory . '*.jpg');

if ( $files !== false )
{
    $filecount = count( $files );
}

$randomBGNumber = rand(1, $filecount);
?>
<section class="main burn bg-yellow" style="background-image: url('<?php echo $baseUrl; ?>/assets/images/bgs/mcd-web-bg-<?php echo $randomBGNumber; ?>.jpg');">
<div class="scroller">