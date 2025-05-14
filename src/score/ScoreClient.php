<?php

namespace telesign\enterprise\sdk\score;

use telesign\sdk\score\ScoreClient as _ScoreClient;
use telesign\enterprise\sdk\Config;

/**
 * Score provides risk information about a specified phone number,
 */
class ScoreClient extends _ScoreClient {

  function __construct ($customer_id, $api_key, $rest_endpoint = "https://rest-ww.telesign.com", ...$other) {
    $sdk_version_origin = Config::getVersion('telesign/telesignenterprise');
    $sdk_version_dependency = Config::getVersion('telesign/telesign');
    parent::__construct($customer_id, $api_key, $rest_endpoint, "php_telesign_enterprise", $sdk_version_origin, $sdk_version_dependency, ...$other);
  }

}