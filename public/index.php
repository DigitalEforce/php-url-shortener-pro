<?php
require '../app/config.php';
require '../app/UrlShortener.php';

$shortener = new UrlShortener($pdo);
$shortUrl = '';
if(isset($_POST['original_url'])){
    $shortCode = $shortener->createShortUrl($_POST['original_url'], null);
	$shortUrl = "r/$shortCode";
	
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
	$host = $_SERVER['HTTP_HOST'];
	$basePath = "/php-url-shortener-pro"; // adjust if needed
	$shortUrl = $protocol . "://" . $host . $basePath . "/r/" . $shortCode;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Professional URL Shortener</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<style>
body { background: linear-gradient(135deg,#6a11cb,#2575fc); min-height:100vh; display:flex; justify-content:center; align-items:center; font-family:'Poppins',sans-serif;}
.card { padding:2rem; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.2); max-width:500px; width:100%; text-align:center; background:#fff;}
input { border-radius:50px; padding:0.75rem 1.5rem; margin-bottom:1rem;}
.btn-primary { border-radius:50px; padding:0.75rem 2rem;}
a.admin-link { display:block; margin-top:1rem; color:#2575fc;}
</style>
</head>
<body>
<div class="card">
<h2 class="mb-4">Professional URL Shortener</h2>
<form method="POST">
<input type="url" name="original_url" class="form-control mb-3" placeholder="Enter your long URL" required>
<button type="submit" class="btn btn-primary w-100">Shorten URL</button>
</form>

<?php if($shortUrl): ?>
<div class="alert alert-success mt-3 rounded">
----- Short URL ----- <br /><a href="<?= $shortUrl ?>" target="_blank"><?= $shortUrl ?></a>
</div>
<?php endif; ?>

<a href="admin/login.php" class="admin-link">Admin Login</a>
</div>
</body>
</html>
