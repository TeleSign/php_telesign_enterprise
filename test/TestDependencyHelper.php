<?php

namespace telesign\enterprise\sdk;

trait TestDependencyHelper {

  protected function assertDependencyMethods($enterpriseClient, $dependencyClient, array $methods) {
    $this->assertTrue(is_subclass_of($enterpriseClient, $dependencyClient));

    foreach ($methods as $method) {
      $this->assertTrue(method_exists($enterpriseClient, $method));
      $this->assertTrue((new \ReflectionMethod($enterpriseClient, $method))->isPublic());
    }
  }
}