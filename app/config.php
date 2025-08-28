<?php
session_start();
$host="localhost"; $dbname="url_shortener"; $username="root"; $password="";
try { 
    $pdo=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){ 
    die("DB Connection Failed: ".$e->getMessage());
}
?>
