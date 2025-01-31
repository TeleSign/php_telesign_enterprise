<?php

require __DIR__ . "/../vendor/autoload.php";

use telesign\enterprise\sdk\phoneid\PhoneIdClient;

$customer_id = getenv('CUSTOMER_ID') ?? 'FFFFFFFF-EEEE-DDDD-1234-AB1234567890';
$api_key = getenv('API_KEY') ?? 'ABC12345yusumoN6BYsBVkh+yRJ5czgsnCehZaOYldPJdmFh6NeX8kunZ2zU1YWaUw/0wV6xfw==';

$phone_number = getenv('PHONE_NUMBER') ?? '11234567890';
$ucid = "ATCK";

$phoneid = new PhoneIdClient($customer_id, $api_key);
$response = $phoneid->numberDeactivation($phone_number, $ucid);

if ($response->ok) {
  if ($response->json['number_deactivation']['last_deactivated']) {
    echo "Phone number {$response->json["number_deactivation"]["number"]}"
    . " was last deactivated {$response->json["number_deactivation"]["last_deactivated"]}.";
  }
  else {
    echo "Phone number {$response->json['number_deactivation']['number']} has not been deactivated.";
  }
}
