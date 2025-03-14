<?php
session_start();
include('db.php');

// Fetch cart items
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM cart WHERE user_id = $user_id";
    $cart_items = $conn->query($sql);
} else {
    $cart_items = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - E-commerce Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center" style="background-image: url('assets/cart-bg.jpg');">

    <!-- Header -->
    <header class="bg-brown-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Simple E-commerce Store</h1>
            <nav>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="cart.php" class="px-4 py-2 hover:bg-brown-700">Cart</a>
                    <a href="logout.php" class="px-4 py-2 hover:bg-brown-700">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="px-4 py-2 hover:bg-brown-700">Login</a>
                    <a href="register.php" class="px-4 py-2 hover:bg-brown-700">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- Cart Content -->
    <div class="container mx-auto py-8 bg-black bg-opacity-50 p-6 rounded-lg">
        <?php if (mysqli_num_rows($cart_items) > 0): ?>
            <h2 class="text-xl font-semibold text-white mb-4">Your Cart</h2>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <ul>
                    <?php
                    $total = 0;
                    while ($item = $cart_items->fetch_assoc()):
                        $total += $item['price'];
                    ?>
                        <li class="flex justify-between py-2 border-b">
                            <span><?php echo $item['name']; ?> - $<?php echo $item['price']; ?></span>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <div class="mt-4 flex justify-between">
                    <p class="text-xl font-bold">Total: $<?php echo $total; ?></p>
                    <a href="checkout.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Proceed to Checkout</a>
                </div>
            </div>
        <?php else: ?>
            <p class="text-white">Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-brown-800 text-white p-4 text-center">
        <p>&copy; 2025 Simple E-commerce Store</p>
    </footer>

</body>
</html>
