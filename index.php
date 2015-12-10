<?php
	if( strpos($_SERVER['HTTP_HOST'], '.dev') !== false) {
		$baseUrl = 'http://localhost:4200';
	} else {
		$baseUrl = 'http://mullinschaindrive.com/staging';
	}
?>

<?php include('components/header.php'); ?>

<?php

$menu = '<div class="main-menu"><div class="menu-toggle"><i class="fa fa-bars"></i></div><ul class="menu-list">';


require('bigcartel.class.php');
require('functions.php');




	$BG = new BigCartel;
	$BG->setStore('mullinschaindrive');

	$storeInfo = $BG->getStoreInfo();

	// var_dump($storeInfo);

	// echo '<br />';
	// echo '<br />';
	// echo '<br />';
	// echo '<br />';
	// echo '<br />';

	$products = $BG->listProducts();

	// var_dump($products);


	$html = '<section class="content">';

	foreach($products as $product) {
		$name = str_replace('Mullins', '', $product->name);

		if(strpos(strtolower($name), 'shirt') !== false || strpos(strtolower($name), 'poster') !== false) {

		} else {
			$menu .= '<li class="menu-item"><a href="#'.toCamelCase($name).'">'.$name.'</a></li>';
			$html .= '<section class="product" id="'.toCamelCase($name).'">';
			$html .= '<h3 class="product-name">'.$name.'<a class="purchase-link" target="_blank" href="'.$storeInfo->url.''.$product->url.'">$'.$product->default_price.' <i class="fa fa-shopping-cart"></i></a></h3>';
			$html .= '<p class="product-description">'.utf8_decode($product->description).'</p>';
			foreach($product->images as $image) {
				$html .= '<img src="'.$image->url.'" />';
			}
			$html .= '</section>';
		}
	}

	$html .='</section>';

	$menu .= '<li class="after"><div class="inner"></div></li></ul>';
	$menu .= '<span class="contact-info">Mullins Chain Drive<br/>401 1st Street #155</br>Richmond, California 94801</br></br><a href="mailto:info@mullinschaindrive.com">info@mullinschaindrive.com</a></span>';
	$menu .= '<div class="social"><a href="http://facebook.com/mullinschaindrive" target="_blank"><i class="fa fa-facebook"></i></a><a href="http://instagram.com/mullinschaindrive" target="_blank"><i class="fa fa-instagram"></i></a>';
	$menu .= '</div>';


	echo $html;
?>




<?php include('components/footer.php'); ?>
