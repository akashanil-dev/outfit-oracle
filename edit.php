<?php
session_start();
require 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if id is provided
if (!isset($_GET['id'])) {
    header("Location: view-items.php");
    exit();
}

$item_id = intval($_GET['id']);

// Fetch item
$query = "SELECT * FROM clothes WHERE id='$item_id' AND user_id='$user_id' LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) != 1) {
    echo "Item not found or you don't have permission to edit it.";
    exit();
}

$item = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Clothing Item</title>
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
    <h2>Edit Clothing Item</h2>

    <form action="update-handler.php" method="POST">
        <!-- Hidden field to send item id -->
        <input type="hidden" name="id" value="<?= $item['id'] ?>">

        <label>Dress Type:</label>
        <select name="dress_type" required>
            <?php
            $types = ["Shirt","T-Shirt","Pants","Jeans","Trousers","Kurta","Dhothi","Jubba","Sweatshirt","Hoodie","Jacket","Tracksuit"];
            foreach ($types as $type) {
                $selected = ($item['dress_type'] == $type) ? "selected" : "";
                echo "<option value=\"$type\" $selected>$type</option>";
            }
            ?>
        </select>

        <label>Dress Name:</label>
        <input type="text" name="dress_name" value="<?= htmlspecialchars($item['dress_name']) ?>" required>

        <label>Color:</label>
        <input type="text" name="color" value="<?= htmlspecialchars($item['color']) ?>" required>

        <label>Wash Type:</label>
        <select name="wash_type" required>
            <option value="Hand Wash" <?= $item['wash_type'] == "Hand Wash" ? "selected" : "" ?>>Hand Wash</option>
            <option value="Machine Wash" <?= $item['wash_type'] == "Machine Wash" ? "selected" : "" ?>>Machine Wash</option>
        </select>

        <label>Wear Count:</label>
        <input type="number" name="wear_count" min="0" value="<?= $item['wear_count'] ?>" required>

        <label>Occasion:</label>
        <select name="occasion" required>
            <option value="Casual" <?= $item['occasion'] == "Casual" ? "selected" : "" ?>>Casual</option>
            <option value="Formal" <?= $item['occasion'] == "Formal" ? "selected" : "" ?>>Formal</option>
            <option value="Festive" <?= $item['occasion'] == "Festive" ? "selected" : "" ?>>Festive</option>
        </select>

        <button type="submit">Update Item</button>
    </form>

    <a class="back-link" href="view-items.php">← Back to Your Items</a>
</div>

</body>
</html>
