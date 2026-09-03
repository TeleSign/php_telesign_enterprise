<?php

namespace telesign\enterprise\sdk\voice;

use PHPUnit\Framework\TestCase;
use telesign\sdk\voice\VoiceClient as DependencyVoiceClient;

final class VoiceClientTest extends TestCase {

  use \telesign\enterprise\sdk\TestDependencyHelper;

  function testExposesDependencyMethods() {
    $this->assertDependencyMethods(
      VoiceClient::class,
      DependencyVoiceClient::class,
      ["call", "status"]
    );
  }

}
