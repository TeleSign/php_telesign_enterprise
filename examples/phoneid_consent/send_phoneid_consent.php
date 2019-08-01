<?php

require __DIR__ . "/../../vendor/autoload.php";

use telesign\enterprise\sdk\phoneid\PhoneIdClient;

$customer_id = "Put your customer ID between these quotes.";
$api_key = "Put your API key between these quotes.";
$phone_number = "Put the complete phone number you want to retrieve the consent history for here.";
$consent_timestamp = "2019-07-12T02:39:27Z";

$other = ["consent_method" => $consent_method, "consent_timestamp" => $consent_timestamp, "addons" => ["contact" => []]];

$phoneid = new PhoneIdClient($customer_id, $api_key);
print_r($phoneid);
$response = $phoneid->consent_send($phone_number, $other);

print_r($response->json);
