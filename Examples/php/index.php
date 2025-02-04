<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=car_parts_shop", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch products
function getProducts($pdo) {
    $stmt = $pdo->query("SELECT * FROM products");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add to cart
if (isset($_GET['add'])) {
    $id = $_GET['add'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    header("Location: index.php");
    exit();
}

// Display products
$products = getProducts($pdo);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Car Parts Webshop</title>
</head>
<body>
    <h1>Car Parts</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <?= htmlspecialchars($product['name']) ?> - $
                <?= number_format($product['price'], 2) ?>
                <a href="?add=<?= $product['id'] ?>">Add to Cart</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Cart</h2>
    <ul>
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>
                <?php $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
                      $stmt->execute([$id]);
                      $product = $stmt->fetch(PDO::FETCH_ASSOC); ?>
                <li>
                    <?= htmlspecialchars($product['name']) ?> x <?= $quantity ?> - $
                    <?= number_format($product['price'] * $quantity, 2) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Cart is empty</li>
        <?php endif; ?>
    </ul>
    <a href="checkout.php">Checkout</a>
</body>
</html>
