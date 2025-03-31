<?php
include("../includes/connect.php");
include("../includes/function.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Register</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" />

    <style>
        body {
            overflow-x: hidden;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            background-color: #17a2b8;
        }

        .navbar a {
            color: white;
            font-weight: bold;
        }

        .footer {
            background-color: #17a2b8;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0 ">
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"> Home</a>
            </div>
        </nav>

        <div class="content">
            <div class="text-center mt-3 mb-4">
                <h3 class="d-inline-block p-2 px-4 rounded">
                    Admin Registration
                </h3>
            </div>
            <div class="container mt-3">
                <form action="" method="post" enctype="multipart/form-data" class="p-4 shadow-lg bg-white rounded">
                    <div class="mb-3">
                        <label for="admin_name" class="form-label fw-bold">Admin Name</label>
                        <input type="text" name="admin_name" id="admin_name" class="form-control"
                            placeholder="Enter Admin Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_email" class="form-label fw-bold">Email</label>
                        <input type="email" name="admin_email" id="admin_email" class="form-control"
                            placeholder="Enter Admin Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_image" class="form-label fw-bold">Admin Image</label>
                        <input type="file" name="admin_image" id="admin_image" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_pass" class="form-label fw-bold">Password</label>
                        <input type="password" name="admin_pass" id="admin_pass" class="form-control"
                            placeholder="Enter Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_contact" class="form-label fw-bold">Contact</label>
                        <input type="tel" name="admin_contact" id="admin_contact" class="form-control"
                            placeholder="Enter Mobile Number" pattern="[0-9]{10}" maxlength="10" required>
                    </div>

                    <div class="text-center mt-4">
                        <input type="submit" name="admin_register" class="btn btn-info text-white px-5 py-2 fw-bold"
                            value="Register">
                        <p class="mt-3 fw-semibold text-muted">Already have an account? <a href="admin_login.php"
                                class="text-info fw-bold text-decoration-none">Login</a></p>
                    </div>




                </form>
            </div>
        </div>

        <div class="p-3 text-center footer">
            <p class="mb-0 text-white">&copy; 2025 Hidden Store. All rights reserved. Designed by Nanda Bendkoli.</p>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>


        <!-- php code -->

        <?php


        if (isset($_POST['admin_register'])) {
            $admin_name = $_POST['admin_name'];
            $admin_email = $_POST['admin_email'];
            $admin_password = $_POST['admin_pass']; // Fixed name mismatch
            $hash_password = password_hash($admin_password, PASSWORD_DEFAULT); // Fixed incorrect variable
            $admin_contact = $_POST['admin_contact'];
            $admin_image = $_FILES['admin_image']['name'];
            $tmp_admin_image = $_FILES['admin_image']['tmp_name'];

            $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name' OR admin_email='$admin_email'";
            $result = mysqli_query($conn, $select_query);
            $rows_count = mysqli_num_rows($result);

            if ($rows_count > 0) {
                echo "<script>alert('UserName or Email already exists!');</script>";
            } else {
                // Move uploaded image
                move_uploaded_file($tmp_admin_image, "./admin_images/$admin_image"); // Fixed incorrect variable
        
                $insert_userReg_query = "INSERT INTO `admin_table` 
        (admin_name, admin_email, admin_password, admin_image, admin_contact) 
        VALUES ('$admin_name', '$admin_email', '$hash_password', '$admin_image','$admin_contact')";

                $result_query = mysqli_query($conn, $insert_userReg_query);

                if ($result_query) {
                    echo "<script>alert('Data inserted successfully');</script>";
                } else {
                    die(mysqli_error($conn));
                }
            }
        }
        ?>


</html>