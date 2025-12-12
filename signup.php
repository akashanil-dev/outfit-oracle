<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    :root {
        --accent: #2b2b2b;      /* main color */
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
    <h2>Create Account</h2>
    <p class="tagline">Join your wardrobe journey</p>

    <form id="signupForm" action="signup-handler.php" method="POST">
        <input type="text" name="name" class="input" placeholder="Full Name" required>
        <input type="email" name="email" class="input" placeholder="Email" required>
        <input type="password" name="password" id="password" class="input" placeholder="Password" required>

        <button class="btn" type="submit">Sign Up</button>
    </form>

    <p class="small">
        Already have an account? <a href="login.php">Login</a>
    </p>
</div>

<script>
document.getElementById('signupForm').addEventListener('submit', function(e){
    const pwd = document.getElementById('password').value;
    if(pwd.length < 6){
        alert("Password must be at least 6 characters long.");
        e.preventDefault();
    }
});
</script>

</body>
</html>
