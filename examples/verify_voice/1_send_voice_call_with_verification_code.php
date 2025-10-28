<?php

require __DIR__ . "/../../vendor/autoload.php";

use telesign\enterprise\sdk\verify\VerifyClient;
use function telesign\sdk\util\randomWithNDigits;

$customer_id = getenv('CUSTOMER_ID') ?? 'FFFFFFFF-EEEE-DDDD-1234-AB1234567890';
$api_key = getenv('API_KEY') ?? 'ABC12345yusumoN6BYsBVkh+yRJ5czgsnCehZaOYldPJdmFh6NeX8kunZ2zU1YWaUw/0wV6xfw==';

$phone_number = getenv('PHONE_NUMBER') ?? '11234567890';
$verify_code = randomWithNDigits(5);

$verify = new VerifyClient($customer_id, $api_key);
$response = $verify->voice($phone_number, [ "verify_code" => $verify_code ]);

echo "Please enter the verification code you were sent: ";

$user_entered_verify_code = trim(fgets(STDIN));

if ($verify_code == $user_entered_verify_code) {
  echo "Your code is correct.";
}
else {
  echo "Your code is incorrect.";
}
