<?php
	if( strpos($_SERVER['HTTP_HOST'], '.dev') !== false) {
		$baseUrl = 'http://localhost:4200';
	} else {
		$baseUrl = 'http://mullinschaindrive.com';
	}
?>

<?php include('components/header.php'); ?>

<?php include('components/footer.php'); ?>
<?php

require('bigcartel.class.php');




	$BG = new BigCartel;
	$BG->setStore('mullinschaindrive');

	$store_info = $BG->getStoreInfo();

	var_dump($store_info);

	echo '<br />';
	echo '<br />';
	echo '<br />';
	echo '<br />';
	echo '<br />';

	$products = $BG->listProducts();

	var_dump($products);
?>