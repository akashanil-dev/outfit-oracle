<?php
session_start();
require 'db.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (
    isset($_POST['dress_type']) &&
    isset($_POST['dress_name']) &&
    isset($_POST['color']) &&
    isset($_POST['wash_type']) &&
    isset($_POST['wear_count']) &&
    isset($_POST['occasion'])
) {
    $user_id = $_SESSION['user_id'];

    $dress_type = mysqli_real_escape_string($conn, $_POST['dress_type']);
    $dress_name = mysqli_real_escape_string($conn, $_POST['dress_name']);
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $wash_type = mysqli_real_escape_string($conn, $_POST['wash_type']);
    $wear_count = intval($_POST['wear_count']);
    $occasion = mysqli_real_escape_string($conn, $_POST['occasion']);

    $query = "INSERT INTO clothes (user_id, dress_type, dress_name, color, wash_type, wear_count, occasion)
              VALUES ('$user_id', '$dress_type', '$dress_name', '$color', '$wash_type', '$wear_count', '$occasion')";

    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php?added=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} else {
    echo "Invalid form submission.";
}
?>
