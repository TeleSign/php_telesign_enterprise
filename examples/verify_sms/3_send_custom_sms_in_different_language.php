<?php

require __DIR__ . "/../vendor/autoload.php";

use telesign\enterprise\sdk\verify\VerifyClient;

$customer_id = getenv('CUSTOMER_ID') ?? 'FFFFFFFF-EEEE-DDDD-1234-AB1234567890';
$api_key = getenv('API_KEY') ?? 'ABC12345yusumoN6BYsBVkh+yRJ5czgsnCehZaOYldPJdmFh6NeX8kunZ2zU1YWaUw/0wV6xfw==';

$phone_number = getenv('PHONE_NUMBER') ?? '11234567890';
$template = 'Votre code de vérification Widgets \'n\' More est $$CODE$$.';

$verify = new VerifyClient($customer_id, $api_key);
$response = $verify->sms($phone_number, [ "template" => $template ]);
