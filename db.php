<?php
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "ecommerce_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
