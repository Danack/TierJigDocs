<?php

function getAppEnv() {
    static $env = [
        'jig_compilecheck' => 'COMPILE_CHECK_MTIME',
        'caching_setting' => 'caching.revalidate',
        'route_caching' => false,
        'script_packing' => false,
    ];

    return $env;
}
