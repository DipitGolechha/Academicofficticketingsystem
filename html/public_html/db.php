<?php
$host = 'localhost'; // Host name is usually localhost
$dbname = 'id21643299_maindatabase'; // Your database name
$user = 'id21643299_maindatabaseplakshaacad'; // Your database username
$password = 'Plaksha@12345'; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
