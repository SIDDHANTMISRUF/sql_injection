<?php
$q = $_GET['q'] ?? '';
$rows = [];
try {
$pdo = new PDO('mysql:host=db;dbname=sqli_lab;charset=utf8mb4', 'sqli_user', 'sqli_pass');
// Intentionally vulnerable for lab
$sql = "SELECT name,description FROM products WHERE name LIKE '%$q%'";
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $error = $e->getMessage(); }
?>
<?php include "_header.php"; ?>
<div class="card p-4 mx-auto" style="max-width:800px;">
<h4 class="mb-3">Search (VULNERABLE)</h4>
<form>
<input name="q" class="form-control mb-3" placeholder="Try: %' OR 1=1 --" value="<?= htmlspecialchars($q) ?>">
<button class="btn btn-primary w-100">Search</button>
</form>
<hr>
<?php if(!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<?php foreach ($rows as $r): ?>
<div class="mb-2"><strong><?= htmlspecialchars($r['name']) ?></strong><br><?= htmlspecialchars($r['description']) ?></div>
<?php endforeach; ?>
</div>
<?php include "_footer.php"; ?>