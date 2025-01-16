<?php
$host = 'localhost';
$db = 'db55a4vqgftm7o';
$user = 'unf9slyrgthy1';
$password = 'mefxoimggpqp';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
