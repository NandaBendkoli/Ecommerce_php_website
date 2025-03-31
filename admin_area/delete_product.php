<?php
include("../includes/connect.php");

if (isset($_GET['delete_products'])) {
    $delete_id = $_GET['delete_products'];

    // Confirmation popup
    echo "
    <script>
        if (confirm('Are you sure you want to delete this product?')) {
            window.location.href = './delete_product.php?confirm_delete=$delete_id';
        } else {
            window.location.href = './view_products.php';
        }
    </script>";
}

// Check for confirmation and proceed to delete
if (isset($_GET['confirm_delete'])) {
    $delete_id = $_GET['confirm_delete'];

    $delete_product = "DELETE FROM `products` WHERE product_id=$delete_id";
    $result_delete = mysqli_query($conn, $delete_product);

    if ($result_delete) {
        echo "<script>alert('Product Deleted Successfully!')</script>";
        echo "<script>window.open('./view_products.php','_self')</script>";
    }
}
?>