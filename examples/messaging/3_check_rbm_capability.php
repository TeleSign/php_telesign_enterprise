<?php

require __DIR__ . "/../../vendor/autoload.php";

use telesign\enterprise\sdk\messaging\MessagingClient;

$customer_id = getenv('CUSTOMER_ID') ?? 'FFFFFFFF-EEEE-DDDD-1234-AB1234567890';
$api_key = getenv('API_KEY') ?? 'ABC12345yusumoN6BYsBVkh+yRJ5czgsnCehZaOYldPJdmFh6NeX8kunZ2zU1YWaUw/0wV6xfw==';
$phone_number = getenv('PHONE_NUMBER') ?? '11234567890';
$agent_id = getenv('RBM_AGENT_ID') ?? 'test_rbm_agent_id';

$messaging = new MessagingClient($customer_id, $api_key);

echo "Checking RBM capability for $phone_number with agent $agent_id..." . PHP_EOL;
$response = $messaging->checkPhoneNumberRBMCapability($phone_number, $agent_id);

echo "Status Code: " . ($response->status_code ?? "Unknown") . PHP_EOL;

if ($response->ok) {
    echo "RBM capability check completed." . PHP_EOL;
    echo "Response: " . json_encode($response->json, JSON_PRETTY_PRINT) . PHP_EOL;
} else {
    echo "Error checking RBM capability:" . PHP_EOL;
    print_r($response->json);
}
