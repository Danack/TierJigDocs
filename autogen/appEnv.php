<?php

// This file was automatically generated with the command line:
// vendor/bin/genenv -p data/config.php data/envRequired.php autogen/appEnv.php centos,live

function getAppEnv() {
    static $env = [
        'jig_compilecheck' => 'COMPILE_CHECK_EXISTS',
        'caching_setting' => 'caching.time',
        'route_caching' => true,
        'script_packing' => false,
    ];

    return $env;
}