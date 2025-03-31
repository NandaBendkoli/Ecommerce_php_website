<?php
include("../includes/connect.php");

if (isset($_POST['insert_product'])) {
    // Database connection check
    if (!$conn) {
        die("<script>alert('Database connection failed');</script>");
    }

    // Accessing form variables and sanitizing inputs
    $product_title = mysqli_real_escape_string($conn, trim($_POST['product_title']));
    $product_description = mysqli_real_escape_string($conn, trim($_POST['product_desc']));
    $product_keyword = mysqli_real_escape_string($conn, trim($_POST['product_keyword']));
    $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
    $product_brands = mysqli_real_escape_string($conn, $_POST['product_brands']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_status = "true";

    // Accessing image names
    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_img3 = $_FILES['product_img3']['name'];

    // Accessing temporary image names
    $temp_img1 = $_FILES['product_img1']['tmp_name'];
    $temp_img2 = $_FILES['product_img2']['tmp_name'];
    $temp_img3 = $_FILES['product_img3']['tmp_name'];

    // Check if any field is empty
    if (
        empty($product_title) || empty($product_description) || empty($product_keyword) ||
        empty($product_category) || empty($product_brands) || empty($product_price) ||
        empty($product_img1) || empty($product_img2) || empty($product_img3)
    ) {
        echo "<script>alert('Please fill all required fields.');</script>";
    } else {
        // Define image directory
        $target_dir = "./product_images/";

        // Ensure directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move uploaded files
        if (
            move_uploaded_file($temp_img1, $target_dir . $product_img1) &&
            move_uploaded_file($temp_img2, $target_dir . $product_img2) &&
            move_uploaded_file($temp_img3, $target_dir . $product_img3)
        ) {
            // Insert product into database
            $insert_product = "INSERT INTO `products` 
                (product_title, product_desc, product_keyword, category_id, brand_id, product_image1, product_image2, product_image3, product_price, date, status) 
                VALUES 
                ('$product_title', '$product_description', '$product_keyword', '$product_category', '$product_brands', '$product_img1', '$product_img2', '$product_img3', '$product_price', NOW(), '$product_status')";

            $result_query = mysqli_query($conn, $insert_product);

            if ($result_query) {
                echo "<script>alert('Product successfully inserted!');</script>";
            } else {
                echo "<script>alert('Error inserting product: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Error uploading images. Please check file permissions.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" />
    <style>
        .navbar a {
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="content">
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"> Home</a>
            </div>
        </nav>

        <div class="container">
            <h3 class="text-center pt-4">Insert New Product</h3>

            <form action="" method="post" enctype="multipart/form-data" class="p-4 shadow-lg bg-white rounded">
                <div class="mb-3">
                    <label for="product_title" class="form-label fw-bold">Product Title</label>
                    <input type="text" name="product_title" id="product_title" class="form-control"
                        placeholder="Enter product title">
                </div>

                <div class="mb-3">
                    <label for="product_desc" class="form-label fw-bold">Product Description</label>
                    <input type="text" name="product_desc" id="product_desc" class="form-control"
                        placeholder="Enter product description">
                </div>

                <div class="mb-3">
                    <label for="product_keyword" class="form-label fw-bold">Product Keywords</label>
                    <input type="text" name="product_keyword" id="product_keyword" class="form-control"
                        placeholder="Enter product keywords">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Select a Category</label>
                    <select name="product_category" class="form-select">
                        <option value="">Select a Category</option>
                        <?php
                        $select_category = "SELECT * FROM `categories`";
                        $result_query = mysqli_query($conn, $select_category);
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            echo "<option value='{$row['category_id']}'>{$row['category_title']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Select a Brand</label>
                    <select name="product_brands" class="form-select">
                        <option value="">Select a Brand</option>
                        <?php
                        $select_brand = "SELECT * FROM `brands`";
                        $result_query = mysqli_query($conn, $select_brand);
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            echo "<option value='{$row['brand_id']}'>{$row['brand_title']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="product_img1" class="form-label fw-bold">Product Image 1</label>
                        <input type="file" name="product_img1" id="product_img1" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="product_img2" class="form-label fw-bold">Product Image 2</label>
                        <input type="file" name="product_img2" id="product_img2" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="product_img3" class="form-label fw-bold">Product Image 3</label>
                        <input type="file" name="product_img3" id="product_img3" class="form-control">
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="product_price" class="form-label fw-bold">Product Price</label>
                    <input type="text" name="product_price" id="product_price" class="form-control"
                        placeholder="Enter product price">
                </div>

                <div class="text-center mt-4">
                    <input type="submit" name="insert_product" class="btn btn-info text-white px-5 py-2 fw-bold"
                        value="Insert Product">
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

</body>

</html>