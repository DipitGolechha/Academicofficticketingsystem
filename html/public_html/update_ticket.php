<?php
session_start();
include 'db.php'; // Replace with your database connection script

if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    echo "<script>alert('Access denied. Only admins are authorized.'); window.location.href = 'index.php';</script>";
    exit;
}

$ticketId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch ticket details from the database
$stmt = $pdo->prepare("SELECT * FROM issues WHERE ID = ?");
$stmt->bindParam(1, $ticketId, PDO::PARAM_INT);
$stmt->execute();
$ticket = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch admin names for "Assigned To" dropdown
$adminNamesStmt = $pdo->query("SELECT DISTINCT Name FROM admin_login_table");
$adminNames = $adminNamesStmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission for updates and comments
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and sanitize form data
    $status = $_POST['status'] ?? '';
    $priority = $_POST['priority'] ?? '';
    $category = $_POST['category'] ?? '';
    $assignedTo = $_POST['assignedTo'] ?? '';
    $comment = $_POST['comment'] ?? '';
    $commenttitle = $_POST['commenttitle'] ?? '';


    // Update the ticket details
    $updateSql = "UPDATE issues SET Status = ?, Priority = ?, Category = ?, AssignedTo = ? WHERE ID = ?";
    $pdo->prepare($updateSql)->execute([$status, $priority, $category, $assignedTo, $ticketId]);

    // Insert a new comment if provided
   // Insert a new comment if provided
    if (!empty($comment)) {
      $commentSql = "INSERT INTO issues_status (ID, CommentTitle, CommentText, CommentBy, CommentTo) VALUES (?, ?, ?, ?, ?)";
      $pdo->prepare($commentSql)->execute([$ticketId, $commenttitle, $comment, $_SESSION['admin_name'], $assignedTo]);
    }


    // Redirect back to the admin_viewticket.php page to see changes
    header("Location: view_ticket.php?id=" . $ticketId);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        font-family: Open Sans;
        background-color: #f4f4f4;
        margin-top: 0px;
    }
     .navbar-custom {
            background-color: #14a2b8;
        }
    .container,
    .ticket-details {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        border-collapse: collapse;
    }
    .ticket-details th,
    .ticket-details td {
        padding: 16px;
        text-align: left;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }
    .ticket-details th {
        background-color: #f8f9fa;
        color: #14a2b8;
        font-weight: 500;
    }
    .ticket-details td a {
        color: #14a2b8;
        text-decoration: none;
    }
    .ticket-details td a:hover {
        text-decoration: underline;
    }
    .ticket-details tr:last-child th,
    .ticket-details tr:last-child td {
        border-bottom: none;
    }
    .comments-section {
        padding: 10px;
        background-color: #e9ecef;
        border-radius: 5px;
        margin-top: 10px;
    }
    .comment {
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        background-color: #f8f9fa;
    }
    .comment .comment-author {
        color: #010807;
        font-weight: bold;
    }
    .btn-custom {
            background-color: #14a2b8;
            border-color: #14a2b8;
            color: white;
    }
    .btn-custom:hover {
            background-color: #14a2b8;
            border-color: #0e5a68;
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

<form method="post" action="update_ticket.php?id=<?php echo $ticketId; ?>">
        <table class="table ticket-details">
            <tr>
                <th>Status</th>
                <td>
                    <select name="status" class="form-control">
                        <option value="open" <?php echo $ticket['Status'] == 'open' ? 'selected' : ''; ?>>Open</option>
                        <option value="inprogress" <?php echo $ticket['Status'] == 'inprogress' ? 'selected' : ''; ?>>In Progress</option>
                        <option value="closed" <?php echo $ticket['Status'] == 'closed' ? 'selected' : ''; ?>>Closed</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Priority</th>
                <td>
                    <select name="priority" class="form-control">
                        <option value="high" <?php echo $ticket['Priority'] == 'high' ? 'selected' : ''; ?>>High</option>
                        <option value="medium" <?php echo $ticket['Priority'] == 'medium' ? 'selected' : ''; ?>>Medium</option>
                        <option value="low" <?php echo $ticket['Priority'] == 'low' ? 'selected' : ''; ?>>Low</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Category</th>
                <td>
                    <select name="category" class="form-control">
                        <option value="Course Issues" <?php echo $ticket['Category'] == 'Course Issues' ? 'selected' : ''; ?>>Course Issues</option>
                        <option value="General Issues" <?php echo $ticket['Category'] == 'General Issues' ? 'selected' : ''; ?>>General Issues</option>
                        <option value="Counseling" <?php echo $ticket['Category'] == 'Counseling' ? 'selected' : ''; ?>>Counseling</option>
                        <option value="Major Courses Concerns" <?php echo $ticket['Category'] == 'Major Courses Concerns' ? 'selected' : ''; ?>>Major Courses Concerns</option>
                        <option value="Help Related to Academics" <?php echo $ticket['Category'] == 'Help Related to Academics' ? 'selected' : ''; ?>>Help Related to Academics</option>
                        <option value="Others" <?php echo $ticket['Category'] == 'Others' ? 'selected' : ''; ?>>Others</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Assigned To</th>
                <td>
                    <select name="assignedTo" class="form-control">
                        <?php foreach ($adminNames as $admin): ?>
                            <option value="<?php echo htmlspecialchars($admin['Name']); ?>" <?php echo $ticket['AssignedTo'] == $admin['Name'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($admin['Name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>
        
        <div class="form-group">
            <label for="comment">Add Comment Title:</label>
            <input tyupe="text" class="form-control" id="commenttitle" name="commenttitle" rows="3" required></input>
        </div>

        
        <!-- Section for adding comments -->
        <div class="form-group">
            <label for="comment">Add Comment:</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-custom btn-block">Update Ticket</button>
    </form>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
