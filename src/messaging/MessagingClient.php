<?php

namespace telesign\enterprise\sdk\messaging;

use telesign\sdk\messaging\MessagingClient as _MessagingClient;

/**
 * TeleSign's Messaging API allows you to easily send SMS messages. You can send alerts, reminders, and notifications,
 * or you can send verification messages containing one-time passcodes (OTP).
 */
class MessagingClient extends _MessagingClient {

  const OMNI_MESSAGING_RESOURCE = "/v1/omnichannel";

  function __construct ($customer_id, $api_key, $rest_endpoint = "https://rest-ww.telesign.com", ...$other) {
    parent::__construct($customer_id, $api_key, $rest_endpoint, ...$other);
  }

  /**
    * Send a message to the target recipient using any of Telesign's supported channels.
    * @param params All required and optional parameters well-structured according to the API documentation.
    * <p>
    * See  https://developer.telesign.com/enterprise/reference/sendadvancedmessage for detailed API documentation.
    * </p>
  */
  function omniMessage(array $params = []) {
    return $this->post(self::OMNI_MESSAGING_RESOURCE, $params, null, null, "application/json", "Basic");
  }
}
