<?php
	include '../view/header.php';
	
	$customer = $_SESSION['customer'];
	$products = $_SESSION['products'];
	$email = $_SESSION['email'];
?>
<main>

    <h2>Register Product</h2>
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php else: ?>
        <form action="." method="post" id="aligned">
            <input type="hidden" name="action" 
                   value="register_product">
            <input type="hidden" name="customer_id" 
                   value="<?php echo htmlspecialchars($customer['customerID']); ?>">

            <label>Customer:</label>
            <label><?php echo htmlspecialchars($customer['firstName'] . ' ' . 
                                              $customer['lastName']) ?></label>
            <br>

            <label>Product:</label>
            <select name="product_code">
            <?php foreach ($products as $product) : ?>
                <option value="<?php echo htmlspecialchars($product['productCode']); ?>">
                    <?php echo htmlspecialchars($product['name']); ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>&nbsp;</label>
            <input type="submit" value="Register Product" />
        </form>
		<form action="." method="post">
			<input type="hidden" name="action" value="logout">
			<label>You are logged in as <?php echo htmlspecialchars($email)?></label><br>
			<input type="submit" value="Logout">
		</form>
    <?php endif; ?>

</main>
<?php include '../view/footer.php'; ?>