<?php

// This is a sample configuration file

use TierJig\Config;
use Configurator\ConfiguratorException;
use Jig\Jig;
use Room11\Caching\LastModifiedStrategy;

$default = [
    'app_name' => 'tierjigdocs',
    'app_sitename' => 'tierjigdocs',
    'nginx_sendFile' => 'off',
    Config::SCRIPT_VERSION => date('jmyhis')
];


$live = [];
$dev = [];

$live['nginx_sendFile'] = 'on';


// What cache setting to use for assets
$live[Config::CACHING_SETTING] = LastModifiedStrategy::CACHING_TIME;;
$dev[Config::CACHING_SETTING] = LastModifiedStrategy::CACHING_REVALIDATE;

// Whether JS/CSS should be served packed together.
$live[Config::SCRIPT_PACKING] = true;
$live[Config::SCRIPT_PACKING] = false;

// What domain to use to generate absolute links
$live[Config::DOMAIN_CANONICAL] = 'phpjig.com';
$dev[Config::DOMAIN_CANONICAL] = 'phpjig.test';

$live[Config::ROUTE_CACHING] = true;
$dev[Config::ROUTE_CACHING] = false;

// Whether to recompile Jig templates 
$dev[Config::JIG_COMPILE_CHECK] = Jig::COMPILE_CHECK_MTIME;
$live[Config::JIG_COMPILE_CHECK] = Jig::COMPILE_CHECK_EXISTS;


$dev[Config::SCRIPT_PACKING] = false;
$live[Config::SCRIPT_PACKING] = true;

$evaluate = function ($config, $environment) {
    if (array_key_exists('app_name', $config) == false) {
        throw new ConfiguratorException("app.name isn't set for environment '$environment'.");
    }
    
    if (array_key_exists('phpfpm_socket_directory', $config) == false) {
        throw new ConfiguratorException("phpfpm_socket_directory isn't set for environment '$environment'.");
    }

    $phpfpm_socket_directory = $config['phpfpm_socket_directory'];
    $app_name = $config['app_name'];

    return [
        'phpfpm_socket_fullpath' => "$phpfpm_socket_directory/php-fpm-$app_name.sock"
    ]; 
};


$centos = [
    'nginx_log_directory' => '/var/log/nginx',
    'nginx_root_directory' => '/usr/share/nginx',
    'nginx_conf_directory' => '/etc/nginx',
    'nginx_run_directory ' => '/var/run',
    'nginx_user' => 'nginx',
    'nginx_sendFile' => 'on',
    
    'app_root_directory' => dirname(__DIR__),
    
    'phpfpm_www_maxmemory' => '16M',
    //'phpfpm_user' => $app_name,
    'phpfpm_group' => 'www-data',
    'phpfpm_socket_directory' => '/var/run/php-fpm',
    'phpfpm_conf_directory' => '/etc/php-fpm.d',
    'phpfpm_pid_directory' => '/var/run/php-fpm',

    'php_conf_directory' => '/etc/php',
    'php_log_directory' => '/var/log/php',
    'php_errorlog_directory' => '/var/log/php',
    'php_session_directory' => '/var/lib/php/session',
];

// Duplicate the environment for my local dev.
$centos_guest = $centos;