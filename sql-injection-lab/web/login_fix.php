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

    // allow built-in demo credentials first
    foreach ($valid_creds as $c) {
        if ($u === $c['username'] && $p === $c['password']) {
            $_SESSION['user'] = $u;
            $success = "Logged in as (builtin) " . htmlspecialchars($u);
            if (function_exists('log_query')) log_query('LOGIN_FIX_BUILTIN', 'builtin-login', [$u]);
            break;
        }
    }

    // if not builtin, proceed with secure DB check (prepared stmt)
    if (empty($success)) {
        try {
            $pdo = get_db_conn();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1");
            if (function_exists('log_query')) log_query('LOGIN_FIX', 'SELECT * FROM users WHERE username = ? AND password = ?', [$u,$p]);
            $stmt->execute([$u, $p]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $_SESSION['user'] = $row['username'];
                $success = "Logged in as " . htmlspecialchars($row['username']);
            } else {
                $error = "Invalid credentials";
            }
        } catch (Exception $e) {
            $error = "DB Error: " . $e->getMessage();
        }
    }
}
?>
<?php include "_header.php"; ?>
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card p-4">
      <h4 class="text-center mb-3">Secure Login (Prepared Statements)</h4>
      <?php if($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
      <?php if($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
      <form method="post">
        <label class="form-label">Username</label>
        <input class="form-control mb-3" name="username" required>
        <label class="form-label">Password</label>
        <input class="form-control mb-3" name="password" required>
        <button class="btn btn-success w-100">Login</button>
      </form>
    </div>
  </div>
</div>
<?php include "_footer.php"; ?>
