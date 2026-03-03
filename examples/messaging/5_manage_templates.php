<?php

require __DIR__ . "/../../vendor/autoload.php";

use telesign\enterprise\sdk\messaging\MessagingClient;

$customer_id = getenv('CUSTOMER_ID') ?? 'FFFFFFFF-EEEE-DDDD-1234-AB1234567890';
$api_key = getenv('API_KEY') ?? 'ABC12345yusumoN6BYsBVkh+yRJ5czgsnCehZaOYldPJdmFh6NeX8kunZ2zU1YWaUw/0wV6xfw==';

$messaging = new MessagingClient($customer_id, $api_key);
$channel = "sms";
$template_name = "php_test_template_" . date('YmdHis');

echo "=== Template Management Tests ===\n";

// 1. Create template
$create_params = [
    "name" => $template_name,
    "type" => "standard",
    "channel" => $channel,
    "content" => [
        [
            "body" => [
                "type" => "text",
                "text" => "Your testorder {{1}} has shipped to {{2}}."
            ]
        ]
    ]
];
echo "\n1. Creating template '$template_name'..." . PHP_EOL;
$create_response = $messaging->createMsgTemplate($create_params);
echo "Create template status: " . ($create_response->status_code ?? "Unknown") . PHP_EOL;

if ($create_response->ok) {
    echo "Template created successfully!\n";
    
    // 2. Get template
    sleep(1);
    echo "\n2. Getting template details..." . PHP_EOL;
    $get_response = $messaging->getMsgTemplate($channel, $template_name);
    echo "Get template status: " . ($get_response->status_code ?? "Unknown") . PHP_EOL;
    
    // 3. Get all templates
    echo "\n3. Getting all templates..." . PHP_EOL;
    $list_response = $messaging->getAllMsgTemplates();
    echo "Get all templates status: " . ($list_response->status_code ?? "Unknown") . PHP_EOL;
    
    // 4. Delete template
    sleep(1);
    echo "\n4. Deleting template..." . PHP_EOL;
    $delete_response = $messaging->deleteMsgTemplate($channel, $template_name);
    echo "Delete template status: " . ($delete_response->status_code ?? "Unknown") . PHP_EOL;
    
} else {
    echo "Failed to create template:" . PHP_EOL;
    print_r($create_response->json);
}
