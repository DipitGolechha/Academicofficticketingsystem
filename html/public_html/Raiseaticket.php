<?php
session_start(); // Start or resume the session

if (!isset($_SESSION['user_email'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit;
}

include 'db.php'; // Include your db connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"] ?? '';
    $content = $_POST["content"] ?? '';
    $attachments = $_POST["attachments"] ?? ''; // Assuming this is a text field or URL of the uploaded file
    $priority = $_POST["priority"] ?? '';
    $category = $_POST["category"] ?? '';
    $assignedTo = $_POST["assignedTo"] ?? '';

    $studentName = $_SESSION['user_name']; // Get student name from session
    $studentEmail = $_SESSION['user_email']; // Get student email from session
    $status = 'Open'; // Default status

    // Insert the new ticket into the database
    $sql = "INSERT INTO issues (Title, Content, Attachments, Status, Priority, Category, StudentName, StudentEmail, AssignedTo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->bindParam(2, $content, PDO::PARAM_STR);
        $stmt->bindParam(3, $attachments, PDO::PARAM_STR);
        $stmt->bindParam(4, $status, PDO::PARAM_STR);
        $stmt->bindParam(5, $priority, PDO::PARAM_STR);
        $stmt->bindParam(6, $category, PDO::PARAM_STR);
        $stmt->bindParam(7, $studentName, PDO::PARAM_STR);
        $stmt->bindParam(8, $studentEmail, PDO::PARAM_STR);
        $stmt->bindParam(9, $assignedTo, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<script>alert('Ticket raised successfully.'); window.location.href='tickethistory.php';</script>";
            exit;
        } else {
            echo "<script>alert('Something went wrong. Please try again later.'); window.location.href='Raiseaticket.php';</script>";
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
    <title>Raise a Ticket</title>
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

<nav class="navbar navbar-expand-sm bg-info navbar-dark">
    <a class="navbar-brand" href="#">Plaksha Academic Ticketing System</a>
  <ul class="navbar-nav">
    <li class="nav-item ">
      <a class="nav-link" href="index.php">Home Page</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="Raiseaticket.php">Raise a Ticket</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="tickethistory.php">Ticket History</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="FAQ.php">FAQ</a>
    </li>
  </ul>
</nav>

<div class="container">
    <center>
        <h2 class="mb-4" style="color: #14a2b8;">Raise a Ticket</h2>
    </center>
    <form action="Raiseaticket.php" method="post" enctype="multipart/form-data"> <!-- Updated form tag -->
        <div class="form-group">
            <label for="title">Title of the issue:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category" name="category" required>
                <option value="Course Issues">Course Issues</option>
                <option value="General Issues">General Issues</option>
                <option value="Counseling">Counseling</option>
                <option value="Major Courses Concerns">Major Courses Concerns</option>
                <option value="Help Related to Academics">Help Related to Academics</option>
                <option value="Others">Others</option>
            </select>
        </div>
        <div class="form-group">
            <label for="priority">Priority:</label>
            <select class="form-control" id="priority" name="priority" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>
        <div class="form-group">
            <label for="assignedTo">Assigned to user:</label>
            <select class="form-control" id="assignedTo" name="assignedTo" required>
                <option value="Academic office">Academic office</option>
                <option value="Manoj Sir">Manoj Sir</option>
                <option value="Nandini Ma'am">Nandini Ma'am</option>
                <option value="Manan Chawla">Manan Chawla</option>
            </select>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="5" placeholder="Enter details" required></textarea>
        </div>
        <div class="form-group">
            <label for="attachments">Attachments:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="attachments" name="attachments">
                <label class="custom-file-label" for="attachments">Choose file</label>
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-custom btn-block">Submit Ticket</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
