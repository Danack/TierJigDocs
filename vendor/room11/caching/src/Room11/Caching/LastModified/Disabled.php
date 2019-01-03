<?php

namespace Room11\Caching\LastModified;

use Room11\Caching\LastModifiedStrategy;

class Disabled implements LastModifiedStrategy
{
    public function getHeaders($lastModified)
    {
        return array(
            'Pragma' => 'no-cache',
            'Cache-Control' => 'no-transform, no-cache, no-store',
        );
    }
}
