<?php

namespace Room11\Caching;

interface LastModifiedStrategy
{
    const CACHING_DISABLED = 'caching.disabled';
    const CACHING_REVALIDATE = 'caching.revalidate';
    const CACHING_TIME = 'caching.time';

    /**
     * Gets the appropriate caching headers based on the last modified time
     * 
     * @param $lastModified
     * @return mixed
     */
    public function getHeaders($lastModified);
}
