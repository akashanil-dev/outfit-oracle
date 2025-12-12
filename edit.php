<?php
session_start();
require 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if id is provided
if (!isset($_GET['id'])) {
    header("Location: view-items.php");
    exit();
}

$item_id = intval($_GET['id']);

// Fetch item
// Use prepared statement for safety
$stmt = $conn->prepare("SELECT * FROM clothes WHERE id = ? AND user_id = ? LIMIT 1");
$stmt->bind_param("ii", $item_id, $user_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows !== 1) {
    echo "Item not found or you don't have permission to edit it.";
    exit();
}

$item = $res->fetch_assoc();
$stmt->close();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Edit Clothing Item</title>

<style>
  :root{
    --bg1:#f3f4f6;
    --bg2:#eceef1;
    --card:#fff;
    --accent:#2b2b2b;
    --accent-light:#444;
    --muted:#6b6b6b;
    --radius:14px;
    --pad:20px;
  }

  *,*::before,*::after{box-sizing:border-box}

  html,body{height:100%;margin:0}
  body{
    font-family: system-ui, "Segoe UI", Roboto, Arial;
    background: linear-gradient(135deg,var(--bg1),var(--bg2));
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
    color:var(--accent);
  }

  .card{
    width:min(520px,100%);
    background:var(--card);
    border-radius:var(--radius);
    padding:calc(var(--pad) + 6px);
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    animation:fadeUp .38s ease both;
  }

  @keyframes fadeUp{
    from{opacity:0;transform:translateY(10px)}
    to{opacity:1;transform:none}
  }

  h2{
    margin:0 0 8px;
    font-size:1.3rem;
    letter-spacing:0.3px;
  }

  .sub{
    margin:0 0 18px;
    color:var(--muted);
    font-size:.95rem;
  }

  form{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap:12px;
  }

  .full{ grid-column:1 / -1 }

  label{
    display:block;
    font-size:13px;
    color:var(--muted);
    margin-bottom:6px;
  }

  input, select{
    width:100%;
    padding:10px 12px;
    border-radius:8px;
    border:1px solid #ddd;
    background:#fff;
    font-size:14px;
  }

  .actions{
    margin-top:14px;
    display:flex;
    gap:10px;
  }

  .btn{
    flex:1;
    padding:11px 14px;
    border-radius:9px;
    font-weight:600;
    cursor:pointer;
    font-size:15px;
    text-decoration:none;
    text-align:center;
    border:0;
    transition:0.25s;
  }

  .btn.primary{
    background:var(--accent);
    color:#fff;
  }
  .btn.primary:hover{
    background:var(--accent-light);
    transform:translateY(-2px);
  }

  .btn.ghost{
    background:transparent;
    border:1px solid #ddd;
    color:var(--accent);
  }
  .btn.ghost:hover{
    background:#f1f1f1;
    transform:translateY(-2px);
  }

  @media (max-width:680px){
    form{ grid-template-columns:1fr; }
  }
</style>
</head>

<body>
<main class="card">
  <h2>Edit Clothing Item</h2>
  <p class="sub">Update the details for this item and save your changes.</p>

  <form action="update-handler.php" method="POST">
    <!-- Hidden field to send item id -->
    <input type="hidden" name="id" value="<?= (int)$item['id'] ?>" />

    <div class="full">
      <label for="dress_type">Dress Type</label>
      <select name="dress_type" id="dress_type" required>
        <option value="">— Choose type —</option>
        <?php
        $types = ["Shirt","T-Shirt","Pants","Jeans","Trousers","Kurta","Dhothi","Jubba","Sweatshirt","Hoodie","Jacket","Tracksuit"];
        foreach ($types as $type) {
            $sel = ($item['dress_type'] === $type) ? 'selected' : '';
            echo '<option value="'.htmlspecialchars($type).'" '.$sel.'>'.htmlspecialchars($type).'</option>';
        }
        ?>
      </select>
    </div>

    <div>
      <label for="dress_name">Dress Name</label>
      <input type="text" id="dress_name" name="dress_name" value="<?= htmlspecialchars($item['dress_name']) ?>" required>
    </div>

    <div>
      <label for="color">Color</label>
      <input type="text" id="color" name="color" value="<?= htmlspecialchars($item['color']) ?>" required>
    </div>

    <div>
      <label for="wash_type">Wash Type</label>
      <select id="wash_type" name="wash_type" required>
        <option value="">— Select wash —</option>
        <option value="Hand Wash" <?= $item['wash_type'] === "Hand Wash" ? 'selected' : '' ?>>Hand Wash</option>
        <option value="Machine Wash" <?= $item['wash_type'] === "Machine Wash" ? 'selected' : '' ?>>Machine Wash</option>
        <option value="Both" <?= $item['wash_type'] === "Both" ? 'selected' : '' ?>>Both</option>
      </select>
    </div>

    <div>
      <label for="wear_count">Wear Count</label>
      <input type="number" id="wear_count" name="wear_count" min="0" value="<?= (int)$item['wear_count'] ?>" required>
    </div>

    <div class="full">
      <label for="occasion">Occasion</label>
      <select id="occasion" name="occasion" required>
        <option value="">— Select occasion —</option>
        <option value="Casual" <?= $item['occasion'] === "Casual" ? 'selected' : '' ?>>Casual</option>
        <option value="Formal" <?= $item['occasion'] === "Formal" ? 'selected' : '' ?>>Formal</option>
        <option value="Festive" <?= $item['occasion'] === "Festive" ? 'selected' : '' ?>>Festive</option>
      </select>
    </div>

    <div class="actions full">
      <button type="submit" class="btn primary">Update Item</button>
      <a href="view-items.php" class="btn ghost">← Back</a>
    </div>
  </form>
</main>
</body>
</html>
