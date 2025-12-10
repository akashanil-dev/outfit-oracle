<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
    <h2>Login</h2>

    <form action="login-handler.php" method="POST">
        <input type="email" name="email" class="input" placeholder="Email" required>
        <input type="password" name="password" class="input" placeholder="Password" required>

        <button class="btn" type="submit">Login</button>
    </form>

    <p class="small">Don't have an account? <a href="signup.php">Create one</a></p>
</div>

</body>
</html>
