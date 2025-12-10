<?php
$host = "localhost";    // Usually localhost
$user = "root";         // Default XAMPP/WAMP username
$pass = "";             // Default password (empty on XAMPP/WAMP)
$dbname = "wardrobe_db"; // Your database name

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
