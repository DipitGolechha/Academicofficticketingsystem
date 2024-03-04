<?php
include 'db.php'; // Include your db connection
try {
    $stmt = $pdo->query("SELECT * FROM faq ORDER BY Category, Date DESC");
    $faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $faqs = []; // set to an empty array to avoid errors in case of a query failure
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>FAQ - Plaksha University</title>
<style>
body {
    font-family: Open Sans; /* Updated font-family */
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    color: #14a2b8;
}
.faq-container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
 .navbar-custom {
            background-color: #0056b3;
        }
h1 {
    color: teal;
    text-align: center;
}
.categories ul {
    list-style-type: none;
    padding: 0;
}
.categories ul li {
    cursor: pointer;
    padding: 10px;
    background-color: #e9ecef;
    margin-bottom: 5px;
    border-radius: 5px;
}
.categories ul li:hover {
    background-color: #dde;
}
.question {
    display: none;
    background-color: #f8f9fa;
    margin: 5px 0;
    padding: 10px;
    border-radius: 5px;
}
a {
    text-decoration: none;
    color: teal;
}
a:hover {
    text-decoration: underline;
}
.question p {
    color: black; 
}

</style>
<script>
function showQuestions(category) {
    // Hide all questions
    var questions = document.getElementsByClassName('question');
    for (var i = 0; i < questions.length; i++) {
        questions[i].style.display = 'none';
    }

    // Show questions for the selected category
    var selectedQuestions = document.getElementsByClassName(category);
    for (var i = 0; i < selectedQuestions.length; i++) {
        selectedQuestions[i].style.display = 'block';
    }
}
</script>
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
    <li class="nav-item">
      <a class="nav-link" href="tickethistory.php">Ticket History</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="FAQ.php">FAQ</a>
    </li>
  </ul>
</nav>

 <div class="faq-container">
        <h1>Frequently Asked Questions</h1>
        <p>Here are some of the most asked questions. If you have a question and it has not been answered, please raise a ticket!</p>

        <div class="content">
            <div class="categories">
                <ul>
                    <?php 
                    $displayedCategories = []; 
                    foreach ($faqs as $faq) {
                        $category = htmlspecialchars($faq['Category']);
                        if (!in_array($category, $displayedCategories)) {
                            echo "<li onclick=\"showQuestions('$category')\">$category</li>";
                            $displayedCategories[] = $category; 
                        }
                    }
                    ?>
                </ul>

            </div>
            <div class="questions">
                <?php foreach ($faqs as $faq): ?>
                <div class="question <?php echo htmlspecialchars($faq['Category']); ?>">
                    <h4><?php echo htmlspecialchars($faq['Question']); ?></h4>
                    <p><?php echo htmlspecialchars($faq['Answer']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div></body>
</html>