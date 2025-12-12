<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Wardrobe Manager</title>

  <style>
    :root {
      --bg1:#f3f4f6;
      --bg2:#e9eaee;
      --card:#ffffff;
      --accent:#111;
      --muted:#666;
      --radius:12px;
      --pad:22px;
    }

    html,body { height:100%; margin:0; }

    body {
      font-family: system-ui, "Segoe UI", Roboto, Arial;
      background: linear-gradient(135deg, var(--bg1), var(--bg2));
      display:flex;
      align-items:center;
      justify-content:center;
      padding:24px;
      color:var(--accent);
    }

    .card {
      width:min(380px,100%);
      background:var(--card);
      border-radius:var(--radius);
      padding:calc(var(--pad) + 6px);
      text-align:center;
      box-shadow:0 8px 22px rgba(0,0,0,0.07);
      animation: fadeUp .5s ease both;
    }

    /* Simple entrance animation */
    @keyframes fadeUp {
      from { opacity:0; transform: translateY(12px); }
      to   { opacity:1; transform: translateY(0); }
    }

    .logo {
      font-size:32px;
      margin-bottom:12px;
      opacity:0.9;
      user-select:none;
    }

    h1 {
      margin:0 0 6px;
      font-size:1.4rem;
      font-weight:700;
      letter-spacing:0.3px;
    }

    p.lead {
      margin:0 0 18px;
      color:var(--muted);
      font-size:.93rem;
      line-height:1.45;
    }

    .btn {
      display:block;
      width:100%;
      padding:12px;
      border-radius:9px;
      text-decoration:none;
      text-align:center;
      font-weight:600;
      cursor:pointer;
      box-sizing:border-box;
      margin-top:12px;
      border:0;
      transition:0.25s;
    }

    .btn.primary {
      background:var(--accent);
      color:#fff;
    }
    .btn.primary:hover {
      background:#333;
      transform:translateY(-2px);
    }

    .btn.secondary {
      background:#fff;
      border:1px solid rgba(0,0,0,0.08);
      color:var(--accent);
    }
    .btn.secondary:hover {
      background:#f0f0f0;
      transform:translateY(-2px);
    }

    @media (max-width:360px) {
      .card { padding:16px; }
      h1 { font-size:1.2rem; }
    }
  </style>
</head>

<body>
  <main class="card" role="main" aria-labelledby="title">
    <div class="logo">👕</div>

    <h1 id="title">Wardrobe Manager</h1>
    <p class="lead">
      Your outfits, organized. Track what you own,<br>
      simplify choices, and keep things effortless.
    </p>

    <a class="btn primary" href="login.php" role="button">Login</a>
    <a class="btn secondary" href="signup.php" role="button">Create Account</a>
  </main>
</body>
</html>
