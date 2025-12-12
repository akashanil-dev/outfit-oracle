<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    :root {
        --bg1:#f3f4f6;
        --bg2:#e9eaee;
        --card:#ffffff;
        --accent:#111;
        --accent-light:#444;
        --muted:#666;
        --radius:14px;
    }

    body {
        margin:0;
        font-family: system-ui, "Segoe UI", sans-serif;
        background: linear-gradient(135deg, var(--bg1), var(--bg2));
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
        padding:20px;
    }

    .container {
        width:min(420px,100%);
        padding:28px;
        background:var(--card);
        border-radius:var(--radius);
        text-align:center;
        box-shadow:0 8px 24px rgba(0,0,0,0.08);
        animation: fadeUp .45s ease both;
    }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(10px); }
        to   { opacity:1; transform:translateY(0); }
    }

    h2 {
        margin:0 0 10px;
        color:var(--accent);
        font-size:1.45rem;
        font-weight:700;
    }

    .welcome {
        color:var(--muted);
        margin-bottom:22px;
        font-size:1rem;
    }

    .btn {
        display:block;
        width:100%;
        padding:12px;
        margin-top:12px;
        text-decoration:none;
        border-radius:10px;
        font-weight:600;
        font-size:16px;
        transition:0.25s;
        box-sizing:border-box;
    }

    .btn.primary {
        background:var(--accent);
        color:#fff;
    }
    .btn.primary:hover {
        background:var(--accent-light);
        transform:translateY(-2px);
    }

    .btn.secondary {
        background:#fafafa;
        border:1px solid #ddd;
        color:var(--accent);
    }
    .btn.secondary:hover {
        background:#f1f1f1;
        transform:translateY(-2px);
    }

    .btn.danger {
        background:#e04545;
        color:#fff;
    }
    .btn.danger:hover {
        background:#c93737;
        transform:translateY(-2px);
    }
</style>
</head>

<body>

<div class="container">
    <h2>Welcome, <?= htmlspecialchars($user_name) ?> 👋</h2>
    <p class="welcome">What would you like to do today?</p>

    <a href="add.php" class="btn primary">➕ Add Wardrobe Item</a>
    <a href="view-items.php" class="btn secondary">📦 View All Items</a>
    <a href="logout.php" class="btn danger">🚪 Logout</a>
</div>

</body>
</html>
