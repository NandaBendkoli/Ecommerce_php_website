<?php
if (isset($_GET['edit_brand'])) {
    $edit_brand = $_GET['edit_brand'];

    $get_brand = "SELECT * FROM `brands` WHERE brand_id = $edit_brand";
    $result = mysqli_query($conn, $get_brand);
    $row = mysqli_fetch_assoc($result);
    $brand_title = $row["brand_title"];
}

if (isset($_POST['edit_brand'])) {
    $brand_title = $_POST['brand_title'];

    $update_query = "UPDATE `brands` SET brand_title='$brand_title' WHERE brand_id = $edit_brand";
    $result_update = mysqli_query($conn, $update_query);
    if ($result_update) {
        echo "<script>alert('Brand Updated Successfully!')</script>";
        echo "<script>window.open('./view_brands.php', '_self')</script>";
    }
}
?>

<div class="content m-auto w-50">
    <h2 class="text-center">Edit Brand</h2>

    <div class="container mt-4">
        <form action="" method="post" class="p-4 shadow-lg bg-white rounded">
            <div class="mb-3">
                <label for="brand_title" class="form-label fw-bold">Brand Name</label>
                <div class="input-group">
                    <span class="input-group-text bg-info text-white">
                        <i class="fa-solid fa-list"></i>
                    </span>
                    <input type="text" class="form-control" name="brand_title" id="brand_title"
                        placeholder="Enter brand name" value="<?php echo $brand_title ?>" required>
                </div>
            </div>

            <div class="text-center mt-4">
                <input type="submit" class="btn btn-info text-white px-5 py-2 fw-bold" name="edit_brand"
                    value="Update Brand">
            </div>
        </form>
    </div>
</div>