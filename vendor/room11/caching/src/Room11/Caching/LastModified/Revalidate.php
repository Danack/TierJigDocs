<?php

namespace Room11\Caching\LastModified;

use Room11\Caching\LastModifiedStrategy;

class Revalidate implements LastModifiedStrategy
{
    private $seconds_to_cache;
    private $secondsForCDNToCache;
    
    public function __construct($seconds_to_cache, $secondsForCDNToCache)
    {
        $this->seconds_to_cache = $seconds_to_cache;
        $this->secondsForCDNToCache = $secondsForCDNToCache;
    }
    
    public function getHeaders($lastModifiedTime)
    {
        $expiresTimeStamp = gmdate("D, d M Y H:i:s", time() + $this->seconds_to_cache) . " UTC";

        $headers["Expires"] = $expiresTimeStamp;
        $headers['Last-Modified'] = gmdate('D, d M Y H:i:s', $lastModifiedTime). ' UTC';

        // max-age = browser max age
        // s-maxage = intermediate (cache e.g. CDN)
        $headers["Cache-Control"] = sprintf(
            //TODO - this is only appropriate for non-logged in content
            //should people be able to pass in a flag for 'publicness'
            // or should it be a separate caching strategy?
            "no-transform,must-revalidate,public,max-age=%s,s-maxage=%s",
            $this->seconds_to_cache,
            $this->secondsForCDNToCache
        );

        return $headers;
    }
}
