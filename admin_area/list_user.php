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
    <title>All Users</title>
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
        <h1 class="text-center mb-4">All Users</h1>

        <div class="table-responsive bg-white p-3 rounded shadow">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-info">
                    <?php
                    $get_users = "SELECT * FROM `user_table`";
                    $get_users_result = mysqli_query($conn, $get_users);
                    $row_count = mysqli_num_rows($get_users_result);
                    echo "<tr>
                        <th>Sr No</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Address</th>
                        <th>Mobile</th>
                    </tr>
                </thead>
                <tbody>";

                    if ($row_count == 0) {
                        echo "<tr><td colspan='6' class='text-center py-4 fw-bold text-danger'>🚫 No Users Yet!</td></tr>";
                    } else {
                        $number = 0;
                        while ($row_data = mysqli_fetch_assoc($get_users_result)) {
                            $number++;
                            echo "<tr>
                                <td>$number</td>
                                <td>{$row_data['username']}</td>
                                <td>{$row_data['user_email']}</td>
                                <td><img src='../users_area/users_images/{$row_data['user_image']}' alt='{$row_data['username']}' class='img-fluid' style='width: 80px; height: 80px; object-fit: cover;'></td>
                                <td>{$row_data['user_address']}</td>
                                <td>{$row_data['user_mobile']}</td>
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