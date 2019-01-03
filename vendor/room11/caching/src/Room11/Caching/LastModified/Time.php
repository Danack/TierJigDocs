<?php

namespace Room11\Caching\LastModified;

use Room11\Caching\LastModifiedStrategy;

class Time implements LastModifiedStrategy
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
        $headers = [];
        $expiresTimeStamp = gmdate("D, d M Y H:i:s", time() + $this->seconds_to_cache) . " UTC";

        $headers["Expires"] = $expiresTimeStamp;
        $headers["Pragma"] = "cache";
        
        // max-age = browser max age
        // s-maxage = intermediate (cache e.g. CDN)
        $headers["Cache-Control"] = sprintf(
            //TODO - this is only appropriate for non-logged in content
            // should the 'public' be passed in as a flag.
            "no-transform,public,max-age=%s,s-maxage=%s",
            $this->seconds_to_cache,
            $this->secondsForCDNToCache
        );
        
        return $headers;
    }
}
