<?php
require_once 'config.php';
require_once 'logger.php';
session_start();

$error = '';
$success = '';

$valid_creds = [
  ['username' => 'teacher', 'password' => 'teach123'],
  ['username' => 'demo', 'password' => 'demo123']
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';

    // First: allow a couple of hard-coded valid credentials (for demo)
    foreach ($valid_creds as $c) {
        if ($u === $c['username'] && $p === $c['password']) {
            $_SESSION['user'] = $u;
            $success = "Logged in as (builtin) " . htmlspecialchars($u);
            // also log the successful auth (labelled)
            if (function_exists('log_query')) log_query('LOGIN_VULN_BUILTIN', "builtin-login", [$u]);
            break;
        }
    }

    // If not matched builtin creds, run the intentionally vulnerable DB check
    if (empty($success)) {
        try {
            // vulnerable: concatenates user input into SQL (for lab only)
            $pdo = get_db_conn();
            $sql = "SELECT * FROM users WHERE username = '$u' AND password = '$p' LIMIT 1";
            if (function_exists('log_query')) log_query('LOGIN_VULN', $sql);
            $stmt = $pdo->query($sql);
            $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
            if ($row) {
                $_SESSION['user'] = $row['username'];
                $success = "Logged in as " . htmlspecialchars($row['username']);
            } else {
                $error = "Invalid credentials";
            }
        } catch (Exception $e) {
            $error = "DB conn failed: " . $e->getMessage();
        }
    }
}
?>
<?php include '_header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card p-4">
      <h4 class="text-center mb-3">Vulnerable Login (for demo)</h4>

      <?php if($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
      <?php if($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

      <form method="post" novalidate>
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input name="username" class="form-control" placeholder="e.g. admin">
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input name="password" class="form-control" placeholder="Try: ' OR '1'='1">
          
        </div>
        <div class="d-grid mt-3">
          <button class="btn btn-primary">Login</button>
        </div>
      </form>

      <hr/>
      <div class="small text-muted text-center">
        Try the vulnerable login or visit <a href="/search_vuln.php">search demo</a>
      </div>
    </div>
  </div>
</div>
<?php include '_footer.php'; ?>
