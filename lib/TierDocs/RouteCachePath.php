<?php

namespace TierDocs;

/**
 * Class JigCompilePath
 *
 * The path that templates which are compiled into PHP files should be written
 */
class RouteCachePath
{
    private $path;

    public function __construct($path)
    {
        if ($path === null) {
            throw new \Exception(
                "Path cannot be null for class RouteCachePath"
            );
        }
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }
}
