<?php

require __DIR__.'/vendor/autoload.php';

$client = new \Delatbabel\ApiSecurity\Helpers\Client();

$client->setPrivateKey(__DIR__.'/private_key');
$params = array();

$response = file_get_contents("http://homestead.app/company?sig=".$client->createHMAC($params));
echo $response;