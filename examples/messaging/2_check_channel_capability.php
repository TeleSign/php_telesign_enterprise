<?php

require __DIR__ . "/../../vendor/autoload.php";

use telesign\enterprise\sdk\messaging\MessagingClient;

$customer_id = getenv('CUSTOMER_ID') ?? 'FFFFFFFF-EEEE-DDDD-1234-AB1234567890';
$api_key = getenv('API_KEY') ?? 'ABC12345yusumoN6BYsBVkh+yRJ5czgsnCehZaOYldPJdmFh6NeX8kunZ2zU1YWaUw/0wV6xfw==';
$phone_number = getenv('PHONE_NUMBER') ?? '918105955669';

$messaging = new MessagingClient($customer_id, $api_key);

echo "Checking channel capability for $phone_number (RCS)..." . PHP_EOL;
$response = $messaging->checkPhoneNumberChannelCapability("rcs", $phone_number);

echo "Status Code: " . ($response->status_code ?? "Unknown") . PHP_EOL;

if ($response->ok) {
    echo "Channel capability check completed." . PHP_EOL;
    echo "Response: " . json_encode($response->json, JSON_PRETTY_PRINT) . PHP_EOL;
} else {
    echo "Error checking capability:" . PHP_EOL;
    print_r($response->json);
}