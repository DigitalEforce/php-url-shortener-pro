<?php
require '../app/config.php';
require '../app/UrlShortener.php';

$shortener = new UrlShortener($pdo);

if(isset($_GET['c'])){
    $url = $shortener->getOriginalUrl($_GET['c']);
    if($url){
        header("Location: ".$url['original_url']);
        exit;
    } else {
        echo "Invalid URL.";
    }
}
?>
