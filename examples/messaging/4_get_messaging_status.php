<?php

require __DIR__ . "/../../vendor/autoload.php";

use telesign\enterprise\sdk\messaging\MessagingClient;

$customer_id = getenv('CUSTOMER_ID') ?? 'FFFFFFFF-EEEE-DDDD-1234-AB1234567890';
$api_key = getenv('API_KEY') ?? 'ABC12345yusumoN6BYsBVkh+yRJ5czgsnCehZaOYldPJdmFh6NeX8kunZ2zU1YWaUw/0wV6xfw==';
$reference_id = getenv('REFERENCE_ID') ?? '0123456789ABCDEF0123456789ABCDEF';

$messaging = new MessagingClient($customer_id, $api_key);

echo "Getting status for reference ID: $reference_id..." . PHP_EOL;
$response = $messaging->getMessagingStatus($reference_id);

echo "Status Code: " . ($response->status_code ?? "Unknown") . PHP_EOL;

if ($response->ok) {
    echo "Status retrieved successfully." . PHP_EOL;
    echo "Status: " . json_encode($response->json["status"] ?? [], JSON_PRETTY_PRINT) . PHP_EOL;
} else {
    echo "Error getting status:" . PHP_EOL;
    print_r($response->json);
}
