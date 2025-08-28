<?php
// Check if admin is logged in
function isAdminLoggedIn(){
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Redirect non-admin users to login page
function requireAdmin(){
    if(!isAdminLoggedIn()){
        header("Location: login.php");
        exit;
    }
}

// Example for future guest/user login checks
function isUserLoggedIn(){
    return isset($_SESSION['user_id']);
}

// Protect pages for logged-in users only
function requireUser(){
    if(!isUserLoggedIn()){
        header("Location: ../public/index.php");
        exit;
    }
}
?>
