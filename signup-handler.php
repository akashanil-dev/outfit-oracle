<?php
include 'db.php';

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Validate password length
if (strlen($password) < 6) {
    die("Password must be at least 6 characters long.");
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if email already exists
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    header("Location: signup.php?error=email_exists");
    exit();
}

// Insert into database
$query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

if (mysqli_query($conn, $query)) {
    header("Location: dashboard.php?signup=success");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
