<?php

require __DIR__ . "/../../vendor/autoload.php";

use telesign\enterprise\sdk\phoneid\PhoneIdClient;

$customer_id = getenv('CUSTOMER_ID') ?? 'FFFFFFFF-EEEE-DDDD-1234-AB1234567890';
$api_key = getenv('API_KEY') ?? 'ABC12345yusumoN6BYsBVkh+yRJ5czgsnCehZaOYldPJdmFh6NeX8kunZ2zU1YWaUw/0wV6xfw==';

$phone_number = getenv('PHONE_NUMBER') ?? '11234567890';
$ucid = "BACF";

$phoneid = new PhoneIdClient($customer_id, $api_key);
$response = $phoneid->score($phone_number, $ucid);

if ($response->ok) {
  echo "Phone number $phone_number has a '{$response->json["risk"]["level"]}' risk level"
    . " and the recommendation is to '{$response->json["risk"]["recommendation"]}' the transaction.";
}
