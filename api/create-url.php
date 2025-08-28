<?php
require '../app/config.php';
require '../app/UrlShortener.php';

header('Content-Type: application/json');

$shortener = new UrlShortener($pdo);
$data = json_decode(file_get_contents('php://input'), true);

if(!isset($data['url'])) {
    echo json_encode(['error'=>'URL required']);
    exit;
}

$userId = $data['user_id'] ?? null;
$custom = $data['custom_alias'] ?? null;
$code = $shortener->createShortUrl($data['url'], $userId, $custom);

echo json_encode(['short_url' => "../public/redirect.php?c=$code"]);
?>
