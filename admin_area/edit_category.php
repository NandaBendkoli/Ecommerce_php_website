<?php
if (isset($_GET['edit_category'])) {
    $edit_category = $_GET['edit_category'];

    $get_category = "SELECT * FROM `categories` WHERE category_id =$edit_category";
    $result = mysqli_query($conn, $get_category);
    $row = mysqli_fetch_assoc($result);
    $category_title = $row["category_title"];

}
if (isset($_POST['edit_cat'])) {
    $cat_title = $_POST['cat_title'];

    $update_query = "UPDATE `categories` SET category_title='$cat_title' WHERE category_id =$edit_category";
    $result_update = mysqli_query($conn, $update_query);
    if ($result_update) {
        echo "<script>alert('Category Updated Successfully!')</script>";
        echo "<script>window.open('./view_categories.php','_self')</script>";
    }


}


?>


<div class="content m-auto w-50">
    <h2 class="text-center">Edit Category</h2>

    <div class="container mt-4">
        <form action="" method="post" class="p-4 shadow-lg bg-white rounded">
            <div class="mb-3">
                <label for="cat_title" class="form-label fw-bold">Category Name</label>
                <div class="input-group">
                    <span class="input-group-text bg-info text-white">
                        <i class="fa-solid fa-list"></i>
                    </span>
                    <input type="text" class="form-control" name="cat_title" id="cat_title"
                        placeholder="Enter category name" value="<?php echo $category_title ?>" required>
                </div>
            </div>

            <div class="text-center mt-4">
                <input type="submit" class="btn btn-info text-white px-5 py-2 fw-bold" name="edit_cat"
                    value="Update Category">
            </div>
        </form>
    </div>
</div>