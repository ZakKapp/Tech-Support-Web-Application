<?php
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_products';
    }
}

switch ($action) {
	case 'list_products':
		// Get product data
		$products = get_products();

		// Display the product list
		include('product_list.php');
		break;
	case 'delete_product':
		$product_code = filter_input(INPUT_POST, 'product_code');
		delete_product($product_code);
		header("Location: .");
		break;
	case 'show_add_form':
		include('product_add.php');
		break;
	case 'add_product':
		$code = filter_input(INPUT_POST, 'code');
		$name = filter_input(INPUT_POST, 'name');
		$version = filter_input(INPUT_POST, 'version', FILTER_VALIDATE_FLOAT);
		$release_date = filter_input(INPUT_POST, 'release_date');

		// Validate the inputs
		if ( empty($code) || empty($name) || 
			empty($version) || $version === FALSE || 
			empty($release_date)) {
			$error = "Invalid product data. Check all fields and try again.";
			include('../errors/error.php');
			break;
		} else {
			$date = new DateTime($release_date);
			//$date->format('n-j-Y');
			
			add_product($code, $name, $version, $date->format('Y-n-j'));
			header("Location: .");
			break;
		}
}
?>