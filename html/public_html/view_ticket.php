<?php
session_start();
include 'db.php'; // Replace with your database connection script

if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    echo "<script>alert('Access denied. Only admins are authorized.'); window.location.href = 'index.php';</script>";
    exit;
}

$ticketId = isset($_GET['id']) ? intval($_GET['id']) : 0;
try {
    // Fetch ticket details from the database
    $stmt = $pdo->prepare("SELECT * FROM issues WHERE ID = ?");
    $stmt->bindParam(1, $ticketId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        echo "<script>alert('Ticket not found.'); window.location.href='tickethistory.php';</script>";
        exit;
    }

    $ticket = $stmt->fetch(PDO::FETCH_ASSOC);

    

    // Fetch comments related to the ticket
    $commentsStmt = $pdo->prepare("SELECT * FROM issues_status WHERE ID = ? ORDER BY Time DESC");
    $commentsStmt->bindParam(1, $ticketId, PDO::PARAM_INT);
    $commentsStmt->execute();
    $comments = $commentsStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Redirect to an error page or display an error message
    // Using 'exit' here to ensure that no further code is run
    exit("Error: " . $e->getMessage());
}
try {
    $adminNamesStmt = $pdo->prepare("SELECT Name FROM admin_login_table WHERE Name != ?");
    $adminNamesStmt->execute([$_SESSION['admin_name']]);
    $adminNames = $adminNamesStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle error
    exit("Error fetching admin names: " . $e->getMessage());
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
            background-color: #106c7e;
            border-color: #0e5a68;
        }
</style>

</head>
<body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
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

<!-- Trigger buttons for modal -->
<!-- Modal -->
 <div class="container">
        <h2 class="mb-4" style="color: #14a2b8;">Ticket Details</h2>
                <table class="table ticket-details">
            <tr>
                <th>ID</th>
                <td><?php echo htmlspecialchars($ticket['ID']); ?></td>
            </tr>
            <tr>
                <th>Created at</th>
                <td><?php echo htmlspecialchars($ticket['Date']); ?></td>
            </tr>
            <tr>
                <th>Title</th>
                <td><?php echo htmlspecialchars($ticket['Title']); ?></td>
            </tr>
            <tr>
                <th>Content</th>
                <td><?php echo htmlspecialchars($ticket['Content']); ?></td>
            </tr>
            <tr>
                <th>Attachments</th>
                <td>
                    <?php if ($ticket['Attachments']): ?>
                        <a href="<?php echo htmlspecialchars($ticket['Attachments']); ?>">View attachments</a>
                    <?php else: ?>
                        None
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo htmlspecialchars($ticket['Status']); ?></td>
            </tr>
            <tr>
                <th>Priority</th>
                <td><?php echo htmlspecialchars($ticket['Priority']); ?></td>
            </tr>
            <tr>
                <th>Category</th>
                <td><?php echo htmlspecialchars($ticket['Category']); ?></td>
            </tr>
            <tr>
                <th>Student Name</th>
                <td><?php echo htmlspecialchars($ticket['StudentName']); ?></td>
            </tr>
            <tr>
                <th>Student Email</th>
                <td><?php echo htmlspecialchars($ticket['StudentEmail']); ?></td>
            </tr>
            <tr>
                <th>Assigned To User</th>
                <td><?php echo htmlspecialchars($ticket['AssignedTo']); ?></td>
            </tr>
<tr>
    <th>Comments</th>
<td>
    <div class="comments-section">
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <div class="comment-author">
                    <?php echo htmlspecialchars($comment['CommentBy']); ?> (<?php echo date('Y-m-d', strtotime($comment['Time'])); ?>)
                    <br>
                    Assigned to: <?php echo htmlspecialchars($comment['CommentTo']); ?>
                </div>
                <?php if (!empty($comment['CommentTitle'])): ?>
                    <div class="comment-title" style="font-weight: bold;"><?php echo htmlspecialchars($comment['CommentTitle']); ?></div>
                <?php endif; ?>
                <div style="color: #14a2b8;"><?php echo nl2br(htmlspecialchars($comment['CommentText'])); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</td>

</tr>        </table>
    <a href="update_ticket.php?id=<?php echo $ticketId; ?>" class="btn btn-custom btn-block">Update Ticket</a>



</div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>\

</body>
</html>