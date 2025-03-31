<?php
// Fetch user details when editing account
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'] ?? '';

    // SQL query to fetch user data
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_session_name'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_array($result_query);

    // Check if data is fetched successfully
    if ($row_fetch) {
        $user_id = $row_fetch['user_id'] ?? '';
        $user_username = $row_fetch['username'] ?? '';
        $user_email = $row_fetch['user_email'] ?? '';
        $user_password = $row_fetch['user_password'] ?? '';
        $user_ip = $row_fetch['user_ip'] ?? '';
        $user_address = $row_fetch['user_address'] ?? '';
        $user_mobile = $row_fetch['user_mobile'] ?? '';
        $user_image = $row_fetch['user_image'] ?? 'default.jpg'; // Use a default image if none
    } else {
        echo "<script>alert('User not found!'); window.location.href='profile.php';</script>";
        exit();
    }

    // Handle form submission for updating data
    if (isset($_POST['user_update'])) {
        $update_id = $user_id;

        // Get form data
        $username = $_POST['user_username'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_add'];
        $user_mobile = $_POST['user_contact'];

        // Handle image upload
        $new_user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];

        // Only update image if a new one is uploaded
        if (!empty($new_user_image)) {
            move_uploaded_file($user_image_tmp, "./users_images/$new_user_image");
        } else {
            $new_user_image = $user_image; // Keep the old image if no new one is uploaded
        }

        // Update user data in the database
        $update_data = "UPDATE `user_table` SET 
            username='$username',
            user_email='$user_email',
            user_image='$new_user_image',
            user_address='$user_address',
            user_mobile='$user_mobile'
            WHERE user_id=$user_id";

        $result_update_query = mysqli_query($conn, $update_data);

        // Check if update was successful
        if ($result_update_query) {
            echo "<script>
                alert('Data Updated Successfully!');
                window.location.href='user_logout.php';
            </script>";
            exit();
        } else {
            echo "<script>alert('Update failed, please try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>

    <!-- Bootstrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />

    <style>
        /* Profile Image Styling */
        .user-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #00796b;
            margin-right: -117px;
        }

        /* Flex container for input and image */
        .image-upload-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        /* Button Styling */
        input[type="submit"] {
            color: #fff;
            font-weight: bold;
            border-radius: 8px;
            transition: 0.3s ease;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: rgb(3, 0, 207);
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <h3 class="text-center text-success my-3">Edit Account</h3>

    <!-- Form -->
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_username"
                value="<?php echo $user_username; ?>" placeholder="Username">
        </div>

        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_email" value="<?php echo $user_email; ?>"
                placeholder="User Email">
        </div>

        <!-- Image upload with preview -->
        <div class="form-outline mb-4 image-upload-container">
            <input type="file" class="form-control w-50" name="user_image">
            <img src="./users_images/<?php echo $user_image; ?>" alt="Profile Image" class="user-image">
        </div>

        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_add" value="<?php echo $user_address; ?>"
                placeholder="User Address">
        </div>

        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_contact" value="<?php echo $user_mobile; ?>"
                placeholder="User Contact">
        </div>

        <!-- Submit button -->
        <input type="submit" class="py-2 px-3 border-0 bg-info" name="user_update" value="Update">
    </form>

</body>

</html>