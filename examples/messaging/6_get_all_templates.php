<?php

require __DIR__ . "/../../vendor/autoload.php";

use telesign\enterprise\sdk\messaging\MessagingClient;

$customer_id = getenv('CUSTOMER_ID') ?? 'FFFFFFFF-EEEE-DDDD-1234-AB1234567890';
$api_key = getenv('API_KEY') ?? 'ABC12345yusumoN6BYsBVkh+yRJ5czgsnCehZaOYldPJdmFh6NeX8kunZ2zU1YWaUw/0wV6xfw==';

$messaging = new MessagingClient($customer_id, $api_key);

echo "Listing all messaging templates..." . PHP_EOL;
$response = $messaging->getAllMsgTemplates();

echo "Status Code: " . ($response->status_code ?? "Unknown") . PHP_EOL;

if ($response->ok) {
    echo "Templates found: " . count($response->json ?? []) . PHP_EOL;
    echo json_encode($response->json, JSON_PRETTY_PRINT);
} else {
    echo "Error listing templates:" . PHP_EOL;
    print_r($response->json);
}
