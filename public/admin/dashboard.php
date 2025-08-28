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
<body class="container py-5">
<h2 class="mb-4">Admin Dashboard</h2>
<a href="../index.php" class="btn btn-secondary mb-3">Homepage</a>

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
</body>
</html>
