<?php
ob_start();
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
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
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

    .navbar {
      padding: 10px;
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
            <li class="nav-item">
              <a class="nav-link" href="./users_area/user_register.php">Register</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="cart_item.php">
                <i class="fa-solid fa-cart-shopping"></i> <sup> <?php cart_item(); ?></sup>
              </a>
            </li>

          </ul>

        </div>
      </div>
    </nav>

    <?php
    cart();
    ?>
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
    


    <div class="bg-light text-center py-3">
      <h3>Hidden Store</h3>
      <p>Discover a world of elegance and quality.</p>
    </div>

    <div class="container">
      <form action="" method="post">
        <div class="table-responsive">
          <table class="table table-borderd text-center">

            <tbody>
              <?php
              $user_ip = getUserIP();
              $total_price = 0;
              $cart_price_query = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
              $result_cart_price_query = mysqli_query($conn, $cart_price_query);

              $result_count = mysqli_num_rows($result_cart_price_query);
              if ($result_count > 0) {

                echo "<thead>
                        <tr>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Remove</th>
                            <th>Operation</th>
                        </tr>
                    </thead>";

                while ($row = mysqli_fetch_array($result_cart_price_query)) {
                  $product_id = $row['product_id'];
                  $quantity = $row['quantity'];

                  $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
                  $result_select_product_query = mysqli_query($conn, $select_products);
                  $row_product_price = mysqli_fetch_array($result_select_product_query);

                  $product_price = $row_product_price['product_price'];
                  $product_title = $row_product_price['product_title'];
                  $product_image1 = $row_product_price['product_image1'];

                  $subtotal = $product_price * $quantity;
                  $total_price += $subtotal;
                  ?>
                  <tr>
                    <td><?php echo $product_title; ?></td>
                    <td><img src="./images/<?php echo $product_image1; ?>" width="80" alt=""></td>

                    <td>
                      <div class="col-12 col-md-6 mx-auto">
                        <input name="cart_quantity[<?php echo $product_id; ?>]" class="form-control" type="number"
                          value="<?php echo $quantity; ?>">
                      </div>
                    </td>

                    <?php
                    $user_ip = getUserIP();
                    // update logic
                
                    if (isset($_POST['update_cart'])) {
                      foreach ($_POST['cart_quantity'] as $product_id => $cart_quantity) {
                        $update_cart = "UPDATE `cart_details` SET quantity=$cart_quantity WHERE ip_address='$user_ip'
                                         AND product_id=$product_id";
                        $result_cart = mysqli_query($conn, $update_cart);
                      }
                      header("Location: cart_item.php");
                      exit(); // Ensure no further code runs after redirect
                    }

                    // delete logic
                    if (isset($_POST['remove_cart'])) {
                      foreach ($_POST['remove'] as $product_id) {
                        $remove_cart = "DELETE FROM `cart_details` WHERE ip_address='$user_ip' AND product_id=$product_id";
                        $result_remove = mysqli_query($conn, $remove_cart);
                      }
                      header("Location: cart_item.php");
                      exit();
                    }


                    ?>
                    <td><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $product_price; ?>/-</td>
                    <td><input class="form-check-input" type="checkbox" name="remove[]" value="<?php echo $product_id; ?>">
                    </td>

                    <td>
                      <div class="d-flex flex-column flex-md-row">
                        <input type="submit" class="btn-custom btn-update mb-2 mb-md-0 me-md-2" name="update_cart"
                          value="Update Cart">
                        <input type="submit" class="btn-custom btn-remove" name="remove_cart" value="Remove Selected">
                      </div>
                    </td>
                  </tr>
                <?php }
              } else {
                echo "<h2 class='text-center text-danger'>Cart Is Empty!</h2>";

              } ?>
            </tbody>
          </table>
        </div>

        <div class="d-flex flex-column flex-md-row align-items-center mb-5 mt-5">
          <h4 class='px-3 mb-2 mb-md-0'>Subtotal: <strong><i
                class='fa-solid fa-indian-rupee-sign'></i><?php echo $total_price; ?>/-</strong></h4>
          <div class="d-flex">
            <a href='./index.php'
              class='bg-info px-3 py-2 border-0 mx-1 btn-custom text-decoration-none text-white'>Continue Shopping</a>
            <a href='./users_area/chekout.php'
              class='bg-secondary px-3 py-2 border-0 mx-1 btn-custom text-decoration-none text-white'>Check Out</a>
          </div>
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
    <?php
    ob_end_flush();
    ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
</body>

</html>