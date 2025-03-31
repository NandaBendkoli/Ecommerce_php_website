<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Orders</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" />

    <!-- CSS Styling -->
    <style>
        /* Basic Body Styling */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #333;
        }

        /* Heading Styling */
        h3.text-success {
            font-size: 1.5rem;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #00796b;
            text-align: center;
        }

        /* Table Container */
        .table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        /* Table Header Styling */
        .table thead {
            background: linear-gradient(45deg, #00bcd4, #00796b);
            color: #fff;
        }

        .table th {
            padding: 10px;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        /* Table Body Rows Styling */
        .table tbody {
            background: #fafafa;
        }

        .table tbody tr {
            transition: 0.3s ease;
        }

        /* Hover Effect for Rows */
        .table tbody tr:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }

        /* Cell Styling */
        .table td {
            padding: 8px;
            text-align: center;
            font-size: 1rem;
            border-bottom: 1px solid #ddd;
        }

        /* Status Styling */
        .status-complete {
            font-weight: bold;
            color: #388e3c;
        }

        .status-incomplete {
            font-weight: bold;
            color: #d32f2f;
        }

        .status-paid {
            font-weight: bold;
            color: #4caf50;
            background: #e8f5e9;
            padding: 5px 10px;
            border-radius: 5px;
        }

        /* Confirm Button Styling */
        .table a {
            display: inline-block;
            padding: 4px 10px;
            background: #00796b;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: 0.3s ease;
        }

        .table a:hover {
            background: #005f4b;
            transform: scale(1.1);
        }

        /* Responsive Table Adjustments */
        @media (max-width: 768px) {
            h3.text-success {
                font-size: 1.2rem;
            }

            .table {
                width: 100%;
                font-size: 0.7rem;
            }

            .table th,
            .table td {
                padding: 6px;
            }

            .table a {
                font-size: 0.6rem;
                padding: 3px 8px;
            }
        }
    </style>
</head>

<body>
    <?php

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        echo "<script>alert('User not logged in. Please log in.');</script>";
        exit();
    }

    $username = $_SESSION['username'];

    // Get user_id properly
    $get_users = "SELECT * FROM `user_table` WHERE username='$username'";
    $get_users_result = mysqli_query($conn, $get_users);

    if (!$get_users_result || mysqli_num_rows($get_users_result) == 0) {
        echo "<script>alert('User not found.');</script>";
        exit();
    }

    $row_fetch = mysqli_fetch_assoc($get_users_result);
    $user_id = $row_fetch['user_id'];

    // Debugging: Check if user_id is retrieved
    if (empty($user_id)) {
        echo "<script>alert('Error: User ID not retrieved.');</script>";
        exit();
    }
    ?>

    <h3 class="text-success">All Orders</h3>
    <div class="table-responsive">
        <table class="table table-bordered mt-5">
            <thead class="bg-info">
                <tr>
                    <th>Sr. No</th>
                    <th>Amount Due</th>
                    <th>Total Products</th>
                    <th>Invoice Number</th>
                    <th>Date</th>
                    <th>Complete/Incomplete</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="bg-secondary text-light">
                <?php
                $get_order_details = "SELECT * FROM `users_orders` WHERE user_id='$user_id'";
                $get_order_details_result = mysqli_query($conn, $get_order_details);

                if (!$get_order_details_result || mysqli_num_rows($get_order_details_result) == 0) {
                    echo "<tr><td colspan='7' class='text-center text-danger'>No orders found.</td></tr>";
                } else {
                    $sr_number = 1;
                    while ($row_orders = mysqli_fetch_assoc($get_order_details_result)) {
                        $order_id = $row_orders["order_id"];
                        $order_amount = $row_orders["amount_due"];
                        $total_products = $row_orders["total_products"];
                        $invoice_number = $row_orders["invoice_number"];
                        $order_status = $row_orders["order_status"];
                        $order_status_display = ($order_status == 'pending') ? '<span class="status-incomplete">Incomplete</span>' : '<span class="status-complete">Complete</span>';
                        $order_date = $row_orders["order_date"];

                        echo " 
                <tr> 
                    <td>$sr_number</td>
                    <td>₹$order_amount</td>
                    <td>$total_products</td>
                    <td>$invoice_number</td>
                    <td>$order_date</td> 
                    <td>$order_status_display</td>";

                        if ($order_status == 'Complete') {
                            echo '<td><span class="status-paid">Paid</span></td>';
                        } else {
                            echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>";
                        }
                        echo "</tr>";

                        $sr_number++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>