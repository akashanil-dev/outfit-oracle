<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    :root {
        --accent: #2b2b2b;
        --accent-light: #4a4a4a;
        --bg1: #f7f7f7;
        --bg2: #ececec;
    }

    body {
        margin: 0;
        font-family: system-ui, "Segoe UI", sans-serif;
        background: linear-gradient(135deg, var(--bg1), var(--bg2));
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        width: 330px;
        background: #fff;
        padding: 26px;
        border-radius: 14px;
        text-align: center;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    h2 {
        margin: 0 0 6px;
        font-size: 24px;
        color: var(--accent);
        font-weight: 700;
    }

    .tagline {
        margin: 0 0 18px;
        font-size: 14px;
        color: #777;
    }

    .input {
        width: 100%;
        padding: 12px;
        margin-bottom: 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 15px;
        box-sizing: border-box;
        transition: 0.2s;
    }

    .input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 6px rgba(0,0,0,0.07);
        outline: none;
    }

    .btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        background: var(--accent);
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: 0.25s;
    }

    .btn:hover {
        background: var(--accent-light);
        transform: translateY(-2px);
    }

    .small {
        margin-top: 14px;
        font-size: 14px;
        color: #555;
    }

    a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Welcome Back</h2>
    <p class="tagline">Login to your wardrobe</p>

    <form action="login-handler.php" method="POST">
        <input type="email" name="email" class="input" placeholder="Email">
        <input type="password" name="password" class="input" placeholder="Password">
        <button class="btn" type="submit">Login</button>
    </form>

    <p class="small">
        Don't have an account? <a href="signup.php">Create one</a>
    </p>
</div>

<script>
document.querySelector("form").addEventListener("submit", function(e) {

    const email = document.querySelector('input[name="email"]').value.trim();
    const password = document.querySelector('input[name="password"]').value;

    // 1️⃣ Email cannot be empty
    if (email.length === 0) {
        alert("Please enter your email.");
        e.preventDefault();
        return;
    }

    // 2️⃣ Email must be valid format
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        e.preventDefault();
        return;
    }

    // 3️⃣ Password cannot be empty
    if (password.length === 0) {
        alert("Please enter your password.");
        e.preventDefault();
        return;
    }

});
</script>

<?php if (isset($_GET['error'])): ?>
<script>
    <?php if ($_GET['error'] === 'no_account'): ?>
        alert("No account found with this email.");
    <?php elseif ($_GET['error'] === 'wrong_password'): ?>
        alert("Incorrect password. Please try again.");
    <?php endif; ?>
</script>
<?php endif; ?>


</body>
</html>
