<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Clothing Item</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            margin: 60px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0px 0px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            font-weight: normal;
            color: #333;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
            color: #444;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #45a049;
        }

        .back-link {
            text-align: center;
            display: block;
            margin-top: 15px;
            color: #555;
            text-decoration: none;
        }
    </style>

</head>
<body>

<div class="container">
    <h2>Add Clothing Item</h2>

    <form action="add-handler.php" method="POST">

        <label>Dress Type:</label>
        <select name="dress_type" required>
            <option value="Shirt">Shirt</option>
            <option value="T-Shirt">T-Shirt</option>
            <option value="Pants">Pants</option>
            <option value="Jeans">Jeans</option>
            <option value="Trousers">Trousers</option>
            <option value="Kurta">Kurta</option>
            <option value="Dhothi">Dhothi</option>
            <option value="Jubba">Jubba</option>
            <option value="Sweatshirt">Sweatshirt</option>
            <option value="Hoodie">Hoodie</option>
            <option value="Jacket">Jacket</option>
            <option value="Tracksuit">Tracksuit</option>
        </select>

        <label>Dress Name:</label>
        <input type="text" name="dress_name" required>

        <label>Color:</label>
        <input type="text" name="color" required>

        <label>Wash Type:</label>
        <select name="wash_type" required>
            <option value="Hand Wash">Hand Wash</option>
            <option value="Machine Wash">Machine Wash</option>
        </select>

        <label>Wear Count:</label>
        <input type="number" name="wear_count" min="0" value="0" required>

        <label>Occasion:</label>
        <select name="occasion" required>
            <option value="Casual">Casual</option>
            <option value="Formal">Formal</option>
            <option value="Festive">Festive</option>
        </select>

        <button type="submit">Add Item</button>
    </form>

    <a class="back-link" href="dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>
