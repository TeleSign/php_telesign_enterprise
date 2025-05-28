<?php

namespace telesign\enterprise\sdk\verify;

use telesign\sdk\rest\RestClient;
use telesign\enterprise\sdk\Config;

/**
 * The Telesign Verification Process makes it easy for you ...
 */
class VerificationProcessClient extends RestClient {

  const BASE_URL_VERIFY_API = "https://verify.telesign.com";
  const PATH_CREATE = "/verification";
  const PATH_UPDATE = "/verification/%s/state";
  const PATH_RETRIEVE = "/verification/%s";


  function __construct ($customer_id, $api_key, $rest_endpoint = self::BASE_URL_VERIFY_API, ...$other) {
    $sdk_version_origin = Config::getVersion('telesign/telesignenterprise');
    $sdk_version_dependency = Config::getVersion('telesign/telesign');
    parent::__construct($customer_id, $api_key, $rest_endpoint, "php_telesign_enterprise", $sdk_version_origin, $sdk_version_dependency, ...$other);
  }

  /**
    * Use this action to create a verification process for the specified phone number.
    * 
    * See https://developer.telesign.com/enterprise/reference/createverificationprocess for detailed API documentation.
  */
  function create ($phone_number, array $params = []) {
    $params["recipient"] = [
      "phone_number" => $phone_number
    ];

    if (!isset($params["verification_policy"])) {
      $params["verification_policy"] = [
        [ "method" => "sms" ]
      ];
    }

    return $this->post(self::PATH_CREATE, $params, null, null, "application/json", "Basic");
  }

  /**
    * Use this action to update a verification process for the specified reference_id.
    * 
    * See https://developer.telesign.com/enterprise/reference/updateverificationprocess for detailed API documentation.
  */
  function update ($reference_id, array $params = []) {
    return $this->patch(sprintf(self::PATH_UPDATE, $reference_id), $params, null, null, "application/json", "Basic");
  }

  /**
    * Use this action to retrieve a verification process for the specified reference_id.
    * 
    * See https://developer.telesign.com/enterprise/reference/getverificationprocess for detailed API documentation.
  */
  function retrieve ($reference_id) {
    return $this->get(sprintf(self::PATH_RETRIEVE, $reference_id));
  }
}
