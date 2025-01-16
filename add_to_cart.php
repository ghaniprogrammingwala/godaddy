<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $domain_name = strtolower(trim($_POST['domain_name']));
    $extension = trim($_POST['extension']);
    $price = floatval($_POST['price']);

    // Check if the domain already exists in the database
    $query = $conn->prepare("SELECT id FROM domains WHERE domain_name = :domain_name AND extension = :extension");
    $query->execute(['domain_name' => $domain_name, 'extension' => $extension]);
    $existing_domain = $query->fetch();

    // Insert the domain into the database if it doesn't exist
    if (!$existing_domain) {
        $insert_query = $conn->prepare("
            INSERT INTO domains (domain_name, extension, price, available) 
            VALUES (:domain_name, :extension, :price, 1)
        ");
        $insert_query->execute([
            'domain_name' => $domain_name,
            'extension' => $extension,
            'price' => $price,
        ]);
        $domain_id = $conn->lastInsertId();
    } else {
        $domain_id = $existing_domain['id'];
    }

    // Add the domain to the cart
    $cart_query = $conn->prepare("INSERT INTO cart (domain_id) VALUES (:domain_id)");
    $cart_query->execute(['domain_id' => $domain_id]);

    header("Location: cart.php");
    exit;
}
?>
