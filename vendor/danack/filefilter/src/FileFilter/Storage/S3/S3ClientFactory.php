<?php

namespace FileFilter\Storage\S3;

use Aws\S3\S3Client;

class S3ClientFactory
{
    private $s3Config;
    
    function __construct(S3Config $s3Config)
    {
        $this->s3Config = $s3Config;
    }

    /**
     * @param bool $region
     * @return S3Client
     */
    function createClient($region = false)
    {
        $params = [
            'key'    => $this->s3Config->getKey(),
            'secret' => $this->s3Config->getSecret()
        ];

        if ($region) {
            $params['region'] = $region;
        }
        
        return \Aws\S3\S3Client::factory($params);
    }
}
