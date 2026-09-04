<?php

namespace telesign\enterprise\sdk;
use Composer\InstalledVersions;

class Config {
    public static function getVersion($package)
    {
        return InstalledVersions::getPrettyVersion($package);
    }
}
