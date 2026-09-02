<?php

namespace telesign\enterprise\sdk\messaging;

use telesign\sdk\Example;
use telesign\sdk\ClientTest;
use telesign\sdk\messaging\MessagingClient as DependencyMessagingClient;

final class MessagingClientTest extends ClientTest {

  use \telesign\enterprise\sdk\TestDependencyHelper;

  const EXAMPLE_REFERENCE_ID = Example::REFERENCE_ID;
  const EXAMPLE_PHONE_NUMBER = Example::PHONE_NUMBER;
  const EXAMPLE_CHANNEL = "rcs";
  const EXAMPLE_AGENT_ID = "test_rbm_agent_id";
  const EXAMPLE_TEMPLATE_CHANNEL = "sms";
  const EXAMPLE_TEMPLATE_NAME = "test_template";

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

  const EXAMPLE_CREATE_TEMPLATE_PARAMS = [
    "name" => "test_template",
    "type" => "standard",
    "channel" => "sms",
    "content" => [
      [
        "body" => [
          "type" => "text",
          "text" => "Your testorder {{1}} has shipped to {{2}}."
        ]
      ]
    ]
  ];

  function getRequestExamples () {
    return [
      // omniMessage
      'omniMessage' => [
        MessagingClient::class,
        "omniMessage",
        [self::EXAMPLE_BODY_OMNIMESSAGE],
        self::EXAMPLE_REST_ENDPOINT . "/v1/omnichannel",
        json_encode(self::EXAMPLE_BODY_OMNIMESSAGE)
      ],
      // checkPhoneNumberChannelCapability
      'checkChannelCapability' => [
        MessagingClient::class,
        "checkPhoneNumberChannelCapability",
        [self::EXAMPLE_CHANNEL, self::EXAMPLE_PHONE_NUMBER],
        self::EXAMPLE_REST_ENDPOINT . "/capability/" . self::EXAMPLE_CHANNEL . "/" . self::EXAMPLE_PHONE_NUMBER,
        []
      ],
      // checkPhoneNumberRBMCapability
      'checkRBMCapability' => [
        MessagingClient::class,
        "checkPhoneNumberRBMCapability",
        [self::EXAMPLE_PHONE_NUMBER, self::EXAMPLE_AGENT_ID],
        self::EXAMPLE_REST_ENDPOINT . "/capability/rcs/" . self::EXAMPLE_PHONE_NUMBER . "/" . self::EXAMPLE_AGENT_ID,
        []
      ],
      // getMessagingStatus
      'getMessagingStatus' => [
        MessagingClient::class,
        "getMessagingStatus",
        [self::EXAMPLE_REFERENCE_ID, ["verify_code" => "123456"]],
        self::EXAMPLE_REST_ENDPOINT . "/v1/omnichannel/" . self::EXAMPLE_REFERENCE_ID . "?verify_code=123456",
        []
      ],
      // getAllMsgTemplates
      'getAllTemplates' => [
        MessagingClient::class,
        "getAllMsgTemplates",
        [],
        self::EXAMPLE_REST_ENDPOINT . "/v1/omnichannel/templates",
        []
      ],
      // createMsgTemplate
      'createTemplate' => [
        MessagingClient::class,
        "createMsgTemplate",
        [self::EXAMPLE_CREATE_TEMPLATE_PARAMS],
        self::EXAMPLE_REST_ENDPOINT . "/v1/omnichannel/templates",
        json_encode(self::EXAMPLE_CREATE_TEMPLATE_PARAMS)
      ],
      // getMsgTemplate
      'getTemplate' => [
        MessagingClient::class,
        "getMsgTemplate",
        [self::EXAMPLE_TEMPLATE_CHANNEL, self::EXAMPLE_TEMPLATE_NAME],
        self::EXAMPLE_REST_ENDPOINT . "/v1/omnichannel/templates/" . self::EXAMPLE_TEMPLATE_CHANNEL . "/" . self::EXAMPLE_TEMPLATE_NAME,
        []
      ],
      // deleteMsgTemplate
      'deleteTemplate' => [
        MessagingClient::class,
        "deleteMsgTemplate",
        [self::EXAMPLE_TEMPLATE_CHANNEL, self::EXAMPLE_TEMPLATE_NAME],
        self::EXAMPLE_REST_ENDPOINT . "/v1/omnichannel/templates/" . self::EXAMPLE_TEMPLATE_CHANNEL . "/" . self::EXAMPLE_TEMPLATE_NAME,
        []
      ]
    ];
  }

  function testExposesDependencyMethods() {
    $this->assertDependencyMethods(
      MessagingClient::class,
      DependencyMessagingClient::class,
      ["message", "status"]
    );
  }
}
