<?php

require('../vendor/autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : null;

if (!$url) {
    die("No url provided");
}

//$url = base64_decode($url);

$youtube = new \YouTube\YouTubeDownloader();

$links = $youtube->getDownloadLinks($url);

$error = $youtube->getLastError();

$info = $youtube->getInfo();

$name = $youtube->getVideoName();

header('Content-Type: application/json');
echo json_encode([
    'links' => $links,
    'error' => $error,
    'info' => $info,
    'name' => $name
], JSON_PRETTY_PRINT);
