<?php
function get_registration($customer_id, $product_code) {
    global $db;
    $query = 'SELECT * FROM registrations
              WHERE customerID = :customer_id
              AND productCode = :product_code';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':product_code', $product_code);
    $statement->execute();
    $registration = $statement->fetch();
    $statement->closeCursor();
    
    if ($registration === FALSE) { // no registration in database
        return NULL;
    } else {
        return $registration;
    }
}

function add_registration($customer_id, $product_code) {
    global $db;
    $date = date('Y-m-d');  // get current date in yyyy-mm-dd format
    $query = 'INSERT INTO registrations VALUES
            (:customer_id, :product_code, :date)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':product_code', $product_code);
    $statement->bindValue(':date', $date);
    $statement->execute();
    $statement->closeCursor();
}
?>