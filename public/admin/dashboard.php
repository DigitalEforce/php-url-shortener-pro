<?php
require '../../app/config.php';
require '../../app/auth.php';
require '../../app/UrlShortener.php';
require '../../app/Analytics.php';

// Protect admin page
requireAdmin();

$shortener = new UrlShortener($pdo);
$analytics = new Analytics($pdo);

$stmt = $pdo->query("SELECT urls.*, users.username FROM urls LEFT JOIN users ON urls.user_id=users.id ORDER BY created_at DESC");
$urls = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body { font-family:'Poppins',sans-serif; background:#f8f9fa; }
.card { padding:2rem; border-radius:15px; margin-top:20px; box-shadow:0 10px 25px rgba(0,0,0,0.1);}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">URL Shortener Admin</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="analytics.php">Analytics</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container py-5">
<h2>Dashboard</h2>
<div class="card">
<table class="table table-striped table-hover">
<thead class="table-dark">
<tr>
<th>User</th>
<th>Original URL</th>
<th>Short URL</th>
<th>Clicks</th>
<th>Created At</th>
</tr>
</thead>
<tbody>
<?php foreach($urls as $u): ?>
<tr>
<td><?= $u['username']?:'Guest' ?></td>
<td><?= $u['original_url'] ?></td>
<td><a href="../r/<?= $u['custom_alias']?:$u['short_code'] ?>" target="_blank"><?= $u['custom_alias']?:$u['short_code'] ?></a></td>
<td><?= $u['clicks'] ?></td>
<td><?= $u['created_at'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</body>
</html>
