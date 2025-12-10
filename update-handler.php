<?php
session_start();
require 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if required POST data exists
if (
    isset($_POST['id']) &&
    isset($_POST['dress_type']) &&
    isset($_POST['dress_name']) &&
    isset($_POST['color']) &&
    isset($_POST['wash_type']) &&
    isset($_POST['wear_count']) &&
    isset($_POST['occasion'])
) {
    $user_id = $_SESSION['user_id'];
    $item_id = intval($_POST['id']);

    // Sanitize inputs
    $dress_type = mysqli_real_escape_string($conn, $_POST['dress_type']);
    $dress_name = mysqli_real_escape_string($conn, $_POST['dress_name']);
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $wash_type = mysqli_real_escape_string($conn, $_POST['wash_type']);
    $wear_count = intval($_POST['wear_count']);
    $occasion = mysqli_real_escape_string($conn, $_POST['occasion']);

    // Update query
    $query = "UPDATE clothes 
              SET dress_type='$dress_type', 
                  dress_name='$dress_name', 
                  color='$color', 
                  wash_type='$wash_type', 
                  wear_count='$wear_count', 
                  occasion='$occasion'
              WHERE id='$item_id' AND user_id='$user_id'";

    if (mysqli_query($conn, $query)) {
        header("Location: view-items.php?updated=1");
        exit();
    } else {
        echo "Error updating item: " . mysqli_error($conn);
    }

} else {
    echo "Invalid form submission.";
}
?>
