<?php
include("../includes/connect.php");

if (isset($_GET['delete_payment'])) {
    $delete_id = $_GET['delete_payment'];

    // Confirmation popup
    echo "
    <script>
        if (confirm('Are you sure you want to delete this payment?')) {
            window.location.href = './delete_payment.php?confirm_delete=$delete_id';
        } else {
            window.location.href = './all_payment.php';
        }
    </script>";
}

// Check for confirmation and proceed to delete
if (isset($_GET['confirm_delete'])) {
    $delete_id = $_GET['confirm_delete'];

    $delete_payment = "DELETE FROM `user_payment` WHERE order_id = $delete_id";
    $result_delete = mysqli_query($conn, $delete_payment);

    if ($result_delete) {
        echo "<script>alert('Payment Deleted Successfully!')</script>";
        echo "<script>window.open('./all_payment.php','_self')</script>";
    } else {
        echo "<script>alert('Failed to delete payment!')</script>";
        echo "<script>window.open('./all_payment.php','_self')</script>";
    }
}
?>