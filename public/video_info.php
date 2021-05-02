<?php

require('../vendor/autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : null;

if(isset($_GET['crypt']) && $_GET['crypt'] == 'on'){
$url = base64_decode($url);
}


if (!$url) {
    die("No url provided");
}


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
