<?php
require_once 'config.php';
require_once 'logger.php';

$q = $_GET['q'] ?? '';
$msg = '';
$start = microtime(true);

try {
    $pdo = get_db_conn();
    // Vulnerable query (SQLite) - equality check
    $sql = "SELECT id FROM products WHERE name = '$q' LIMIT 1";
    log_query('SEARCH_VULN_TIME', $sql);
    // If query string contains "SLEEP(" (detected as demo payload), simulate DB sleep here
    if (stripos($q, 'SLEEP(') !== false) {
        // simulate a DB-side delay (demo only)
        sleep(3);
    } else {
        // run the harmless SELECT (may return nothing)
        @$pdo->query($sql);
    }
} catch (Exception $e) { $msg = $e->getMessage(); }
$elapsed = microtime(true) - $start;
?>
<?php include "_header.php"; ?>
<div class="card p-4 mx-auto" style="max-width:900px;">
  <h4 class="mb-3">Time-based Blind SQLi Demo (SIMULATED for SQLite)</h4>
  <form>
    <input name="q" class="form-control mb-3" placeholder="Try payload that includes SLEEP(...) marker" value="<?= htmlspecialchars($q) ?>">
    <button class="btn btn-primary w-100">Run</button>
  </form>
  <hr>
  <?php if($msg): ?><div class="alert alert-danger">DB Error: <?= htmlspecialchars($msg) ?></div><?php endif; ?>
  <p>Elapsed: <strong><?= number_format($elapsed,3) ?>s</strong></p>
  <?php if($elapsed > 2.0): ?><div class="alert alert-success">Delay detected — simulated time-based injection success.</div><?php endif; ?>
  <div class="small text-muted">Note: SQLite has no SLEEP(). We simulate delay in PHP for demo purposes only.</div>
</div>
<?php include "_footer.php"; ?>
