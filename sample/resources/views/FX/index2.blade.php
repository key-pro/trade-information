<?php
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://currencyapi.net/api/v1/rates?key=yuSkajIGZQ46gEFd7bQ2ieF1opgW7KcX73Jo&output=JSON',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
]);
$response = curl_exec($curl);
curl_close($curl);

// echo $response;

$value = substr($response,57,228);

echo $value;
echo PHP_EOL;
$str_count = 1;
$view = 2;
for($i = 0; $i < 3; $i++){
  echo substr($value,$str_count,3),PHP_EOL;
  $str_count += 5;
  echo substr($value,$str_count,7+$view),PHP_EOL;
  $str_count += 9;
}