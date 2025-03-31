<?php
include("../includes/connect.php");
session_start();

// Fetch order details if order_id is provided
if (!isset($_GET['order_id'])) {
    echo "<script>alert('No order selected!');</script>";
    exit();
}

$order_id = $_GET['order_id'];
$select_data = "SELECT * FROM `users_orders` WHERE order_id=$order_id";
$result = mysqli_query($conn, $select_data);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('Order not found!');</script>";
    exit();
}

$row_fetch = mysqli_fetch_assoc($result);
$invoice_number = $row_fetch['invoice_number'];
$amount_due = $row_fetch['amount_due'];

// Handle payment confirmation
if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $date = $_POST['date'];

    $insert_query = "INSERT INTO `user_payment` (order_id, invoice_number, amount, payment_mode, date)
                     VALUES ($order_id, $invoice_number, $amount, '$payment_mode', '$date')";
    
    if (mysqli_query($conn, $insert_query)) {
        // Update order status
        $update_orders = "UPDATE `users_orders` SET order_status='Complete' WHERE order_id=$order_id";
        mysqli_query($conn, $update_orders);

        echo "<h3 class='text-center text-light bg-success'>Payment Completed Successfully!</h3>";
        echo "<script> window.open('profile.php?my_orders','_self'); </script>";
    } else {
        echo "<h3 class='text-center text-light bg-danger'>Payment Failed. Try Again!</h3>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

<body class="bg-secondary">
    <div class="container my-5">
        <h2 class="text-center text-light">Confirm Payment</h2>

        <!-- Payment Form -->
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="Invoice" class="text-light">Invoice Number</label>
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>" readonly>
            </div>

            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="Amount" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>" readonly>
            </div>

            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto" required>
                    <option value="" disabled selected>Select Payment Mode</option>
                    <option>UPI</option>
                    <option>Net Banking</option>
                    <option>PayPal</option>
                    <option>Cash on Delivery</option>
                    <option>Pay Offline</option>
                </select>
            </div>

            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="date" class="text-light">Payment Date</label>
                <input type="date" class="form-control w-50 m-auto" name="date" required>
            </div>

            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
