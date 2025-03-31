<?php
// Include the database connection
include('connect.php');

// Function to fetch and display random products (Limited to 6)
function getProducts()
{
    global $conn;

    if (!isset($_GET['category']) && !isset($_GET['brand'])) {
        $select_product_query = "SELECT * FROM `products` ORDER BY RAND() LIMIT 9";
        $result_product_query = mysqli_query($conn, $select_product_query);

        while ($row = mysqli_fetch_assoc($result_product_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_desc'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];

            echo "
            <div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./images/$product_image1' class='card-img-top' alt='$product_title' />
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <p class='card-text'><i class='fa-solid fa-indian-rupee-sign'></i> $product_price</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                    </div>
                </div> 
            </div>
            ";
        }
    }
}

// Function to fetch and display all products
function get_All_Products()
{
    global $conn;

    if (!isset($_GET['category']) && !isset($_GET['brand'])) {
        $select_product_query = "SELECT * FROM `products` ORDER BY RAND()";
        $result_product_query = mysqli_query($conn, $select_product_query);

        while ($row = mysqli_fetch_assoc($result_product_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_desc'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];

            echo "
            <div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./images/$product_image1' class='card-img-top' alt='$product_title' />
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <p class='card-text'><i class='fa-solid fa-indian-rupee-sign'></i> $product_price</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                    </div>
                </div>
            </div>
            ";
        }
    }
}

// Function to fetch products by category
function get_unique_Category()
{
    global $conn;

    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];

        $select_product_query = "SELECT * FROM `products` WHERE category_id=$category_id";
        $result_product_query = mysqli_query($conn, $select_product_query);
        $number_of_rows = mysqli_num_rows($result_product_query);

        if ($number_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>NO STOCK FOR THIS CATEGORY!</h2>";
        }

        while ($row = mysqli_fetch_assoc($result_product_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_desc'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];

            echo "
            <div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./images/$product_image1' class='card-img-top' alt='$product_title' />
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <p class='card-text'><i class='fa-solid fa-indian-rupee-sign'></i> $product_price</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                    </div>
                </div>
            </div>
            ";
        }
    }
}

// Function to fetch products by brand
function get_unique_Brand()
{
    global $conn;

    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];

        $select_product_query = "SELECT * FROM `products` WHERE brand_id=$brand_id";
        $result_product_query = mysqli_query($conn, $select_product_query);
        $number_of_rows = mysqli_num_rows($result_product_query);

        if ($number_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>NO STOCK FOR THIS BRAND!</h2>";
        }

        while ($row = mysqli_fetch_assoc($result_product_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_desc'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];

            echo "
            <div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./images/$product_image1' class='card-img-top' alt='$product_title' />
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <p class='card-text'><i class='fa-solid fa-indian-rupee-sign'></i> $product_price</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                    </div>
                </div>
            </div>
            ";
        }
    }
}

// product_details.php

function view_details()
{
    global $conn;

    if (!isset($_GET['category']) && !isset($_GET['brand'])) {
        if (isset($_GET['product_id'])) {

            $product_id = $_GET['product_id'];

            // Fetch specific product details
            $select_product_query = "SELECT * FROM `products` WHERE product_id = $product_id";
            $result_product_query = mysqli_query($conn, $select_product_query);

            while ($row = mysqli_fetch_assoc($result_product_query)) {
                $product_title = $row['product_title'];
                $product_description = $row['product_desc'];
                $product_image1 = $row['product_image1'];
                $product_image2 = $row['product_image2'];
                $product_image3 = $row['product_image3'];
                $product_price = $row['product_price'];

                echo "
              <div class='col-md-4 mb-2'>
                  <div class='card'>
                      <img src='./images/$product_image1' class='card-img-top' alt='$product_title' />
                      <div class='card-body'>
                          <h5 class='card-title'>$product_title</h5>
                          <p class='card-text'>$product_description</p>
                          <p class='card-text'><i class='fa-solid fa-indian-rupee-sign'></i> $product_price</p>
                          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
                          <a href='index.php' class='btn btn-secondary'>Go Home</a>
                      </div>
                  </div> 
              </div>
               <div class='col-md-8'>
             
               <div class='row'>
                <div class='col-md-12'>
                   <h4 class='text-center text-light bg-info'>Related Products</h4>
                </div>
                <div class='col-md-6'>
               <div class='card'>
                      <img src='./images/$product_image2' class='card-img-top' alt='$product_title' />
                      <div class='card-body'>
                          <h5 class='card-title'>$product_title</h5>
                          <p class='card-text'>$product_description</p>
                          <p class='card-text'><i class='fa-solid fa-indian-rupee-sign'></i> $product_price</p>
                          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
                          <a href='index.php' class='btn btn-secondary'>Go Home</a>
                      </div>
                  </div>

                </div>
                <div class='col-md-6'>
                <div class='card'>
                      <img src='./images/$product_image3' class='card-img-top' alt='$product_title' />
                      <div class='card-body'>
                          <h5 class='card-title'>$product_title</h5>
                          <p class='card-text'>$product_description</p>
                          <p class='card-text'><i class='fa-solid fa-indian-rupee-sign'></i> $product_price</p>
                          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
                          <a href='index.php' class='btn btn-secondary'>Go Home</a>
                      </div>
                  </div>
                    
                </div>
               </div>
            </div>
              ";
            }
        }
    }
}



// Function to fetch and display brands
function getBrands()
{
    global $conn;
    $select_brands = "SELECT * FROM `brands`";
    $result_brand = mysqli_query($conn, $select_brands);

    while ($row_data = mysqli_fetch_assoc($result_brand)) {
        $brand_title = $row_data['brand_title'];
        $brand_id = $row_data['brand_id'];

        echo "<li class='nav-item'><a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a></li>";
    }
}

// Function to fetch and display categories
function getCategories()
{
    global $conn;
    $select_category = "SELECT * FROM `categories`";
    $result_category = mysqli_query($conn, $select_category);

    while ($row_data = mysqli_fetch_assoc($result_category)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];

        echo "<li class='nav-item'><a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a></li>";
    }
}


// function search_product
function search_product()
{
    global $conn;
    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "SELECT * FROM `products` WHERE product_keyword LIKE '%$search_data_value%' OR product_title LIKE '%$search_data_value%'";
        $result_search_query = mysqli_query($conn, $search_query);
        $num_of_rows = mysqli_num_rows($result_search_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No Result Match. No Products found on this category!</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_search_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_desc'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];

            echo "
            <div class='col-md-4 mb-2'>
                <div class='card'>
                    <img src='./images/$product_image1' class='card-img-top' alt='$product_title' />
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <p class='card-text'><i class='fa-solid fa-indian-rupee-sign'></i> $product_price</p>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add To Cart</a>
                        <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
                    </div>
                </div>
            </div>
            ";
        }

    }
}




// get ip  add function

function getUserIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP from shared internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP passed from a proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Default IP address
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// $user_ip = getUserIP();
// echo "User IP Address: " . $user_ip;


// cart function
function cart()
{

    if (isset($_GET['add_to_cart'])) {
        global $conn;
        $user_ip = getUserIP();
        $get_product_id = $_GET['add_to_cart'];
        $select_cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip' AND product_id=$get_product_id";

        $result_cart_query = mysqli_query($conn, $select_cart_query);
        $number_of_rows = mysqli_num_rows($result_cart_query);
        if ($number_of_rows > 0) {
            echo "<script>alert('This item is already present in the cart');</script>";
            echo "<script>window.open('index.php','_self');</script>";
        } else {
            $insert_cart_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) 
                                  VALUES($get_product_id, '$user_ip', 0)";
            $insert_result = mysqli_query($conn, $insert_cart_query);

            if (!$insert_result) {
                die("Insert Query Failed: " . mysqli_error($conn));
            }

            echo "<script>alert('Item is inserted in the cart');</script>";
            echo "<script>window.open('index.php','_self');</script>";
        }
    }


}

// function to get cart item numbers

function cart_item()
{

    if (isset($_GET['add_to_cart'])) {
        global $conn;
        $user_ip = getUserIP();
        $select_cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
        $result_cart_query = mysqli_query($conn, $select_cart_query);
        $count_num_rows = mysqli_num_rows($result_cart_query);
    } else {
        global $conn;
        $user_ip = getUserIP();
        $select_cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
        $result_cart_query = mysqli_query($conn, $select_cart_query);
        $count_num_rows = mysqli_num_rows($result_cart_query);
    }
    echo $count_num_rows;
}

// total price function

function total_cart_price()
{
    global $conn;
    $user_ip = getUserIP();
    $total_price = 0;

    $cart_price_query = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $result_cart_price_query = mysqli_query($conn, $cart_price_query);

    while ($row = mysqli_fetch_array($result_cart_price_query)) {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
        $result_select_product_query = mysqli_query($conn, $select_products);

        while ($row_product_price = mysqli_fetch_array($result_select_product_query)) {
            $product_value = $row_product_price['product_price'];
            $total_price += $product_value;
        }
    }
    echo $total_price;
}

// get user orders detailed
function get_user_order_details()
{
    global $conn;

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        echo "User not logged in.";
        return;
    }

    $username = $_SESSION['username'];

    // Correct SQL query with quotes
    $get_details = "SELECT * FROM `user_table` WHERE username='$username'";
    $result_details = mysqli_query($conn, $get_details);

    while ($row_query = mysqli_fetch_array($result_details)) {
        $user_id = $row_query["user_id"];

        // Check if no other GET parameters are present
        if (!isset($_GET['edit_account']) && !isset($_GET['my_orders']) && !isset($_GET['delete_account'])) {

            $get_orders = "SELECT * FROM `users_orders` WHERE user_id=$user_id AND order_status='pending'";
            $result_orders = mysqli_query($conn, $get_orders);
            $row_count = mysqli_num_rows($result_orders);

            // Output pending orders if any
            if ($row_count > 0) {
                echo "
                <div class='order-status-container text-center my-5 p-4 border border-success rounded shadow-lg bg-light'>
                    <h3 class='text-success fw-bold mb-3'>
                        You Have <span class='text-danger fw-bolder fs-4'>$row_count</span> Pending Orders
                    </h3>
                    <p class='text-muted mb-2 fs-6'>Don’t keep your cravings waiting — check your orders now!</p>
                    <a href='profile.php?my_orders' class='btn btn-dark btn-sm fw-semibold px-4 py-2'>View Order Details</a>
                </div>";
            } else {
                echo "
                <div class='order-status-container text-center my-5 p-4 border border-success rounded shadow-lg bg-light'>
                    <h3 class='text-success fw-bold mb-3'>
                        You Have Zero Pending Orders.
                    </h3> 
                    <a href='../index.php' class='btn btn-dark btn-sm fw-semibold px-4 py-2'>Explore Products</a>
                </div>";
            }


        }
    }
}

?>