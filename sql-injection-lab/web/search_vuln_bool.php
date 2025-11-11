<?php
// search_vuln_bool.php - boolean-based SQLi demo
$q = $_GET['q'] ?? '';
$results = [];
$msg = '';
try {
    $pdo = new PDO('mysql:host=db;dbname=sqli_lab;charset=utf8mb4', 'sqli_user', 'sqli_pass');
    // intentionally vulnerable - no param binding
    $sql = "SELECT id,name,description FROM products WHERE name LIKE '%$q%'";
    $rows = $pdo->query($sql);
    if ($rows) {
        foreach ($rows as $r) $results[] = $r;
    }
} catch (Exception $e) {
    $msg = "DB error: " . $e->getMessage();
}
?>
<!doctype html><html><head><title>Search boolean vuln</title></head><body>
<h2>Search (vulnerable)</h2>
<form method="get"><input name="q" value="<?php echo htmlspecialchars($q); ?>"><button>Search</button></form>
<?php if($msg) echo "<div style='color:red'>$msg</div>"; ?>
<ul>
<?php foreach($results as $r): ?>
  <li><?php echo htmlspecialchars($r['name'])." - ".htmlspecialchars($r['description']); ?></li>
<?php endforeach; ?>
</ul>
</body></html>
