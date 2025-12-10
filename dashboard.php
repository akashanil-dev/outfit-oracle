<?php
session_start();

// If user not logged in → redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", sans-serif;
            background: #f5f5f5;
        }

        .container {
            width: 450px;
            margin: 120px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            background: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.2s;
            font-size: 16px;
        }

        .btn:hover {
            background: #555;
        }

        .top {
            color: #444;
            font-size: 18px;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?= htmlspecialchars($user_name) ?> 👋</h2>

    <p class="top">What would you like to do today?</p>

    <a class="btn" href="add.php">➕ Add Wardrobe Item</a>
    <a class="btn" href="view-items.php">📦 View All Items</a>
    <a class="btn" href="logout.php">🚪 Logout</a>
</div>

</body>
</html>
