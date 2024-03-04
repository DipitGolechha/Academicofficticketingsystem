<?php
session_start(); // Start the session

include 'db.php'; // Include your db connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["studentEmail"] ?? '';
    $password = $_POST["studentPassword"] ?? '';

    $sql = "SELECT * FROM login WHERE StudentEmail = ?";
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['Password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $row['StudentID'];
                $_SESSION['user_name'] = $row['StudentName'];
                $_SESSION['user_email'] = $row['StudentEmail'];

                // Redirect to a welcome or home page
                header("Location: index.php");
                exit;
            } else {
                // Invalid password
                echo "<script>alert('Invalid password.'); window.location.href='login.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('No account found with that email.'); window.location.href='signup.php';</script>";
            exit;
        }
        unset($stmt);
    }
    unset($pdo);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
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
    <h2 class="mb-4 text-center" style="color: #14a2b8;">Student Login</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="loginForm" action="login.php" method="post">
    <div class="form-group">
        <label for="studentEmail">Student Email:</label>
        <input type="email" class="form-control" id="studentEmail" name="studentEmail" placeholder="Enter your Plaksha email" required>
    </div>
    <div class="form-group">
        <label for="studentPassword">Password:</label>
        <input type="password" class="form-control" name="studentPassword" id="studentPassword" placeholder="Enter your password" required>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
