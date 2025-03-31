<?php
include("../includes/connect.php");
if (isset($_GET['delete_brand'])) {
    $delete_id = $_GET['delete_brand'];

    echo "
    <script>
        if (confirm('Are you sure you want to delete this brand?')) {
            window.location.href = './delete_brand.php?confirm_delete=$delete_id';
        } else {
            window.location.href = './view_brands.php';
        }
    </script>";
}

if (isset($_GET['confirm_delete'])) {
    $delete_id = $_GET['confirm_delete'];

    $delete_brand = "DELETE FROM `brands` WHERE brand_id=$delete_id";
    $result_delete = mysqli_query($conn, $delete_brand);

    if ($result_delete) {
        echo "<script>alert('Brand Deleted Successfully!')</script>";
        echo "<script>window.open('./view_brands.php','_self')</script>";
    }
}
?>