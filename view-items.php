<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int) $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT id, dress_type, dress_name, color, wash_type, wear_count, occasion FROM clothes WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Your Wardrobe</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
/* same style as before, shortened here for clarity */
:root{
  --bg1:#f3f4f6; --bg2:#e9eaee; --card:#fff;
  --accent:#2b2b2b; --muted:#666; --radius:14px;
}
body{
  margin:0; font-family:system-ui; background:linear-gradient(135deg,var(--bg1),var(--bg2));
  padding:28px; color:var(--accent);
}
.wrapper{ max-width:1150px; margin:0 auto; }
header{
  display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;
}
h1{ margin:0; font-size:1.35rem; }
.lead{ margin:4px 0 0; color:var(--muted); }

.btn{
  padding:8px 14px; border-radius:10px; text-decoration:none; font-weight:600;
  display:inline-block; font-size:14px; border:0; transition:.25s;
}
.btn.ghost{ border:1px solid #ddd; background:#fff; }
.btn.ghost:hover{ background:#f1f1f1; }
.btn.success{ background:#4CAF50; color:white; }
.btn.success:hover{ background:#3f9644; }

.grid{
  display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:20px; margin-top:16px;
}
.card{
  background:var(--card); border-radius:var(--radius); padding:18px;
  box-shadow:0 8px 22px rgba(0,0,0,0.06); animation:fadeUp .35s ease both;
}
@keyframes fadeUp{ from{opacity:0; transform:translateY(12px);} to{opacity:1; transform:none;} }

.card-icon{ font-size:34px; margin-bottom:8px; }
.card h3{ margin:0; font-size:1.1rem; font-weight:600; }
.card small{ display:block; color:var(--muted); margin-bottom:10px; }
.info{ font-size:.9rem; line-height:1.45; margin-bottom:14px; }

.actions{ display:flex; gap:8px; }
.btn.edit{ background:#eee; color:var(--accent); }
.btn.edit:hover{ background:#e3e3e3; }
.btn.delete{ background:#e04545; color:white; }
.btn.delete:hover{ background:#c73737; }

.filter-box{
  margin-top:10px;
  display:flex;
  gap:10px;
  align-items:center;
}
.filter-select{
  padding:8px 12px; border-radius:8px;
  border:1px solid #ccc; background:white; font-size:14px;
}
</style>
</head>
<body>

<div class="wrapper">

  <header>
    <div>
      <h1>Your Wardrobe</h1>
      <p class="lead">A clean overview of everything you own.</p>
    </div>
    <div>
      <a href="dashboard.php" class="btn ghost">← Dashboard</a>
      <a href="add.php" class="btn success">➕ Add Item</a>
    </div>
  </header>

  <!-- ⭐ FILTER DROPDOWN ADDED HERE -->
  <div class="filter-box">
    <label for="filter" style="font-weight:600;">Filter by Type:</label>
    <select id="filter" class="filter-select">
      <option value="all">All Items</option>
      <option>Shirt</option>
      <option>T-Shirt</option>
      <option>Pants</option>
      <option>Jeans</option>
      <option>Trousers</option>
      <option>Kurta</option>
      <option>Dhothi</option>
      <option>Jubba</option>
      <option>Sweatshirt</option>
      <option>Hoodie</option>
      <option>Jacket</option>
      <option>Tracksuit</option>
    </select>
  </div>
  <!-- END FILTER BOX -->

  <?php if (!empty($items)): ?>

    <div class="grid" id="grid">
      <?php foreach ($items as $row): ?>

        <?php
        // Icons
        $icons = [
            "Shirt"=>"👕","T-Shirt"=>"👚","Pants"=>"👖","Jeans"=>"🩳",
            "Trousers"=>"👖","Kurta"=>"🧥","Dhothi"=>"🩲","Jubba"=>"🧵",
            "Sweatshirt"=>"🧥","Hoodie"=>"🧥","Jacket"=>"🧥","Tracksuit"=>"🎽"
        ];
        $icon = $icons[$row['dress_type']] ?? "👗";
        ?>

        <div class="card" data-type="<?= htmlspecialchars($row['dress_type']) ?>">
          <div class="card-icon"><?= $icon ?></div>

          <h3><?= htmlspecialchars($row['dress_name']) ?></h3>
          <small><?= htmlspecialchars($row['dress_type']) ?></small>

          <div class="info">
            <b>Color:</b> <?= htmlspecialchars($row['color']) ?><br>
            <b>Wash:</b> <?= htmlspecialchars($row['wash_type']) ?><br>
            <b>Wear Count:</b> <?= (int) $row['wear_count'] ?><br>
            <b>Occasion:</b> <?= htmlspecialchars($row['occasion']) ?>
          </div>

          <div class="actions">
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn edit">Edit</a>
            <a href="delete.php?id=<?= $row['id'] ?>" class="btn delete" onclick="return confirm('Delete this item?')">Delete</a>
          </div>
        </div>

      <?php endforeach; ?>
    </div>

  <?php else: ?>
    <p style="text-align:center; margin-top:30px; color:var(--muted); font-size:1.1rem;">
      No items found.<br><br>
      <a href="add.php" class="btn success">➕ Add one now</a>
    </p>
  <?php endif; ?>

</div>

<script>
/* ⭐ JS FILTER FUNCTION */
const filter = document.getElementById("filter");
const cards = document.querySelectorAll(".card");

filter.addEventListener("change", () => {
  const selected = filter.value;

  cards.forEach(card => {
    const type = card.getAttribute("data-type");

    if (selected === "all" || type === selected) {
      card.style.display = "block";
      card.style.opacity = "1";
    } else {
      card.style.display = "none";
      card.style.opacity = "0";
    }
  });
});
</script>

</body>
</html>
