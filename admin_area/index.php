<?php
include("../includes/connect.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    crossorigin="anonymous" />

  <style>
    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
      }

      .navbar-brand {
        font-size: 1rem;
      }

      .content-container {
        margin-top: 20px;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">Home</a>
      <a class="navbar-brand" href="admin_register.php">Register</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <?php
          if (isset($_SESSION['admin_name'])) {
            echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome " . $_SESSION['admin_name'] . "</a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='admin_logout.php'>Log Out</a></li>";
          } else {
            echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome Guest</a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='admin_login.php'>Login</a></li>";
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container-fluid content-container">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block bg-info sidebar p-3">
        <div class="text-center">
          <?php
          if (isset($_SESSION['admin_name'])) {
            $admin_name = $_SESSION['admin_name'];
            $admin_image_query = "SELECT admin_image FROM `admin_table` WHERE admin_name='$admin_name'";
            $result_image = mysqli_query($conn, $admin_image_query);
            $row_image = mysqli_fetch_assoc($result_image);
            $admin_image = $row_image['admin_image'] ?? 'default.jpg';
            echo "<img class='img-fluid rounded-circle' src='./admin_images/$admin_image' alt='Profile Image' width='100'>";
          }
          ?>
        </div>
        <hr>
        <nav class="nav flex-column ">
          <li class="nav-item"><a href="insert_products.php" class="nav-link text-white"><i class="fas fa-plus"></i>
              Insert Products</a></li>
          <li class="nav-item"><a href="view_products.php" class="nav-link text-white"><i class="fas fa-eye"></i> View
              Products</a></li>
          <li class="nav-item"><a href="index.php?insert_category" class="nav-link text-white"><i
                class="fas fa-layer-group"></i> Insert Categories</a></li>
          <li class="nav-item"><a href="view_categories.php" class="nav-link text-white"><i class="fas fa-list"></i>
              View Categories</a></li>
          <li class="nav-item"><a href="index.php?insert_brand" class="nav-link text-white"><i class="fas fa-tags"></i>
              Insert Brands</a></li>
          <li class="nav-item"><a href="view_brands.php" class="nav-link text-white"><i class="fas fa-eye"></i> View
              Brands</a></li>
          <li class="nav-item"><a href="all_orders.php" class="nav-link text-white"><i class="fas fa-shopping-cart"></i>
              All Orders</a></li>
          <li class="nav-item"><a href="all_payment.php" class="nav-link text-white"><i class="fas fa-credit-card"></i>
              All Payments</a></li>
          <li class="nav-item"><a href="list_user.php" class="nav-link text-white"><i class="fas fa-list-alt"></i> List
              Users</a></li>

          <?php if (isset($_SESSION['admin_name'])): ?>
            <li class="nav-item">
              <a href="admin_logout.php" class="nav-link text-white">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a href="admin_login.php" class="nav-link text-white">
                <i class="fas fa-sign-in-alt"></i> Login
              </a>
            </li>
          <?php endif; ?>
        </nav>
      </nav>

      <!-- Main Content Area -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="pt-3 text-center">
          <h3 class="mb-3">Admin Area</h3>
          <p class="alert alert-info">Welcome to the Admin Dashboard! Manage products, categories, brands, orders, and
            users seamlessly.</p>
        </div>

        <div class="container">
          <?php
          if (isset($_GET['insert_category']))
            include('insert_categories.php');
          if (isset($_GET['insert_brand']))
            include('insert_brands.php');
          if (isset($_GET['delete_products']))
            include('delete_product.php');
          if (isset($_GET['edit_category']))
            include('edit_category.php');
          if (isset($_GET['edit_brand']))
            include('edit_brands.php');
          if (isset($_GET['delete_category']))
            include('delete_category.php');
          if (isset($_GET['delete_brand']))
            include('delete_brand.php');
          if (isset($_GET['delete_order']))
            include('delete_order.php');
          if (isset($_GET['delete_payment']))
            include('delete_payment.php');
          ?>
        </div>
      </main>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-info text-white text-center py-3 mt-4">
    <p class="mb-0">&copy; 2025 Hidden Store. Designed by Nanda Bendkoli.</p>
    <p>Elegance and quality, handpicked for your lifestyle.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
</body>

</html>