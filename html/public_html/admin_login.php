<?php
session_start();

include 'db.php'; // Include your database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminEmail = $_POST["adminEmail"] ?? '';
    $adminPassword = $_POST["adminPassword"] ?? '';

    // Query to check if the email exists
    $stmt = $pdo->prepare("SELECT * FROM admin_login_table WHERE Email = ?");
    $stmt->bindParam(1, $adminEmail, PDO::PARAM_STR);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if (password_verify($adminPassword, $admin['Password'])) {
            // Set session variables
            $_SESSION['admin_name'] = $admin['Name'];
            $_SESSION['admin_email'] = $admin['Email'];
            $_SESSION['isAdmin'] = true;

            // Redirect to admin dashboard
            header("Location: adminviewtickets.php");
            exit;
        } else {
            $loginError = "Invalid password.";
        }
    } else {
        $loginError = "Admin email not found.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Open Sans; /* Updated font-family */
            background-color: #f4f4f4;
            margin-top: 0px;
        }
        .navbar-custom {
            background-color: #0056b3;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .form-control:focus {
            border-color: #14a2b8;
            box-shadow: 0 0 0 0.2rem rgba(20, 162, 184, 0.25);
        }
        .btn-custom {
            background-color: #14a2b8;
            border-color: #14a2b8;
            color: white;
        }
        .btn-custom:hover {
            background-color: #106c7e;
            border-color: #0e5a68;
        }
         
    .custom-file-input:lang(en)~.custom-file-label::after {
        content: "Browse";
    }
    .custom-file-input:lang(en)~.custom-file-label {
        content: "Choose file";
    }
    .custom-file-label {
        background-color: #f8f9fa;
        
    }
    .custom-file-input:focus~.custom-file-label {
        border-color: #14a2b8;
        box-shadow: 0 0 0 0.2rem rgba(20, 162, 184, 0.25);
    }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="text-center mb-4">
        <img src="imgs/loginsignupimg.png" width="200px" height="200px" class="rounded-circle" alt="User Image" />
    </div>
    <h2 class="mb-4 text-center" style="color: #14a2b8;">Admin Login</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="adminLoginForm" action="admin_login.php" method="post">
                <div class="form-group">
                    <label for="adminEmail">Email:</label>
                    <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="adminPassword">Password:</label>
                    <input type="password" class="form-control" name="adminPassword" id="adminPassword" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-custom btn-block">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min
