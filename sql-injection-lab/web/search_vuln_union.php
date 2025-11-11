<?php
$q = $_GET['q'] ?? '';
$rows = [];
try {
$pdo = new PDO('mysql:host=db;dbname=sqli_lab;charset=utf8mb4', 'sqli_user', 'sqli_pass');
$sql = "SELECT id,name FROM products WHERE name LIKE '%$q%'";
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $err = $e->getMessage(); }
?>
<?php include "_header.php"; ?>
<div class="card p-4 mx-auto" style="max-width:700px;">
<h4 class="mb-3">UNION-based SQL Injection (Vulnerable)</h4>
<form>
<input name="q" class="form-control mb-3" placeholder="Try: %' UNION SELECT username,password FROM users -- " value="<?= htmlspecialchars($q) ?>">
<button class="btn btn-primary w-100">Search</button>
</form>
<hr>
<?php foreach ($rows as $r): ?>
<p><strong><?= htmlspecialchars($r['id']) ?></strong> — <?= htmlspecialchars($r['name']) ?></p>
<?php endforeach; ?>
</div>
<?php include "_footer.php"; ?>