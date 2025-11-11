<?php /* Shared header + navbar */ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>SQL Injection Lab</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root { --card-radius: 14px; }
body { background: linear-gradient(120deg,#f6f9ff,#eef6f8); min-height:100vh; }
.card { border-radius: var(--card-radius); box-shadow: 0 10px 26px rgba(20,50,80,0.10); }
nav.navbar { background:#fff; box-shadow:0 8px 24px rgba(30,60,90,0.06); }
.brand { font-weight:800; letter-spacing:.3px; }
</style>
</head>
<body>
<nav class="navbar navbar-expand-md mb-4">
<div class="container">
<a class="navbar-brand brand" href="/index.php">SQLi Lab</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbars">
<ul class="navbar-nav ms-auto">
<li class="nav-item"><a class="nav-link" href="/login_vuln.php">Login (Vuln)</a></li>
<li class="nav-item"><a class="nav-link" href="/login_fix.php">Login (Fixed)</a></li>
<li class="nav-item"><a class="nav-link" href="/search_vuln.php">Search (Vuln)</a></li>
<li class="nav-item"><a class="nav-link" href="/search_fix.php">Search (Fixed)</a></li>
<li class="nav-item"><a class="nav-link" href="/search_vuln_union.php">UNION Demo</a></li>
<li class="nav-item"><a class="nav-link" href="/search_vuln_time.php">Time-based Demo</a></li>
<li class="nav-item"><a class="nav-link" href="/dashboard_logs.php">Logs</a></li>
</ul>
</div>
</div>
</nav>
<div class="container py-4">