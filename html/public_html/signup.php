<?php
session_start(); // Start the session at the beginning of the script

include 'db.php'; // Include your db connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = $_POST["studentName"] ?? '';
    $studentId = $_POST["studentId"] ?? '';
    $studentEmail = $_POST["studentEmail"] ?? '';
    $password = $_POST["studentPassword"] ?? '';
    $studentBatch = $_POST["studentBatch"] ?? ''; // Capture the batch data

    // Validate email
    if (!filter_var($studentEmail, FILTER_VALIDATE_EMAIL) || !str_ends_with($studentEmail, '@plaksha.edu.in')) {
        echo "Please use a Plaksha email address.";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO login (StudentID, StudentName, Batch, StudentEmail, Password) VALUES (?, ?, ?, ?, ?)"; 
        
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(1, $studentId, PDO::PARAM_STR);
            $stmt->bindParam(2, $studentName, PDO::PARAM_STR);
            $stmt->bindParam(4, $studentEmail, PDO::PARAM_STR);
            $stmt->bindParam(5, $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(3, $studentBatch, PDO::PARAM_STR); 

            if ($stmt->execute()) {
                // Set session variables
                $_SESSION['user_id'] = $studentId;
                $_SESSION['user_name'] = $studentName;
                $_SESSION['user_email'] = $studentEmail;
                $_SESSION['user_batch'] = $studentBatch; // Optionally store batch in session

                // Redirect to a welcome or home page
                header("Location: index.php");
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
                // Redirect back to the signup page
                header("Location: signup.php");
                exit;
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Signup</title>
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
    <h2 class="mb-4 text-center" style="color: #14a2b8;">Student Signup</h2>
    <div class="text-center mb-4">
        <img src="imgs/loginsignupimg.png" width="200px" height="200px" class="rounded-circle" alt="User Image" />
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="signupForm" method="post" action="signup.php">
                <div class="form-group">
                    <label for="studentName">Student Name:</label>
                    <input type="text" class="form-control" name="studentName" id="studentName" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="studentId">Student ID:</label>
                    <input type="text" class="form-control" name="studentId" id="studentId" placeholder="Enter your student ID" required>
                </div>
                <div class="form-group">
                    <label for="studentBatch">Batch:</label>
                    <select class="form-control" id="studentBatch" name="studentBatch" required>
                        <option value="">Select your batch</option>
                        <option value="Ug2021">Ug2021</option>
                        <option value="Ug2022">Ug2022</option>
                        <option value="Ug2023">Ug2023</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="studentEmail">Student Email:</label>
                    <input type="email" class="form-control" name="studentEmail" id="studentEmail" placeholder="Enter your Plaksha email" pattern=".+@plaksha\.edu\.in$" title="Email must be a Plaksha domain" required>

                </div>
               <div class="form-group">
                    <label for="studentPassword">Password:</label>
                    <input type="password" name="studentPassword" class="form-control" id="studentPassword" placeholder="Create a password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-custom btn-block">Signup</button>
                </div>
            </form>
        </div>
    </div>
</div>



</body>
</html>