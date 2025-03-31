<?php
$username_session = $_SESSION['username'];

if (isset($_POST['delete'])) {
    $delete_query = "DELETE FROM `user_table` WHERE username='$username_session'";
    $delete_result = mysqli_query($conn, $delete_query);
    if ($delete_result) {
        session_destroy();
        echo "<script>alert('Account Deleted!')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

if (isset($_POST['dont_delete'])) {
    echo "<script>window.open('profile.php','_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 70%;
            text-align: center;
        }

        h3 {
            color: #d9534f;
            font-size: 1.8rem;
        }

        .form-control {
            padding: 10px;
            width: 100%;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .form-control[name='delete'] {
            background-color: #d9534f;
            color: #fff;
        }

        .form-control[name='dont_delete'] {
            background-color: #5cb85c;
            color: #fff;
        }

        .form-control:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Delete Account</h3>
        <form action="" method="post" class="mt-5">
            <input type="submit" class="form-control" name="delete" value="Delete Account">
            <input type="submit" class="form-control" name="dont_delete" value="Don't Delete Account">
        </form>
    </div>
</body>

</html>