<?PHP
    
require('../vendor/autoload.php');

$query = isset($_GET['q']) ? $_GET['q'] : null;

if (!$query) {
    die("No search query provided");
}


$youtube = new \YouTube\Search();
$links = $youtube->search_yt_links($query);

header('Content-Type: application/json');
echo json_encode([
    'links' => $links,
], JSON_PRETTY_PRINT);
    
?>
