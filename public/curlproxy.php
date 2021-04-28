<?php
$url = $_GET['url'];

  function proxyRequest($url) {
    $fixieUrl = getenv("QUOTAGUARD_URL");
    $parsedFixieUrl = parse_url($fixieUrl);

    $proxy = $parsedFixieUrl['host'].":".$parsedFixieUrl['port'];
    $proxyAuth = $parsedFixieUrl['user'].":".$parsedFixieUrl['pass'];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyAuth);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }

  $response = proxyRequest($url);
  print_r($response);
?>
