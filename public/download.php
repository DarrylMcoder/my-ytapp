<?PHP
    
set_time_limit(0);

require('../vendor/autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : null;

if ($url == false) {
    die("No url provided");
}

$youtube = new \YouTube\YouTubeDownloader();

$links = $youtube->getDownloadLinks($url);

$error = $youtube->getLastError();

$info = $youtube->getInfo();

$name = $youtube->getVideoName();

$vid_url = $links[0]['url'];

if(!isset($vid_url)){
die "No video found!";
}

if(isset($error)){
  die "ERROR: ".$error;
}

$youtubefiledownloader = new \YouTube\YouTubeFileDownloader();

$youtubefiledownloader->setFileName($name);

$youtubefiledownloader->download($vid_url);
    
?>
