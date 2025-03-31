<?php
include("../includes/connect.php");

if (isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title'];

    // Check if brand already exists
    $select_query = "SELECT * FROM `brands` WHERE brand_title='$brand_title'";
    $result_query = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_query);

    if ($number > 0) {
        echo "<script>alert('This Brand is already inserted in the Database');</script>";
    } else {
        // Insert new brand
        $insert_query = "INSERT INTO `brands` (brand_title) VALUES ('$brand_title')";
        $result = mysqli_query($conn, $insert_query);

        if ($result) {
            echo "<script>alert('Brand has been inserted successfully');</script>";
        } else {
            echo "<script>alert('Error inserting Brand');</script>";
        }
    }
}
?>

<div class="container my-5">
    <div class="col-md-6 mx-auto">
        <h3 class="text-center mb-4">Insert New Brand</h3>

        <div class="p-4 shadow-lg bg-white rounded">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="brand_title" class="form-label fw-bold">Brand Name</label>
                    <div class="input-group">
                        <span class="input-group-text bg-info text-white">
                            <i class="fas fa-tags"></i>
                        </span>
                        <input type="text" class="form-control" name="brand_title" id="brand_title"
                            placeholder="Enter brand name" required>
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <input type="submit" class="btn btn-info text-white fw-bold py-2" name="insert_brand"
                        value="Insert Brand">
                </div>
            </form>
        </div>
    </div>
</div>