<?php

function lookup(){  
$statica_env = getenv("QUOTAGUARD_URL");      $statica = parse_url($statica_env);  $proxyUrl $statica['host'].":".$statica['port'];  $proxyAuth = $statica['user'].":".$statica['pass'];  
$url = "http://www.google.com";  
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, $url);  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  curl_setopt($ch, CURLOPT_PROXY, $proxyUrl);  curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);  
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyAuth);  
$response = curl_exec($ch);  
return $response;
}

$res = lookup();
print_r($res);

?>
