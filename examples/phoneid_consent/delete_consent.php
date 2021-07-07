<?php

require __DIR__ . "/../../vendor/autoload.php";

use telesign\enterprise\sdk\phoneid\PhoneIdClient;

$customer_id = "Put your customer ID between these quotes.";
$api_key = "Put your API key between these quotes.";
$phone_number = "Put the complete phone number you want to retrieve the consent history for here.";
$consent_method = "1";

$phoneid = new PhoneIdClient($customer_id, $api_key);
$response = $phoneid->consent_delete($phone_number, ["consent_method" => $consent_method, "addons" => ["contact" => []]] );

print_r($response->json);
