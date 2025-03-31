<?php
include("../includes/connect.php");
include('../includes/function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" />
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg bg-info navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome " . ($_SESSION['admin_name']) . "</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='./admin_logout.php'>Log Out</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome Guest</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='./admin_login.php'>Login</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">All Orders</h1>

        <div class="table-responsive bg-white p-3 rounded shadow">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-info">
                    <?php
                    $get_orders = "SELECT * FROM `users_orders`";
                    $get_orders_result = mysqli_query($conn, $get_orders);
                    $row_count = mysqli_num_rows($get_orders_result);
                    echo "<tr>
                        <th>Sr No</th>
                        <th>Due Amount</th>
                        <th>Invoice Number</th>
                        <th>Total Products</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>";

                    if ($row_count == 0) {
                        echo "<tr><td colspan='7' class='text-center py-4 fw-bold text-danger'>🚫 No Orders Yet!</td></tr>";
                    } else {
                        $number = 0;
                        while ($row_data = mysqli_fetch_assoc($get_orders_result)) {
                            $order_id = $row_data['order_id'];
                            $amount_due = $row_data['amount_due'];
                            $invoice_number = $row_data['invoice_number'];
                            $total_products = $row_data['total_products'];
                            $order_date = $row_data['order_date'];
                            $order_status = $row_data['order_status'];
                            $number++;
                            echo "<tr>
                                <td>$number</td>
                                <td>$amount_due</td>
                                <td>$invoice_number</td>
                                <td>$total_products</td>
                                <td>$order_date</td>
                                <td>$order_status</td>
                                <td><a href='index.php?delete_order=$order_id' class='text-danger'><i class='fa-solid fa-trash'></i></a></td>
                            </tr>";
                        }
                    }
                    ?>
                    </tbody>
            </table>
        </div>
    </div>

    <footer class="bg-info text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; 2025 Hidden Store. All rights reserved. Designed by Nanda Bendkoli.</p>
        <p class="mb-0">Discover a world of elegance and quality, where every product is handpicked to elevate your
            lifestyle.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>