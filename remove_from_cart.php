<?php
require 'db.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the domain ID from the POST data
    $domain_id = intval($_POST['domain_id'] ?? 0);

    if ($domain_id > 0) {
        // Remove the domain from the cart
        $query = $conn->prepare("DELETE FROM cart WHERE domain_id = :domain_id");
        $query->execute(['domain_id' => $domain_id]);
    }

    // Redirect back to the cart page
    header("Location: cart.php");
    exit;
}
?>
