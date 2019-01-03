<?php


namespace FileFilter\Storage\S3;

class S3Config
{
    private $key;
    
    private $secret;
    
    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getSecret() {
        return $this->secret;
    }
}
