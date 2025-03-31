<?php
include("../includes/connect.php");
include("../includes/function.php");

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

    .navbar {
      margin-bottom: 20px;

      z-index: 10;

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
    <!-- Navbar (First Child) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info ">
      <div class="container-fluid">
        <a href="../index.php"> <img class="logo" src="../images/logo.png" alt="Logo" /></a>
    </nav>
    <!------------->
    <div class="content">
      <div class="text-center mt-3 mb-4">
        <h3 class="d-inline-block p-2 px-4 rounded">
          User Registration
        </h3>
      </div>
      <div class="container mt-3">
        <form action="" method="post" enctype="multipart/form-data" class="p-4 shadow-lg bg-white rounded">
          <!-- User Name -->
          <div class="mb-3">
            <label for="user_name" class="form-label fw-bold">Username</label>
            <div class="input-group">
              <span class="input-group-text bg-info text-white"><i class="fas fa-user"></i></span>
              <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name"
                required>
            </div>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="user_email" class="form-label fw-bold">Email</label>
            <div class="input-group">
              <span class="input-group-text bg-info text-white"><i class="fas fa-envelope"></i></span>
              <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter Your Email"
                required>
            </div>
          </div>

          <!-- User Image -->
          <div class="mb-3">
            <label for="user_image" class="form-label fw-bold">User Image</label>
            <input type="file" name="user_image" id="user_image" class="form-control" required>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label for="user_pass" class="form-label fw-bold">Password</label>
            <div class="input-group">
              <span class="input-group-text bg-info text-white"><i class="fas fa-lock"></i></span>
              <input type="password" name="user_pass" id="user_pass" class="form-control"
                placeholder="Enter Your Password" required>
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="mb-3">
            <label for="confirm_pass" class="form-label fw-bold">Confirm Password</label>
            <div class="input-group">
              <span class="input-group-text bg-info text-white"><i class="fas fa-lock"></i></span>
              <input type="password" name="confirm_pass" id="confirm_pass" class="form-control"
                placeholder="Confirm Password" required>
            </div>
          </div>

          <!-- Address -->
          <div class="mb-3">
            <label for="user_add" class="form-label fw-bold">Address</label>
            <div class="input-group">
              <span class="input-group-text bg-info text-white"><i class="fas fa-map-marker-alt"></i></span>
              <input type="text" name="user_add" id="user_add" class="form-control" placeholder="Enter Your Address"
                required>
            </div>
          </div>
          <!-- ---contact -->
          <!-- Contact Field -->
          <div class="mb-3">
            <label for="user_contact" class="form-label fw-bold">Contact</label>
            <div class="input-group">
              <span class="input-group-text bg-info text-white"><i class="fas fa-phone-alt"></i></span>
              <input type="tel" name="user_contact" id="user_contact" class="form-control"
                placeholder="Enter Your Mobile Number" pattern="[0-9]{10}" maxlength="10" required>
            </div>
          </div>
          <!-- Submit Button -->
          <div class="text-center mt-4">
            <input type="submit" name="user_register" class="btn btn-info text-white px-5 py-2 fw-bold"
              value="Register">
            <p class="mt-3 fw-semibold text-muted">Already have an account? <a href="user_login.php"
                class="text-info fw-bold text-decoration-none">Login</a></p>

          </div>
        </form>
      </div>

    </div>
    <!-- footer  -->
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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"></script>

    <!-- php code -->

    <?php

    // -------------------
    if (isset($_POST['user_register'])) {


      $user_username = $_POST['user_name'];
      $user_user_email = $_POST['user_email'];
      $user_password = $_POST['user_pass'];
      $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
      $user_confirm_password = $_POST['confirm_pass'];
      $user_add = $_POST['user_add'];
      $user_user_contact = $_POST['user_contact'];
      $user_user_image = $_FILES['user_image']['name'];
      $tmp_user_image = $_FILES['user_image']['tmp_name'];
      $user_ip = getUserIP();

      $select_query = "SELECT * FROM  `user_table` WHERE  username='$user_username' or user_email='$user_user_email'";
      $result = mysqli_query($conn, $select_query);
      $rows_count = mysqli_num_rows($result);
      if ($rows_count > 0) {
        $row = mysqli_fetch_array($result);
        echo "<script>alert('UserName and Email is Allready Exist!');</script>";

      } else {
        // Move uploaded image
        move_uploaded_file($tmp_user_image, "./users_images/$user_user_image");

        $insert_userReg_query = "INSERT INTO `user_table` 
            (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) 
            VALUES ('$user_username', '$user_user_email', '$hash_password', '$user_user_image', '$user_ip', '$user_add', '$user_user_contact')";

        $result_query = mysqli_query($conn, $insert_userReg_query);

        if ($result_query) {
          echo "<script>alert('Data is inserted');</script>";
        } else {
          die(mysqli_error($conn));
        }
      }

    }
    ?>
</body>

</html>