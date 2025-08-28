<?php
include '../../app/config.php';

// Redirect to login if not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Fetch summary stats
$totalUrls = $pdo->query("SELECT COUNT(*) FROM urls")->fetchColumn();
$totalClicks = $pdo->query("SELECT COUNT(*) FROM clicks")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

<div class="container mt-5">
    <h2>Welcome, Admin</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
              <div class="card-header">Total URLs</div>
              <div class="card-body">
                <h5 class="card-title"><?= $totalUrls ?></h5>
              </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
              <div class="card-header">Total Clicks</div>
              <div class="card-body">
                <h5 class="card-title"><?= $totalClicks ?></h5>
              </div>
            </div>
        </div>
    </div>

    <p class="mt-4">Use the <strong>Analytics</strong> tab to see detailed click statistics.</p>
</div>

</body>
</html>
