<?PHP
   
require('../vendor/autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : null;

if (!$url) {
    die("No url provided");
}

$browser = new \YouTube\Browser();
$result = $browser->get($url);
header("Content-type: text/html");
header("Content-length: ".strlen($result));
echo $result;
    
?>
