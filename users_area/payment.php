<?php
include("../includes/connect.php");
include("../includes/function.php");



// Get user IP
$user_ip = getUserIP();

// Fetch user data from database
$get_user = "SELECT * FROM `user_table` WHERE user_ip='$user_ip'";
$result = mysqli_query($conn, $get_user);

if ($result && mysqli_num_rows($result) > 0) {
    $run_query = mysqli_fetch_array($result);
    $user_id = $run_query['user_id'];
} else {
    $user_id = "Guest"; // Fallback if no user found
}
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
            z-index: 10;
        }

        .content h3 {
            margin-top: 20px;
            padding: 10px;
        }

        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
            text-align: center;
        }

        h2 {
            color: #00796b;
            font-weight: bold;
        }

        .row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
 
        .payment-option {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        img {
            width: 100%;
            max-width: 300px;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        img:hover {
            transform: scale(1.05);
        }

        a {
            display: block;
            font-size: 1.2rem;
            color: #00796b;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        a:hover {
            color: #004d40;
        }

        .qr-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .qr-container img {
            width: 350px;
            height: 350px;
            border-radius: 10px;
        }

        .qr-container span {
            font-size: 1.4rem;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Payment Option</h2>
        <div class="payment-option">
            <div>
                <a href="https://www.paypal.com" target="_blank">
                    <img src="../images/upi.jpg" alt="upi_img">
                </a>
            </div>

            <div>
                <a href="order.php?user_id=<?php echo $user_id; ?>">
                    <h2 class="text-center">Pay Offline</h2>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>