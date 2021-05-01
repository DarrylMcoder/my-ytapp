<?php

set_time_limit(0);

require('../vendor/autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : null;

if ($url == false) {
    die("No url provided");
}

$debug = isset($_GET['debug']) ? $_GET['debug'] : false;

//comment next line to disable encryption
$url = base64_decode($url);

$youtube = new \YouTube\YoutubeStreamer();
$youtube->debug = $debug;
$youtube->stream($url);
