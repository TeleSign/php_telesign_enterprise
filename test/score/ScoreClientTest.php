<?php

namespace telesign\enterprise\sdk\score;

use PHPUnit\Framework\TestCase;
use telesign\sdk\score\ScoreClient as DependencyScoreClient;

final class ScoreClientTest extends TestCase {

  use \telesign\enterprise\sdk\TestDependencyHelper;

  function testExposesDependencyMethods() {
    $this->assertDependencyMethods(
      ScoreClient::class,
      DependencyScoreClient::class,
      ["score", "emailIntelligence"]
    );
  }
}
