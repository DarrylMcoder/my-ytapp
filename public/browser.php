<?PHP
   
require('../vendor/autoload.php');

$url = isset($_REQUEST['url']) ? $_REQUEST['url'] : null;


if (!$url) {
    die("No url provided");
}

$url = base64_decode($url);

$browser = new \YouTube\Browser();
$result = $browser->get($url);
header("Content-type: text/html");
header("Content-length: ".strlen($result));
echo $result;
    
?>
