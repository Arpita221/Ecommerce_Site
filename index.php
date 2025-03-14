<?php
session_start();
include('db.php');

// Fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - E-commerce Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center" style="background-image: url('assets/home-bg.WEBP');">

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

    <!-- Product Listing -->
    <div class="container mx-auto py-8 grid grid-cols-4 gap-4">
        <?php while ($product = $result->fetch_assoc()): ?>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <img src="assets/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="w-full h-64 object-cover rounded">
                <h3 class="text-lg font-semibold mt-4"><?php echo $product['name']; ?></h3>
                <p class="text-gray-600"><?php echo $product['description']; ?></p>
                <p class="text-xl font-bold text-green-500 mt-2">$<?php echo $product['price']; ?></p>
                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" class="mt-4 bg-brown-500 text-white px-4 py-2 rounded hover:bg-brown-600">Add to Cart</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-brown-800 text-white p-4 text-center">
        <p>&copy; 2025 Simple E-commerce Store</p>
    </footer>

</body>
</html>
