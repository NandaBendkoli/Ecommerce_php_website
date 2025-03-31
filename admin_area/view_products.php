<?php
include("../includes/connect.php");
include('../includes/function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" />
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php"> Home</a>
        </div>
    </nav>

    <h1 class="text-center p-4">All Products</h1>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead style="background-color: #17a2b8 !important;" class="text-white">
                    <tr>
                        <th>Sr No</th>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th>Total Sold</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_products = "SELECT * FROM `products`";
                    $get_products_result = mysqli_query($conn, $get_products);
                    $number = 0;

                    while ($row = mysqli_fetch_assoc($get_products_result)) {
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_image1 = $row['product_image1'];
                        $product_price = $row['product_price'];
                        $status = $row['status'];
                        $get_count = "SELECT * FROM `orders_pending` WHERE product_id=$product_id";
                        $get_count_result = mysqli_query($conn, $get_count);
                        $rows_count = mysqli_num_rows($get_count_result);
                        $number++;

                        echo "<tr>
                            <td>$number</td>
                            <td>$product_title</td>
                            <td><img class='img-fluid' style='max-width: 80px;' src='./product_images/$product_image1' alt=''></td>
                            <td>$product_price</td>
                            <td>$rows_count</td>
                            <td>$status</td>
                            <td><a href='edit_products.php?edit_products=$product_id'><i class='fa-solid fa-pen-to-square text-warning'></i></a></td>
                            <td><a href='index.php?delete_products=$product_id'><i class='fa-solid fa-trash text-danger'></i></a></td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <?php
        if (isset($_GET['edit_products'])) {
            include('edit_products.php');
        }
        ?>
    </div>

    <div class="bg-info text-center text-white py-3 mt-4">
        <p class="mb-0">&copy; 2025 Hidden Store. All rights reserved. Designed by Nanda Bendkoli.</p>
        <p>Discover a world of elegance and quality, where every product is handpicked to elevate your lifestyle.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>