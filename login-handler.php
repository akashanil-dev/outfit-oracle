<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Get user
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($query) == 1) {
    $user = mysqli_fetch_assoc($query);

    // Verify password
    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        header("Location: dashboard.php");  
        exit;
    } else {
        echo "Incorrect password.";
    }

} else {
    echo "No account found with this email.";
}
?>
