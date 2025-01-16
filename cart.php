<?php
require 'db.php';
// Fetch all items in the cart
$query = $conn->prepare("
    SELECT cart.id AS cart_id, domains.domain_name, domains.extension, domains.price 
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #1a1a1a;
            line-height: 1.6;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        h2 {
            color: #1a1a1a;
            margin-bottom: 20px;
            font-weight: 600;
            border-bottom: 2px solid #008a45;
            padding-bottom: 10px;
        }
        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            transition: all 0.3s ease;
        }
        .item:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .item span {
            font-weight: 600;
            color: #1a1a1a;
        }
        .item button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .item button:hover {
            background-color: #ff3333;
            transform: scale(1.05);
        }
        .checkout {
            margin-top: 30px;
            text-align: right;
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
        }
        .checkout h3 {
            color: #008a45;
            font-size: 20px;
            margin-bottom: 15px;
        }
        .checkout button {
            background-color: #008a45;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .checkout button:hover {
            background-color: #00a45c;
            transform: scale(1.05);
        }
        @media (max-width: 600px) {
            .container {
                margin: 20px 15px;
                padding: 20px;
            }
            .item {
                flex-direction: column;
                text-align: center;
            }
            .item button {
                margin-top: 10px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Cart</h2>
        <?php if (!empty($cart_items)): ?>
            <?php foreach ($cart_items as $item): ?>
                <div class="item">
                    <span><?php echo $item['domain_name'] . $item['extension']; ?> - $<?php echo number_format($item['price'], 2); ?></span>
                    <form action="remove_from_cart.php" method="POST">
                        <input type="hidden" name="domain_id" value="<?php echo $item['cart_id']; ?>">
                        <button type="submit">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
            <div class="checkout">
                <h3>Total: $<?php echo number_format($total_price, 2); ?></h3>
                <form action="checkout.php" method="POST">
                    <button type="submit">Checkout</button>
                </form>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>
</html>
