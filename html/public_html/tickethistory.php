<?php
session_start(); // Start or resume the session

// Redirect to login page if not logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

include 'db.php'; // Include your db connection

// Fetch tickets for the logged-in user
try {
    $stmt = $pdo->prepare("SELECT * FROM issues WHERE StudentEmail = ? ORDER BY Date DESC");
    $stmt->bindParam(1, $_SESSION['user_email'], PDO::PARAM_STR);
    $stmt->execute();
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket History</title>
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
        .table-custom {
            color: #495057;
        }
        .table-custom thead th {
            color: #fff;
            background-color: #14a2b8;
        }
        .table-custom tbody tr:hover {
            background-color: #f2f2f2;
        }
        .btn-custom {
            background-color: #14a2b8;
            color: white;
        }
        .btn-custom:hover {
            background-color: #106c7e;
        }
        .status {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    text-align: center;
    vertical-align: middle;
    border-radius: 0.25rem;
    color: white;
}
.status-open {
    background-color: #17a2b8; 
}
.status-inprogress {
    background-color: #ffc107; 
    color: black; 
}
.status-closed {
    background-color: #28a745; 
}

.priority {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    text-align: center;
    vertical-align: middle;
    border-radius: 0.25rem;
    color: white;
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

<nav class="navbar navbar-expand-sm bg-info navbar-dark">
    <a class="navbar-brand" href="#">Plaksha Academic Ticketing System</a>
  <ul class="navbar-nav">
    <li class="nav-item ">
      <a class="nav-link" href="index.php">Home Page</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="Raiseaticket.php">Raise a Ticket</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="tickethistory.php">Ticket History</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="FAQ.php">FAQ</a>
    </li>
  </ul>
</nav>

<div class="container">
        <h2 class="mb-4" style="color: #14a2b8;">Ticket History</h2>
        <table class="table table-custom">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Assigned to</th>
                    <th>Live Status</th>
                    <th>Priority</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ticket['Date']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['Title']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['Category']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['AssignedTo']); ?></td>
                        <td>
                            <span class="status status-<?php echo strtolower(htmlspecialchars($ticket['Status'])); ?>">
                                <?php echo htmlspecialchars($ticket['Status']); ?>
                            </span>
                        </td>
                        <td>
                            <span class="priority priority-<?php echo strtolower(htmlspecialchars($ticket['Priority'])); ?>">
                                <?php echo htmlspecialchars($ticket['Priority']); ?>
                            </span>
                        </td>
                        <td><a href="ticket.php?id=<?php echo htmlspecialchars($ticket['ID']); ?>" class="btn btn-custom">View Full Ticket</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
