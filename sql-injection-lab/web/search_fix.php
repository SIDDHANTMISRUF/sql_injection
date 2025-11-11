<?php
$q = $_GET['q'] ?? '';
$rows = [];
try {
    $pdo = new PDO('mysql:host=db;dbname=sqli_lab;charset=utf8mb4', 'sqli_user', 'sqli_pass');
    $stmt = $pdo->prepare("SELECT name,description FROM products WHERE name LIKE ?");
    $stmt->execute(["%$q%"]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $error = $e->getMessage(); }
?>
<?php include "_header.php"; ?>
<div class="card p-4 mx-auto" style="max-width:700px;">
  <h4 class="mb-3">Search (SECURE)</h4>

  <form>
    <input name="q" class="form-control mb-3" value="<?= htmlspecialchars($q) ?>">
    <button class="btn btn-success w-100">Search</button>
  </form>

  <hr>
  <?php foreach ($rows as $r): ?>
    <p><strong><?= htmlspecialchars($r['name']) ?></strong><br><?= htmlspecialchars($r['description']) ?></p>
  <?php endforeach; ?>
</div>
<?php include "_footer.php"; ?>
