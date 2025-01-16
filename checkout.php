<?php
require 'db.php';

// Fetch all items in the cart
$query = $conn->prepare("
    SELECT domains.domain_name, domains.extension, domains.price 
    FROM cart 
    JOIN domains ON cart.domain_id = domains.id
");
$query->execute();
$cart_items = $query->fetchAll(PDO::FETCH_ASSOC);

// Calculate the total price
$total_price = 0;
foreach ($cart_items as $item) {
    $total_price += $item['price'];
}

// Clear the cart after checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clear_cart_query = $conn->prepare("DELETE FROM cart");
    $clear_cart_query->execute();
    $cart_cleared = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; margin: 0; }
        .container { max-width: 800px; margin: auto; text-align: center; }
        h2, h3 { color: #333; }
        .summary { margin: 20px 0; }
        .thank-you { margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($cart_items) && empty($cart_cleared)): ?>
            <h2>Order Summary</h2>
            <div class="summary">
                <?php foreach ($cart_items as $item): ?>
                    <p><?php echo $item['domain_name'] . $item['extension']; ?> - $<?php echo number_format($item['price'], 2); ?></p>
                <?php endforeach; ?>
                <h3>Total: $<?php echo number_format($total_price, 2); ?></h3>
            </div>
            <form method="POST">
                <button type="submit">Confirm Checkout</button>
            </form>
        <?php elseif (!empty($cart_cleared)): ?>
            <h2>Thank You!</h2>
            <p>Your purchase was successful. Your cart is now empty.</p>
        <?php else: ?>
            <p>Your cart is empty. Nothing to checkout.</p>
        <?php endif; ?>
    </div>
</body>
</html>
