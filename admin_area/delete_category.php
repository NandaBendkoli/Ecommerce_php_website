<?php
include("../includes/connect.php");
if (isset($_GET['delete_category'])) {
    $delete_id = $_GET['delete_category'];

    // Confirmation popup
    echo "
    <script>
        if (confirm('Are you sure you want to delete this category?')) {
            window.location.href = './delete_category.php?confirm_delete=$delete_id';
        } else {
            window.location.href = './view_categories.php';
        }
    </script>";
}

// Check for confirmation and proceed to delete
if (isset($_GET['confirm_delete'])) {
    $delete_id = $_GET['confirm_delete'];

    $delete_category = "DELETE FROM `categories` WHERE category_id=$delete_id";
    $result_delete = mysqli_query($conn, $delete_category);

    if ($result_delete) {
        echo "<script>alert('Category Deleted Successfully!')</script>";
        echo "<script>window.open('./view_categories.php','_self')</script>";
    }
}
?>
