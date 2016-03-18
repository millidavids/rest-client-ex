<?php

require __DIR__.'/vendor/autoload.php';

$client = new \Delatbabel\ApiSecurity\Helpers\Client();

$client->setPrivateKey(__DIR__.'/private_key');

// Index
$params = array();
$hmac = $client->createHMAC($params);
$response = file_get_contents("http://homestead.app/company?hmac=".$params['hmac']."&cnonce=".$params['cnonce']);
echo $response;

// Show
$params = array();
$hmac = $client->createHMAC($params);
$response = file_get_contents("http://homestead.app/company/1?hmac=".$params['hmac']."&cnonce=".$params['cnonce']);
echo $response;

// Store
$params = array('name' => 'lol', 'url' => 'lol.com');
$hmac = $client->createHMAC($params);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://homestead.app/company');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'name='.$params['name'].'&url='.$params['url'].'&hmac='.$params['hmac'].'&cnonce='.$params['cnonce']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
echo $response;

// Update
$params = array('name' => 'lol', 'url' => 'lol.com');
$hmac = $client->createHMAC($params);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://homestead.app/company/1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'name='.$params['name'].'&url='.$params['url'].'&hmac='.$params['hmac'].'&cnonce='.$params['cnonce']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
echo $response;

