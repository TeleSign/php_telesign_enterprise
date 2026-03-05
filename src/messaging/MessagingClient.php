<?php

namespace telesign\enterprise\sdk\messaging;

use telesign\sdk\messaging\MessagingClient as _MessagingClient;
use telesign\enterprise\sdk\Config;

/**
 * TeleSign's Messaging API allows you to easily send SMS messages. You can send alerts, reminders, and notifications,
 * or you can send verification messages containing one-time passcodes (OTP).
 */
class MessagingClient extends _MessagingClient {

  const OMNI_MESSAGING_RESOURCE = "/v1/omnichannel";
  const CAPABILITY_RESOURCE = "/capability";
  const TEMPLATES_RESOURCE = "/v1/omnichannel/templates";

  function __construct ($customer_id, $api_key, $rest_endpoint = "https://rest-ww.telesign.com", ...$other) {
    $sdk_version_origin = Config::getVersion('telesign/telesignenterprise');
    $sdk_version_dependency = Config::getVersion('telesign/telesign');
    parent::__construct($customer_id, $api_key, $rest_endpoint, "php_telesign_enterprise", $sdk_version_origin, $sdk_version_dependency, ...$other);
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

  /**
   * Use this action to check capability of a phone number to use the specified channel.
   * 
   * See https://developer.telesign.com/enterprise/reference/checkphonenumberchannelcapability for detailed API documentation.
   */
  function checkPhoneNumberChannelCapability($channel, $phoneNumber) {
    $resource = self::CAPABILITY_RESOURCE . '/' . $channel . '/' . $phoneNumber;
    return $this->get($resource);
  }

  /**
   * Use this action to check capability of a phone number to receive messages from the specified RBM agent.
   * 
   * See https://developer.telesign.com/enterprise/reference/checkphonenumberrbmcapability for detailed API documentation.
   */
  function checkPhoneNumberRBMCapability($phoneNumber, $agentId) {
    $resource = self::CAPABILITY_RESOURCE . '/rcs/' . $phoneNumber . '/' . $agentId;
    return $this->get($resource);
  }

  /**
   * Get delivery status and other details for a Telesign Messaging transaction that you have created.
   * 
   * See https://developer.telesign.com/enterprise/reference/getmessagingstatus for detailed API documentation.
   */
  function getMessagingStatus($referenceId, array $params = []) {
    $resource = self::OMNI_MESSAGING_RESOURCE . '/' . $referenceId;
    return $this->get($resource, $params);
  }

  /**
   * Use this action to get details for all Telesign Messaging templates associated with this Customer ID.
   * 
   * See https://developer.telesign.com/enterprise/reference/getallmsgtemplates for detailed API documentation.
   */
  function getAllMsgTemplates() {
    return $this->get(self::TEMPLATES_RESOURCE);
  }

  /**
   * Use this action to create a Telesign Messaging template.
   * 
   * See https://developer.telesign.com/enterprise/reference/createmsgtemplate for detailed API documentation.
   */
  function createMsgTemplate(array $params = []) {
    return $this->post(self::TEMPLATES_RESOURCE, $params, null, null, "application/json", "Basic");
  }

  /**
   * Use this action to get details for the specified Telesign Messaging template.
   * 
   * See https://developer.telesign.com/enterprise/reference/getmsgtemplate for detailed API documentation.
   */
  function getMsgTemplate($channel, $templateName) {
    $resource = self::TEMPLATES_RESOURCE . '/' . $channel . '/' . $templateName;
    return $this->get($resource);
  }

  /**
   * Use this action to delete a Telesign Messaging template.
   * 
   * See https://developer.telesign.com/enterprise/reference/deletemsgtemplate for detailed API documentation.
   */
  function deleteMsgTemplate($channel, $templateName) {
    $resource = self::TEMPLATES_RESOURCE . '/' . $channel . '/' . $templateName;
    return $this->delete($resource);
  }
}