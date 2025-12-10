<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", sans-serif;
            background: #f5f5f5;
        }

        .container {
            width: 400px;
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

        .input {
            width: 100%;
            padding: 12px;
            margin-bottom: 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.2s;
        }

        .btn:hover {
            background: #555;
        }

        a {
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }

        .small {
            margin-top: 12px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Create Account</h2>

    <form id="signupForm" action="signup-handler.php" method="POST">
        <input type="text" name="name" class="input" placeholder="Full Name" required>
        <input type="email" name="email" class="input" placeholder="Email" required>
        <input type="password" name="password" id="password" class="input" placeholder="Password" required>

        <button class="btn" type="submit">Sign Up</button>
    </form>

    <p class="small">Already have an account? <a href="login.php">Login</a></p>
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
