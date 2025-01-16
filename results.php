<?php
require 'db.php';
// Get the user's search query from the URL
$search = strtolower(trim($_GET['domain'] ?? ''));
// Define popular domain extensions
$extensions = ['.com', '.net', '.org', '.info', '.io'];
// Generate dynamic results with prices
$results = [];
foreach ($extensions as $ext) {
    $results[] = [
        'domain_name' => $search,
        'extension' => $ext,
        'price' => rand(10, 50), // Random price between $10 and $50
        'available' => true, // Assume all generated domains are available
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domain Search Results</title>
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
        .domain {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            transition: all 0.3s ease;
        }
        .domain:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .domain-name {
            font-weight: 600;
            color: #008a45;
            font-size: 18px;
        }
        .domain-price {
            color: #666;
            font-size: 16px;
        }
        .domain button {
            background-color: #008a45;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .domain button:hover {
            background-color: #00a45c;
            transform: scale(1.05);
        }
        .domain button:active {
            transform: scale(0.95);
        }
        @media (max-width: 600px) {
            .container {
                margin: 20px 15px;
                padding: 20px;
            }
            .domain {
                flex-direction: column;
                text-align: center;
            }
            .domain button {
                margin-top: 10px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Results for "<?php echo htmlspecialchars($search); ?>"</h2>
        <?php if (!empty($search)): ?>
            <?php foreach ($results as $result): ?>
                <div class="domain">
                    <span class="domain-name"><?php echo $result['domain_name'] . $result['extension']; ?></span>
                    <span class="domain-price">$<?php echo number_format($result['price'], 2); ?></span>
                    <form action="add_to_cart.php" method="POST" style="margin: 0;">
                        <input type="hidden" name="domain_name" value="<?php echo $result['domain_name']; ?>">
                        <input type="hidden" name="extension" value="<?php echo $result['extension']; ?>">
                        <input type="hidden" name="price" value="<?php echo $result['price']; ?>">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Please enter a domain name to search.</p>
        <?php endif; ?>
    </div>
</body>
</html>
