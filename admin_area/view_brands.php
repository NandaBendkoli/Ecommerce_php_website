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
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table-container {
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .product_img {
            height: 100px;
            width: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-info navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome " . ($_SESSION['admin_name']) . "</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='./admin_logout.php'>Log Out</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome Guest</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='./admin_login.php'>Login</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <h1 class="text-center">All Brands</h1>
        <div class="table-responsive table-container">
            <table class="table table-bordered text-center">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Sr No</th>
                        <th>Brand Title</th>
                        <th>EDIT</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_brand = "SELECT * FROM `brands`";
                    $result = mysqli_query($conn, $select_brand);
                    $number = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $brand_id = $row["brand_id"];
                        $brand_title = $row["brand_title"];
                        $number++;
                        echo "<tr>";
                        echo "<td>$number</td>";
                        echo "<td>$brand_title</td>";
                        echo "<td><a href='index.php?edit_brand=$brand_id' class='text-warning'><i class='fa-solid fa-pen-to-square'></i></a></td>";
                        echo "<td><a href='index.php?delete_brand=$brand_id' class='text-danger'><i class='fa-solid fa-trash'></i></a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="bg-info text-white text-center p-3 mt-4">
        <p class="mb-0">&copy; 2025 Hidden Store. All rights reserved. Designed by Nanda Bendkoli.</p>
        <p>Discover a world of elegance and quality, where every product is handpicked to elevate your lifestyle.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>