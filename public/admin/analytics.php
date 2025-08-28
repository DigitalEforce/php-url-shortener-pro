<?php
include '../../app/config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Fetch URL stats (total clicks per URL)
$urls = $pdo->query("
    SELECT u.id, u.short_code, u.original_url, u.clicks
    FROM urls u
")->fetchAll(PDO::FETCH_ASSOC);

// Fetch clicks per day for chart
$clicksByDate = $pdo->query("
    SELECT DATE(clicked_at) as date, COUNT(*) as clicks
    FROM clicks
    GROUP BY DATE(clicked_at)
    ORDER BY DATE(clicked_at) ASC
")->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for Chart.js
$chartLabels = [];
$chartData = [];
foreach ($clicksByDate as $row) {
    $chartLabels[] = $row['date'];
    $chartData[] = $row['clicks'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Analytics</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <h2>URL Analytics Dashboard</h2>
    <hr>

    <h4>All URLs & Total Clicks</h4>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Short Code</th>
                <th>Original URL</th>
                <th>Total Clicks</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($urls as $url): ?>
            <tr>
                <td><?= htmlspecialchars($url['short_code']) ?></td>
                <td><?= htmlspecialchars($url['original_url']) ?></td>
                <td><?= $url['clicks'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="mt-5">Clicks Over Time</h4>
    <canvas id="clickChart" height="100"></canvas>
</div>

<script>
const ctx = document.getElementById('clickChart').getContext('2d');
const clickChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($chartLabels) ?>,
        datasets: [{
            label: 'Clicks per Day',
            data: <?= json_encode($chartData) ?>,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: true,
            tension: 0.2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
</body>
</html>
