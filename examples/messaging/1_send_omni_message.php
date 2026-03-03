<?php

require __DIR__ . "/../../vendor/autoload.php";

use telesign\enterprise\sdk\messaging\MessagingClient;

$customer_id = getenv('CUSTOMER_ID') ?? 'FFFFFFFF-EEEE-DDDD-1234-AB1234567890';
$api_key = getenv('API_KEY') ?? 'ABC12345yusumoN6BYsBVkh+yRJ5czgsnCehZaOYldPJdmFh6NeX8kunZ2zU1YWaUw/0wV6xfw==';
$phone_number = getenv('PHONE_NUMBER') ?? '11234567890';

$messaging = new MessagingClient($customer_id, $api_key);

$params = [
    "recipient" => ["phone_number" => $phone_number],
    "message" => [ 
        "sms" => [
            "parameters" => ["text" => "You're scheduled for a dentist appointment at 2:30PM."],
            "template" => "text"
        ]
    ],
    "message_type" => "ARN",
    "channels" => [["channel" => "sms", "fallback_time" => 300]],
];

echo "Sending omni message to $phone_number..." . PHP_EOL;
$response = $messaging->omniMessage($params);

echo "Status Code: " . ($response->status_code ?? "Unknown") . PHP_EOL;

if ($response->ok) {
    echo "Message sent successfully." . PHP_EOL;
    echo "Reference ID: " . ($response->json["reference_id"] ?? "N/A") . PHP_EOL;
} else {
    echo "Error sending message:" . PHP_EOL;
    print_r($response->json);
}