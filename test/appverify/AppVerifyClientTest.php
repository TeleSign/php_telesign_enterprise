<?php

namespace telesign\enterprise\sdk\appverify;

use telesign\sdk\Example;
use telesign\sdk\ClientTest;

final class AppVerifyClientTest extends ClientTest
{
    const EXAMPLE_PHONE_NUMBER = Example::PHONE_NUMBER;
    const EXAMPLE_REFERENCE_ID = Example::REFERENCE_ID;
    const EXAMPLE_UNKNOWN_CALLER_ID = "1234567890";
    const APP_VERIFY_BASE_RESOURCE = "/v1/verify/auto/voice";

    function getRequestExamples()
    {
        return [
            // Initiate
            [
                AppVerifyClient::class,
                "initiate",
                [
                    self::EXAMPLE_PHONE_NUMBER,
                ],
                self::EXAMPLE_REST_ENDPOINT . self::APP_VERIFY_BASE_RESOURCE . "/initiate",
                [
                    "phone_number" => self::EXAMPLE_PHONE_NUMBER
                ],
            ],

            // Finalize
            [
                AppVerifyClient::class,
                "finalize",
                [
                    self::EXAMPLE_REFERENCE_ID,
                ],
                self::EXAMPLE_REST_ENDPOINT . self::APP_VERIFY_BASE_RESOURCE . "/finalize",
                [
                    "reference_id" => self::EXAMPLE_REFERENCE_ID
                ],
            ],

            // Report Unknown Caller ID
            [
                AppVerifyClient::class,
                "reportUnknownCallerId",
                [
                    self::EXAMPLE_REFERENCE_ID,
                    self::EXAMPLE_UNKNOWN_CALLER_ID,
                ],
                self::EXAMPLE_REST_ENDPOINT . self::APP_VERIFY_BASE_RESOURCE . "/finalize/callerid",
                [
                    "reference_id" => self::EXAMPLE_REFERENCE_ID,
                    "unknown_caller_id" => self::EXAMPLE_UNKNOWN_CALLER_ID
                ],
            ],

            // Report Timeout
            [
                AppVerifyClient::class,
                "reportTimeout",
                [
                    self::EXAMPLE_REFERENCE_ID,
                ],
                self::EXAMPLE_REST_ENDPOINT . self::APP_VERIFY_BASE_RESOURCE . "/finalize/timeout",
                [
                    "reference_id" => self::EXAMPLE_REFERENCE_ID
                ],
            ],

            // Get Transaction Status
            [
                AppVerifyClient::class,
                "getTransactionStatus",
                [
                    self::EXAMPLE_REFERENCE_ID,
                ],
                self::EXAMPLE_REST_ENDPOINT . self::APP_VERIFY_BASE_RESOURCE . "/" . self::EXAMPLE_REFERENCE_ID,
                []
            ],
        ];
    }
}