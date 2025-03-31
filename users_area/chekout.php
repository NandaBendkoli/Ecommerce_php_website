<?php
include("../includes/connect.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Commerce Checkout Page</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    crossorigin="anonymous" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .logo {
      max-width: 100%;
      height: auto;

    }

    .card-img-top {
      width: 100%;
      height: 200px;
      object-fit: contain;
    }

    .table {
      background-color: #ffffff;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .table th,
    .table td {
      padding: 12px;
      vertical-align: middle;
    }

    .btn-custom {
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      transition: 0.3s;
    }

    .btn-update {
      background-color: #28a745;
      color: white;
    }

    .btn-remove {
      background-color: #dc3545;
      color: white;
    }

    .btn-custom:hover {
      opacity: 0.8;
    }
  </style>
</head>

<body>
  <!-- Container -->
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
        <img class="logo" src="../images/logo.png" alt="Logo" />
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../displayAll.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../users_area/user_register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="bg-light text-center py-3">
      <h3>Hidden Store</h3>
      <p>Discover a world of elegance and quality.</p>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Check if user is logged in -->
          <?php
          if (!isset($_SESSION['username'])) {
            include('user_login.php');
          } else {
            include('payment.php');
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-info p-3 text-center">
    <p class="mb-0 text-white">
      &copy; 2025 Hidden Store. All rights reserved. Designed by Nanda Bendkoli.
    </p>
    <p>
      Discover a world of elegance and quality, where every product is handpicked to elevate your lifestyle.
    </p>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  crossorigin="anonymous"></script>
</body>

</html>