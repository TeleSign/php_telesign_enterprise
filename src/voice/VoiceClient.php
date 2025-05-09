<?php

namespace telesign\enterprise\sdk\voice;

use telesign\sdk\voice\VoiceClient as _VoiceClient;
use telesign\enterprise\sdk\Config;

/**
 * TeleSign's Voice API allows you to easily send voice messages. You can send alerts, reminders, and notifications,
 * or you can send verification messages containing time-based, one-time passcodes (TOTP).
 */
class VoiceClient extends _VoiceClient {

  function __construct ($customer_id, $api_key, $rest_endpoint = "https://rest-ww.telesign.com", ...$other) {
    $sdk_version_origin = Config::getVersion('telesign/telesignenterprise');
    $sdk_version_dependency = Config::getVersion('telesign/telesign');
    parent::__construct($customer_id, $api_key, $rest_endpoint, "php_telesign_enterprise", $sdk_version_origin, $sdk_version_dependency, ...$other);
  }
}
