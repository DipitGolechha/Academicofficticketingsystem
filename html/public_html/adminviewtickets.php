<?php
session_start(); // Start or resume the session

// Check if admin is logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit;
}

$adminName = $_SESSION['admin_name']; // The name of the admin logged in

include 'db.php'; // Your database connection file

// Fetch tickets assigned to the admin first
$stmt = $pdo->prepare("SELECT * FROM issues WHERE AssignedTo = ? ORDER BY Date DESC");
$stmt->execute([$adminName]);
$assignedTickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch and display other tickets
$stmt = $pdo->prepare("SELECT * FROM issues WHERE AssignedTo != ? ORDER BY Date DESC");
$stmt->execute([$adminName]);
$otherTickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Office Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Open Sans; /* Updated font-family */
            background-color: #f4f4f4;
            margin-top: 0px;
        }
        .navbar-custom {
            background-color: #14a2b8;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #14a2b8;
            color: white;
        }
        .btn-custom:hover {
            background-color: #106c7e;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .status, .priority {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            border-radius: 0.25rem;
            color: white;
        }
        .status-open {
            background-color: #17a2b8; /* Bootstrap's info color, a light blue */
        }
        .status-inprogress {
            background-color: #ffc107; /* Bootstrap's warning color, yellow */
            color: black; /* Ensuring text is readable on a light background */
        }
        .status-closed {
            background-color: #28a745; /* Bootstrap's success color, green */
        }
        .priority-high {
            background-color: #dc3545; /* Bootstrap's danger color, red */
        }
        .priority-medium {
            background-color: #ffc107; /* Bootstrap's warning color, yellow */
            color: black; /* Ensuring text is readable on a light background */
        }
        .priority-low {
            background-color: #17a2b8; /* A light blue color */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="adminviewtickets.php">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="admin_login.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <h2 class="mb-4" style="color: #14a2b8;">Ticket List</h2>
    <div class="table-responsive">
        <table class="table">
            <thead style="background-color: #14a2b8; color: #fff;">
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Category</th>
                    <th>Student Name</th>
                    <th>Assigned To</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assignedTickets as $ticket): ?>
                    <tr>
                        <td><?= htmlspecialchars($ticket['Date']) ?></td>
                        <td><?= htmlspecialchars($ticket['Title']) ?></td>
                        <td><span class="status status-<?= strtolower(htmlspecialchars($ticket['Status'])) ?>"><?= htmlspecialchars($ticket['Status']) ?></span></td>
                        <td><span class="priority priority-<?= strtolower(htmlspecialchars($ticket['Priority'])) ?>"><?= htmlspecialchars($ticket['Priority']) ?></span></td>
                        <td><?= htmlspecialchars($ticket['Category']) ?></td>
                        <td><?= htmlspecialchars($ticket['StudentName']) ?></td>
                        <td><?= htmlspecialchars($ticket['AssignedTo']) ?></td>
                        <td>
                            <a href="view_ticket.php?id=<?= $ticket['ID'] ?>" class="btn btn-custom">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php foreach ($otherTickets as $ticket): ?>
                    <tr>
                        <td><?= htmlspecialchars($ticket['Date']) ?></td>
                        <td><?= htmlspecialchars($ticket['Title']) ?></td>
                        <td><span class="status status-<?= strtolower(htmlspecialchars($ticket['Status'])) ?>"><?= htmlspecialchars($ticket['Status']) ?></span></td>
                        <td><span class="priority priority-<?= strtolower(htmlspecialchars($ticket['Priority'])) ?>"><?= htmlspecialchars($ticket['Priority']) ?></span></td>
                        <td><?= htmlspecialchars($ticket['Category']) ?></td>
                        <td><?= htmlspecialchars($ticket['StudentName']) ?></td>
                        <td><?= htmlspecialchars($ticket['AssignedTo']) ?></td>
                        <td>
                            <a href="view_ticket.php?id=<?= $ticket['ID'] ?>" class="btn btn-custom">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
