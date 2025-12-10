<?php
session_start();
require 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: view-items.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$item_id = intval($_GET['id']);

// Ensure the item belongs to the user
$query = "DELETE FROM clothes WHERE id='$item_id' AND user_id='$user_id'";
if (mysqli_query($conn, $query)) {
    header("Location: view-items.php?deleted=1");
    exit();
} else {
    echo "Error deleting item: " . mysqli_error($conn);
}
?>
