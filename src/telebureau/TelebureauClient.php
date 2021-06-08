<?php

namespace telesign\enterprise\sdk\telebureau;

use telesign\sdk\rest\RestClient;

/**
 * TeleBureau is a service is based on TeleSign's watchlist, which is a proprietary database containing verified phone
 * numbers of users known to have committed online fraud. TeleSign crowd-sources this information from its customers.
 * Participation is voluntary, but you have to contribute in order to benefit.
 */
class TelebureauClient extends RestClient {

  const TELEBUREAU_CREATE_RESOURCE = "/v1/telebureau/event";
  const TELEBUREAU_RETRIEVE_RESOURCE = "/v1/telebureau/event/%s";
  const TELEBUREAU_DELETE_RESOURCE = "/v1/telebureau/event/%s";

  function __construct ($customer_id, $api_key, $rest_endpoint = "https://rest-ww.telesign.com", ...$other) {
    parent::__construct($customer_id, $api_key, $rest_endpoint, ...$other);
  }

  /**
   * Creates a telebureau event corresponding to supplied data.
   *
   * See https://developer.telesign.com/docs/telebureau-api for detailed API documentation.
   */
  function createEvent (array $fields) {
    return $this->post(self::TELEBUREAU_CREATE_RESOURCE, $fields);
  }

  /**
   * Retrieves the fraud event status. You make this call in your web application after completion of create
   * transaction for a telebureau event.
   *
   * See https://developer.telesign.com/docs/telebureau-api for detailed API documentation.
   */
  function retrieveEvent ($reference_id, array $fields = []) {
    return $this->get(sprintf(self::TELEBUREAU_RETRIEVE_RESOURCE, $reference_id), $fields);
  }

  /**
   * Deletes a previously submitted fraud event. You make this call in your web application after completion of the
   * create transaction for a telebureau event.
   *
   * See https://developer.telesign.com/docs/telebureau-api for detailed API documentation.
   */
  function deleteEvent ($reference_id, array $fields = []) {
    return $this->delete(sprintf(self::TELEBUREAU_DELETE_RESOURCE, $reference_id), $fields);
  }

}
