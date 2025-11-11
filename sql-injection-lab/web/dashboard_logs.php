<?php include "_header.php"; ?>
<?php
$logfile = __DIR__ . "/query_logs.txt";
$lines = file_exists($logfile) ? array_reverse(file($logfile)) : [];
?>
<div class="card p-4 mx-auto" style="max-width:800px;">
<h4 class="mb-3">Query Logs Dashboard</h4>
<p class="small text-muted">Shows recorded SQL queries for analysis / ML demo.</p>
<table class="table table-striped">
<thead><tr><th>Log Entry</th></tr></thead>
<tbody>
<?php foreach ($lines as $line): ?>
<tr><td><?= htmlspecialchars($line) ?></td></tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php include "_footer.php"; ?>