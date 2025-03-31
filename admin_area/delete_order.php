<?php
include("../includes/connect.php");

if (isset($_GET['delete_order'])) {
    $delete_id = $_GET['delete_order'];

    // Confirmation popup
    echo "
    <script>
        if (confirm('Are you sure you want to delete this order?')) {
            window.location.href = './delete_order.php?confirm_delete=$delete_id';
        } else {
            window.location.href = './all_orders.php';
        }
    </script>";
}

// Check for confirmation and proceed to delete
if (isset($_GET['confirm_delete'])) {
    $delete_id = $_GET['confirm_delete'];

    $delete_order = "DELETE FROM `users_orders` WHERE order_id = $delete_id";
    $result_delete = mysqli_query($conn, $delete_order);

    if ($result_delete) {
        echo "<script>alert('Order Deleted Successfully!')</script>";
        echo "<script>window.open('./all_orders.php','_self')</script>";
    } else {
        echo "<script>alert('Failed to delete order!')</script>";
        echo "<script>window.open('./all_orders.php','_self')</script>";
    }
}
?>