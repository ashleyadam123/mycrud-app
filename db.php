<?php
$host = 'localhost'; // Change this to your database host
$dbname = 'crud_db'; // Your database name
$username = 'root';  // Your MySQL username
$password = '';      // Your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
