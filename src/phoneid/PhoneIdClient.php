<?php

namespace telesign\enterprise\sdk\phoneid;

use telesign\sdk\phoneid\PhoneIdClient as _PhoneIdClient;
use telesign\enterprise\sdk\Config;

/**
 * PhoneID is a set of REST APIs that deliver deep phone number data attributes that help optimize the end user
 * verification process and evaluate risk.
 *
 * TeleSign PhoneID provides a wide range of risk assessment indicators on the number to help confirm user identity,
 * delivering real-time decision making throughout the number lifecycle and ensuring only legitimate users are
 * creating accounts and accessing your applications.
 */
class PhoneIdClient extends _PhoneIdClient {

  const PHONEID_STANDARD_RESOURCE = "/v1/phoneid/standard/%s";
  const PHONEID_SCORE_RESOURCE = "/v1/phoneid/score/%s";
  const PHONEID_CONTACT_RESOURCE = "/v1/phoneid/contact/%s";
  const PHONEID_LIVE_RESOURCE = "/v1/phoneid/live/%s";
  const PHONEID_NUMBER_DEACTIVATION_RESOURCE = "/v1/phoneid/number_deactivation/%s";

  function __construct ($customer_id, $api_key, $rest_endpoint = "https://rest-ww.telesign.com", ...$other) {
    $sdk_version_origin = Config::getVersion('telesign/telesignenterprise');
    $sdk_version_dependency = Config::getVersion('telesign/telesign');
    parent::__construct($customer_id, $api_key, $rest_endpoint, "php_telesign_enterprise", $sdk_version_origin, $sdk_version_dependency, ...$other);
  }

  /**
   * The PhoneID Standard API that provides phone type and telecom carrier information to identify which phone
   * numbers can receive SMS messages and/or a potential fraud risk.
   *
   * See https://developer.telesign.com/docs/rest_phoneid-standard for detailed API documentation.
   */
  function standard ($phone_number, array $params = []) {
    return $this->get(sprintf(self::PHONEID_STANDARD_RESOURCE, $phone_number), $params);
  }

  /**
   * Score is an API that delivers reputation scoring based on phone number intelligence, traffic patterns, machine
   * learning, and a global data consortium.
   *
   * See https://developer.telesign.com/docs/rest_api-phoneid-score for detailed API documentation.
   */
  function score ($phone_number, $ucid, array $other = []) {
    return $this->get(sprintf(self::PHONEID_SCORE_RESOURCE, $phone_number), array_merge($other, [
      "ucid" => $ucid
    ]));
  }

  /**
   * The PhoneID Contact API delivers contact information related to the subscriber's phone number to provide another
   * set of indicators for established risk engines.
   *
   * See https://developer.telesign.com/docs/rest_api-phoneid-contact for detailed API documentation.
   */
  function contact ($phone_number, $ucid, array $other = []) {
    return $this->get(sprintf(self::PHONEID_CONTACT_RESOURCE, $phone_number), array_merge($other, [
      "ucid" => $ucid
    ]));
  }

  /**
   * The PhoneID Live API delivers insights such as whether a phone is active or disconnected, a device is reachable
   * or unreachable and its roaming status.
   *
   * See https://developer.telesign.com/docs/rest_api-phoneid-live for detailed API documentation.
   */
  function live ($phone_number, $ucid, array $other = []) {
    return $this->get(sprintf(self::PHONEID_LIVE_RESOURCE, $phone_number), array_merge($other, [
      "ucid" => $ucid
    ]));
  }

  /**
   * The PhoneID Number Deactivation API determines whether a phone number has been deactivated and when, based on
   * carriers' phone number data and TeleSign's proprietary analysis.
   *
   * See https://developer.telesign.com/docs/rest_api-phoneid-number-deactivation for detailed API documentation.
   */
  function numberDeactivation ($phone_number, $ucid, array $other = []) {
    return $this->get(sprintf(self::PHONEID_NUMBER_DEACTIVATION_RESOURCE, $phone_number), array_merge($other, [
      "ucid" => $ucid
    ]));
  }

}
