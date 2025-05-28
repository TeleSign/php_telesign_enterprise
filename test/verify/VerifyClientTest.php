<?php

namespace telesign\enterprise\sdk\verify;

use telesign\sdk\Example;
use telesign\sdk\ClientTest;

final class VerifyClientTest extends ClientTest {

  const EXAMPLE_PHONE_NUMBER = Example::PHONE_NUMBER;
  const EXAMPLE_UCID = Example::UCID;
  const EXAMPLE_REFERENCE_ID = Example::REFERENCE_ID;
  const BASE_URL_VERIFICATION_PROCESS = "https://verify.telesign.com";
  const EXAMPLE_VERIFY_CODE = "1234";

  function getRequestExamples () {
    return [
      [
        VerifyClient::class,
        "sms",
        [
          self::EXAMPLE_PHONE_NUMBER,
          [
            "ucid" => self::EXAMPLE_UCID,
            "verify_code" => self::EXAMPLE_VERIFY_CODE
          ]
        ],
        self::EXAMPLE_REST_ENDPOINT. "/v1/verify/sms",
        [
          "ucid" => self::EXAMPLE_UCID,
          "verify_code" => self::EXAMPLE_VERIFY_CODE,
          "phone_number" => self::EXAMPLE_PHONE_NUMBER
        ]
      ],
      [
        VerifyClient::class,
        "voice",
        [
          self::EXAMPLE_PHONE_NUMBER,
          [
            "ucid" => self::EXAMPLE_UCID,
            "verify_code" => self::EXAMPLE_VERIFY_CODE
          ]
        ],
        self::EXAMPLE_REST_ENDPOINT. "/v1/verify/call",
        [
          "ucid" => self::EXAMPLE_UCID,
          "verify_code" => self::EXAMPLE_VERIFY_CODE,
          "phone_number" => self::EXAMPLE_PHONE_NUMBER
        ]
      ],
      [
        VerifyClient::class,
        "smart",
        [
          self::EXAMPLE_PHONE_NUMBER,
          self::EXAMPLE_UCID,
          [
            "verify_code" => self::EXAMPLE_VERIFY_CODE
          ]
        ],
        self::EXAMPLE_REST_ENDPOINT. "/v1/verify/smart",
        [
          "ucid" => self::EXAMPLE_UCID,
          "verify_code" => self::EXAMPLE_VERIFY_CODE,
          "phone_number" => self::EXAMPLE_PHONE_NUMBER
        ]
      ],
      [
        VerifyClient::class,
        "status",
        [
          self::EXAMPLE_REFERENCE_ID,
          [
            "optional_param" => "123"
          ]
        ],
        self::EXAMPLE_REST_ENDPOINT . "/v1/verify/". self::EXAMPLE_REFERENCE_ID . "?optional_param=123",
        []
      ],
      [
        VerifyClient::class,
        "completion",
        [
          self::EXAMPLE_REFERENCE_ID,
          [
            "optional_param" => "123"
          ]
        ],
        self::EXAMPLE_REST_ENDPOINT . "/v1/verify/completion/". self::EXAMPLE_REFERENCE_ID,
        [
          "optional_param" => "123"
        ]
      ],
      [
        VerificationProcessClient::class,
        "create",
        [
          self::EXAMPLE_PHONE_NUMBER,
          [
            "verification_policy" => [
              [ "method" => "sms" ]
            ],
          ]
        ],
        self::EXAMPLE_REST_ENDPOINT . "/verification",
        json_encode(Example::objExampleVerification())
      ],
      [
        VerificationProcessClient::class,
        "update",
        [
          self::EXAMPLE_REFERENCE_ID,
          [
            "action" => "finalize",
            "security_factor" => "203466"
          ]
        ],
        self::EXAMPLE_REST_ENDPOINT . "/verification/". self::EXAMPLE_REFERENCE_ID. "/state",
        json_encode([
          "action" => "finalize",
          "security_factor" => "203466"
        ])
      ],
      [
        VerificationProcessClient::class,
        "retrieve",
        [
          self::EXAMPLE_REFERENCE_ID
        ],
        self::EXAMPLE_REST_ENDPOINT . "/verification/". self::EXAMPLE_REFERENCE_ID,
        []
      ],
    ];
  }

}
