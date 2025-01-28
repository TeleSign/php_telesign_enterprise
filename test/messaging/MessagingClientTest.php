<?php

namespace telesign\enterprise\sdk\messaging;

use telesign\sdk\Example;
use telesign\sdk\ClientTest;

final class MessagingClientTest extends ClientTest {

  const EXAMPLE_REFERENCE_ID = Example::REFERENCE_ID;
  const EXAMPLE_PHONE_NUMBER = Example::PHONE_NUMBER;

  const EXAMPLE_BODY_OMNIMESSAGE = [
    "recipient" => ["phone_number" => Example::PHONE_NUMBER],
    "message" => [ 
      "sms" => [
        "parameters" => [
          "text" => "All purchases today are 20% off!"
        ],
        "template" => "text"
      ]
    ],
    "message_type" => "ARN",
    "channels" => [
      ["channel" => "sms", "fallback_time" => 300],
    ],
  ];

  function getRequestExamples () {
    return [
      [
        MessagingClient::class,
        "message",
        [
          self::EXAMPLE_PHONE_NUMBER,
          "Your OTP is 12345",
          "OTP",
          [ "optional_param" => "123" ]
        ],
        self::EXAMPLE_REST_ENDPOINT . "/v1/messaging",
        [
          "phone_number" => self::EXAMPLE_PHONE_NUMBER,
          "message" => "Your OTP is 12345",
          "message_type" => "OTP",
          "optional_param" => "123"
        ]
      ],
      [
        MessagingClient::class,
        "status",
        [
          self::EXAMPLE_REFERENCE_ID,
          [ "optional_param" => "123" ]
        ],
        self::EXAMPLE_REST_ENDPOINT . "/v1/messaging/" . self::EXAMPLE_REFERENCE_ID . "?optional_param=123",
        []
      ],
      [
        MessagingClient::class,
        "omniMessage",
        array (self::EXAMPLE_BODY_OMNIMESSAGE),
        self::EXAMPLE_REST_ENDPOINT . "/v1/omnichannel",
        json_encode(self::EXAMPLE_BODY_OMNIMESSAGE)
      ]
    ];
  }

}
