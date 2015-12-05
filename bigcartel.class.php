<?php
/**
 * BigCartel REST API Library
 *
 * Usage instructions at https://github.com/gareth-poole/bigcartel-api/blob/master/README.md
 *
 * @package
 * @author Gareth Poole
 * @copyright Gareth Poole 2013
 * @version 0.1
 */

require('RemoteConnector.php');

class BigCartel {

	const API = 'http://api.bigcartel.com/';

	private $_store;

	public function setStore($store){
		$this->_store = $store;
	}

	private function request($request){
		return self::API . $this->_store . $request;
	}

	public function getStoreInfo(){
		try{
			$stream = new Pos_RemoteConnector(self::request('/store.js'));
			if(!$stream->getErrorMessage()){
				return json_decode($stream);
			}
		}
		catch(Exception $e){
			// log $e
		}
	}


	public function listProducts($limit = 9999, $category = false){
		try {
			$output = array();
			$stream = new Pos_RemoteConnector(self::request('/products.js'));
			if(!$stream->getErrorMessage()){

				$products = json_decode($stream);

				if($category){
					foreach($products as $product){
						foreach($product->categories as $product_category){
							if($product_category->permalink == $category){
								$output[] = $product;
							}
						}
					}
				}
				else{
					$output = $products;
				}

				return $output;
			}
		}
		catch(Exception $e){
			// log $e
		}
	}


}