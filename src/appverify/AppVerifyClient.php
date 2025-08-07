<?php

namespace telesign\enterprise\sdk\appverify;

use telesign\sdk\appverify\AppVerifyClient as _AppVerifyClient;
use telesign\enterprise\sdk\Config;

/**
 * App Verify is a secure, lightweight SDK that integrates a frictionless user verification process into existing
 * native mobile applications.
 */

class AppVerifyClient extends _AppVerifyClient
{
    const APP_VERIFY_BASE_RESOURCE = "/v1/verify/auto/voice";
    const INITIATE_RESOURCE = self::APP_VERIFY_BASE_RESOURCE . "/initiate";
    const FINALIZE_RESOURCE = self::APP_VERIFY_BASE_RESOURCE . "/finalize";
    const FINALIZE_CALLERID_RESOURCE = self::APP_VERIFY_BASE_RESOURCE . "/finalize/callerid";
    const FINALIZE_TIMEOUT_RESOURCE = self::APP_VERIFY_BASE_RESOURCE . "/finalize/timeout";

    function __construct($customer_id, $api_key, $rest_endpoint = "https://rest-ww.telesign.com", ...$other)
    {
        $sdk_version_origin = Config::getVersion('telesign/telesignenterprise');
        $sdk_version_dependency = Config::getVersion('telesign/telesign');
        parent::__construct($customer_id, $api_key, $rest_endpoint, "php_telesign_enterprise", $sdk_version_origin, $sdk_version_dependency, ...$other);
    }

    /**
     * Use this endpont to initiate verification of the specified phone number using the Telesign App Verify API.
     *
     * @param string $phone_number
     * @param array $optionalParams is array for additional parameters like 'verify_code', 'language'
     * @return array Response from Telesign API
     * 
     * See https://developer.telesign.com/enterprise/reference/sendappverifycode for detailed API documentation.
     */
    public function initiate(string $phone_number, array $optionalParams = [])
    {
        $params = array_merge(["phone_number" => $phone_number], $optionalParams);
        return $this->post(self::INITIATE_RESOURCE, $params);
    }

    /**
     * Use this endpoint to terminate a call created using the Telesign App Verify API if the handset does not terminate the call in your application.
     *
     * @param string $reference_id
     * @param array $optionalParams is array for additional parameters like 'verify_code'
     * @return array Response from Telesign API
     * 
     * See https://developer.telesign.com/enterprise/reference/endappverifycall for detailed API documentation.
     */
    public function finalize(string $reference_id, array $optionalParams = [])
    {
        $params = array_merge(["reference_id" => $reference_id], $optionalParams);
        return $this->post(self::FINALIZE_RESOURCE, $params);
    }

    /**
     * If a Telesign App Verify API call is unsuccessful, the device will not receive the call.
     * If there is a prefix sent by Telesign in the initiate request and it cannot be matched to the CLI of the verification call,
     * you can use this endpoint to report the issue to Telesign for troubleshooting
     *
     * @param string $reference_id
     * @param string $unknown_caller_id
     * @param array $optionalParams is array for additional parameters like 'customer_id'
     * @return array Response from Telesign API
     * 
     * See https://developer.telesign.com/enterprise/reference/reportappverifycallerid for detailed API documentation.
     */
    public function reportUnknownCallerId(string $reference_id, string $unknown_caller_id, array $optionalParams = [])
    {
        $params = array_merge([
            "reference_id" => $reference_id,
            "unknown_caller_id" => $unknown_caller_id,
        ], $optionalParams);
        return $this->post(self::FINALIZE_CALLERID_RESOURCE, $params);
    }

    /**
     * If a mobile device verification call does not make it to the designated handset within the specified amount of time, 
     * you can use the Finalize Timeout endpoint to report the issue to Telesign.
     *
     * @param string $reference_id
     * @return array Response from Telesign API
     * 
     * * See https://developer.telesign.com/enterprise/reference/reportappverifytimeout for detailed API documentation.
     */
    public function reportTimeout(string $reference_id)
    {
        $params = ["reference_id" => $reference_id];
        return $this->post(self::FINALIZE_TIMEOUT_RESOURCE, $params);
    }

    /**
     * Use this endpoint to get the status of a Telesign App Verify API request that you initiated.
     *
     * @param string $reference_id
     * @return array Response from Telesign API
     * 
     * See https://developer.telesign.com/enterprise/reference/getappverifystatus for detailed API documentation.
     */
    public function getTransactionStatus(string $reference_id)
    {
      return $this->get(self::APP_VERIFY_BASE_RESOURCE . "/" . $reference_id);
    }
}
