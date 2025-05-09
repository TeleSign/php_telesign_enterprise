<?php

namespace telesign\enterprise\sdk\appverify;

use telesign\sdk\appverify\AppVerifyClient as _AppVerifyClient;
use telesign\enterprise\sdk\Config;

/**
 * App Verify is a secure, lightweight SDK that integrates a frictionless user verification process into existing
 * native mobile applications.
 */
class AppVerifyClient extends _AppVerifyClient {

  function __construct ($customer_id, $api_key, $rest_endpoint = "https://rest-ww.telesign.com", ...$other) {
    $sdk_version_origin = Config::getVersion('telesign/telesignenterprise');
    $sdk_version_dependency = Config::getVersion('telesign/telesign');
    parent::__construct($customer_id, $api_key, $rest_endpoint, "php_telesign_enterprise", $sdk_version_origin, $sdk_version_dependency, ...$other);
  }

}
