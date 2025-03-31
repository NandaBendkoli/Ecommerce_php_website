<?php
include("./includes/connect.php");
include('./includes/function.php');
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


    @media (max-width: 768px) {
      .logo {
        width: 15%;

      }
    }

    @media (max-width: 480px) {
      .logo {
        width: 20%;

      }
    }


    .card-img-top {
      width: 100%;
      height: 200px;
      object-fit: contain;
    }
  </style>
</head>

<body>



  <!-- Container -->
  <div class="container-fluid p-0">
    <!-- Navbar (First Child) -->

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
        <img class="logo" src="./images/logo.png" alt="Logo" />
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="displayAll.php">Products</a>
            </li>
            <?php
            if (isset($_SESSION['username'])) {
              echo "<li class='nav-item'>
                  <a class='nav-link' href='./users_area/profile.php'>My Account</a>
                </li>";
            } else {
              echo "<li class='nav-item'>
                  <a class='nav-link' href='./users_area/user_register.php'>Register</a>
                </li>";
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="cart_item.php">
                <i class="fa-solid fa-cart-shopping"></i> <sup><?php cart_item(); ?></sup>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Total Price: <i class='fa-solid fa-indian-rupee-sign'></i>
                <?php total_cart_price(); ?>/-</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin_area/index.php">Admin Area</a>
            </li>
          </ul>
          <form class="d-flex" role="search" action="search_product.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
              name="search_data" />
            <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
          </form>
        </div>
      </div>
    </nav>

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
<a class='nav-link' href='./users_area/user_logout.php' style='color: #00796b; font-weight: bold;'>Log Out</a>
</li>";
        } else {
          // Show "Welcome Guest" and Login link for guests
          echo "
<li class='nav-item'>
<a class='nav-link' href='#' style='color: #00796b; font-weight: bold;'>Welcome Guest</a>
</li>
<li class='nav-item'>
<a class='nav-link' href='./users_area/user_login.php' style='color: #00796b; font-weight: bold;'>Login</a>
</li>";

        }
        ?>
      </ul>
    </nav>



    <!-- Store Header (Third Child) -->
    <div class="bg-light text-center py-3">
      <h3>Hidden Store</h3>
      <p>Discover a world of elegance and quality.</p>
    </div>

    <!-- -------------------------------------------------------- -->

    <!-- Fourth Child (Products and Sidebar) -->
    <div class="row">
      <div class="col-md-10 mt-3">
        <div class="row">
          <!-- fetching products -->
          <?php
          //  calling getProducts function
          getProducts();
          get_unique_Category();
          get_unique_Brand();


          ?>
        </div> <!-- Closing col-md-10 -->
      </div>

      <!-- Sidebar (Brands and Categories) -->
      <div class="col-md-2 bg-secondary p-0">
        <!-- brands -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light">
              <h4>Delivery Brands</h4>
            </a>
          </li>
          <?php
          //  get brands
          getBrands();


          ?>
        </ul>

        <!-- category -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light">
              <h4>Categories</h4>
            </a>
          </li>
          <?php
          getCategories();
          ?>
        </ul>
      </div> <!-- Closing col-md-2 -->
    </div> <!-- Closing row -->

    <!-- footer  -->
    <!-- Footer (Last Child) -->
    <div class="bg-info p-3 text-center">
      <div class="container">
        <p class="mb-0 text-white">
          &copy; 2025 Hidden Store. All rights reserved. Designed by Nanda Bendkoli.
        </p>
        <p>
          Discover a world of elegance and quality, where every product is handpicked to elevate your lifestyle.
        </p>
      </div>
    </div>

  </div> <!-- Closing container-fluid -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
</body>

</html>