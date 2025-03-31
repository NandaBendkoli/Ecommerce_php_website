<?php
include("../includes/connect.php");
include('../includes/function.php');
session_start();

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
        /* Body Styling */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            overflow-x: hidden;
        }

        /* Navbar Brand Logo */
        .logo {
            width: 5%;
            height: 5%;
        }

        /* Card Image Styling */
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }

        /* Sidebar Container */
        .ul-part {
            height: 100vh;
            background: #888f96;
            color: #fff;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }


        .admin_img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 3px solid #fff;
            border-radius: 80%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            margin-bottom: 2px;
            transition: transform 0.3s ease;
        }


        .admin_img:hover {
            transform: scale(1.05);
        }

        .admin-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 5px;
            color: #fff;
        }

        .ul-part .nav-item {
            width: 100%;
            text-align: center;
            padding: 8px 0;
        }

        /* Sidebar Links with Icons */
        .ul-part .nav-link {
            color: #ddd !important;
            transition: 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 1rem;
            font-weight: 500;
            padding: 10px;
            border-radius: 5px;
        }

        /* Font Awesome Icons Size */
        .ul-part .nav-link i {
            font-size: 1.2rem;
        }

        .ul-part .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.1);
            transform: scale(1.05);
            transition: 0.3s ease;
        }

        /* Sidebar Active Link Styling */
        .ul-part .nav-item.bg-info a {
            font-size: 1.2rem;
            font-weight: bold;
        }

        /* Store Header Styling */
        .bg-light.text-center.py-3 h3 {
            font-size: 2rem;
            font-weight: bold;
            color: #00796b;
        }

        /* Footer Styling */
        .bg-info p {
            font-size: 0.9rem;
            line-height: 1.5;
        }



        /* Small Device Adjustments */
        @media (max-width: 768px) {
            .ul-part {
                height: auto;
            }

            .admin_img {
                width: 100px;
                height: 100px;
            }

            .ul-part .nav-link {
                font-size: 0.9rem;
            }

            .bg-light.text-center.py-3 h3 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>



    <!-- Container -->
    <div class="container-fluid p-0">
        <!-- Navbar (First Child) -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info  ">
            <div class="container-fluid">
                <img class="logo" src="../images/logo.png" alt="Logo" />

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="../displayAll.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="../cart_item.php">
                                <i class="fa-solid fa-cart-shopping"></i> <sup> <?php cart_item(); ?></sup>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Total Price: <i
                                    class='fa-solid fa-indian-rupee-sign'></i>
                                <?php total_cart_price(); ?>/-</a>
                        </li>

                    </ul>

                    <form class="d-flex" role="search" action="../search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data" />
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
        <!-- --------------------------------------- -->
        <!-- calling cart function-->
        <?php
        cart();
        ?>

        <!-- -------------------------------- -->
        <!-- Secondary Navbar (Second Child) -->
        <nav class="navbar navbar-expand-lg ">
            <ul class="navbar-nav me-auto">
                <?php

                // Check if user is logged in
                if (isset($_SESSION['username'])) {
                    // Show "Welcome [username]" and Log Out link
                    echo " 
<li class='nav-item'>
<a class='nav-link' href='#' style='color: #00796b; font-weight: bold;'>Welcome " . ($_SESSION['username']) . "</a>
 </li>
<li class='nav-item'>
<a class='nav-link' href='../users_area/user_logout.php' style='color: #00796b; font-weight: bold;'>Log Out</a>
</li>";
                } else {
                    // Show "Welcome Guest" and Login link for guests
                    echo "
<li class='nav-item'>
<a class='nav-link' href='#' style='color: #00796b; font-weight: bold;'>Welcome Guest</a>
</li>
<li class='nav-item'>
<a class='nav-link' href='../users_area/user_login.php' style='color: #00796b; font-weight: bold;'>Login</a>
</li>";

                }
                ?>
            </ul>
        </nav>

        <!------------------------------------------------------------>
        <div class="row">
            <div class="col-md-2 p-0">
                <ul class="navbar-nav bg-secondary text-center ul-part">
                    <li class="nav-item bg-info">
                        <a class="nav-link text-light" href="#">
                            <h4>Your Profile</h4>
                        </a>
                    </li>
                    <!-- 1.image -->
                    <?php

                    // Check if username exists in session
                    if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
 
                        // SQL query to fetch user image
                        $user_image = "SELECT * FROM `user_table` WHERE username='$username'";
                        $result_image = mysqli_query($conn, $user_image);

                        // Check if query returned a result
                        if ($result_image && mysqli_num_rows($result_image) > 0) {
                            $row_image = mysqli_fetch_array($result_image);
                            $user_image = $row_image['user_image'];

                            // Output the profile image
                            echo "<li class='nav-item'>
                                <img class='admin_img ' src='./users_images/$user_image' alt='Profile Image'>
                                </li>";
                        } else {
                            echo "<li class='nav-item'>
                                <img class='admin_img ' src='../images/top6.png' alt='Profile Image'>
                                </li>";
                        }
                    } else {
                        echo "Error: User not logged in.";
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php">
                            <i class="fas fa-box"></i> Pending Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?edit_account">
                            <i class="fas fa-user-edit"></i> Edit Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?my_orders">
                            <i class="fas fa-box"></i> Users Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?delete_account">
                            <i class="fas fa-trash-alt"></i> Delete Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="user_logout.php">
                            <i class="fas fa-sign-out-alt"></i> Log Out
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10">
                <?php get_user_order_details();
                if (isset($_GET['edit_account'])) {
                    include('edit_account.php');

                }

                if (isset($_GET['my_orders'])) {
                    // include('user_orders.php');
                    include('user_orders.php');


                }
                if (isset($_GET['delete_account'])) {
                    // include('user_orders.php');
                    include('delete_account.php');


                }

                ?>

            </div>
        </div>








        <!-- footer  -->
        <!-- Footer (Last Child) -->
        <div class="bg-info p-3 text-center footer">
            <p class="mb-0 text-white">
                &copy; 2025 Hidden Store. All rights reserved. Designed by Nanda
                Bendkoli.
            </p>
            <p>
                Discover a world of elegance and quality, where every product is
                handpicked to elevate your lifestyle.
            </p>
        </div>

    </div> <!-- Closing container-fluid -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>