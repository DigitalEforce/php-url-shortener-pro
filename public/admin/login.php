<?php
require '../../app/config.php';
require '../../app/auth.php';

$error = '';
if(isset($_POST['username'], $_POST['password'])){
    if($_POST['username']=='admin' && $_POST['password']=='admin123'){
        $_SESSION['admin_logged_in']=true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}

// If already logged in, redirect to dashboard
if(isAdminLoggedIn()){
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background:#f4f4f4; display:flex; justify-content:center; align-items:center; min-height:100vh; font-family:'Poppins',sans-serif;}
.card { padding:2rem; border-radius:15px; max-width:400px; width:100%; background:#fff; box-shadow:0 10px 25px rgba(0,0,0,0.2);}
input { border-radius:50px; padding:0.75rem 1.5rem; margin-bottom:1rem;}
.btn-primary { border-radius:50px; width:100%; padding:0.75rem;}
</style>
</head>
<body>
<div class="card">
<h2 class="text-center mb-4">Admin Login</h2>
<?php if($error) echo "<div class='alert alert-danger rounded'>$error</div>"; ?>
<form method="POST">
<input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
<button type="submit" class="btn btn-primary">Login</button>
</form>
</div>
</body>
</html>
