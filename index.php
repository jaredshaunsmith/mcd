<?php
	if( strpos($_SERVER['HTTP_HOST'], '.dev') !== false) {
		$baseUrl = 'http://localhost:4200';
	} else {
		$baseUrl = 'http://mullinschaindrive.com';
	}
?>

<?php include('components/header.php'); ?>

<?php

$menu = '<div class="main-menu"><ul class="menu-list"><li class="after"><div class="inner"></div></li><li class="menu-item label">Products</li>';


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

	$menu .= '</ul></div>';

	echo $menu;
	echo $html;
?>




<?php include('components/footer.php'); ?>
