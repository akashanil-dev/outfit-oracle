<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Add Clothing Item</title>

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
  <h2>Add Clothing Item</h2>
  <p class="sub">Fill in the details to add a new piece to your wardrobe.</p>

  <form id="addForm" action="add-handler.php" method="POST">
    
    <div class="full">
      <label for="dress_type">Dress Type</label>
      <select name="dress_type" id="dress_type">
        <option value="">— Choose type —</option>
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

    <div>
      <label for="dress_name">Dress Name</label>
      <input type="text" id="dress_name" name="dress_name">
    </div>

    <div>
      <label for="color">Color</label>
      <input type="text" id="color" name="color">
    </div>

    <div>
      <label for="wash_type">Wash Type</label>
      <select id="wash_type" name="wash_type">
        <option value="">— Select wash —</option>
        <option>Hand Wash</option>
        <option>Machine Wash</option>
        <option>Both</option>

      </select>
    </div>

    <div>
      <label for="wear_count">Wear Count</label>
      <input type="number" id="wear_count" name="wear_count" min="0" value="0">
    </div>

    <div class="full">
      <label for="occasion">Occasion</label>
      <select id="occasion" name="occasion">
        <option value="">— Select occasion —</option>
        <option>Casual</option>
        <option>Formal</option>
        <option>Festive</option>
      </select>
    </div>

    <div class="actions full">
      <button type="submit" class="btn primary">➕ Add Item</button>
      <a href="dashboard.php" class="btn ghost">← Back</a>
    </div>

  </form>
</main>

<script>
/* Basic form validation for add item form */
document.getElementById('addForm').addEventListener('submit', function(e) {
  const dressType = document.getElementById('dress_type').value.trim();
  const dressName = document.getElementById('dress_name').value.trim();
  const color = document.getElementById('color').value.trim();
  const washType = document.getElementById('wash_type').value.trim();
  const wearCountRaw = document.getElementById('wear_count').value;
  const occasion = document.getElementById('occasion').value.trim();

  // 1. Dress type selected
  if (dressType === '') {
    alert('Please choose a dress type.');
    e.preventDefault();
    return;
  }

  // 2. Dress name not empty
  if (dressName.length === 0) {
    alert('Please enter a dress name.');
    e.preventDefault();
    return;
  }

  // 3. Color not empty
  if (color.length === 0) {
    alert('Please enter a color.');
    e.preventDefault();
    return;
  }

  // 4. Wash type selected
  if (washType === '') {
    alert('Please select a wash type.');
    e.preventDefault();
    return;
  }

  // 5. Wear count is a non-negative integer
  const wearCount = Number(wearCountRaw);
  if (!Number.isFinite(wearCount) || isNaN(wearCount) || wearCount < 0) {
    alert('Please enter a valid wear count (0 or greater).');
    e.preventDefault();
    return;
  }

  // 6. Occasion selected
  if (occasion === '') {
    alert('Please select an occasion.');
    e.preventDefault();
    return;
  }

  // All checks passed → form will submit
});
</script>

</body>
</html>
