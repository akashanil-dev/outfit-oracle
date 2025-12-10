<!DOCTYPE html>
<html>
<head>
    <title>Wardrobe Manager</title>
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

        h1 {
            margin-bottom: 20px;
            color: #333;
            font-size: 28px;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            background: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.2s;
            font-size: 16px;
        }

        .btn:hover {
            background: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Wardrobe Manager</h1>
        <a class="btn" href="login.php">Login</a>
        <a class="btn" href="signup.php">Sign Up</a>
    </div>

</body>
</html>
