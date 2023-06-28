<?php
require('../model/database.php');
require('../model/customer_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'search_customers';
    }
}

//instantiate variable(s)
$last_name = '';
$customers = NULL;

switch ($action) {
	case 'search_customers':
		include('customer_search.php');
		break;
	case 'display_customers':
		$last_name = filter_input(INPUT_POST, 'last_name');
		if (empty($last_name)) {
			$message = 'You must enter a last name.';
		} else {
			$customers = get_customers_by_last_name($last_name);
		}
		include('customer_search.php');
		break;
	case 'display_customer':
		$customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
		$customer = get_customer($customer_id);
		$countries = getCountries();
		include('customer_display.php');
		break;
	case 'update_customer':
		// Get data from POST request
		$customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
		$first_name = filter_input(INPUT_POST, 'first_name');
		$last_name = filter_input(INPUT_POST, 'last_name');
		$address = filter_input(INPUT_POST, 'address');
		$city = filter_input(INPUT_POST, 'city');
		$state = filter_input(INPUT_POST, 'state');
		$postal_code = filter_input(INPUT_POST, 'postal_code');
		$country_code = filter_input(INPUT_POST, 'country_code');
		$phone = filter_input(INPUT_POST, 'phone');
		$email = filter_input(INPUT_POST, 'email');
		$password = filter_input(INPUT_POST, 'password');
    
		update_customer($customer_id, $first_name, $last_name,
				$address, $city, $state, $postal_code, $country_code,
				$phone, $email, $password);

		header("Location: .");
		break;
}
?>