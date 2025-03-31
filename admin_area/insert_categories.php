<?php
include("../includes/connect.php");

if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];

    // Check if category already exists
    $select_query = "SELECT * FROM `categories` WHERE category_title='$category_title'";
    $result_query = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_query);

    if ($number > 0) {
        echo "<script>alert('This Category is already inserted in the Database');</script>";
    } else {
        // Insert new category
        $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
        $result = mysqli_query($conn, $insert_query);

        if ($result) {
            echo "<script>alert('Category has been inserted successfully');</script>";
        } else {
            echo "<script>alert('Error inserting category');</script>";
        }
    }
}
?>

<div class="container my-5">
    <div class="col-md-6 mx-auto">
        <h2 class="text-center mb-4">Insert New Category</h2>

        <div class="p-4 shadow-lg bg-white rounded">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="cat_title" class="form-label fw-bold">Category Name</label>
                    <div class="input-group">
                        <span class="input-group-text bg-info text-white">
                            <i class="fa-solid fa-list"></i>
                        </span>
                        <input type="text" class="form-control" name="cat_title" id="cat_title"
                            placeholder="Enter category name" required>
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <input type="submit" class="btn btn-info text-white fw-bold py-2" name="insert_cat"
                        value="Insert Category">
                </div>
            </form>
        </div>
    </div>
</div>