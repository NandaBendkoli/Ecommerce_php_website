<?php
include("../includes/connect.php");
include("../includes/function.php");

@session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Commerce Website</title>

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

        .logo {
            width: 5%;
            height: 5%;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }

        .navbar {
            margin-bottom: 20px;
            /* Adds space below navbar */
            z-index: 10;
            /* Ensures navbar stays on top */
        }

        .content h3 {
            margin-top: 20px;
            /* Pushes heading down */
            padding: 10px;
            /* Adds some padding around the heading */
        }
    </style>
</head>

<body>
    <!-- Container -->
    <div class="container-fluid p-0 ">
        <div class="content">
            <div class="text-center mt-3 mb-4">
                <h3 class="d-inline-block p-2 px-4 rounded">
                    Admin Login
                </h3>
            </div>

            <div class="container mt-3">
                <form action="" method="post" class="p-4 shadow-lg bg-white rounded">
                    <!-- User Name -->
                    <div class="mb-3">
                        <label for="admin_name" class="form-label fw-bold">Admin Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white"><i class="fas fa-user"></i></span>
                            <input type="text" name="admin_name" id="admin_name" class="form-control"
                                placeholder="Enter Your Name" required>
                        </div>
                    </div>


                    <!-- Password -->
                    <div class="mb-3">
                        <label for="admin_password" class="form-label fw-bold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white"><i class="fas fa-lock"></i></span>
                            <input type="password" name="admin_password" id="admin_password" class="form-control"
                                placeholder="Enter Your Password" required>
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <input type="submit" name="admin_login" class="btn btn-info text-white px-5 py-2 fw-bold"
                            value="Login">
                        <p class="mt-3 fw-semibold text-muted">Don't have an account? <a href="admin_register.php"
                                class="text-info fw-bold text-decoration-none">Register</a></p>

                    </div>
                </form>
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

        </div>
        <!-- footer  -->
        <!-- Footer (Last Child) -->


        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <!-- php code -->

        <?php


        if (isset($_POST['admin_login'])) {
            $admin_name = $_POST['admin_name'];
            $admin_password = $_POST['admin_password'];

            // Query to check if admin exists
            $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name'";
            $select_result = mysqli_query($conn, $select_query);

            if (!$select_result) {
                die("Query Failed: " . mysqli_error($conn));
            }

            $row_count = mysqli_num_rows($select_result);
            $row_data = mysqli_fetch_assoc($select_result);

            if ($row_count > 0) {
                // Verify hashed password
                if (password_verify($admin_password, $row_data['admin_password'])) {
                    $_SESSION['admin_name'] = $admin_name;
                    echo "<script>alert('Login Successful!');</script>";
                    echo "<script>window.location.href='index.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Invalid Password!');</script>";
                }
            } else {
                echo "<script>alert('Admin Not Found!');</script>";
            }
        }
        ?>




</body>

</html>