<?php

namespace JigDocs;

/**
 * Class JigCompilePath
 *
 * The path that templates which are compiled into PHP files should be written
 */
class TestFixturesPath
{
    private $path;

    public function __construct($path)
    {
        if ($path === null) {
            throw new \Exception(
                "Path cannot be null for class TestFixturesPath"
            );
        }
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }
}
