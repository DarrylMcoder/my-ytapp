<?php
$url = $_GET['url'];
proxyRequest($url);

  function proxyRequest($url) {
    $fixieUrl = getenv("FIXIE_URL");
    $parsedFixieUrl = parse_url($fixieUrl);

    $proxy = $parsedFixieUrl['host'].":".$parsedFixieUrl['port'];
    $proxyAuth = $parsedFixieUrl['user'].":".$parsedFixieUrl['pass'];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyAuth);
    curl_close($ch);
  }

  $response = proxyRequest();
  print_r($response);
?>