<?php

namespace telesign\enterprise\sdk\verify;

use telesign\sdk\rest\RestClient;

/**
 * The Verify API delivers phone-based verification and two-factor authentication using a time-based, one-time passcode
 * sent via SMS message or Voice call.
 */
class VerifyClient extends RestClient {

  const VERIFY_SMS_RESOURCE = "/v1/verify/sms";
  const VERIFY_VOICE_RESOURCE = "/v1/verify/call";
  const VERIFY_SMART_RESOURCE = "/v1/verify/smart";
  const VERIFY_STATUS_RESOURCE = "/v1/verify/%s";
  const VERIFY_COMPLETION_RESOURCE = "/v1/verify/completion/%s";

  function __construct ($customer_id, $api_key, $rest_endpoint = "https://rest-ww.telesign.com", ...$other) {
    parent::__construct($customer_id, $api_key, $rest_endpoint, ...$other);
  }

  /**
   * The SMS Verify API delivers phone-based verification and two-factor authentication using a time-based,
   * one-time passcode sent over SMS.
   *
   * See https://developer.telesign.com/docs/rest_api-verify-sms for detailed API documentation.
   */
  function sms ($phone_number, array $other = []) {
    return $this->post(self::VERIFY_SMS_RESOURCE, array_merge($other, [
      "phone_number" => $phone_number
    ]));
  }

  /**
   * The Voice Verify API delivers patented phone-based verification and two-factor authentication using a one-time
   * passcode sent over voice message.
   *
   * See https://developer.telesign.com/docs/rest_api-verify-call for detailed API documentation.
   */
  function voice ($phone_number, array $other = []) {
    return $this->post(self::VERIFY_VOICE_RESOURCE, array_merge($other, [
      "phone_number" => $phone_number
    ]));
  }

  /**
   * The Smart Verify web service simplifies the process of verifying user identity by integrating several TeleSign
   * web services into a single API call. This eliminates the need for you to make multiple calls to the TeleSign
   * Verify resource.
   *
   * See https://developer.telesign.com/docs/rest_api-smart-verify for detailed API documentation.
   */
  function smart ($phone_number, $ucid, array $other = []) {
    return $this->post(self::VERIFY_SMART_RESOURCE, array_merge($other, [
      "phone_number" => $phone_number,
      "ucid" => $ucid
    ]));
  }

  /**
   * Retrieves the verification result for any verify resource.
   *
   * See https://developer.telesign.com/docs/rest_api-verify-transaction-callback for detailed API documentation.
   */
  function status ($reference_id, array $params = []) {
    return $this->get(sprintf(self::VERIFY_STATUS_RESOURCE, $reference_id), $params);
  }
  
  /**
   * Notifies TeleSign that a verification was successfully delivered to the user in order to help improve
   * the quality of message delivery routes.
   *
   * See https://developer.telesign.com/docs/completion-service-for-verify-products for detailed API documentation.
   */
  function completion ($reference_id, array $params = []) {
    return $this->put(sprintf(self::VERIFY_COMPLETION_RESOURCE, $reference_id), $params);
  }

}
