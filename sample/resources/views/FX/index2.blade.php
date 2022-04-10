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

echo $response;
