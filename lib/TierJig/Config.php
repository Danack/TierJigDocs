<?php


namespace TierJig;


class Config {

    const GITHUB_ACCESS_TOKEN = 'github_access_token';
    const GITHUB_REPO_NAME = 'github_repo_name';
    
    //Server container
    const AWS_SERVICES_KEY = 'aws_services_key';
    const AWS_SERVICES_SECRET = 'aws_services_secret';
    
    
    const LIBRATO_KEY = 'librato_key';
    const LIBRATO_USERNAME = 'librato_username';
    const LIBRATO_STATSSOURCENAME = 'librato_stats_source_name';

    const JIG_COMPILE_CHECK = 'jig_compilecheck';

    const DOMAIN_CANONICAL = 'domain_canonical';
    const DOMAIN_CDN_PATTERN= 'domain_cdn_pattern';
    const DOMAIN_CDN_TOTAL= 'domain_cdn_total';

    const CACHING_SETTING = 'caching_setting';
    const ROUTE_CACHING = 'route_caching';
    
    const SCRIPT_VERSION = 'script_version';
    const SCRIPT_PACKING = 'script_packing';
    
    
    private $values = [];

    public function __construct()
    {
        $this->values = [];
        $this->values = array_merge($this->values, \getAppEnv());

        // If someone has not setup a keys file, don't try and call getAppKeys
        if (function_exists('getAppKeys')) {
            $this->values = array_merge($this->values, getAppKeys());
        }
    }

    public function getKey($key)
    {
        if (array_key_exists($key, $this->values) == false) {
            throw new \Exception("Missing config value of $key");
        }

        return $this->values[$key];
    }

    public function getKeyWithDefault($key, $default)
    {
        if (array_key_exists($key, $this->values) === false) {
            return $default;
        }

        return $this->values[$key];
    }
}

