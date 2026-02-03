<?php

require __DIR__ . "/../../vendor/autoload.php";

use telesign\enterprise\sdk\score\ScoreClient;

$customer_id = getenv('CUSTOMER_ID') ?? 'FFFFFFFF-EEEE-DDDD-1234-AB1234567890';
$api_key = getenv('API_KEY') ?? 'ABC12345yusumoN6BYsBVkh+yRJ5czgsnCehZaOYldPJdmFh6NeX8kunZ2zU1YWaUw/0wV6xfw==';

$phone_number = getenv('PHONE_NUMBER') ?? '11234567890';
$account_lifecycle_event= getenv('ACCOUNT_LIFECYCLE_EVENT') ?? 'create';

$scoreClient = new ScoreClient($customer_id, $api_key);
$response = $scoreClient->score($phone_number, $account_lifecycle_event, [
    "account_id" => "my_account_id", 
    "email_address" => "user@example.com", 
    "originating_ip" => "8.8.8.8"
]);
if ($response->ok) {
    echo "Phone number $phone_number has a '{$response->json["risk"]["level"]}' risk level"
       . " and the recommendation is to '{$response->json["risk"]["recommendation"]}' the transaction.";
} 
else {
    echo "Failed to get risk score for phone number $phone_number.";
}