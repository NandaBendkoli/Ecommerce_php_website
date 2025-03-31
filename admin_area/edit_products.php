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
    <title>Insert Product</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />


<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    crossorigin="anonymous" />

<style>
    .navbar {
        background-color: #17a2b8;
    }

    .navbar a {
        color: white;
        font-weight: bold;
    }

    .product_img {
        width: 100px;
        height: 100px;
    }
</style>

<body>


    <div class="content ">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="view_products.php">Home</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">

                        <?php

                        // Check if user is logged in
                        if (isset($_SESSION['username'])) {
                            // Show "Welcome [username]" and Log Out link
                            echo " 
                        <li class='nav-item'>
                        <a class='nav-link' href='#' >Welcome " . ($_SESSION['username']) . "</a>
                        </li>
                        <li class='nav-item'>
                        <a class='nav-link' href='../users_area/user_logout.php' >Log Out</a>
                        </li>";
                        } else {
                            // Show "Welcome Guest" and Login link for guests
                            echo "
                            <li class='nav-item'>
                            <a class='nav-link' href='#' >Welcome Guest</a>
                            </li>
                            <li class='nav-item'>
                            <a class='nav-link' href='../users_area/user_login.php' >Login</a>
                            </li>";
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </nav>


    </div>
    <?php

    if (isset($_GET['edit_products'])) {
        $edit_id = $_GET['edit_products'];
        $get_data = "SELECT * FROM `products` WHERE product_id=$edit_id";
        $get_data_result = mysqli_query($conn, $get_data);
        $row = mysqli_fetch_assoc($get_data_result);
        $product_title = $row['product_title'];
        $product_description = $row['product_desc'];
        $product_keyword = $row['product_keyword'];
        $category_id = $row['category_id'];
        $brand_id = $row['brand_id'];
        $product_image1 = $row['product_image1'];
        $product_image2 = $row['product_image2'];
        $product_image3 = $row['product_image3'];
        $product_price = $row['product_price'];


        // category
        $select_category = "SELECT * FROM `categories` WHERE category_id=$category_id";
        $result_query = mysqli_query($conn, $select_category);
        $row_category = mysqli_fetch_assoc($result_query);
        $category_title = $row_category['category_title'];

        //brand 
    
        $select_brand = "SELECT * FROM `brands` WHERE brand_id=$brand_id";
        $result_query = mysqli_query($conn, $select_brand);
        $row_brand = mysqli_fetch_assoc($result_query);
        $brand_title = $row_brand['brand_title'];













    }
    ?>

    <div class="content m-auto ">

        <h3 class="text-center pt-4">Edit the Product</h3>

        <div class="container mt-3">
            <form action="" method="post" enctype="multipart/form-data" class="p-4 shadow-lg bg-white rounded">
                <!-- Product Title -->
                <div class="mb-3">
                    <label for="product_title" class="form-label fw-bold">Product Title</label>
                    <div class="input-group">
                        <span class="input-group-text bg-info text-white"><i class="fas fa-tag"></i></span>
                        <input type="text" name="product_title" id="product_title" class="form-control"
                            placeholder="Enter product title" value="<?php echo $product_title ?>">
                    </div>
                </div>

                <!-- Product Description -->
                <div class="mb-3">
                    <label for="product_desc" class="form-label fw-bold">Product Description</label>
                    <div class="input-group">
                        <span class="input-group-text bg-info text-white"><i class="fas fa-align-left"></i></span>
                        <input type="text" name="product_desc" id="product_desc" class="form-control"
                            placeholder="Enter product description" value="<?php echo $product_description ?>">
                    </div>
                </div>

                <!-- Product Keywords -->
                <div class="mb-3">
                    <label for="product_keyword" class="form-label fw-bold">Product Keywords</label>
                    <div class="input-group">
                        <span class="input-group-text bg-info text-white"><i class="fas fa-key"></i></span>
                        <input type="text" name="product_keyword" id="product_keyword" class="form-control"
                            placeholder="Enter product keywords" value="<?php echo $product_keyword ?>">
                    </div>
                </div>

                <!-- Categories -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Select a Category</label>
                    <div class="input-group">
                        <span class="input-group-text bg-info text-white"><i class="fas fa-list"></i></span>
                        <select name="product_category" class="form-select">
                            <option value="<?php echo $category_title ?>"><?php echo $category_title ?></option>
                            <?php
                            $select_category_all = "SELECT * FROM `categories`";
                            $result_query_all = mysqli_query($conn, $select_category_all);
                            while ($row = mysqli_fetch_assoc($result_query_all)) {
                                $category_title = $row['category_title'];
                                $category_id = $row['category_id'];
                                echo "<option value='$category_id'>$category_title</option>";
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <!-- Brands -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Select a Brand</label>
                    <div class="input-group">
                        <span class="input-group-text bg-info text-white"><i class="fas fa-industry"></i></span>
                        <select name="product_brands" class="form-select">
                            <option value="<?php echo $brand_title ?>"><?php echo $brand_title ?></option>

                            <?php
                            $select_brand_all = "SELECT * FROM `brands`";
                            $result_query_all = mysqli_query($conn, $select_brand_all);
                            while ($row = mysqli_fetch_assoc($result_query_all)) {
                                $brand_title = $row['brand_title'];
                                $brand_id = $row['brand_id'];
                                echo "<option value='$brand_id'>$brand_title</option>";
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <!-- Product Images -->

                <div class="mb-1">
                    <label for="product_img1" class="form-label fw-bold">Product Image 1</label>
                    <div class="d-flex">
                        <input type="file" name="product_img1" id="product_img1" class="form-control w-90 m-auto">
                        <img class="product_img" src="../images/<?php echo $product_image1 ?>" alt="">
                    </div>
                </div>
                <div>
                    <label for="product_img2" class="form-label fw-bold">Product Image 2</label>
                    <div class="d-flex">
                        <input type="file" name="product_img2" id="product_img2" class="form-control w-90 m-auto">
                        <img class="product_img" src="../images/<?php echo $product_image2 ?>" alt="">
                    </div>
                </div>
                <div class="mb-1">
                    <label for="product_img3" class="form-label fw-bold">Product Image 3</label>
                    <div class="d-flex">
                        <input type="file" name="product_img3" id="product_img3" class="form-control w-90 m-auto">
                        <img class="product_img" src="../images/<?php echo $product_image3 ?>" alt="">
                    </div>
                </div>


                <!-- Product Price -->
                <div class="mb-3 mt-3">
                    <label for="product_price" class="form-label fw-bold">Product Price</label>
                    <div class="input-group">
                        <span class="input-group-text bg-info text-white"><i class="fas fa-dollar-sign"></i></span>
                        <input type="text" name="product_price" id="product_price" class="form-control"
                            placeholder="Enter product price" value="<?php echo $product_price ?>">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <input type="submit" name="edit_products" class="btn btn-info text-white px-5 py-2 fw-bold"
                        value="Update Product">
                </div>

                <!-- editing products -->
                <?php
                if (isset($_POST['edit_products'])) {
                    $product_title = $_POST['product_title'];
                    $product_desc = $_POST['product_desc'];
                    $product_keyword = $_POST['product_keyword'];
                    $product_category = $_POST['product_category'];
                    $product_brands = $_POST['product_brands'];
                    $product_price = $_POST['product_price'];

                    $product_img1 = $_FILES['product_img1']['name'];
                    $product_img2 = $_FILES['product_img2']['name'];
                    $product_img3 = $_FILES['product_img3']['name'];

                    $temp_img1 = $_FILES['product_img1']['tmp_name'];
                    $temp_img2 = $_FILES['product_img2']['tmp_name'];
                    $temp_img3 = $_FILES['product_img3']['tmp_name'];

                    if (
                        empty($product_title) || empty($product_description) || empty($product_keyword) ||
                        empty($product_category) || empty($product_brands) || empty($product_price) ||
                        empty($product_img1) || empty($product_img2) || empty($product_img3)
                    ) {
                        echo "<script>alert('Please fill all required fields.');</script>";
                        exit();
                    }



                    $update_product = "UPDATE `products` SET product_title='$product_title',
                    product_desc='$product_desc', product_keyword='$product_keyword',
                    category_id='$category_id', brand_id='$brand_id', product_image1='$product_image1',
                    product_image2='$product_image2', product_image3='$product_image3', product_price='$product_price',
                    date=NOW() WHERE product_id=$edit_id";

                    $update_product_result = mysqli_query($conn, $update_product);

                    if ($update_product_result) {  // Fixed this line!
                        echo "<script>alert('Product Updated Successfully!')</script>";
                        echo "<script>window.open('./index.php','_self')</script>";
                    }



                }



                ?>























            </form>
        </div>
    </div>
    <div class="bg-info p-3 text-center">
        <p class="mb-0 text-white">
            &copy; 2025 Hidden Store. All rights reserved. Designed by Nanda
            Bendkoli.
        </p>
        <p>
            Discover a world of elegance and quality, where every product is
            handpicked to elevate your lifestyle.
        </p>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

</body>

</html>