<?php
include("../includes/connect.php");
include("../includes/function.php");

if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    echo "<script>alert('User ID is missing!');</script>";
    exit();
}

$user_id = $_GET['user_id'];
$user_ip = getUserIP();
$total_price = 0;
$count_product = 0;
$invoice_number = mt_rand();
$status = 'pending';

// Fetch cart items
$cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
$result_cart_query_price = mysqli_query($conn, $cart_query_price);
if (mysqli_num_rows($result_cart_query_price) == 0) {
    echo "<script>alert('No items in cart');</script>";
    exit();
}

// Calculate total price correctly
while ($row_price = mysqli_fetch_array($result_cart_query_price)) {
    $product_id = $row_price['product_id'];
    $quantity = $row_price['quantity'];

    // Get product price
    $select_product_query = "SELECT * FROM `products` WHERE product_id=$product_id";
    $run_price = mysqli_query($conn, $select_product_query);
    $row_product_price = mysqli_fetch_array($run_price);

    $product_price = $row_product_price['product_price'];
    $total_price += ($product_price * $quantity);
    $count_product++;
}

// Insert into `users_orders`
$insert_orders = "INSERT INTO `users_orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status)
VALUES ($user_id, $total_price, $invoice_number, $count_product, NOW(), '$status')";
$run_orders = mysqli_query($conn, $insert_orders);

// Insert into `orders_pending`
$result_cart_query_price = mysqli_query($conn, $cart_query_price);
while ($row_price = mysqli_fetch_array($result_cart_query_price)) {
    $product_id = $row_price['product_id'];
    $quantity = $row_price['quantity'];

    $insert_pending_orders = "INSERT INTO `orders_pending` (user_id, invoice_number, product_id, quantity, order_status)
    VALUES ($user_id, $invoice_number, $product_id, $quantity, '$status')";
    mysqli_query($conn, $insert_pending_orders);
}

// Delete items from cart
$empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$user_ip'";
$result_delete = mysqli_query($conn, $empty_cart);

echo "<script>alert('Order submitted successfully!');</script>";
echo "<script>window.open('profile.php','_self');</script>";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
</head>

<body>
    <h1>Order</h1>

</body>

</html>